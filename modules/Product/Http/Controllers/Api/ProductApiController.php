<?php

namespace Modules\Product\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Core\Services\Image\IImageService;
use Modules\Core\Traits\ResponseTrait;
use Modules\Product\Http\Requests\StoreProductRequest;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductItem;
use Modules\Product\Models\ProductVariation;
use Modules\Product\Resources\ProductCategoryResource;
use Modules\Product\Resources\ProductDetailResource;
use Modules\Product\Resources\ProductResource;

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
        $query = Product::query()->with(["image:model_id,url", "category:id,name", "productItems:id,product_id,quantity"]);
        // if($request->is_active){

        // }
        $products = $query->paginate(10);
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


    public function update(Request $request, $id)
    {
        $productCategory = ProductCategory::find($id);
        if (!$productCategory) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        if ($productCategory->category_id != $request->category_id) {
            $totalChildren = ProductCategory::where("category_id", $productCategory->id)->count();
            if ($totalChildren) {
                return $this->ErrorResponse(message: __("You do not select this parent. because the paren already to add it for the children."), status_code: 422);
            }
        }
        $imageService = app(IImageService::class);

        if ($request->hasFile("image")) {
            $imageService->update($request->image, $productCategory, "categories");
        }
        $productCategory->update = $request->validated();
        return $this->SuccessResponse();
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
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
