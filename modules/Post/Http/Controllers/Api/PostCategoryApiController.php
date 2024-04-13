<?php

namespace Modules\Post\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Core\Traits\ResponseTrait;
use Modules\Post\Http\Requests\StorePostCategoryRequest;
use Modules\Post\Http\Requests\UpdatePostCategoryRequest;
use Modules\Post\Models\PostCategory;
use Modules\Post\Resources\PostCategoryResource;

class PostCategoryApiController extends Controller
{
    use ResponseTrait;

    public function index(Request $request)
    {
        $query = PostCategory::query();
        // if($request->is_active){

        // }
        $categories = $query->paginate();
        return $this->SuccessResponse($categories);
    }

    public function store(StorePostCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            PostCategory::create($request->validated());
            DB::commit();
            return $this->SuccessResponse();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->ErrorResponse(message: $e->getMessage());
        }
    }

    public function show($id)
    {
        $category = PostCategory::find($id);
        if (!$category) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        return $this->SuccessResponse(new PostCategoryResource($category));
    }

    public function update(UpdatePostCategoryRequest $request, $id)
    {
        $category = PostCategory::find($id);
        if (!$category) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        $category->update($request->validated());
        return $this->SuccessResponse();
    }

    public function destroy($id)
    {
        $category = PostCategory::find($id);
        if (!$category) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        if($category->posts()->count()){
            return $this->ErrorResponse(message: "Vui lòng xóa bài viết thuộc thư mục này trước", status_code: 422);
        }
        $category->delete();
        return $this->SuccessResponse();
    }

    public function changeActive($id)
    {
        $category = PostCategory::find($id);
        if (!$category) {
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        $category->update(["is_active" => !$category->is_active]);
        return $this->SuccessResponse();
    }

    public function getAll(){
        $posts = PostCategory::get();
        return $this->SuccessResponse($posts);
    }
}
