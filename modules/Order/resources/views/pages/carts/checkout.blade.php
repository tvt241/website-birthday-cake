@extends("core::main")

@section("content")
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Thông tin thanh toán</h4>
            <form action="{{ route("checkout.store") }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        @php $user = auth()->user() @endphp
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <label>Tên người nhận<span class="text-danger">*</span></label>
                                    <input type="text" 
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old("name", $user?->name) }}"
                                        name="name"
                                    >
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="checkout__input">
                                    <label>Số điện thoại<span class="text-danger">*</span></label>
                                    <input type="text" 
                                        class="form-control @error('phone') is-invalid @enderror" 
                                        value="{{ old("phone", $user?->phone) }}"
                                        name="phone"
                                    >
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="checkout__input">
                                    <label>Email</label>
                                    <input type="text" 
                                        class="form-control @error('email') is-invalid @enderror" 
                                        value="{{ old("email", $user?->email) }}"
                                        name="email"
                                    >
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <label>Tỉnh/ Thành phố <span class="text-danger">*</span></label>
                                    <select name="province_name" id="" class="form-control provinces__input @error('province_name') is-invalid @enderror">
                                        <option value="">-- Chọn --</option>
                                    </select>
                                    @error('province_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="checkout__input ">
                                    <label>Quận/ Huyện <span class="text-danger">*</span></label>
                                    <select name="district_name" id="" class="form-control districts__input @error('district_name') is-invalid @enderror">
                                        <option value="">-- Chọn --</option>
                                    </select>
                                    @error('district_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="checkout__input">
                                    <label>Xã/ Phường<span class="text-danger">*</span></label>
                                    <select name="ward_name" id="" class="form-control wards__input @error('ward_name') is-invalid @enderror">
                                        <option value="">-- Chọn --</option>
                                    </select>
                                    @error('ward_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <label>Địa chỉ chi tiết<span class="text-danger">*</span></label>
                            <input type="text" name="address2" placeholder="Địa chỉ cụ thể" class="form-control @error('address2') is-invalid @enderror">
                            @error('address2')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="checkout__input">
                            <label>Ghi chú</label>
                            <input type="text" name="note" class="form-control"
                                placeholder="Bạn có lưu  ý những gì với đơn hàng này không?">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="checkout__order">
                            <h4>Đơn hàng của bạn</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Giá</span></div>
                            <ul>
                                @foreach ($carts as $cart)
                                    <li>
                                        <div class="row align-items-end">
                                            <div class="col-9">
                                                {{ $cart->name }} <b>x {{ $cart->quantity }}</b>
                                                @if($cart->info)
                                                    ( {{ $cart->info }} )
                                                @endif
                                            </div>
                                            <div class="col-3 text-right">
                                                <span>{{ formatCurrency($cart->quantity * $cart->price) }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="checkout__order__subtotal">
                                Giảm giá
                                <span>0</span>
                                <div class="checkout__input mt-2 mb-0 d-flex">
                                    <input type="text" name="coupon_code" class="col-8 form-control @error('coupon_code') is-invalid @enderror" placeholder="Mã giảm giá">
                                    <button class="site-btn col-4 btn__coupons" type="button">Dùng</button>
                                    @error('coupon_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="checkout__order__shipping" style="display: none">Phí ship <span>0</span></div>
                            <div class="checkout__order__shipping">Tổng tiền <span>{{ $carts_price }}</span></div>
                            
                            <div class="checkout__order__total">Thanh toán <span>{{ $carts_price }}</span></div>
                            
                            <div class="checkout__input__checkbox">
                                <input type="radio" value="VNPAY" checked name="method_payment" id="VNPAY">
                                <label for="VNPAY">
                                    Thanh toán online (VNPAY)
                                </label>
                            </div>

                            {{-- <div class="checkout__input__checkbox">
                                <input type="radio" value="PAYOS" name="method_payment" id="PAYOS">
                                <label for="PAYOS">
                                    Thanh toán online (PAYOS)
                                </label>
                            </div> --}}
                            <div class="checkout__input__checkbox" >
                                <input type="radio" value="COD" name="method_payment" id="COD">
                                <label for="COD">
                                    Ship Cod
                                </label>
                            </div>
                            @include("core::helpers.__show__message_basic")
                            <button type="submit" class="site-btn">Đặt hàng</button>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</section>
<input type="hidden" id="provinces_url" value="{{ route("api.locations.provinces") }}">
<input type="hidden" id="districts_url" value="{{ route("api.locations.districts", ["province" => ":province"]) }}">
<input type="hidden" id="wards_url" value="{{ route("api.locations.wards", ["district" => ":district"]) }}">
<input type="hidden" id="fee_url" value="{{ route("shippings.fee") }}">
<input type="hidden" id="coupon_check_url" value="{{ route('coupons.check') }}">
<input type="hidden" id="amount" value="{{ $carts_price  }}">

@endsection

@push("css")
    <style>
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
    <script>
        $(".btn__coupons").on("click", function(){
            const code = $("input[name='coupon_code']").val();
            const amount = $("#amount").val().replaceAll(",", "");
            if(!code){
                alertError("Mã giảm giá không được để trống");
                return;
            }
            const data = {
                code,
                amount
            }
            let url = $("#coupon_check_url").val();
            $.ajax({
                method: "POST",
                url: url,
                data,
                success: function(response){
                    const value = response.data.value;
                    let payment = amount - Number(value);
                    $(".checkout__order__subtotal > span").html(formatCurrency(value));
                    $(".checkout__order__total > span").html(formatCurrency(payment));
                    console.log(response);
                },
                error: function(response){
                    console.log(response);
                }
            }); 
        });
    </script>
@endpush

