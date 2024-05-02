@extends("core::main")

@section("content")
<section class="breadcrumb-section set-bg" data-setbg="{{ asset("storage/setup/header.jpg") }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Tra cứu đơn hàng</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product">
    <div class="container">
        <div class="row">
            <div class="order__widget col-md-6 offset-md-6">
                <form action="#" method="POST">
                    <input type="text" name="code" value="{{ request("code") }}"  placeholder="Nhập mã đơn hàng">
                    <button type="button" class="site-btn btn-search-order">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="shoping-cart spad" style="display: none">
    <div class="container">
        <div class="row order-info">
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="width: 40%" class="shoping__product">Sản phẩm</th>
                                <th class="shoping__product">Chi tiết</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" id="order_details_url" value="{{ route("orders.details", ["order" => ":id"]) }}">
@endsection

@push("js")
    <script src="{{ asset("assets/js/order/order.js") }}"></script>
@endpush

@push("css")
    <style>
        .order__widget{
            position: relative;
            margin-bottom: 30px;
        }

        .order__widget form input {
            width: 100%;
            font-size: 16px;
            padding-left: 20px;
            color: #1c1c1c;
            height: 46px;
            border: 1px solid #ededed;
        }

        .order__widget form button {
            position: absolute;
            right: 0;
            top: 0;
            padding: 0 26px;
            height: 100%;
        }

        .shoping__cart__info{
            text-align: left
        }
        .shoping__cart__item img{
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .order-info i{
            float: right;
        }
    </style>
@endpush