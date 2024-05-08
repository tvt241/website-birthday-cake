<?php

namespace Modules\Coupon\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Modules\Core\Traits\ResponseTrait;
use Modules\Coupon\Enums\CouponDiscountTypeEnum;
use Modules\Coupon\Enums\CouponStatusEnum;
use Modules\Coupon\Http\Requests\StoreCouponRequest;
use Modules\Coupon\Http\Requests\UpdateCouponRequest;
use Modules\Coupon\Http\Requests\UseCouponRequest;
use Modules\Coupon\Models\Coupon;
use Modules\Coupon\Resources\CouponDetailsResource;
use Modules\Coupon\Resources\CouponResource;
use Modules\Order\Models\Order;
use PDO;

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
        $coupon = Coupon::find($id);
        if(!$coupon){
            return $this->ErrorResponse("Mã giảm giá không tồn tại");
        }
        $order = Order::where("coupon_id", $coupon->id)->latest()->get();
        $coupon->orders = $order;
        return $this->SuccessResponse(new CouponDetailsResource($coupon));
    }

    public function update(UpdateCouponRequest $request, $id)
    {
        $coupon = Coupon::find($id);
        if(!$coupon){
            return $this->ErrorResponse("Mã giảm giá không tồn tại");
        }
        if($request->quantity < $coupon->quantity - $coupon->available){
            throw ValidationException::withMessages(["quantity" => "Mã giảm giá đã được sử dụng quá số lượng mới"]);
        }
        if($request->quantity < $coupon->budget - $coupon->budget_available){
            throw ValidationException::withMessages(["budget" => "Mã giảm giá dã vượt quá ngân sách mới"]);
        }
        $coupon->update($request->validated());
        return $this->SuccessResponse();
    }

    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        if(!$coupon){
            return $this->ErrorResponse("Mã giảm giá không tồn tại", 404);
        }
        $coupon->delete();
        return $this->SuccessResponse();
    }

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
