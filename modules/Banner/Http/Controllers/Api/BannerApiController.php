<?php

namespace Modules\Banner\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Banner\Http\Requests\StoreBannerRequest;
use Modules\Banner\Http\Requests\UpdateBannerRequest;
use Modules\Banner\Models\Banner;
use Modules\Banner\Resources\BannerResource;
use Modules\Core\Services\Image\ImageService;
use Modules\Core\Traits\ResponseTrait;

class BannerApiController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $banners = Banner::paginate();
        $newItems = $banners->getCollection()->map(function ($product) {
            return new BannerResource($product);
        });
        $banners->setCollection($newItems);
        return $this->SuccessResponse($banners);
    }

    public function store(StoreBannerRequest $request, ImageService $imageService)
    {
        try {
            $banner = Banner::create($request->validated());
            $bannerChange = Banner::where("order", $request->order)->first();
            if($bannerChange){
                $order = Banner::count("*");
                $bannerChange->order = $order;
                $bannerChange->save();
            }
            $imageService->store($request->image, $banner, "banners");
            return $this->SuccessResponse();

        } catch (\Exception $e) {
            return $this->ErrorResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        return $this->SuccessResponse(new BannerResource($banner));
    }

    public function update(UpdateBannerRequest $request, $id, ImageService $imageService)
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        $banner->update($request->validated());
        if($request->image){
            $imageService->update($request->image, $banner, "banners");
        }
        return $this->SuccessResponse();
    }

    public function destroy($id, ImageService $imageService)
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        $imageService->destroy($banner);
        $banner->delete();
        return $this->SuccessResponse();
    }

    public function order(){
        $order = Banner::count("*");
        $data = [
            "order" => $order += 1
        ];
        return $this->SuccessResponse($data);
    }
}
