<?php

namespace Modules\Customer\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Modules\Customer\Enums\CustomerSocialEnum;
use Modules\Customer\Enums\CustomerStatusEnum;
use Modules\Customer\Models\Customer;
use Modules\Customer\Services\SocialService;

class SocialiteController extends Controller
{
    public $socialService;
    public function __construct(SocialService $socialService)
    {
        $this->socialService = $socialService;
    }

    public function redirect($social)
    {
        $socials = CustomerSocialEnum::getValues();
        if(!in_array($social, $socials)){
            return redirect()->route("login");
        }
        return Socialite::driver($social)->redirect();
    }

    public function login($social)
    {
        $socials = CustomerSocialEnum::getValues();
        if(!in_array($social, $socials)){
            return redirect()->route("login");
        }
        $info = Socialite::driver($social)->user();
        $social_value =  CustomerSocialEnum::getValue($social);
        $user = Customer::where("email", $info->email)->where("social", $social_value)->first();
        if (!$user) {
            $user = Customer::create([
                "username" => uniqid(),
                "name" => $info->name,
                "email" => $info->email,
                "social" => $social_value,
                "is_active" => CustomerStatusEnum::NOTVERIFIED->value
            ]);
        }
        Auth::loginUsingId($user->id);
        return redirect()->route("home");
       
    }
}
