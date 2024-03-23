<?php

namespace Modules\User\Http\Controllers\Auth;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\ResponseTrait;

class LoginApiController extends Controller
{
    use ResponseTrait;

    public $form;
    public $http;

    public function __construct()
    {
        $clientId =  env("GRANT_CLIENT_ID");
        $clientSecret = env("GRANT_CLIENT_SECRET");
        if (!$clientId || !$clientSecret) {
            abort(500, "Vui lòng liên hệ nhà cung cấp");
        }
        $this->form["client_id"] = $clientId;
        $this->form["client_secret"] = $clientSecret;
        $this->form["scope"] = "";
        $this->http = app("HttpHelperAuth");

    }
    public function login(Request $request)
    {
        $url = "oauth/token";

        $data = [
            'grant_type' => 'password',
            'username' => $request->username,
            'password' => $request->password,
        ];

        $this->form = array_merge($data, $this->form);

        $response = $this->http->post($url, $this->form);

        $status = $response->status();
        $result = $response->object();

        return $this->SuccessResponse($result, $result->message, $status);
    }

    public function refreshToken(Request $request)
    {
        $clientId =  env("GRANT_CLIENT_ID");
        $clientSecret = env("GRANT_CLIENT_SECRET");
        if (!$clientId || !$clientSecret) {
            abort(500, "Vui lòng liên hệ nhà cung cấp");
        }
        $data = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->refresh_token,
            'scope' => '',
        ];

        $response = Http::asForm()->post(env("APP_URL") . "/oauth/token", $data);

        $data = $response->object();
    }
}
