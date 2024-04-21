<?php

namespace Modules\Customer\Http\Controllers\Auth;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Customer\Enums\CustomerKeyLoginEnum;
use Modules\Customer\Http\Requests\LoginCustomerRequest;
use Modules\Customer\Models\Customer;

class LoginController extends Controller
{
    public function login(){
        return view("customer::pages.auth.login");
    }

    public function handleLogin(LoginCustomerRequest $request)
    {
        // $pattern = '/^(84|\+84|0)\d{9}$/';
        $key = "username";
        if(is_numeric($request->username)){
            $key = "phone";
        }
        else if(filter_var($request->username, FILTER_VALIDATE_EMAIL)){
            $key = "email";
        }
        $customer = Auth::guard("customer_web")->attempt([
            $key => $request->username,
            "password" => $request->password,
            "social" => null
        ]);
        if(!$customer){
            $error = CustomerKeyLoginEnum::getValue($key) . " hoặc mật khẩu không chính xác";
            return back()->withInput()->with("error", $error);
        }
        return redirect()->route("home");
    }
}
