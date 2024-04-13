<?php
namespace Modules\Core\Services\SendOtp;

interface ISendOtpService{
    public function sendOtp($phoneNumber, $token);
    public function confirmOtp($sessionInfo, $code);
}
?>