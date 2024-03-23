<?php

namespace Modules\Core\Helpers;

use Illuminate\Support\Facades\Http;

class HttpHelperAuth
{
    public $http;
    public function __construct()
    {
        $url = env("APP_URL");
        if(!$url){
            abort(500, "Vui long lien he nha cung cap");
        }
        $this->http = Http::baseUrl($url);
    }

    public function get($url, $params){
        return $this->http->get($url, $params);
    }

    public function post($url, $data){
        return $this->http->post($url, $data);
    }

    public function put($url, $data){
        return $this->http->put($url, $data);
    }

    public function delete($url, $data){
        return $this->http->delete($url, $data);
    }
}