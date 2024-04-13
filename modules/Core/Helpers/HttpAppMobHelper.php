<?php

namespace Modules\Core\Helpers;

use Illuminate\Support\Facades\Http;
use stdClass;

class HttpAppMobHelper
{
    public $http;
    public $config;

    public function __construct() 
    {
        $setting = new stdClass;
        $setting->url = "https://vapi.vnappmob.com";
        $this->config = $setting;
        $this->http = Http::baseUrl($this->config->url);
    }

    function setToken($token)
    {
        $this->config->token = $token;
    }

    public function get($url, $array = [])
    {
        $headers = [
            'Content-Type' => 'application/json;',
        ];
        return $this->http->withHeaders($headers)->get($url, $array);
    }
}
