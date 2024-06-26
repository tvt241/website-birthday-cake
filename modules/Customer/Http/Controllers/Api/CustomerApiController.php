<?php

namespace Modules\Customer\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Core\Traits\ResponseTrait;
use Modules\Customer\Models\Customer;
use Modules\Customer\Resources\CustomerResource;
use Illuminate\Validation\ValidationException;
use Modules\Core\Services\Image\ImageService;
use Modules\Customer\Http\Requests\CustomerActiveRequest;
use Modules\Customer\Http\Requests\StoreCustomerRequest;
use Modules\Customer\Http\Requests\Api\UpdateCustomerRequest;
use Modules\Customer\Resources\CustomerDetailsResource;
use Modules\Order\Enums\OrderStatusEnum;

class CustomerApiController extends Controller
{
    use ResponseTrait;
    public function index(Request $request)
    {
        $customers = Customer::query()->with(["image"])->latest()->paginate();
        $newItems = $customers->getCollection()->map(function ($user) {
            return new CustomerResource($user);
        });
        $customers->setCollection($newItems);
        return $this->SuccessResponse($customers);
    }

    public function store(StoreCustomerRequest $request, ImageService $imageService)
    {
        if(!$request->email && !$request->phone && !$request->username){
            throw ValidationException::withMessages(["username" => "Tối thiểu một trong ba trường: Tên đăng nhập, Email, SDT"]);
        }
        if($request->email){
            $customer = Customer::where("email", $request->email)->whereNull("social")->first();
            if($customer){
                throw ValidationException::withMessages(["email" => "Email đã được sử dụng"]);
            }
        }

        if($request->phone){
            $customer = Customer::where("phone", $request->phone)->whereNull("social")->first();
            if($customer){
                throw ValidationException::withMessages(["phone" => "Số điện thoại đã được sử dụng"]);
            }
        }
        $customer = $request->validated();
        if(!$request->password){
            $customer["password"] = "12345678";
        }
        if(!$request->username){
            $customer["username"] = uniqid();
        }

        $customer = Customer::create($customer);

        if($request->image){
            $imageService->store($request->image, $customer, "customers");
        }
        return $this->SuccessResponse();
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 404);
        }
        return $this->SuccessResponse(new CustomerDetailsResource($customer));
    }

    public function update(UpdateCustomerRequest $request, $id, ImageService $imageService)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return $this->ErrorResponse(message: __("No Results Found."));
        }
        DB::beginTransaction();
        try {
            $data = $request->validated();
            if(!$request->password){
                $data = $request->except("password");
            }
            $customer->update($data);
            if($request->image){
                $imageService->update($request->image, $customer, "users");
            }
            DB::commit();
            return $this->SuccessResponse();
        } catch (\Exception $th) {
            DB::rollBack();
            return $this->ErrorResponse($th->getMessage());
        }
    }

    public function changeActive(CustomerActiveRequest $request, $id)
    {
        $post = Customer::find($id);
        if (!$post) {
            return $this->ErrorResponse(message: __("No Results Found."));
        }
        $post->update(["is_active" => $request->is_active]);
        return $this->SuccessResponse();
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id, ImageService $imageService)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return $this->ErrorResponse(message: __("No Results Found."));
        }
        $order = $customer->order()->where("status", "<>", OrderStatusEnum::COMPLETED)->count();
        if($order){
            return $this->ErrorResponse("Khách hàng đang có đơn hàng chưa hoàn thành");
        }
        $imageService->destroy($customer);
        $customer->carts->delete();
        $customer->delete();
        return $this->SuccessResponse();
    }
}
