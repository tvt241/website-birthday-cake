<style>
    .order-info i{
        float: right;
    }
    .order-info b{
        float: right;
    }
    .order-info p{
        margin: 8px 0;
    }
    .header{
        width: 156px;
        height: 100px;
    }
    h4{
        margin: 10px 0;
    }

    table td{
        border-bottom: 1px dashed;
    }
</style>

<div style="width: 315px"> 
    <h2 style="text-align: center">
        Tiệm bánh kemn hương vị việt
    </h2>   
    <p style="text-align: center">
        Số 49, Ngõ 93, Vương Thừa Vũ, Khương Trung, Thanh Xuân, Hà Nội
    </p>
    <hr>
    <div style="float: right">
        {!! QrCode::size(80)->generate(route("orders.details", ["order" => $order->order_code])); !!}
    </div>
    <h2>Hóa đơn bán hàng</h2>
    <div class="order-info">
        <h4 style="margin-top: 30px">Thông tin đơn hàng</h4>
        <p>Mã đơn hàng: <i>{{ $order->order_code }}</i></p>
        <p>Ngày tạo: <i>{{ $order->created_at->format("H:i d-m-Y") }}</i></p>
        <p>Tình trạng đơn hàng: <i>{{ $order->order_status_name }}</i></p>
    </div>
    <hr>
    <h4>Đơn hàng</h4>
    <table>
        <thead>
            <th>#</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
        </thead>
        <tbody>
            @foreach ($order->orderDetails as $key => $item)
                <tr style="border-bottom: 1px solid black">
                    <td style="width: 15px">{{ $key + 1 }}</td>
                    <td>
                        {{ $item->name }}
                        @if($item->info)
                            - {{ $item->info }}
                        @endif
                        ( {{ formatCurrency($item->price) }} x {{ $item->quantity }} )
                    </td>
                    <td style="vertical-align: bottom;">
                        {{ formatCurrency($item->price * $item->quantity) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="order-info">
        <p>Phí ship: <i>{{ $order->shipping_price }}</i></p>
        <p>Giảm giá <i>{{ $order->coupon_value }}</i></p>
        <p>Tiền hàng: <i>{{ $order->total }}</i></p>
        <p>Tổng thanh toán: <i>{{ $order->amount }}</i></p>
        <p>Thanh toán: <b>{{ $order->payment_method_name }} - {{ $order->payment_status_name }}</b></p>
    </div>

</div>
<script>
    print()
</script>