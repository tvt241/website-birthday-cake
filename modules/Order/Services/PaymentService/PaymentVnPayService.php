<?php
namespace Modules\Order\Services\PaymentService;

class PaymentVnPayService implements IPaymentService
{

    // $vnp_Returnurl = "http://localhost/vnpay_php/vnpay_return.php";
    // $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
    // $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";

    private $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    private $vnp_HashSecret = "LJWXVAIGPCSWAJCIJNIDMQOFSVEMWSTS";
    private $vnp_TmnCode = "9VPAP1AM";

    public function secureHash($inputData){
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url = $this->vnp_Url . "?" . $query;
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $this->vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        return $vnp_Url;
    }

    public function create($order)
    {
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $this->vnp_TmnCode,
            "vnp_Amount" => $order->amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => request()->ip(),
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => $order->order_code,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => route("payment.index", ["name" => "VNPAY"]),
            "vnp_TxnRef" => rand(1,10000),
            "vnp_ExpireDate"=> now()->addMinutes(3)->format("YmdHis"),
        ];
        $vnp_Url = $this->secureHash($inputData);
        header('Location: ' . $vnp_Url);
        die();
    }
}