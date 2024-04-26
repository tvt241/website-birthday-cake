@extends("core::main")

@section("seo")
@if($is_invalid)
    <meta name="description" content="{{ $product->desc_sort }}">
    <meta name="twitter:title" content="Trang chủ" />
    <meta name="twitter:description" content="Sản phẩm - {{ $product->name }}" />
    <meta property="og:title" content="{{ $product->name }}" />
    <meta property="og:image" content="{{ $product->image ? $product->image->url : asset("assets/img/img-default.jpg") }}">
    <meta property="og:image:alt" content="{{ $product->name }}">
    <meta property="og:description" content="{{ $product->desc_sort }}" />
    <meta property="og:availability" content="instock" />
    <meta property="og:price:amount" content="{{ $product->min_price }}">
    <meta property="og:price:currency" content="₫">
@else
    <meta name="description" content="{{ $company["name"] }}">
    <meta name="twitter:title" content="Trang chủ" />
    <meta name="twitter:description" content="Trang chủ -  {{ $company["name"] }}" />
    <meta property="og:title" content="Trang chủ" />
    <meta property="og:image" content="{{ $company["logo"] }}">
    <meta property="og:image:alt" content="{{ $company["name"] }}">
    <meta property="og:description" content="Trang chủ - {{ $company["name"] }}" />
    <meta property="og:availability" content="instock" />
    <meta property="og:price:amount" content="0">
    <meta property="og:price:currency" content="₫">
@endif
@endsection

@section("content")
<section class="breadcrumb-section set-bg" data-setbg="{{ asset("assets/img/breadcrumb.jpg") }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Chi tiết sản phẩm</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-details spad">
    <div class="container">
        @if($is_invalid)
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ $product->image ? $product->image->url : asset("assets/img/img-default.jpg") }}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            @if($items->count() > 1)
                                @foreach ($items as $item)
                                    @php $imageValid = $item->image ? $item->image->url : asset("assets/img/img-default.jpg") @endphp
                                    <img data-imgbigurl="{{ $imageValid }}"
                                            src="{{ $imageValid }}" alt="">
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text cart__container">
                        <h3>{{ $product->name }}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <p>Mô tả: {{ $product->desc_sort ? $product->desc_sort : "Chưa có mô tả" }}</p>
                        <div class="product__details__price price__container">
                            <span class=""></span>
                            <span> ₫</span>
                        </div>
                        <div class="product__details__variations">
                            @if($variations->count() > 1)
                                @include("product::pages.products.__variations-option", ["variations" => $variations])
                            @else
                                @include("product::pages.products.__instock", ["variation" => $variations[0]])
                            @endif
                        </div>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="primary-btn btn__cart_add">Thêm vào giỏ hàng</a>
                        <a href="javascript:void(0)" class="heart-icon btn__heart__cart"><span class="icon_heart_alt"></span></a>
                        
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Mô tả</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Đánh giá <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Mô tả sản phẩm</h6>
                                    {!! $product->desc !!}
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h5 class="py-md-5">Sản phẩm không tồn tại trên hệ thống hoặc đã bị xóa</h5>
        @endif
    </div>
    <input type="hidden" id="carts_store_url" value="{{ route("api.carts.store") }}">
</section>
<section class="featured spad">
    <div class="container">
        <div class="section-title product__discount__title" bis_skin_checked="1">
            <h2>Sản phẩm liên quan</h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ asset("assets/img/product/product-1.jpg") }}">
                        <ul class="product__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push("js")
    <script>
        const items = JSON.parse(`{!! $items->toJson() !!}`);
        const variations = JSON.parse(`{!! $variations->toJson() !!}`);
    </script>
    <script src="{{ asset("assets/js/products/details.js") }}"></script>
@endpush

@push("css")
    <style>
        .variation__btn{
            border: 1px solid #dadada;
            border-radius: 2px;
            background: #fff;
            min-width: 48px;
            height: 32px;
            padding: 0 8px;
            margin: 8px 8px 0 0;
            cursor: pointer;
        }
        .variation__btn.active{
            background: #f36957;
            color: #ffffff;
        }
        .variation__label{
            display: inline-block;
            min-width: 92px;
            word-wrap: break-word;
        }
        figure.image img{
            height: auto !important;
        }
    </style>
@endpush