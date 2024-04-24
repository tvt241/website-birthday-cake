@extends("core::main")

@section("content")
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item ">
                        <h4>Danh mục</h4>
                        <ul class="sidebar__custom">
                            @forelse ($categories as $category)
                            <li>
                                <a href="{{ route("products", ["category" => $category->slug]) }}">{{ $category->name }}</a>
                            </li>
                        @empty
                            <li>
                                <a href="#">Danh mục</a>
                            </li>
                        @endforelse
                        </ul>
                    </div>
                    <div class="sidebar__item">
                        <h4>Giá</h4>
                        <div class="price-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="10" data-max="540">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar__item">
                        <h4>Sắp xếp</h4>
                        <select name="" id="" class="form-control">
                            <option value="">Giá giảm dần</option>
                            <option value="">Giá tăng dần</option>
                            <option value="">Tên A - Z</option>
                            <option value="">Tên Z - A</option>
                        </select>
                    </div>

                    <div class="sidebar__item">
                        <button class="site-btn">Lọc</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ $product->image ? $product->image->url : asset("assets/img/img-default.jpg") }}">
                                </div>
                                <div class="featured__item__text">
                                    <h6>
                                        <a href="{{ route("products.details", ["slug" => $product->slug]) }}">
                                            {{ $product->name }}
                                        </a>
                                    </h6>
                                    <h5>{{ $product->price }} VND</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="product__pagination">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push("css")
    <style>
        .sidebar__custom{
            max-height: 500px;
            overflow-y: auto
        }
        .nice-select{
            width: 100%;
        }
        .nice-select .list{
            width: 100%;
        }
    </style>
@endpush