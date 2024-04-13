@extends("main")

@section("content")
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Thông tin thanh toán</h4>
            <form action="{{ route("checkout.store") }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Tên người nhận<span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Số điện thoại<span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="checkout__input ">
                                        <p>Tỉnh/ Thành phố <span>*</span></p>
                                        <select name="" id="" class="form-control provinces__input">
                                            <option value="">-- Chọn Tỉnh/ Thành Phố</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="checkout__input ">
                                        <p>Quận/ Huyện <span>*</span></p>
                                        <select name="" id="" class="form-control districts__input">
                                            <option value="">-- Chọn Quận/ Huyện</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="checkout__input">
                                        <p>Xã/ Phường<span>*</span></p>
                                        <select name="" id="" class="form-control wards__input">
                                            <option value="">-- Chọn Xã/ Phương</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ chi tiết<span>*</span></p>
                            <input type="text" placeholder="Địa chỉ cụ thể" class="">
                        </div>
                        
                        <div class="checkout__input">
                            <p>Ghi chú<span>*</span></p>
                            <input type="text"
                                placeholder="Bạn có luư ý những gì với đơn hàng này không?">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Đơn hàng của bạn</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Giá</span></div>
                            <ul>
                                <li>Vegetable’s Package <span>$75.99</span></li>
                                <li>Fresh Vegetable <span>$151.99</span></li>
                                <li>Organic Bananas <span>$53.99</span></li>
                            </ul>
                            <div class="checkout__order__subtotal">
                                Giảm giá
                                <span>$0</span>
                                <div class="checkout__input mt-2 mb-0 d-flex">
                                    <input type="text" class="col-8" placeholder="Mã giảm giá">
                                    <button class="site-btn col-4 btn__coupons">Dùng</button>
                                </div>
                            </div>
                            
                            <div class="checkout__order__total">Tổng tiền <span>$750.99</span></div>
                            
                            
                            <div class="checkout__input__checkbox">
                                <input type="radio" value="online" checked name="method-payment" id="">
                                <label for="payment">
                                    Thanh toán online (VNPAY)
                                </label>
                            </div>
                            {{-- <div class="checkout__input__checkbox">
                                <div class="bg-white mb-1 text-center">
                                    <a href="#">
                                        <img class="image-payment" src="{{ asset("assets/img/payment/VNPAY_Logo.webp") }}" alt="">
                                    </a>
                                </div>
                                <div class="bg-white mb-1 text-center">
                                    <a href="#">
                                        <img class="image-payment" src="{{ asset("assets/img/payment/ZaloPay_Logo.png") }}" alt="">
                                    </a>
                                </div>
                                <div class="bg-white mb-1 text-center">
                                    <a href="#">
                                        <img class="image-payment" src="{{ asset("assets/img/payment/MOMO_Logo.webp") }}" alt="">
                                    </a>
                                </div>
                            </div> --}}
                            <div class="checkout__input__checkbox">
                                <input type="radio" value="cod" name="method-payment">
                                <label for="paypal">
                                    Ship Cod
                                </label>
                            </div>
                            <button type="submit" class="site-btn">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<input type="hidden" id="provinces_url" value="{{ route("locations.provinces") }}">
<input type="hidden" id="districts_url" value="{{ route("locations.districts", ["province" => ":province"]) }}">
<input type="hidden" id="wards_url" value="{{ route("locations.wards", ["district" => ":district"]) }}">

@endsection

@push("css")
    <style>
        .form-control {
            height: auto;
            border-color: #f0f0f0; 
        }
        .image-payment{
            height: 50px;
        }
        .btn__coupons{
            margin: 0 !important;
            padding: 0 !important;
            font-size: 15px !important;
        }
    </style>
@endpush

@push("js")
    <script src="{{ asset("assets/js/carts/checkout.js") }}"></script>
@endpush

