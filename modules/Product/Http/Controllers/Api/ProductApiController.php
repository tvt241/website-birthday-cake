<?php

namespace Modules\Product\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Modules\Core\Services\Image\IImageService;
use Modules\Core\Traits\ResponseTrait;
use Modules\Order\Enums\OrderStatusEnum;
use Modules\Order\Models\Cart;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderDetail;
use Modules\Product\Http\Requests\StoreProductRequest;
use Modules\Product\Http\Requests\UpdateProductRequest;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductItem;
use Modules\Product\Models\ProductVariation;
use Modules\Product\Resources\ProductCategoryResource;
use Modules\Product\Resources\ProductDetailResource;
use Modules\Product\Resources\ProductResource;
use PDO;

class ProductApiController extends Controller
{
    use ResponseTrait;

    private $iImageService;

    public function __construct(IImageService $iImageService)
    {
        $this->iImageService = $iImageService;
    }
    public function index(Request $request)
    {
        $query = Product::query()->with(["image:model_id,url", "category:id,name", "productItems:id,product_id,quantity,available"]);

        $products = $query->latest()->paginate(10);
        $newItems = $products->getCollection()->map(function ($product) {
            return new ProductResource($product);
        });
        $products->setCollection($newItems);
        return $this->SuccessResponse($products);
    }

    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $product = Product::create($request->validated());
            if ($request->hasFile("image")) {
                $product->image = $this->iImageService->store($request->image, $product, "products");
            }
            $this->handleStoreVariation($request->variations, $product->id, $request->items);
            DB::commit();
            return $this->SuccessResponse($product);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->ErrorResponse(message: $e->getMessage());
        }
    }

    public function handleStoreVariation($variations, $productId, $items){
        $productVariationIds = [];
        foreach($variations as $variation){
            if(sizeof($productVariationIds)){
                $ids = $productVariationIds;
                $productVariationIds = [];
                foreach($variation["options"] as $option){
                    $data = [
                        "name" => $variation["name"],
                        "value" => $option,
                        "product_id" => $productId,
                    ];
                    foreach($ids as $id){
                        $data["product_variation_id"] = $id;
                        $productVariation = ProductVariation::create($data);
                        $productVariationIds[] = $productVariation->id;
                    }
                }
            }
            else{
                foreach($variation["options"] as $option){
                    $data = [
                        "name" => $variation["name"],
                        "value" => $option,
                        "product_id" => $productId,
                    ];
                    $data["product_variation_id"] = null;
                    $productVariation = ProductVariation::create($data);
                    $productVariationIds[] = $productVariation->id;
                }
            }
            if(sizeof($productVariationIds) == sizeof($items)){
                if(sizeof($items) == 1) $min = 0;
                else $min = $items[0]["price"];
                $max = $items[0]["price"];
                foreach($items as $key => $item){
                    if($item["price"] < $min){
                        $min = $item["price"];
                    }
                    if($item["price"] > $max){
                        $max = $item["price"];
                    }
                    $item["available"] = $item["quantity"];
                    $item["product_id"] = $productId;
                    $item["product_variation_id"] = $productVariationIds[$key];
                    $productItem = ProductItem::create($item);
                    if(isset($item["image"]) && is_file($item["image"])){
                        $productItem->image = $this->iImageService->store($item["image"], $productItem, "product_items");
                    }
                }
                $data = [
                    "min_price" => $min,
                    "max_price" => $max,
                ];
                Product::find($productId)->update($data);
            }
        }
    }

    public function show($id)
    {
        $product = Product::with(["image:model_id,url", "category:id,name", "productItems"])->find($id);
        if (!$product) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }

        return $this->SuccessResponse(new ProductDetailResource($product));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 404);
        }
        DB::beginTransaction();
        try {
            $data = $request->except(["items", "is_change", "variations"]);
            if(!$request->is_change){
                $items = $request->items;
                if(sizeof($items) == 1) $min = 0;
                else $min = $items[0]["price"];
                $max = $items[0]["price"];
                foreach($request->items as $key => $item){
                    $productItem = ProductItem::find($item["id"]);
                    if(!$productItem){
                        DB::rollBack();
                        return $this->ErrorResponse("Sản phẩm đã thay đổi vui lòng thử lại sau");
                    }
                    if($productItem->quantity - $productItem->available > $item["quantity"]){
                        DB::rollBack();
                        throw ValidationException::withMessages(["items.[$key].quantity" => "Số lượng sản phẩm đã bán vượt qua số lượng hiện tại"]);
                    }
                    Cart::where("product_item_id", $productItem->id)
                        ->where("quantity", ">", $item["quantity"])
                        ->update(["quantity" => $item["quantity"]]);
                    if($item["price"] < $min){
                        $min = $item["price"];
                    }
                    if($item["price"] > $max){
                        $max = $item["price"];
                    }
                    $item["available"] = $item["quantity"] - $productItem->quantity + $productItem->available;
                    $productItem->update($item);
                    if(isset($item["image"])){
                        $this->iImageService->update($item["image"], $productItem, "product_items");
                    }
                }
                $data["min_price"] = $min;
                $data["max_price"] = $max;

                if ($request->hasFile("image")) {
                    $this->iImageService->update($request->image, $product, "products");
                }
                DB::commit();
                $product->update($data);
                return $this->SuccessResponse();
            }
            $productItems = $product->productItems;
            $productItemIds = $productItems->pluck("id");

            $orderPendingCount = DB::table("order_details")
                ->join("orders", "orders.id", "=", "order_details.order_id")
                ->whereIn("order_details.product_item_id", $productItemIds)
                ->where("orders.status", ">=", OrderStatusEnum::START_ORDER_PENDING)
                ->where("orders.status", "<", OrderStatusEnum::END_ORDER_PENDING)
                ->count("*");
            if($orderPendingCount){
                return $this->ErrorResponse("Vui lòng hoàn thành những đơn hàng liên quan trước khi cập nhật sản phẩm");
            }
            foreach($productItems as $productItem){
                $this->iImageService->destroy($productItem);
                Cart::where("product_item_id", $productItem->id)->delete();
            }
            $this->handleStoreVariation($request->variations, $product->id, $request->items);

            if ($request->hasFile("image")) {
                $this->iImageService->update($request->image, $product, "products");
            }
            $product->update($data);
            DB::commit();
            return $this->SuccessResponse();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->ErrorResponse($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 404);
        }
        $product->items()->delete();
        $product->variations()->delete();
        $product->carts()->delete();
        $this->iImageService->destroy($product);
        $product->delete();
        return $this->SuccessResponse();
    }

    public function changeActive($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        $product->update(["is_active" => !$product->is_active]);
        return $this->SuccessResponse([]);
    }
}
