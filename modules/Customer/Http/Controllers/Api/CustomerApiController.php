<?php

namespace Modules\Customer\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Core\Traits\ResponseTrait;
use Modules\Customer\Enums\CustomerKeyLoginEnum;
use Modules\Customer\Http\Requests\LoginCustomerRequest;
use Modules\Customer\Models\Customer;
use Modules\Customer\Resources\CustomerResource;
use Illuminate\Validation\ValidationException;
use Modules\Core\Services\Image\ImageService;
use Modules\Customer\Http\Requests\StoreCustomerRequest;
use Modules\Order\Enums\OrderStatusEnum;

class CustomerApiController extends Controller
{
    use ResponseTrait;
    public function index(Request $request)
    {
        $customers = Customer::query()->with(["image"])->paginate();
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
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        return $this->SuccessResponse(new CustomerResource($customer));
    }

    public function update(Request $request, $id, ImageService $imageService)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        DB::beginTransaction();
        try {
            $customer->update($request->validated());
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

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id, ImageService $imageService)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
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
