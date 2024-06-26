<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customer\Enums\CustomerStatusEnum;
use Modules\Order\Enums\PaymentStatusEnum;
use Modules\Order\Models\Order;
use Modules\Order\Models\Payment;
use Modules\Order\Services\PaymentService\VnPayService;
use Modules\Product\Models\ProductItem;
use PDO;

class PaymentController extends Controller
{
    public function payment(Request $request){
        $data = [];
        $data["payment_status"] = PaymentStatusEnum::DONE;
        $message = "Thanh toán đơn hàng thành công. Cảm ơn bạn đã sử dụng website của chúng tôi";

        switch ($request->name) {
            case 'VNPAY':
                $payment = [
                    "name" => "VNPAY",
                    "value" => json_encode($request->except(["name", "vnp_SecureHash"]))
                ];
                Payment::create($payment);
                if($request->vnp_ResponseCode != "00" || $request->vnp_TransactionStatus != "00"){
                    $message = "Thanh toán thất bại! Bạn có thể thanh toán lại sau hoặc liên hệ nhà cung cấp để chuyển trang SHIP COD";
                    return redirect()->route("orders.index", ["code" => $request->vnp_OrderInfo])->with("error", $message);
                }

                $order = Order::where("order_code", $request->vnp_OrderInfo)->first();
                if(!$order){
                    $message = "Không tìm thấy đơn hàng. Vui lòng liên hệ nhà cung cấp";
                    return redirect()->route("orders.index", ["code" => $request->vnp_OrderInfo])->with("error", $message);
                }
                if($order->amount != $request->vnp_Amount / 100){ 
                    $data["payment_status"] = PaymentStatusEnum::LACK;
                    $message = "Ồ có vẻ như bạn đã thanh toán thiếu! Bạn nên thanh toán nốt phần tiền còn thiếu";
                    $order->update($data);
                    return redirect()->route("orders.index", ["code" => $request->vnp_OrderInfo])->with("message", $message);
                }
                break;
            default:
                # code...
                break;
        }
        $orderDetails = $order->orderDetails;
        $isLogin = auth()->check();
        if(!$isLogin || $isLogin && auth()->user()->is_active != CustomerStatusEnum::VERIFIED->value){
            foreach($orderDetails as $orderDetail){
                $productItem = ProductItem::find($orderDetail->product_item_id);
                $productItem->available -= $orderDetail->quantity;
                $productItem->save();
            }
        }
        $order->update($data);
        return redirect()->route("orders.index", ["code" => $request->vnp_OrderInfo])->with("message", $message);
    }
}
