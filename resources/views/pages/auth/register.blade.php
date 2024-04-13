@extends("main")
@section("title")
    Đăng ký
@endsection

@section("content")

<div class="container auth__contaner">
    <div class="row my-4 col-md-10 mx-auto">
        <div class="col-lg-6 col-md-6" style="padding: 350px 20px 20px; background-repeat: no-repeat; background-size: cover; background-image: url('https://bizweb.dktcdn.net/100/333/744/themes/861829/assets/account-banner.jpg?1711936814284')">
            <div class="account_policy_title">Quyền lợi thành viên</div>
            <div class="account_policy_content">
                <p>Chương trình khuyến mãi, quay số</p>
                <p>Theo dõi chi tiết đơn hàng, địa chỉ thanh toán dễ dàng</p>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 border">
            <div class="mb-3 mt-2 text-center col-md-10 mx-auto">
                <ul class="nav nav-underline-active-primary justify-content-center mb-3">
                    <li class="nav-item col-6">
                        <a class="nav-link text-dark" href="{{ route("login") }}">
                            Đăng nhập
                        </a>
                    </li>
                    <li class="nav-item col-6 font-weight-bold active">
                        <a class="nav-link ">
                            Đăng ký
                        </a>
                    </li>
                </ul>
            </div>
            <form action="https://tvt.id.vn/login" method="POST" class="col-md-10 mx-auto my-4">
                @csrf
                <div class="form-outline mb-4">
                    <label for="">
                        Tên đăng nhập
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="email" name="email" class="form-control" value="" placeholder="vd: banhngot">
                </div>

                <div class="form-outline mb-3">
                    <label for="">
                        Mât khẩu
                        <span class="text-danger">*</span>
                    </label>
                    <input type="password" id="password" name="password" class="form-control" value="" placeholder="Nhập mật khẩu">
                </div>

                <div class="form-outline mb-3">
                    <label for="">
                        Nhập lại mât khẩu
                        <span class="text-danger">*</span>
                    </label>
                    <input type="password" id="repassword" name="repassword" class="form-control" value="" placeholder="Nhập lại mật khẩu">
                </div>
                <div class="text-center text-lg-start mt-4 pt-2">
                    <button class="site-btn">
                        Đăng ký
                    </button>

                    <p class="fw-bold mt-2 pt-1">Bạn đã có tài khoản? <a href="{{ route("login") }}" class="text-primary">Đăng Nhập</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push("css")
    <style>
        .divider::before,
        .divider::after {
            content: '';
            width: 100%;
            top: 50%;
            height: 1px;
            background-color:#bebebe;
        }

        .divider::before {
            left: -10px;
            right: auto;
        }

        .divider::after {
            right: -10px;
            left: auto;
        }

        .auth__contaner ul li:after {
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 2px;
            background: #7fad39;
            content: "";
            opacity: 0;
        }

        .auth__contaner ul li.active:after {
            opacity: 1;
        }

        .account_policy_title {
            font-weight: 500;
            margin-bottom: 10px;
            text-transform: uppercase;
            font-size: 16px;
            line-height: 22px;
            color: #303846;
        }

        .account_policy_content p {
            margin-bottom: 7px;
            margin-top: 0 !important;
            position: relative;
            padding-left: 22px;
            font-size: 13px;
            line-height: 1.3;
        }

        .account_policy_content p:after {
            content: "";
            height: 15px;
            width: 15px;
            background-image: url("https://bizweb.dktcdn.net/100/333/744/themes/861829/assets/account_policy_icon.svg?1711936814284");
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            left: 0;
            top: 50%;
            transform: translate(0, -50%);
            position: absolute;
        }
    </style>
@endpush