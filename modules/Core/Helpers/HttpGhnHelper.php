<?php

namespace Modules\Core\Helpers;

use Illuminate\Support\Facades\Http;
use stdClass;

class HttpGhnHelper
{
    public $http;
    public $config;

    public function __construct() 
    {
        $setting = new stdClass;
        $setting->url = "https://dev-online-gateway.ghn.vn";
        $setting->token = "1a6d88b7-68d0-11ee-b1d4-92b443b7a897";
        $setting->shop_id = "189809";
        $this->config = $setting;
        $this->http = Http::baseUrl($this->config->url);
    }

    function setToken($token)
    {
        $this->config->token = $token;
    }

    public function postWithShopId($url, $array)
    {
        $headers = [
            'Content-Type' => 'application/json; charset=utf-8',
            'ShopId' => $this->config->shop_id,
            'Token' => $this->config->token,
        ];
        return $this->http->withHeaders($headers)->post($url, $array);
    }

    public function post($url, $array)
    {
        $headers = [
            'Content-Type' => 'application/json; charset=utf-8',
            'Token' => $this->config->token,
        ];
        return $this->http->withHeaders($headers)->post($url, $array);
    }

    

    // function postPrintDeliveryGhn($data)
    // {
    //     $url = "/shiip/public-api/v2/a5/gen-token";
    //     $response = $this->post($url, $data);
    //     return $response;
    // }

    // public function checkInvalidToken($token, $shopId)
    // {
    //     $url = "/shiip/public-api/v2/shop/all";
    //     $this->setToken($token);
    //     $array = [
    //         "limit" => 50,
    //         "client_phone" => ""
    //     ];
    //     try {
    //         $info = $this->post($url, $array);
    //     } catch (\Throwable $th) {
    //         return "Token không hợp lệ";
    //     }
    //     foreach ($info->data->shops as $shop) {
    //         if ($shop->_id == $shopId) {
    //             return true;
    //         }
    //     }
    //     return "Mã shop không hợp lệ";
    // }

}
