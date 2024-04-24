<?php

namespace Modules\Order\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Core\Traits\ResponseTrait;
use Modules\Order\Models\Cart;
use Modules\Product\Models\ProductItem;

class CartApiController extends Controller
{
    use ResponseTrait;

    public function index(){

    }

    public function store(Request $request){
        $productItem = ProductItem::find($request->product_item_id);
        if(!$productItem){
            return $this->ErrorResponse("Sản phẩm không tồn tại hoặc đã bị xóa", 422);
        }
        if($productItem->quantity < $request->quantity){
            return $this->ErrorResponse("Số lượng sản phẩm không đủ", 422);
        }
        if(!auth()->check()){
            $carts = session("carts", []);
            $totalPrice = 0;
            $flag = false;
            $isMax = false;
            $sizeCart = sizeof($carts);
            if($sizeCart){
                foreach ($carts as $key => $cart){
                    if($cart->product_item_id == $request->product_item_id){
                        $flag = true;
                        if($cart->quantity + $request->quantity >= $productItem->quantity){
                            $isMax = true;
                            $carts[$key]->quantity = $productItem->quantity;
                        }
                        else{
                            $carts[$key]->quantity += $request->quantity;
                        }
                        $carts[$key]->price = $productItem->price;
                    }
                    $totalPrice += $carts[$key]->price * $carts[$key]->quantity;
                }
            }
            if(!$flag){
                $cart = [
                    "product_item_id" => $request->product_item_id,
                    "quantity" => $request->quantity,
                    "price" => $productItem->price,
                    "image" => $productItem->image?->url,
                    "id" => rand(1000, 9999)
                ];
                $product = $productItem->product;

                $cart["name"] = $product->name;
                $cart["slug"] = $product->slug;

                $variationInfo = $productItem->variationsCollect();
                $variation = [];
                if($variationInfo->name != "default"){
                    $variation[] = (object)[
                        "name" => $variationInfo->name,
                        "value" => $variationInfo->value
                    ];
                    if($variationInfo->ancestors->count()){
                        foreach($variationInfo->ancestors as $variationParent){
                            $variation[] = (object)[
                                "name" => $variationParent->name,
                                "value" => $variationParent->value
                            ];
                        }
                    }
                }
                $cart["variation"] = $variation;
                $carts[] = (object)$cart;

                $totalPrice +=  $productItem->price * $request->quantity;
            }
            session()->put("carts", $carts);
            $data = [
                "total_price" => $totalPrice,
                "total_product" => sizeof($carts)
            ];
            if($isMax){
                $message = "Sản phẩm đã đạt tối đa";
            }
            else{
                $message = "Sản phẩm đã được thêm vào giỏ hàng";
            }
            return $this->SuccessResponse($data, $message);
        }
        
        $cart = auth()->user()->carts()->where("product_item_id", $productItem->id)->first();
        $isMax = false;
        $flag = false;
        if($cart){
            $flag = true;
            if($cart->quantity + $request->quantity >= $productItem->quantity){
                $isMax = true;
                $cart->quantity = $productItem->quantity;
            }
            else{
                $cart->quantity += $request->quantity;
            }
            // $cart->price = $productItem->price;
            $cart->save();
        }

        $userId = auth()->id();
        
        if(!$flag){
            $cart = [
                "quantity" => $request->quantity,
                "user_id" => $userId,
                "product_item_id" => $productItem->id
            ];
            Cart::create($cart);
        }
        
        $subQuery = DB::table('product_items')
        ->select('id', 'price', "quantity", "product_variation_id");

        $carts = Cart::query()->where("user_id", $userId)
        ->select(DB::raw("pItemSub.price * carts.quantity as total_price"))
        ->joinSub($subQuery, 'pItemSub', function ($join) {
            $join->on('pItemSub.id', '=', 'carts.product_item_id');
        })
        ->get();

        $totalPrice = $carts->sum("total_price");

        if($isMax){
            $message = "Sản phẩm đã đạt tối đa";
        }
        else{
            $message = "Sản phẩm đã được thêm vào giỏ hàng";
        }
        $data = [
            "total_price" => $totalPrice,
            "total_product" => $carts->count()
        ];
        return $this->SuccessResponse($data, $message);
    }

