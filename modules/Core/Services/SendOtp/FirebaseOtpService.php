<?php
namespace Modules\Core\Services\SendOtp;

use Illuminate\Support\Facades\Http;
use Modules\Core\Helpers\HttpFrebaseHelper;
use Modules\User\app\Enum\FirebaseEnum;

class FirebaseOtpService implements ISendOtpService
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
                return [
                    "is_success" => false,
                    "data" => $message
                ];
            }
            return [
                "is_success" => true,
                "data" => $result->sessionInfo
            ];
        } catch (\Exception $e) {
            return [
                "is_success" => false,
                "data" => $e->getMessage()
            ];
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
            if (isset($result->error)) {
                $message = explode(" ",$result->error->message);
                return [
                    "is_success" => false,
                    "data" => $message
                ];
            }
            return [
                "is_success" => true,
            ];
        } catch (\Exception $e) {
            return [
                "is_success" => false,
                "data" => $e->getMessage()
            ];
        }
    }
}
?>