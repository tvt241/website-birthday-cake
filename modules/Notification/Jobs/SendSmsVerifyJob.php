<?php

namespace Modules\Notification\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Core\Services\SendOtp\FirebaseOtpService;
use Modules\Customer\Models\OtpSms;

class SendSmsVerifyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $phone, $token;

    public function __construct($phone, $token)
    {
        $this->phone = $phone;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(FirebaseOtpService $firebaseOtpService)
    {
        $data = [
            "phone" => $this->phone
        ];

        $token = $firebaseOtpService->sendOtp($this->phone, $this->token);
        $data["token"] = $token["data"];
        OtpSms::create($data);
    }
}
