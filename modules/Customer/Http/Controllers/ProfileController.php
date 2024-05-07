<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Services\Image\ImageService;
use Modules\Customer\Enums\CustomerStatusEnum;
use Modules\Customer\Http\Requests\UpdateCustomerRequest;
use Modules\Order\Enums\OrderStatusEnum;
use Modules\Order\Models\Order;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $orders = Order::where("user_id", $user->id)->latest()->paginate();

        $orderTotalCount = Order::where([
            ["user_id", "=", $user->id],
        ])->count();

        $orderPendingCount = Order::where([
            ["user_id", "=", $user->id],
            ["status", ">=", OrderStatusEnum::START_ORDER_PENDING],
            ["status", "<=", OrderStatusEnum::END_ORDER_PENDING],
        ])->count();

        $orderDoneCount = Order::where([
            ["user_id", "=", $user->id],
            ["status", ">=", OrderStatusEnum::START_ORDER_COMPLETE],
            ["status", "<=", OrderStatusEnum::END_ORDER_COMPLETE],
        ])->count();
        
        $orderCancelCount = Order::where([
            ["user_id", "=", $user->id],
            ["status", ">=", OrderStatusEnum::START_ORDER_ERROR],
            ["status", "<=", OrderStatusEnum::END_ORDER_ERROR],
        ])->count();

        return view("customer::pages.profile.index", [
            "user" => $user,
            "orders" => $orders,
            "order_total_count" => $orderTotalCount,
            "order_pending_count" => $orderPendingCount,
            "order_done_count" => $orderDoneCount,
            "order_cancel_count" => $orderCancelCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('customer::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('customer::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit()
    {
        return view("customer::pages.profile.update");
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateCustomerRequest $request, ImageService $imageService)
    {
       $data = $request->except(["is_active", "password"]);
       $customer = auth()->user();
       if($request->image){
            $imageService->update($request->image, $customer, "customer");
       }
       $customer->update($data);
       return redirect()->route("profile.index");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function delete()
    {
        auth()->user()->update(["is_active", CustomerStatusEnum::DELETE->value]);
        auth()->logout();
        return redirect()->route("login")->with("success", "Tài khoản của bạn sẽ được xóa sau 30 ngày");
    }
}
