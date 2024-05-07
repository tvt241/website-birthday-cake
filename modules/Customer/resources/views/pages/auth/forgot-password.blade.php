@extends("core::main")
@section("title")
    Quên mật khẩu
@endsection

@section("content")

<div class="container auth__contaner">
    <div class="row my-4 col-md-8 col-12 mx-auto">
        <form action="{{ route("check_user") }}" method="POST" onsubmit="handleSubmit(event)" class="mx-auto col-12 col-md-10 form-forgot-password">
            @csrf
            <div class="card rounded">
                <div class="card-header bg-white">
                  <h4>Tìm tài khoản</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nhập email hoặc số điện thoại để tìm tài khoản của bạn</label>
                        <input type="text" 
                            placeholder="Nhập email hoặc số điện thoại" 
                            name="username" 
                            class="form-control p-2 @error('username') is-invalid @enderror"
                        >
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @include("core::helpers.__show__message_basic")
                    </div>
                    <div id="recaptcha"></div>
                    <input type="hidden" name="recaptcha_token">
                    <div class="text-right">
                        <button class="btn btn-secondary btn-cancel p-2">Huỷ</button>
                        <button class="btn btn-success p-2 btn-search-user">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset("assets/css/auth.css") }}">
    <style>
        .btn-search-user{
            background-color: #f26957; 
            border: none
        }

        .btn-search-user:hover{
            background-color: #f7361c; 
            border: none
        }
    </style>
@endpush


@push("js")
    <script type="module" src="{{ asset("assets/js/auth/forgot-password.js") }}"></script>
    <script>
        function handleSubmit(e){
            e.preventDefault();
            const input = $("input[name='username']").val().trim();
            if(!input){
                $(".error-message").html("Vui lòng nhập email hoặc số điện thoại").show();
                return;
            }
            $(".error-message").hide();
            recaptchaVerifier.recaptcha.execute();
        }
    </script>
@endpush
