@extends('core::main')

@section('content')
<section class="breadcrumb-section set-bg" data-setbg="{{ asset("storage/setup/header.jpg") }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Thông tin của bạn</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about" class="about section-show">
    <div class="about-me container">
        @php $user = auth()->user() @endphp
        <div class="row align-items-center">
            <div class="col-lg-4" data-aos="fade-right">
                <img src="{{ asset("assets/img/img-default.jpg") }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
                <h3>Tên: {{ $user->name }}</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <ul>

                            <li>
                                <i class="fa fa-chevron-right"></i>
                                <strong>Tên đăng nhập:</strong>
                                <span>{{ $user->username }}</span>
                            </li>

                            <li>
                                <i class="fa fa-chevron-right"></i>
                                <strong>Số điện thoại:</strong>
                                <span>{{ $user->phone }}</span>
                            </li>

                            <li>
                                <i class="fa fa-chevron-right"></i>
                                <strong>Email:</strong>
                                <span>{{ $user->email }}</span>
                            </li>

                            <li>
                                <i class="fa fa-chevron-right"></i>
                                <strong>Ngày tạo:</strong>
                                <span>{{ $user->created_at->format("d-m-Y") }}</span>
                            </li>

                            <li>
                                <i class="fa fa-chevron-right"></i>
                                <strong>Tình trạng:</strong>
                                <span>{{ $user->active_name }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul>
                            <li>
                                <i class="fa fa-chevron-right"></i>
                                <strong>Ngày sinh:</strong>
                                <span>{{ $user->birthday_human }}</span>
                            </li>

                            <li>
                                <i class="fa fa-chevron-right"></i>
                                <strong>Tuổi:</strong> 
                                <span>{{ $user->age }}</span>
                            </li>

                            <li>
                                <i class="fa fa-chevron-right"></i>
                                <strong>Giới tính:</strong>
                                <span>Nam</span>
                            </li>

                            <li>
                                <i class="fa fa-chevron-right"></i>
                                <strong>Loại thành viên:</strong>
                                <span>Khách hàng thân thiết</span>
                            </li>

                            <li>
                                <i class="fa fa-chevron-right"></i>
                                <strong>Điểm tích lũy:</strong>
                                <span>400</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <ul>
                            <li>
                                <i class="fa fa-chevron-right"></i>
                                <strong>Địa chỉ chính:</strong>
                                <span>{{ $company["address"] }}</span>
                            </li>
                        </ul>
                        <div class="d-flex gap-2 justify-content-between">
                            <button class="btn btn-primary">
                                <a class="text-white" href="{{ route("profile.edit") }}">Cập nhật thông tin</a>
                            </button>
                            <button class="btn btn-primary">Cập nhật địa chỉ</button>
                            <button class="btn btn-primary">
                                <a class="text-white" href="{{ route("password.update") }}">Đổi mật khẩu</a>
                            </button>
                            <button class="btn btn-danger btn-delete-account">Xóa tài khoản</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="counts container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="count-box">
                    <i class="fa fa-shopping-cart fa-custom"></i>
                    <span>{{ $orders->count() }}</span>
                    <p>Đơn hàng</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                <div class="count-box">
                    <i class="fa fa-truck fa-custom"></i>
                    <span>{{ $order_pending_count }}</span>
                    <p>Đang sử lý</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                <div class="count-box">
                    <i class="fa fa-check fa-custom"></i>
                    <span>{{ $order_done_count }}</span>
                    <p>Hoàn thành</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                <div class="count-box">
                    <i class="fa fa-times fa-custom"></i>
                    <span>{{ $order_cancel_count }}</span>
                    <p>Thất bại</p>
                </div>
            </div>
        </div>
    </div>
    @if(sizeof($orders))
        <div class="container orders">
            <div class="my-5">
                <div class="section-title product__discount__title">
                    <h2>Danh sách đơn hàng</h2>
                </div>
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Mã đơn hàng</th>
                        <th>Tổng tiền</th>
                        <th>Thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $order)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <a href="{{ route("orders.index", ["code" => $order->order_code]) }}" title="Xem chi tiết đơn hàng">
                                        {{ $order->order_code }}
                                    </a>
                                </td>
                                <td class="text-right">{{ formatCurrency($order->amount) }}</td>
                                <td>{{ $order->payment_method_name . " - " . $order->payment_status_name }}</td>
                                <td>{{ $order->order_status_name }}</td>
                                <td class="text-right">
                                    @if ($order->is_cancel)
                                        <button class="btn btn-primary btn-cancel" data-order-code="{{ $order->order_code }}">Hủy</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    <form action="{{ route("profile.delete") }}" method="POST" class="d-none form-delete">
        @csrf
    </form>

</section>
@endsection

@push("js")
    <script>
        $(".btn-delete-account").on("click", function(){
            alertConfirm()
                .then((result) => {
                    if(result.isConfirmed){
                        $(".form-delete").submit();
                    }
                })
        });
    </script>
@endpush

@push('css')
    <style>
        .about-me .content h3 {
            font-weight: 700;
            font-size: 26px;
            margin-bottom: 20px;
        }

        .about-me .content ul i {
            font-size: 16px;
            margin-right: 5px;
            color: #f26957;
            line-height: 0;
        }

        .about-me .content ul li {
            list-style: none;
            margin-bottom: 20px;
        }

        .about-me .content ul li span {
            float: right;
        }

        .counts .count-box {
            padding: 30px 30px 25px 30px;
            width: 100%;
            position: relative;
            text-align: center;
            background: rgb(255 0 0 / 15%);
        }

        section .container {
            padding: 30px;
        }

        .counts .count-box span {
            font-size: 36px;
            display: block;
            font-weight: 600;
        }

        .counts .count-box i {
            position: absolute;
            top: -25px;
            left: 50%;
            height: 45px;
            width: 45px;
            transform: translateX(-50%);
            font-size: 24px;
            background: #f26957;
            padding: 12px;
            color: #ffffff;
            border-radius: 50px;
            line-height: 0;
        }

        .counts .count-box p {
            padding: 0;
            margin: 0;
            font-family: "Raleway", sans-serif;
            font-size: 14px;
        }

        .fa-custom:before {
            position: relative;
            top: 9px;
            left: -1px;
        }

        .fa-times::before {
            left: 0px;
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
