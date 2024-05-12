<?php

namespace Modules\Order\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\ValidationException;
use Modules\Core\Traits\ResponseTrait;
use Modules\Coupon\Models\Coupon;
use Modules\Customer\Enums\CustomerStatusEnum;
use Modules\Customer\Models\Customer;
use Modules\Order\Enums\OrderChannelEnum;
use Modules\Order\Enums\OrderStatusEnum;
use Modules\Order\Enums\OrderTypeEnum;
use Modules\Order\Enums\PaymentMethodEnum;
use Modules\Order\Enums\PaymentStatusEnum;
use Modules\Order\Http\Requests\CheckOut\StoreOrderRequest;
use Modules\Order\Http\Requests\UpdateOrderRequest;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderDetail;
use Modules\Order\Resources\OrderDetailsResource;
use Modules\Order\Resources\OrderResource;
use Modules\Product\Models\ProductItem;
use Modules\Setting\Models\BusinessSetting;

class OrderApiController extends Controller
{
    use ResponseTrait;

    public function index(){
        $query = Order::query();
        $orders = $query->latest()->paginate();
        $newItems = $orders->getCollection()->map(function ($order) {
            return new OrderResource($order);
        });
        $orders->setCollection($newItems);
        return $this->SuccessResponse($orders);
    }

    public function store(StoreOrderRequest $request){
        DB::beginTransaction();
        try {
            $order = $request->validated();
            $order["payment_status"] = PaymentStatusEnum::DONE;
            $order["address"] = "--";
            if($request->order_type == OrderTypeEnum::SALES->value){
                $order["order_code"] = renderOrderCode("DBH");
                $companyAddress = BusinessSetting::where("group", "company")->where("key", "address")->first();
                $order["address2"] = $companyAddress->value;
                $order["status"] = OrderStatusEnum::COMPLETED;
            }
            else{ // đơn đặt hàng
                $order["order_code"] = renderOrderCode("DDH");
                $order["status"] = OrderStatusEnum::PROCESSING;
                if($request->payment_method == PaymentMethodEnum::COD->value){
                    $order["payment_status"] = PaymentStatusEnum::UNPAID;
                }
            }
            if($request->user_id){
                $customer = Customer::find($request->user_id);
                $order["name"] = $customer->name;
                $order["email"] = $customer->email;
                $order["phone"] = $customer->phone;
            }
            else{
                $order["name"] = "Khách lẻ";
                $order["phone"] = "0000000000";
            }

            $order["order_channel"] = OrderChannelEnum::POS;
            $order["coupon_value"] = 0;
            $order["total"] = 0;
            $orderDetails = [];
            foreach($request->products as $key => $cart){
                $productItem = ProductItem::find($cart["id"]);
                if(!$productItem){
                    DB::rollBack();
                    return redirect()->route("carts.index")->with("error", "Một vài sản phẩm đã hết hàng");
                }
                if($productItem->quantity < $cart["quantity"]){
                    DB::rollBack();
                    return redirect()->route("carts.index")->with("error", "Một vài sản phẩm đã hết hàng");
                }
                $order["total"] += $productItem->price * $cart["quantity"];
                $product = $productItem->product;
                $orderDetails[$key]["name"] = $product->name;
                $orderDetails[$key]["slug"] = $product->slug;
                $orderDetails[$key]["image"] = $product->image?->url;
                $orderDetails[$key]["price"] = $productItem->price;
                $orderDetails[$key]["price_import"] = $productItem->price_import;
                $orderDetails[$key]["quantity"] = $cart["quantity"];
                $orderDetails[$key]["product_item_id"] = $cart["id"];
                $orderDetails[$key]["info"] = $productItem->variation_string;
                $productItem->available -= $cart["quantity"];
                $productItem->save();
            }
            if($request->coupon_code){
                $coupon = Coupon::where("code", $request->coupon_code)->first();
                if(!$coupon){
                    return back()->withInput()->with('error', "Mã giảm giá không hợp lệ hoặc đã hết hạn");
                }
                $valueDiscount = $coupon->checkCouponInvalid($order["total"]);
                if(!is_array($valueDiscount)){
                    return back()->withInput()->with("error", $valueDiscount);
                }
                
                $order["coupon_value"] = $valueDiscount["value"];
                $order["coupon_id"] = $coupon->id;

                $coupon->available -= 1;
                $coupon->budget_available -= $valueDiscount["value"];
                $coupon->save();
            }

            $order["shipping_price"] = 0;
            $order["amount"] = $order["total"] + $order["shipping_price"] - $order["coupon_value"];
            if($order["amount"] < 0){
                $order["amount"] = 0;
            }

            $orderNew = Order::create($order);
            foreach($orderDetails as $key => $orderDetail){
                $orderDetails[$key]["order_id"] = $orderNew->id;
            }
            OrderDetail::insert($orderDetails);
            DB::commit();
            $data = [
                "order_code" => $orderNew->order_code
            ];
            return $this->SuccessResponse($data);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with("error", "Vui lòng thử lại sau");
        }
    }

