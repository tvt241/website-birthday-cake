@extends("core::main")

@section("content")
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <form action="">
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
                            <div class="d-flex gap-2 align-items-center justify-content-between ">
                                <input value="{{ request("min", 0) }}" type="text" class="input-range form-control" name="min" id="minamount">
                                -
                                <input value="{{ request("max", 2000000) }}"class="input-range form-control" type="text" name="max" id="maxamount">
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Sắp xếp</h4>
                            <select name="sort" id="" class="form-control">
                                <option @if(request("sort") == "price-asc") selected @endif value="price-asc">Giá tăng dần</option>
                                <option @if(request("sort") == "price-desc") selected @endif value="price-desc">Giá giảm dần</option>
                                <option @if(request("sort") == "name-asc") selected @endif value="name-asc">Tên A - Z</option>
                                <option @if(request("sort")  == "name-desc") selected @endif value="name-desc">Tên Z - A</option>
                            </select>
                        </div>
                        <div class="sidebar__item">
                            <button class="site-btn">Lọc</button>
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="row align-items-stretch">
                    @foreach ($products as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6 my-1" style="padding: 0 5px">
                            <div class="product__item h-100 shadow">
                                <div class="product__item__pic set-bg" data-setbg="{{ $product->image ? $product->image->url : asset("assets/img/img-default.jpg") }}">
                                </div>
                                <div class="featured__item__text">
                                    <h6>
                                        <a href="{{ route("products.details", ["slug" => $product->slug]) }}">
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
                                    <h5 class="mb-2">{{ $product->price }} ₫</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="product__pagination">
                    {{ $products->withQueryString()->links() }}
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

        .input-range{
            width: 120px;
        }
    </style>
@endpush