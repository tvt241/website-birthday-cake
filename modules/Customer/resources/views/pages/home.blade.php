@extends("core::main")

@section("content")

<section class="pb-3">
    <div class="container">
        <div class="row">
            <div class="banner__slider owl-carousel">
                <div class="col-lg-12">
                    <div class="banner__item set-bg" data-setbg="{{ asset("assets/img/categories/cat-1.jpg") }}">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="banner__item set-bg" data-setbg="{{ asset("assets/img/categories/cat-2.jpg") }}">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="banner__item set-bg" data-setbg="{{ asset("assets/img/categories/cat-3.jpg") }}">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="banner__item set-bg" data-setbg="{{ asset("assets/img/categories/cat-4.jpg") }}">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="banner__item set-bg" data-setbg="{{ asset("assets/img/categories/cat-4.jpg") }}">
                    </div>
                </div>
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
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{ $category->image ? $category->image : asset("assets/img/img-default.jpg") }}">
                                <h5>
                                    <a href="{{ route("products", ["category" => $category->slug]) }}">{{ $category->name }}</a>
                                </h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</section>

<section class="featured spad">
    <div class="container">
        <div class="section-title product__discount__title">
            <h2>Sản phẩm bán chạy</h2>
        </div>
        <div class="row featured__filter">
            @foreach ([0,1,2,3,4,5,6,7] as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset("assets/img/featured/feature-1.jpg ") }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="featured spad">
    @if(isset($new_products) && $new_products->count())
        <div class="container">
            <div class="section-title product__discount__title">
                <h2>Sản phẩm mới</h2>
            </div>
            <div class="row featured__filter">
                @foreach ($new_products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 mix oranges fresh-meat">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="{{ $product->image ? $product->image->url : asset("assets/img/img-default.jpg") }}">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6>
                                    <a href="{{ route("products.details", $product->slug) }}">
                                        {{  $product->name }}
                                    </a>
                                </h6>
                                <h5>$30.00</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section>

<section class="from-blog spad">
    @if(isset($new_posts) && $new_posts->count())
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title product__discount__title">
                        <h2>Tin tức</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($new_posts as $post)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
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
                                    <a href="{{ $post->slug }}">{{ str()->limit($post->name, 30) }}</a>
                                </h5>
                                <p>{{ str()->limit($post->desc_sort, 90) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection