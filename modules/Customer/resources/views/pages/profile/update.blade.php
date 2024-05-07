@extends('core::main')

@section('content')
<section class="breadcrumb-section set-bg" data-setbg="{{ asset("storage/setup/header.jpg") }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Cập nhật thông tin</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about" class="about section-show">
    <div class="about-me container">
        @php $user = auth()->user() @endphp
        <form action="{{ route("profile.update") }}" method="POST">
            @csrf
            @method("PUT")
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="checkout__input">
                        <label>Tên</label>
                        <input type="text" 
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old("name", $user->name) }}"
                            name="name"
                        >
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <div class="checkout__input">
                        <label>Tên đăng nhập <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control @error('username') is-invalid @enderror"
                            value="{{ old("username", $user->username) }}"
                            name="username"
                        >
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <div class="checkout__input">
                        <label>Email</label>
                        <input type="text" 
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old("email", $user->email) }}"
                            name="email"
                        >
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <div class="checkout__input">
                        <label>Số điện thoại</label>
                        <input type="text" 
                            class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old("phone", $user->phone) }}"
                            name="phone"
                        >
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="checkout__input">
                        <label>Ngày sinh</label>
                        <input type="date" 
                            class="form-control @error('birthday') is-invalid @enderror"
                            value="{{ old("birthday", $user->birthday) }}"
                            name="birthday"
                        >
                        @error('birthday')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    
    
                    <div class="checkout__input">
                        <label>Giới tính</label>
                        <select name="gender" id=""
                            class="form-control @error('gender') is-invalid @enderror" 
                        >
                            <option @if($user->gender == 1) checked @endif value="1">Nam</option>
                            <option @if($user->gender == 0) checked @endif value="0">Nữ</option>
                            <option @if($user->gender == 2) checked @endif value="2">Khác</option>
                        </select>
                        @error('gender')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="checkout__input">
                        <label>Ảnh đại diện</label>
                        <div class="d-flex justify-content-center mt-1">
                            <div class="upload-file">
                                <div class="">
                                    <img width="270" onclick="$('#avartar').click()" src="{{ asset("assets/img/img-default.jpg") }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="custom-file mt-2">
                            <input type="file" name="image" id="avartar"
                                class="custom-file-input"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                            <label class="custom-file-label" for="avartar">Chọn ảnh</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary mr-2">Hủy</button>
                        <button class="btn btn-primary">Cập nhật</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@push('css')
    <style>
       .upload-file__input {
            position: absolute;
            inset-inline-start: 0;
            inset-block-start: 0;
            inline-size: 100%;
            block-size: 100%;
            opacity: 0;
            cursor: pointer;
        }

        section .container {
            padding: 30px;
        }

        .btn-primary{
            background-color: #f26957;
            border: #f26957;
        }

        .btn-primary:hover{
            background-color: #ff1e00;
        }
        
        .btn-primary:active{
            background-color: #ff1e00 !important;
        }

        .btn-danger {
            background-color: #6f6f6f;
            border-color: #6f6f6f;
        }
        .btn-danger:hover{
            background-color: #555555;
            border-color: #6f6f6f;
        }

        .orders a:hover{
            color: unset
        }
    </style>
@endpush
