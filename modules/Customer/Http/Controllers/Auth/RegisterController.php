<?php

namespace Modules\Customer\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customer\Http\Requests\RegisterCustomerRequest;
use Modules\Customer\Models\Customer;

class RegisterController extends Controller
{
    public function register(){
        return view("customer::pages.auth.register");
    }

    public function handleRegister(RegisterCustomerRequest $request)
    {
        $customer = Customer::create($request->validated());
        if(!$customer){
            $error = "Vui lòng thử lại sau";
            return back()->withInput()->with("error", $error);
        }
        return redirect()->route("login");
    }
}
