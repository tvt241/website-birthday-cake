<?php

namespace Modules\Customer\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Customer\Enums\CustomerKeyLoginEnum;
use Modules\Customer\Http\Requests\LoginCustomerRequest;

class LogoutController extends Controller
{
    public function logout(){
        auth()->logout();
        return redirect()->route("login");
    }
}
