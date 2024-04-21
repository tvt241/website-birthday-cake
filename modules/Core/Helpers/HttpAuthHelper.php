<?php

namespace Modules\Core\Helpers;

use Illuminate\Support\Facades\Http;

class HttpAuthHelper
{
    public $http;
    public $form;
    public function __construct()
    {
        $url = "http://localhost:8001";
        // $url = env("APP_URL");
        if(!$url){
            abort(500, "Vui long lien he nha cung cap");
        }
        $clientId =  env("GRANT_CLIENT_ID");
        $clientSecret = env("GRANT_CLIENT_SECRET");
        if (!$clientId || !$clientSecret) {
            abort(500, "Vui lòng liên hệ nhà cung cấp");
        }
        $this->form["client_id"] = $clientId;
        $this->form["client_secret"] = $clientSecret;
        $this->form["scope"] = "";
        $this->http = Http::baseUrl($url);
    }

    public function get($url, $params){
        $form = array_merge($this->form, $params);
        return $this->http->get($url, $form);
    }

    public function post($url, $data){
        $form = array_merge($this->form, $data);
        return $this->http->post($url, $form);
    }

    public function put($url, $data){
        return $this->http->put($url, $data);
    }

    public function delete($url, $data){
        return $this->http->delete($url, $data);
    }
}