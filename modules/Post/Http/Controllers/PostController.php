<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Modules\Post\Models\Post;
use Modules\Post\Models\PostCategory;

class PostController extends Controller
{
    public function __construct()
    {
        $postCategories = PostCategory::where("is_active", 1)->get();
        $postNews = Post::with("image", "category")->invalidByCategory()->where("is_active", 1)->latest()->limit(5)->get();

        View::share("post_categories", $postCategories);
        View::share("post_news", $postNews);
        
    }
    public function index(Request $request)
    {
        $query = Post::with("image", "category")->where("is_active", 1);
        $query->whereRelation("category", function($q) use ($request){
            $q->where("is_active", 1);
            if($request->category){
                $q->where("slug", $request->category);
            }
        });
        if($request->search){
            $query->where("name", "like", "%$request->search%");
        }
        $posts = $query->paginate(12);
        return view('post::pages.blogs.index', [
            "posts" => $posts,
        ]);
    }

    public function showBySlug($slug)
    {
        $post = Post::inValidByCategory()->with(["image:model_id,url", "category"])->where("slug", $slug)->first();
        if(!$post){
            return view("post::pages.blogs.details", [
                "is_invalid" => false,
            ]);
        }
        $category = $post->category;
        $postRelated = Post::where("category_id", $post->category_id)->limit(4)->latest()->get();
        
        return view("post::pages.blogs.details", [
            "is_invalid" => true,
            "post" => $post,
            "category" => $category,
            "post_related" => $postRelated
        ]);
    }

}
