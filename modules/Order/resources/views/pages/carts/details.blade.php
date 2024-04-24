@extends("core::main")

@section("content")
<section class="breadcrumb-section set-bg" data-setbg="{{ asset("assets/img/breadcrumb.jpg") }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Giỏ hàng</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table class="table table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="width: 40%" class="shoping__product">Sản phẩm</th>
                                <th class="shoping__product">Chi tiết</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <tr class="cart__container" data-cart-id="{{ $cart->id }}">
                                    <td class="shoping__cart__item">
                                        <div class="d-flex">
                                            <img src="{{ $cart->image ?  $cart->image :  asset("assets/img/img-default.jpg") }}" alt="">
                                            <h5 class="">{{ $cart->name }}</h5>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__info">
                                        @for ($i = sizeof($cart->variation) - 1; $i >= 0; $i--)
                                            <span>{{ $cart->variation[$i]->name }}: {{ $cart->variation[$i]->value }}</span>
                                            <br>
                                        @endfor
                                    </td>
                                    <td class="shoping__cart__price">
                                        {{ formatCurrency($cart->price) }}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="{{ $cart->quantity }}">
                                            </div>
                                        </div>
                                        <input type="hidden" class="product-item-quantity" value="{{ $cart->max_quantity }}">
                                        <input type="hidden" class="product-item-price" value="{{ $cart->price }}">
                                    </td>
                                    <td class="shoping__cart__total price__container">
                                        <span>{{ formatCurrency($cart->price *  $cart->quantity) }}</span>
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close"></span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="shoping__cart__btns">
                    <a href="{{ route("home") }}" class="primary-btn">Tiếp tục mua sắm</a>
                </div>
            </div>
            <div class="col-lg-6 shoping__checkout">
                <div class="shoping__checkout">
                    <ul>
                        <li>Tổng tiền <span>{{ $carts_price }}</span></li>
                    </ul>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route("checkout.index") }}" class="primary-btn">Thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" id="cart_update_url" value="{{ route("api.carts.update", ["cart" => ":id"]) }}">
<input type="hidden" id="cart_delete_url" value="{{ route("api.carts.destroy", ["cart" => ":id"]) }}">
@endsection

@push("js")
    <script src="{{ asset("assets/js/lodash.min.js") }}"></script>
    <script src="{{ asset("assets/js/carts/cart.js") }}"></script>
@endpush

@push("css")
    <style>
        .shoping__cart__info{
            text-align: left
        }
        .shoping__cart__item img{
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
@endpush