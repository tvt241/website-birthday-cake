@extends("main")

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
                <div class="categories__slider owl-carousel">
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
    <div class="container">
        <div class="section-title product__discount__title">
            <h2>Sản phẩm mới</h2>
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

<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title product__discount__title">
                    <h2>Tin tức</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{ asset("assets/img/blog/blog-1.jpg") }}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">Cooking tips make cooking simple</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{ asset("assets/img/blog/blog-2.jpg") }}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{ asset("assets/img/blog/blog-3.jpg") }}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">Visit the clean farm in the US</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection