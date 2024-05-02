@extends("core::main")

@section("content")
<section class="breadcrumb-section set-bg" data-setbg="{{ asset("storage/setup/header.jpg") }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Tin tức</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog spad">
    <div class="container">
        <div class="row featured__filter">
            @include("post::pages.blogs.sider-bar", ["post_categories" => $post_categories, "post_news" => $post_news])
            <div class="col-lg-8 col-md-7">
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-lg-4 col-md-4 col-sm-6" style="padding: 0 5px">
                            <div class="blog__item shadow">
                                <div class="featured__item__pic">
                                    <img src="{{ $post->image ? $post->image->url :  asset("assets/img/img-default.jpg")  }}" alt="">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li>
                                            <i class="fa fa-calendar-o"></i>
                                            {{ $post->created_at->format("d-m-Y") }}    
                                        </li>
                                        <li><i class="fa fa-comment-o"></i> 5</li>
                                    </ul>
                                    <h5>
                                        <a title="{{ $post->name }}" href="{{ route("blogs.details", ["slug" => $post->slug]) }}">
                                            {{ $post->name }}
                                        </a>
                                    </h5>
                                    <p title="{{ $post->desc_sort  }}">{{ $post->desc_sort  }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                
                    <div class="col-lg-12">
                        <div class="product__pagination blog__pagination">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push("css")
    <style>
        .blog__item .featured__item__pic{
            height: 230px;
        }
        .blog__item .featured__item__pic img{
            height: 230px;
        }
    </style>
@endpush