    public function show(Request $request, $id){
        $order = Order::with("orderDetails")->find($id);
        if(!$order){
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        return $this->SuccessResponse(new OrderDetailsResource($order));
    }

    public function update(UpdateOrderRequest $request, $id){
        $order = Order::find($id);
        if(!$order){
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        $order->update($request->validated());
        return $this->SuccessResponse();
    }

    public function delete(Request $request, $id){
        $order = Order::find($id);
        if(!$order){
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        $order->delete();
        return $this->SuccessResponse();
    }

    public function keys(Request $request){
        $key = $request->key;
        switch ($key) {
            case 'OrderStatusEnum':
                $enums = OrderStatusEnum::getValues();
                break;
            case 'OrderTypeEnum':
                $enums = OrderTypeEnum::getValues();
                break;
            case 'PaymentMethodEnum':
                $enums = PaymentMethodEnum::getValues();
                break;
            case 'PaymentStatusEnum':
                $enums = PaymentStatusEnum::getValues();
                break;
            default:
                $enums = [];
                break;
        }
        return $this->SuccessResponse($enums);
    }

    public function updateStatus(Request $request, $id){
        $order = Order::find($id);
        if(!$order){
            return $this->ErrorResponse("Đơn hàng không tồn tại");
        }
        if($order->status >= OrderStatusEnum::START_ORDER_COMPLETE && $order->status <= OrderStatusEnum::END_ORDER_COMPLETE){
            return $this->ErrorResponse("Đơn hàng đã hoàn thành");
        }

        if($order->status >= OrderStatusEnum::START_ORDER_ERROR && $order->status <= OrderStatusEnum::END_ORDER_ERROR){
            return $this->ErrorResponse("Đơn hàng đã hoàn thành");
        }

        if($order->status != OrderStatusEnum::PENDING->value && $request->value == OrderStatusEnum::PENDING->value){
            return $this->ErrorResponse("Đơn hàng đã được duyệt");
        }

        if($order->status == OrderStatusEnum::PENDING->value && $request->value < OrderStatusEnum::START_ORDER_ERROR){
            DB::beginTransaction();
            try {
                if($order->user_id){
                    $customer = Customer::find($order->user_id);
                    if(!$customer){
                        return $this->ErrorResponse("Người dùng không tồn tại trên hệ thống");
                    }
                    if($customer->is_active == CustomerStatusEnum::VERIFIED->value){
                        $order->status = $request->value;
                        $order->save();
                        return $this->SuccessResponse();
                    }
                }
                $orderDetails = $order->orderDetails;
                foreach($orderDetails as $orderDetail){
                    $productItem = ProductItem::find($orderDetail->product_item_id);
                    if(!$productItem){
                        DB::rollBack();
                        return $this->ErrorResponse("Sản phẩm $orderDetail->name - $orderDetail->info không tồn tại trên hệ thống");
                    }
                    $productItem->available -= $orderDetail->quantity;
                    $productItem->save();
                }
                DB::commit();
                $order->status = $request->value;
                $order->save();
                return $this->SuccessResponse();
            } catch (\Exception $e) {
                DB::rollBack();
                return $this->ErrorResponse($e->getMessage());
            }
        }

        if($order->status == OrderStatusEnum::PENDING->value && $request->value >= OrderStatusEnum::START_ORDER_ERROR){
            DB::beginTransaction();
            try {
                if($order->user_id){
                    $customer = Customer::find($order->user_id);
                    if(!$customer){
                        return $this->ErrorResponse("Người dùng không tồn tại trên hệ thống");
                    }
                    if($customer->is_active == CustomerStatusEnum::VERIFIED->value){
                        $orderDetails = $order->orderDetails;
                        foreach($orderDetails as $orderDetail){
                            $productItem = ProductItem::find($orderDetail->product_item_id);
                            if(!$productItem){
                                DB::rollBack();
                                return $this->ErrorResponse("Sản phẩm $orderDetail->name - $orderDetail->info không tồn tại trên hệ thống");
                            }
                            $productItem->available += $orderDetail->quantity;
                            $productItem->save();
                        }
                        DB::commit();
                    }
                }
                $order->status = $request->value;
                $order->save();
                return $this->SuccessResponse();
            } catch (\Exception $e) {
                DB::rollBack();
                return $this->ErrorResponse($e->getMessage());
            }
        }

        if($order->status > OrderStatusEnum::START_ORDER_PENDING && $order->status < OrderStatusEnum::END_ORDER_PENDING && $request->value >= OrderStatusEnum::START_ORDER_ERROR){
            DB::beginTransaction();
            try {
                $orderDetails = $order->orderDetails;
                foreach($orderDetails as $orderDetail){
                    $productItem = ProductItem::find($orderDetail->product_item_id);
                    if(!$productItem){
                        DB::rollBack();
                        return $this->ErrorResponse("Sản phẩm $orderDetail->name - $orderDetail->info không tồn tại trên hệ thống");
                    }
                    $productItem->available += $orderDetail->quantity;
                    $productItem->save();
                }
                DB::commit();
                $order->status = $request->value;
                $order->save();
                return $this->SuccessResponse();
            } catch (\Exception $e) {
                DB::rollBack();
                return $this->ErrorResponse($e->getMessage());
            }
        }
        
        $order->status = $request->value;
        $order->save();
        return $this->SuccessResponse();
    }

    public function updateStates(Request $request, $id){
        $order = Order::find($id);
        if(!$order){
            return $this->ErrorResponse("Đơn hàng không tồn tại");
        }
        if($order->status >= OrderStatusEnum::START_ORDER_COMPLETE && $order->status <= OrderStatusEnum::END_ORDER_COMPLETE){
            return $this->ErrorResponse("Đơn hàng đã hoàn thành");
        }

        if($order->status >= OrderStatusEnum::START_ORDER_ERROR && $order->status <= OrderStatusEnum::END_ORDER_ERROR){
            return $this->ErrorResponse("Đơn hàng đã hoàn thành");
        }

        $key = $request->key;
        if(!isset($order->$key)){
            return $this->ErrorResponse("Dữ liệu truyền lên không hợp lệ");
        }
        $order->$key = $request->value;
        $order->save();
        return $this->SuccessResponse();

    }
}
