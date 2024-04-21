<?php

namespace Modules\Customer\Http\Controllers\Auth;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Customer\Models\Customer;
use Modules\Customer\Models\OtpSms;

class ResetPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function resetPassword(Request $request)
    {
        $token = $request->token;
        $key = null;
        if($value = $request->email){
            $key = "email";
        }
        if($value = $request->phone){
            $key = "phone";
        }
        if(!$token){
            if(!$key){
                return redirect()->route("forgot_password");
            }
            return redirect()->route("confirm_otp", [$key => $value]);
        }
        return view("customer::pages.auth.reset-password");
    }

    public function updatePassword(Request $request){
        $token = $request->token;
        $key = "phone";
        if(filter_var($request->username, FILTER_VALIDATE_EMAIL)){
            $key = "email";
        }
        if(!$token){
            return redirect()->route("confirm_otp", [$key => $request->username]);
        }
        $otp = OtpSms::where([
            "token" => $token,
            $key => $request->username
        ])->first();
        if(!$otp){
            return redirect()->route("confirm_otp", [$key => $request->username]);
        }

        $customer = Customer::where([
            $key => $request->username,
            "social" => null
        ])->first();

        $customer->update(["password" => $request->password]);
        $otp->delete();

        return redirect()->route("login")->with("success", "Bạn đã có thể đăng nhập với mật khẩu mới");
    }
}
