$(document).ready(function(){
    const inputCode = $(".product input[name='code']");

    if(inputCode.val()){
        getOrderInfo();
    }
    $(".btn-search-order").on("click", function(){
        getOrderInfo();
    })

    function getOrderInfo(){
        let url = $("#order_details_url").val();
        url = url.replace(":id", inputCode.val());
        $.ajax({
            method: "POST",
            url: url,
            success: function(response){
                $(".shoping-cart").show();
                renderOrderInfo(response.data);
                renderOrderDetails(response.data.order_details);
            },
            error: function(res){
                $(".shoping-cart").hide();
                alertError(res.responseJSON.message);
            }
        });
    }

    function renderOrderInfo(data){
        let html = 
                `<div class="col-lg-4">
                    <h4 class="mb-1">Thông tin đơn hàng</h4>
                    <p>Mã đơn hàng: <i>${ data.order_code }</i></p>
                    <p>Ngày tạo: <i>${ data.created_at }</i></p>
                    <p>Tình trạng đơn hàng: <i>${ data.status }</i></p>
                    <p>Hình thức thanh toán: <i>${ data.payment_method }</i></p>
                    <p>Trạng thái thanh toán: <i>${ data.payment_status }</i></p>           
                </div>
                <div class="col-lg-4">
                    <h4 class="mb-1"> -- </h4>
                    <p>Phí ship: <i>${ formatCurrency(data.shipping_price) }</i></p>
                    <p>Giảm giá <i>${ formatCurrency(data.coupon_value) }</i></p>
                    <p>Tiền hàng: <i>${ formatCurrency(data.total) }</i></p>
                    <p>Tổng thanh toán: <i>${ formatCurrency(data.amount) }</i></p>
                </div>
                <div class="col-lg-4">
                    <h4 class="mb-1">Thông tin khách hàng</h4>
                    <p>Tên: <i>${ data.name }</i></p>
                    <p>Số điện thoại: <i>${ data.phone }</i></p>
                    <p>Email: <i>${ data.email }</i></p>
                    <p>Địa chỉ: <i>${ data.address }</i></p>
                    <p>Cụ thể: <i>${ data.address2 }</i></p>
                </div>`;
        $(".order-info").html(html);
    }

    function renderOrderDetails(data){
        let html = "";
        data.forEach(function(item, index){
            html += 
            `<tr class="cart__container">
                <td>${ index + 1 }</td>
                <td class="shoping__cart__item">
                    <div class="d-flex">
                        <img src="${ item.image ?? image_default }" alt="">
                        <h5 class="">${ item.name }</h5>
                    </div>
                </td>
                <td class="shoping__cart__info">
                    ${ item.info }
                </td>
                <td class="shoping__cart__price">
                    ${ formatCurrency(item.price) }
                </td>
                <td class="shoping__cart__price">
                    ${ item.quantity }
                </td>
                <td class="shoping__cart__total price__container">
                    ${ formatCurrency(item.price *  item.quantity) }
                </td>
            </tr>`
        });
        $(".shoping__cart__table tbody").html(html);
    }
});

