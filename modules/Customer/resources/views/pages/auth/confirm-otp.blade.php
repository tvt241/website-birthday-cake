@extends("core::main")
@section("title")
    Xác thực tài khoản
@endsection

@section("content")

<div class="container auth__contaner">
    <div class="row my-4 col-md-8 col-12 mx-auto">
        <form action="{{ route("check_invalid_otp") }}" method="POST" class="mx-auto col-12 col-md-10 form-forgot-password">
            @csrf
            <div class="card rounded">
                <div class="card-header bg-white">
                  <h4>Xác thực tài khoản</h4>
                </div>
                <div class="card-body">
                    @if(request("email"))
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text"  readonly class="form-control" name="username" value="{{ request("email") }}"> 
                        </div>
                    @else
                        <div class="form-group">
                            <label for="">Số điện thoại</label>
                            <a href="{{ route("forgot_password") }}" class="float-right text-primary">Không phải của bạn ?</a>
                            <input type="text" readonly class="form-control" name="username" value="{{ request("phone") }}"> 
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="">Nhập mã xác thực <span class="text-danger"> *</span></label>
                        <input type="text" placeholder="Nhập mã xác thực" name="code" class="form-control p-2">
                        <span class="error text-danger" style="display: none"></span>
                    </div>
                    @include("core::helpers.__show__message_basic")
                    <span class="view-count-down">Gửi lại mã xác minh sau <span class=""></span> giây</span>
                    <span class="view-resend-otp" style="display: none"><a class="text-primary" href="javascript:void(0)">Gửi lại mã xác nhận</a></span>
                    <div id="recaptcha"></div>
                    <input type="hidden" name="recaptcha_token">
                    <div class="text-right">
                        <button class="btn btn-secondary btn-cancel p-2">Huỷ</button>
                        <button class="btn btn-success p-2 btn-confirm">Xác nhận</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<input type="hidden" value="{{ route("resend_otp") }}" id="re_send_otp_url">
<input type="hidden" value="{{ session("send_verify_at", ) }}" id="time_send_verify_old">
@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset("assets/css/auth.css") }}">
@endpush


@push("js")
    <script src="{{ asset('assets/js/auth/count-down.js') }}"></script>
    <script type="module" src="{{ asset('assets/js/auth/firebase-ajax.js') }}"></script>
@endpush
