@extends("core::main")

@section("content")
<section class="breadcrumb-section set-bg" data-setbg="{{ asset("storage/setup/header.jpg") }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Liên hệ</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_phone"></span>
                    <h4>Số điện thoại</h4>
                    <p>{{ $company["phone"] }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_pin_alt"></span>
                    <h4>Địa chỉ</h4>
                    <p>{{ $company["address"] }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_clock_alt"></span>
                    <h4>Mở cửa</h4>
                    <p>24/ 24</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_mail_alt"></span>
                    <h4>Email</h4>
                    <p>{{ $company["email"] }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>Bạn có góp ý hoặc muốn hợp tác</h2>
                </div>
            </div>
        </div>
        <form action="{{ route("store_contact") }}" method="POST">
            @csrf
            @include("core::helpers.__show__message_basic")
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <input type="text" name="name" placeholder="Nhập tên">
                </div>
                <div class="col-lg-6 col-md-6">
                    <input type="text" name="email" placeholder="Nhập email">
                </div>
                <div class="col-lg-12 text-center">
                    <textarea name="content" placeholder="Nhập nội dung"></textarea>
                    <button type="submit" class="site-btn">Gửi</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="map">
    <iframe class="w-100 mb-3 iframe-map" style="height: 500px;" loading="lazy" allowfullscreen
        src="{{ "https://www.google.com/maps/embed/v1/place?key=AIzaSyBjyAuhSLp4OkdsVq-SwTCJ-yNYIKC77mo&q={$company['latitude']},{$company['longitude']}&zoom={$company['zoom']}&maptype=satellite"}}">
    </iframe>
</div> 
@endsection