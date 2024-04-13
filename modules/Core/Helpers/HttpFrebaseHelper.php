<?php
namespace Modules\Core\Helpers;

use Illuminate\Support\Facades\Http;
use Modules\User\app\Enum\FirebaseEnum;

class HttpFrebaseHelper{
    public $http;
    private $header = [
        "header" => [
            'Content-Type' => 'application/json',
        ],
    ];

    public function __construct()
    {
        $url = "https://identitytoolkit.googleapis.com";
        if(!$url){
            abort(500, "Vui long lien he nha cung cap");
        }
        $this->http = Http::baseUrl($url);
        $this->http->withHeaders($this->header);
    }
    
    public function post($url, $params){
        return $this->http->post($url, $params);
    }   
}
?>