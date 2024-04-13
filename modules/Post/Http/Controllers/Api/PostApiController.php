<?php

namespace Modules\Post\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Core\Services\Image\IImageService;
use Modules\Core\Traits\ResponseTrait;
use Modules\Post\Http\Requests\StorePostRequest;
use Modules\Post\Models\Post;
use Modules\Post\Resources\PostResource;

class PostApiController extends Controller
{
    use ResponseTrait;
    
    private $iImageService;

    public function __construct(IImageService $iImageService)
    {
        $this->iImageService = $iImageService;
    }

    public function index(Request $request)
    {
        $query = Post::query()->with(["image:model_id,url", "category:id,name"]);
        if($request->is_active){

        }
        $posts = $query->paginate();
        $newItems = $posts->getCollection()->map(function ($product) {
            return new PostResource($product);
        });
        $posts->setCollection($newItems);
        return $this->SuccessResponse($posts);
    }

    public function store(StorePostRequest $request)
    {
        DB::beginTransaction();
        try {
            $category = Post::create($request->validated());
            if ($request->hasFile("image")) {
                $this->iImageService->store($request->image, $category, "posts");
            }
            DB::commit();
            return $this->SuccessResponse();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->ErrorResponse(message: $e->getMessage());
        }
    }

    public function show($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        return $this->SuccessResponse(new PostResource($post));
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }

        if ($request->hasFile("image")) {
            $this->iImageService->update($request->image, $post, "posts");
        }
        $post->update($request->validated());
        return $this->SuccessResponse();
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        $this->iImageService->destroy($post);
        $post->delete();
        return $this->SuccessResponse();
    }

    public function changeActive($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        $post->update(["is_active" => !$post->is_active]);
        return $this->SuccessResponse();
    }
}
