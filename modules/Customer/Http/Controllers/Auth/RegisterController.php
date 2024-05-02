<?php

namespace Modules\Customer\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Customer\Http\Requests\RegisterCustomerRequest;
use Modules\Customer\Models\Customer;

class RegisterController extends Controller
{
    public function register(){
        return view("customer::pages.auth.register");
    }

    public function handleRegister(RegisterCustomerRequest $request)
    {
        $customer = $request->validated();
        $customer["is_active"] = 1;
        $customer = Customer::create($customer);
        if(!$customer){
            $error = "Vui lòng thử lại sau";
            return back()->withInput()->with("error", $error);
        }
        Auth::loginUsingId($customer->id);
        return redirect()->route("home");
    }
}
