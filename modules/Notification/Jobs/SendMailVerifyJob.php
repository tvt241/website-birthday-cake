<?php

namespace Modules\Notification\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Modules\Customer\Models\Customer;
use Modules\Customer\Models\OtpSms;

class SendMailVerifyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $customer;

    public function __construct($customerId)
    {
        $customer = Customer::find($customerId);
        $this->customer = $customer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $otp = rand(100000, 999999);
        $token = Hash::make($otp);
        $url = route("reset_password", ["email" => $this->customer->email, "token" => $token]);
        $data = [
            "email" => $this->customer->email,
            "otp" => $otp,
            "token" => $token,
        ];
        OtpSms::create($data);

        $data["url"] = $url;
        $data["name"] = $this->customer->username;
        Mail::send("notification::mail.mail-verify", $data, function($message){
            $message->to($this->customer->email)->subject("Bạn đã quên mật khẩu?");
        }); 
        
    }
}
