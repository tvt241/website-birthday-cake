<?php

namespace Modules\Product\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Modules\Core\Services\Image\IImageService;
use Modules\Core\Traits\ResponseTrait;
use Modules\Product\Http\Requests\StoreProductRequest;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductItem;
use Modules\Product\Models\ProductVariation;
use Modules\Product\Resources\ProductCategoryResource;
use Modules\Product\Resources\ProductResource;

class ProductItemApiController extends Controller
{
    use ResponseTrait;

    private $iImageService;

    public function index(Request $request)
    {
        $query = ProductItem::query()
            ->leftJoin("products", function($join){
                $join->on("products.id", "=", "product_items.product_id")
                    ->where("products.is_active", 1);
            })
            ->leftJoin("product_categories", function($join){
                $join->on("product_categories.id", "=", "products.category_id")
                    ->where("product_categories.is_active", 1);
            })
            ->leftJoin("images", function ($join) {
                $join->on("product_items.id", "=", "images.model_id")
                    ->where("images.model_type", ProductItem::class);
            })
            ->select([
                "product_items.id",
                "product_items.price",
                "product_items.quantity",
                "product_items.product_variation_id",
                "products.name",
                "products.slug",
                "images.url as image_url"
            ]);

        $items = $query->paginate();
        $newItems = $items->getCollection()->map(function ($item) {
            $variationInfo = $item->variationsCollect();
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
            $item->variation = $variation;
            return $item;
        });
        $items->setCollection($newItems);
        return $this->SuccessResponse($items);
    }

    public function barcode(Request $request, $barcode){
        $productItem = ProductItem::where("barcode", $barcode)->first();
        if(!$productItem){
            throw ValidationException::withMessages(["barcode" => "Mã barcode không hợp lệ"]);
        }
        return $this->SuccessResponse(new Product);
    }
}
