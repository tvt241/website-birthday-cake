@extends("core::main")
@section("title")
    Xác thực tài khoản
@endsection

@section("content")

<div class="container auth__contaner">
    <div class="row my-4 col-md-8 col-12 mx-auto">
        <form action="{{ route("update_password") }}" method="POST" class="mx-auto col-12 col-md-10 form-forgot-password">
            @csrf
            <input type="hidden" value="{{ request("token") }}" name="token">
            <div class="card rounded">
                <div class="card-header bg-white">
                  <h4>Cập nhật mật khẩu</h4>
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
                        <label for="">Mật khẩu mới <span class="text-danger"> *</span></label>
                        <input type="text" placeholder="Nhập mật khẩu mới" name="password" class="form-control p-2">
                    </div>
                    <div class="form-group">
                        <label for="">Nhập lại mật khẩu mới <span class="text-danger"> *</span></label>
                        <input type="text" placeholder="Nhập mật khẩu mới" name="re-password" class="form-control p-2">
                    </div>
                    @include("core::helpers.__show__message_basic")
                    <div class="text-right">
                        <button class="btn btn-secondary btn-cancel p-2">Huỷ</button>
                        <button class="btn btn-success p-2 btn-confirm">Cập nhật</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset("assets/css/auth.css") }}">
@endpush


@push("js")
@endpush
