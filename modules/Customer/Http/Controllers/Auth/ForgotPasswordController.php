<?php

namespace Modules\Customer\Http\Controllers\Auth;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Core\Services\SendOtp\FirebaseOtpService;
use Modules\Core\Traits\ResponseTrait;
use Modules\Customer\Enums\CustomerKeyLoginEnum;
use Modules\Customer\Events\CustomerForgotPasswordByPhoneEvent;
use Modules\Customer\Http\Requests\Auth\ForgotPasswordRequest;
use Modules\Customer\Models\Customer;
use Modules\Customer\Models\OtpSms;
use Modules\Notification\Jobs\SendMailVerifyJob;
use Modules\Notification\Jobs\SendSmsVerifyJob;

class ForgotPasswordController extends Controller
{

    use ResponseTrait;

    public function index()
    {
        return view("customer::pages.auth.forgot-password");
    }

    public function checkUser(ForgotPasswordRequest $request)
    {
        $key = "phone";
        if(filter_var($request->username, FILTER_VALIDATE_EMAIL)){
            $key = "email";
        }
        $customer = Customer::where([
            $key => $request->username,
            "social" => null
        ])->first();

        if(!$customer){
            $message = CustomerKeyLoginEnum::getValue($key) . " chưa được đăng ký trên hệ thống";
            return back()->with("error", $message);
        }
        
        if($key == "phone"){
            SendSmsVerifyJob::dispatch($request->username, $request->recaptcha_token);
        }
        else{
            SendMailVerifyJob::dispatch($customer->id);
        }
        session()->put("send_verify_at", now());

        return redirect()
            ->route("confirm_otp", [$key => $request->username])
            ->with("success", "Mã xác nhận đã được gửi đến bạn");
    }

    public function confirmOtp()
    {
        return view("customer::pages.auth.confirm-otp");
    }

    public function resendOtp(Request $request){
        $key = "phone";
        if(filter_var($request->username, FILTER_VALIDATE_EMAIL)){
            $key = "email";
        }
        $otp = OtpSms::where([
            $key => $request->username,
        ])->first();

        if(!$otp){
            $message = CustomerKeyLoginEnum::getValue($key) . " không hợp lệ";
            return $this->ErrorResponse($message);
        }

        if(now()->addMinutes(-2) < $otp->created_at){
            $message = "Vui lòng đợi gửi lại sau 1 phút.";
            return $this->ErrorResponse($message);
        }

        $otp->delete();

        if($key == "phone"){
            SendSmsVerifyJob::dispatch($request->username, $request->recaptcha_token);
        }
        else{
            SendMailVerifyJob::dispatch($request->username);
        }
        session()->put("send_verify_at", now());

        return $this->SuccessResponse([]);
    }

    public function checkInvalidOtp(Request $request, FirebaseOtpService $firebaseOtpService){
        $key = "phone";
        if(filter_var($request->username, FILTER_VALIDATE_EMAIL)){
            $key = "email";
        }
        $otp = OtpSms::where([
            $key => $request->username,
        ])->first();

        if(!$otp){
            $message = CustomerKeyLoginEnum::getValue($key) . " không hợp lệ";
            return back()->withInput()->with("error", $message);
        }

        if($key == "phone"){
            if(now()->addMinutes(-2) > $otp->created_at){
                $message = "Mã xác thực đã hết hạn! Vui lòng nhấn nhấn gửi lại mã xác nhận";
                return back()->withInput()->with("error", $message);
            }
            $result = $firebaseOtpService->confirmOtp($otp->token, $request->code);
            if(!$result["is_success"]){
                $message = "Mã xác nhận không đúng";
                return back()->withInput()->with("error", $message);
            }
        }
        else{
            if(now()->addMinutes(-15) >= $otp->created_at){
                $message = "Mã xác thực đã hết hạn! Vui lòng nhấn nhấn gửi lại mã xác nhận";
                return back()->withInput()->with("error", $message);
            }
            if($request->code != $otp->code){
                $message = "Mã xác nhận không đúng";
                return back()->withInput()->with("error", $message);
            }
        }
        return redirect()->route("reset_password", [ $key => $request->username, "token" => $otp->token ]);
    }
}
