@extends("core::main")

@section("seo")
<meta name="description" content="{{ $company["name"] }}">
    <meta name="twitter:title" content="Trang chủ" />
    <meta name="twitter:description" content="Trang chủ -  {{ $company["name"] }}" />
    <meta property="og:title" content="Trang chủ" />
    <meta property="og:image" content="{{ $company["logo"] }}">
    <meta property="og:image:alt" content="{{ $company["name"] }}">
    <meta property="og:description" content="Trang chủ - {{ $company["name"] }}" />
@endsection

@section("content")

<section class="pb-3">
    <div class="container">
        <div class="row">
            <div class="banner__slider owl-carousel">
                @foreach ($banners as $banner)
                    <div class="col-lg-12">
                        <div class="banner__item set-bg" 
                            data-setbg="{{ $banner->image ? $banner->image->url : asset("storage/categories/tang-nguoi-yeu.jpg") }}">
                        </div>
                    </div>
                @endforeach                
            </div>
        </div>
    </div>    
</section>

<section class="categories">
    @if (sizeof($categories))
        <div class="container">
            <div class="section-title product__discount__title">
                <h2>Danh mục sản phẩm</h2>
            </div>
            <div class="row">
                <div class="categories__slider nav__top__slider owl-carousel">
                    @foreach ($categories as $category)
                        <div class="categories__item set-bg shadow" data-setbg="{{ $category->image ? $category->image : asset("assets/img/img-default.jpg") }}">
                            <h5>
                                <a href="{{ route("products", ["category" => $category->slug]) }}">{{ $category->name }}</a>
                            </h5>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</section>

<section class="featured spad">
    @if(isset($product_best_sales) && $product_best_sales->count())
    <div class="container">
        <div class="section-title product__discount__title">
            <h2>Bán chạy</h2>
            <span class="float-right mt-md-2">
                <a class="font-weight-bold h5 text-primary" href="{{ route("products") }}">Xem thêm</a>
            </span>
        </div>
        <div class="row featured__filter align-items-stretch">
            @foreach ($product_best_sales as $product)
                <div class="col-lg-2 col-md-3 col-sm-6 col-6 my-1">
                    <div class="featured__item h-100 shadow">
                        <div class="featured__item__pic set-bg" data-setbg="{{ $product->image ? $product->image->url : asset("assets/img/img-default.jpg") }}">
                        </div>
                        <div class="featured__item__text">
                            <h6>
                                <a title="{{ $product->name }}" href="{{ route("products.details", $product->slug) }}">
                                    {{ $product->name }}
                                </a>
                            </h6>
                            <div class="product__details__rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <span>(18)</span>
                            </div>
                            <h5 class="pb-2">{{ $product->price  }} ₫</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
</section>

<section class="featured spad">
    @if(isset($product_news) && $product_news->count())
        <div class="container">
            <div class="section-title product__discount__title">
                <h2>Mới</h2>
                <span class="float-right mt-md-2">
                    <a class="font-weight-bold h5 text-primary" href="{{ route("products") }}">Xem thêm</a>
                </span>
            </div>
            <div class="row featured__filter align-items-stretch">
                @foreach ($product_news as $product)
                    <div class="col-lg-2 col-md-3 col-sm-6 col-6 my-1">
                        <div class="featured__item h-100 shadow">
                            <div class="featured__item__pic set-bg" data-setbg="{{ $product->image ? $product->image->url : asset("assets/img/img-default.jpg") }}">
                            </div>
                            <div class="featured__item__text">
                                <h6>
                                    <a title="{{ $product->name }}" href="{{ route("products.details", $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h6>
                                <div class="product__details__rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <span>(18)</span>
                                </div>
                                <h5 class="pb-2">{{ $product->price  }} ₫</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section>

<section class="featured spad">
    @if(isset($post_news) && $post_news->count())
        <div class="container">
            <div class="section-title product__discount__title">
                <h2>Tin tức</h2>
                <span class="float-right mt-md-2">
                    <a class="font-weight-bold h5 text-primary" href="{{ route("blogs") }}">Xem thêm</a>
                </span>
            </div>
            <div class="row featured__filter align-items-stretch align-items-stretch">
                @foreach ($post_news as $post)
                    <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                        <div class="blog__item h-100 shadow">
                            <div class="featured__item__pic">
                                <img src="{{ $post->image ? $post->image->url : asset("assets/img/img-default.jpg") }}" alt="">
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
                                    <a title="{{ $post->name }}" href="{{ route("blogs.details", ["slug" => $post->slug ]) }}">{{ $post->name }}</a>
                                </h5>
                                <p title="{{ $post->desc_sort }}">{{ $post->desc_sort }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection