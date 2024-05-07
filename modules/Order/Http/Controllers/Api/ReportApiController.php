<?php

namespace Modules\Order\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Core\Traits\ResponseTrait;
use Modules\Customer\Models\Customer;
use Modules\Order\Enums\OrderStatusEnum;
use Modules\Order\Models\Cart;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderDetail;
use Modules\Product\Models\ProductItem;

class ReportApiController extends Controller
{
    use ResponseTrait;

    public function reportYear(Request $request){
        $year = $request->year;
        if(!$year){
            $year = now()->format("Y");
        }
        $orderInYear = DB::table("orders")
            ->whereYear("created_at", $year)
            ->select(
                DB::raw("MONTH(created_at) AS month"),
                DB::raw("COUNT(*) AS total_sale"),
                DB::raw("COUNT(CASE WHEN orders.status >= 10 AND orders.status <= 19 THEN '*' ELSE null END) AS total_sale_done"),
                DB::raw("SUM(CASE WHEN orders.status >= 10 AND orders.status <= 19 THEN amount ELSE 0 END) AS total_revenue"),
                DB::raw("SUM(CASE WHEN orders.status >= 10 AND orders.status <= 19 THEN coupon_value ELSE 0 END) AS total_coupon"),
                DB::raw("SUM(CASE WHEN orders.status >= 10 AND orders.status <= 19 THEN shipping_price ELSE 0 END) AS total_fee"),
                DB::raw("SUM(CASE WHEN orders.status >= 10 AND orders.status <= 19 THEN (SELECT SUM(order_details.price_import) FROM order_details WHERE order_details.order_id = orders.id) ELSE 0 END) AS total_expense")
            )
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get();
        $revenueData = array_fill(1, 12, null);
        foreach ($orderInYear as $row) {
            $revenueData[$row->month] = $row;
        }
        return $this->SuccessResponse(array_values($revenueData));
    }

    public function reportUser(Request $request){
        $reportUser = DB::table("orders")
            ->join('customers', "customers.id", "=", "orders.user_id")
            ->select(
                "customers.username",
                DB::raw("COUNT(orders.user_id) as orders_count"),
                DB::raw("SUM(orders.amount) as total_revenue"),
                DB::raw("SUM(orders.coupon_value) AS total_coupon"),
            )
            ->groupBy("customers.username")
            ->get();
        return $this->SuccessResponse($reportUser);
    }

}