    public function update(Request $request, $id){
        if(!auth()->check()){
            $carts = session("carts", []);
            $totalPrice = 0;
            $flag = false;
            $sizeCart = sizeof($carts);
            $data = [
                "total_product" => sizeof($carts)
            ];

            if($sizeCart){
                foreach ($carts as $key => $cart){
                    if($id == $cart->id){
                        $flag = true;
                        $productItem = ProductItem::find($cart->product_item_id);

                        if($request->quantity >= $productItem->quantity) $carts[$key]->quantity = $productItem->quantity;
                        else $carts[$key]->quantity = $request->quantity;

                        $carts[$key]->price = $productItem->price;
                        $data["quantity"] = $carts[$key]->quantity;
                        $data["price"] = $carts[$key]->quantity * $carts[$key]->price;
                    }
                    $totalPrice += $carts[$key]->quantity * $carts[$key]->price;
                }
            }
            if(!$flag){
                return $this->ErrorResponse("Mã giỏ hàng không hợp lệ");
            }
            session()->put("carts", $carts);

            $data["total_price"] = $totalPrice;
            $message = "Thành công";
            return $this->SuccessResponse($data, $message);
        }

        $user = auth()->user();
        $cart = $user->carts()->find($id);
        if(!$cart){
            return $this->ErrorResponse("Mã giỏ hàng không hợp lệ");
        }
        $productItem = ProductItem::find($cart->product_item_id);

        if($request->quantity >= $productItem->quantity) $cart->quantity = $productItem->quantity;
        else $cart->quantity = $request->quantity;

        $cart->update();

        $userId = $user->id;
        
        $subQuery = DB::table('product_items')
        ->select('id', 'price', "quantity", "product_variation_id");

        $carts = Cart::query()->where("user_id", $userId)
        ->select(DB::raw("pItemSub.price * carts.quantity as total_price"))
        ->joinSub($subQuery, 'pItemSub', function ($join) {
            $join->on('pItemSub.id', '=', 'carts.product_item_id');
        })
        ->get();

        $totalPrice = $carts->sum("total_price");

        $data = [
            "quantity" => $cart->quantity,
            "price" => $cart->quantity * $productItem->price,
            "total_price" => $totalPrice,
            "total_product" => $carts->count()
        ];
        $message = "Sản phẩm đã được xóa khỏi giỏ hàng";
        return $this->SuccessResponse($data, $message);
    }

    public function destroy(Request $request, $id){
        if(!auth()->check()){
            $carts = session("carts", []);
            $totalPrice = 0;
            $flag = false;
            $sizeCart = sizeof($carts);
            if($sizeCart){
                foreach ($carts as $key => $cart){
                    if($id == $cart->id){
                        $flag = true;
                        array_splice($carts, $key, 1);
                    }
                    else{
                        $totalPrice += $cart->price * $cart->quantity;
                    }
                }
            }
            if(!$flag){
                return $this->ErrorResponse("Mã giỏ hàng không hợp lệ");
            }
            session()->put("carts", $carts);
            $data = [
                "total_price" => $totalPrice,
                "total_product" => sizeof($carts)
            ];
            $message = "Sản phẩm đã được xóa khỏi giỏ hàng";
            return $this->SuccessResponse($data, $message);
        }
        $user = auth()->user();
        $cart = $user->carts()->find($id);
        if(!$cart){
            return $this->ErrorResponse("Mã giỏ hàng không hợp lệ");
        }
        $cart->delete();

        $userId = $user->id;
        
        $subQuery = DB::table('product_items')
        ->select('id', 'price', "quantity", "product_variation_id");

        $carts = Cart::query()->where("user_id", $userId)
        ->select(DB::raw("pItemSub.price * carts.quantity as total_price"))
        ->joinSub($subQuery, 'pItemSub', function ($join) {
            $join->on('pItemSub.id', '=', 'carts.product_item_id');
        })
        ->get();

        $totalPrice = $carts->sum("total_price");

        $data = [
            "total_price" => $totalPrice,
            "total_product" => $carts->count()
        ];
        $message = "Sản phẩm đã được xóa khỏi giỏ hàng";
        return $this->SuccessResponse($data, $message);
    }
}
