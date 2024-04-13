<?php
namespace Modules\Core\Services\SendOtp;

use Illuminate\Support\Facades\Http;
use Modules\Core\Helpers\HttpFrebaseHelper;
use Modules\User\app\Enum\FirebaseEnum;

class FirebaseSendOtpService implements ISendOtpService
{
    private $http;
    
    public function __construct(HttpFrebaseHelper $httpFrebaseHelper)
    {
        $this->http = $httpFrebaseHelper;
    }

    public function sendOtp($phoneNumber, $token){
        $url = "v1/accounts:sendVerificationCode?key=" . getenv("FIRE_API_KEY");
        $phoneNumberFomart = '+84' . substr($phoneNumber, 1);
        $data = [
            "phoneNumber" => $phoneNumberFomart,
            "recaptchaToken" => $token
        ];
        try {
            $response = $this->http->post($url, $data);
            $result = $response->object();
            if (isset($result->error)) {
                $message = explode(" ",$result->error->message);
                // $message = FirebaseEnum::getValue($message[0]) ?? "Vui lòng thử lại sau";
                return false;
            }
            return $result->sessionInfo;
        } catch (\Exception $e) {
            // session()->flash("error", "Nếu không nhận được mã, thử lại sau");
            return false;
        }
    }
    public function confirmOtp($sessionInfo, $code){
        $url = "v1/accounts:signInWithPhoneNumber?key=" . getenv("FIRE_API_KEY");
        $data = [
            "sessionInfo" => $sessionInfo,
            "code" => $code
        ];
        try {
            $response = $this->http->post($url, $data);
            $result = $response->object();
            if (isset($result->error)) { // INVALID_CODE
                // session()->flash("error", "Mã xác nhận không đúng, vui lòng thử lại");
                return false;
            }
            return true;
        } catch (\Exception $e) {
            // session()->flash("error", "Vui lòng thử lại sau");
            return false;
        }
    }
}
?>