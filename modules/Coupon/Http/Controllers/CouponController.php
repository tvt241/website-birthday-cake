<?php

namespace Modules\Coupon\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\ResponseTrait;
use Modules\Coupon\Http\Requests\UseCouponRequest;
use Modules\Coupon\Models\Coupon;

class CouponController extends Controller
{
    use ResponseTrait;
    
    public function check(UseCouponRequest $request){
        $coupon = Coupon::where("code", $request->code)->first();
        if(!$coupon){
            return $this->ErrorResponse("Mã giảm giá không đúng hoặc đã hết hạn");
        }
        $data = $coupon->checkCouponInvalid($request->amount);
        if(!is_array($data)){
            return $this->ErrorResponse($data);
        }
        return $this->SuccessResponse($data);
    }
}
