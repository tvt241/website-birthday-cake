<?php
namespace Modules\Order\Services\Shipping;

use Modules\Core\Helpers\HttpGhnHelper;
use Modules\Core\Traits\ResponseTrait;

class ShippingGhnService implements IShippingService
{
    use ResponseTrait;
    protected $http;
    public function __construct(HttpGhnHelper $httpGhnHelper)
    {
        $this->http = $httpGhnHelper;
    }
    public function getServices($district_code){
        $url = "shiip/public-api/v2/shipping-order/available-services";
        $data = [
            "shop_id" => "189809", 
            "from_district" => "3440", 
            "to_district" => $district_code, 
        ];
        $response = $this->http->post($url, $data);

    }

    public function getFee($order, $orderDetails, $district_code, $ward_code,  $service = 2){
        $url = "shiip/public-api/v2/shipping-order/fee";

        $items = [
            [
                "name" =>  "TEST1",
                "quantity" =>  1,
                "height" =>  200,
                "weight" =>  1000,
                "length" =>  200,
                "width" =>  200
            ]
        ];

        $data = [
            "service_type_id" => $service,
            "from_district_id" => 3440,
            "to_district_id" => (int) $district_code,
            "to_ward_code" => (string) $ward_code,
            "height" => 20,
            "length" => 30,
            "weight" => 3000,
            "width" => 40,
            "insurance_value" => 0, 
            "coupon" =>  null,
            "items" => $items
        ];

        $response = $this->http->postWithShopId($url, $data);
        $result = $response->object();
        if($result->code != 200){
            return $this->ErrorResponse($result->message);
        }
        
        return $this->SuccessResponse($result->data);
    }
}