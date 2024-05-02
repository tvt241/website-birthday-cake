<?php

namespace Modules\Coupon\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Modules\Core\Traits\ResponseTrait;
use Modules\Coupon\Enums\CouponDiscountTypeEnum;
use Modules\Coupon\Http\Requests\StoreCouponRequest;
use Modules\Coupon\Models\Coupon;
use Modules\Coupon\Resources\CouponResource;

class CouponApiController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $coupons = Coupon::paginate();
        $newItems = $coupons->getCollection()->map(function ($coupon) {
            return new CouponResource($coupon);
        });
        $coupons->setCollection($newItems);
        return $this->SuccessResponse($coupons);
    }

    public function store(StoreCouponRequest $request)
    {
        if($request->discount_type == CouponDiscountTypeEnum::PERCENT->value){
            if($request->discount_value > 100){
                throw ValidationException::withMessages(["discount_value" => "Giá trị giảm giá phải nhỏ hơn 100"]);
            }
        }
        try {
            $coupon = $request->validated();
            $coupon["available"] = $request->quantity;
            $coupon = Coupon::create($coupon);
            return $this->SuccessResponse();
        } catch (\Exception $e) {
            return $this->ErrorResponse($e->getMessage());
        }
        
    }

    public function show($id)
    {
        return view('coupon::show');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
