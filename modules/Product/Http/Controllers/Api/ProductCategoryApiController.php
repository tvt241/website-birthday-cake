<?php

namespace Modules\Product\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Core\Traits\ResponseTrait;
use Modules\Product\Http\Requests\StoreProductCategoryRequest;
use Modules\Product\Models\ProductCategory;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Core\Services\Image\IImageService;
use Modules\Product\Http\Requests\UpdateProductCategoryRequest;
use Modules\Product\Resources\ProductCategoryResource;

class ProductCategoryApiController extends Controller
{
    use ResponseTrait;
    private $iImageService;

    public function __construct(IImageService $iImageService)
    {
        $this->iImageService = $iImageService;
    }

    public function index(Request $request)
    {
        $pageSize = $request->get("page-size") ?? 20;
        $page = $request->page ?? 1;

        $constraint = function ($query) use ($request, $pageSize, $page) {
            $query->whereNull("category_id");
            if ($request->status) {
                $query->where("is_active", $request->status);
            }
            $query->limit($pageSize)->offset(($page - 1) * $pageSize);
        };

        $depth = $request->depth ?? null;

        $categories = ProductCategory::treeOf($constraint, $depth)
            ->leftJoin("images", function ($join) {
                $join->on("laravel_cte.id", "=", "images.model_id")
                    ->where("images.model_type", ProductCategory::class);
            })
            ->get([
                "laravel_cte.id",
                "laravel_cte.name",
                "laravel_cte.slug",
                "laravel_cte.category_id",
                "laravel_cte.depth",
                "laravel_cte.path",
                "laravel_cte.is_active",
                "laravel_cte.description",
                "images.url as image"
            ])
            ->toTree();

        $paginateTotal = ProductCategory::query()->where($constraint)->count();

        $paginate = new LengthAwarePaginator($categories, $paginateTotal, $pageSize, $page);
        return $this->SuccessResponse($paginate);
    }

    public function store(StoreProductCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $category = ProductCategory::create($request->validated());
            if ($request->hasFile("image")) {
                $category->image = $this->iImageService->store($request->image, $category, "categories");
            }
            DB::commit();
            return $this->SuccessResponse($category);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->ErrorResponse(message: $e->getMessage());
        }
    }

    public function show($id)
    {
        $productCategory = ProductCategory::find($id);
        if (!$productCategory) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        return $this->SuccessResponse(new ProductCategoryResource($productCategory));
    }


    public function update(UpdateProductCategoryRequest $request, $id)
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
        try {
            if ($request->hasFile("image")) {
                $this->iImageService->update($request->image, $productCategory, "categories");
            }
            $productCategory->update($request->validated());
            return $this->SuccessResponse();
        } catch (\Exception $e) {
            return $this->ErrorResponse($e->getMessage(), status_code: 422);
        }
        
    }

    public function destroy($id)
    {
        $productCategory = ProductCategory::find($id);
        if (!$productCategory) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        $totalChildren = ProductCategory::where("category_id", $productCategory->id)->count();
        if ($totalChildren) {
            return $this->ErrorResponse(message: __("Cannot remove this resource permanently. It is related with another resource."), status_code: 422);
        }
        $this->iImageService->destroy($productCategory);
        $productCategory->delete();
        return $this->SuccessResponse();
    }

    public function changeActive(Request $request, $id)
    {
        $productCategory = ProductCategory::find($id);
        if (!$productCategory) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        $productCategory->update(["is_active" => !$productCategory->is_active]);
        return $this->SuccessResponse([]);
    }

    public function getAll(Request $request)
    {
        $categories = ProductCategory::tree()
            ->leftJoin("images", function ($join) {
                $join->on("laravel_cte.id", "=", "images.model_id")
                    ->where("images.model_type", ProductCategory::class);
            })
            ->get([
                "laravel_cte.id",
                "laravel_cte.name",
                "laravel_cte.slug",
                "laravel_cte.category_id",
                "laravel_cte.depth",
                "laravel_cte.path",
                "laravel_cte.is_active",
                "laravel_cte.description",
                "images.url as image"
            ])
            ->toTree();
        return $this->SuccessResponse($categories);
    }
}
