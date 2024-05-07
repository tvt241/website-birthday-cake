<?php

namespace Modules\Customer\Http\Controllers\Auth;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Customer\Enums\CustomerKeyLoginEnum;
use Modules\Customer\Enums\CustomerStatusEnum;
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
        $customer = Customer::where([
            [$key, $request->username],
            ["social", null],
        ])->first();
        if(!$customer){
            $error = CustomerKeyLoginEnum::getValue($key) . " hoặc mật khẩu không chính xác";
            return back()->withInput()->with("error", $error);
        }
        if(!Hash::check($request->password, $customer->password)){
            $error = CustomerKeyLoginEnum::getValue($key) . " hoặc mật khẩu không chính xác";
            return back()->withInput()->with("error", $error);
        }
        if($customer->is_active == CustomerStatusEnum::BLOCK->value){
            $error = "Tài khoản của bạn đã bị khóa vui lòng liên hệ nhà cung cấp!";
            return back()->withInput()->with("error", $error);
        }
        if($customer->is_active == CustomerStatusEnum::DELETE->value){
            $customer->is_active = CustomerStatusEnum::NOTVERIFIED->value;
            $customer->save();
        }
        Auth::loginUsingId($customer->id);
        return redirect()->route("home");
    }
}
