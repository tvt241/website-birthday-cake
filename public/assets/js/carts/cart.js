$(document).ready(function(){
    $(".icon_close").on("click", function(e){
        const $button = $(this);
        const itemContainer = $button.closest(".cart__container");
        const cartId = itemContainer.data("cart-id");
        let url = $("#cart_delete_url").val();
        url = url.replace(":id", cartId);

        $.ajax({
            method: "DELETE",
            url: url,
            success: function(response){
                alertSuccess(response.message);
                $(".header__cart__count span").html(response.data.total_product);
                $(".header__cart__price span").html(formatCurrency(response.data.total_price));
                $(".shoping__checkout span").html(formatCurrency(response.data.total_price));
                itemContainer.remove();
            },
        });
    });

    $('.pro-qty').on('click', '.qtybtn',_.debounce(function () {
        const itemContainer = $(this).closest(".cart__container");
        const cartId = itemContainer.data("cart-id");

        const inputQty = $(".pro-qty input", itemContainer);
        const quantity = inputQty.val();

        let url = $("#cart_update_url").val();
        url = url.replace(":id", cartId);

        $.ajax({
            method: "PUT",
            url: url,
            data: {
                quantity
            },
            success: function(response){
                toastSuccess(response.message);
                $(".pro-qty input", itemContainer).val(response.data.quantity);
                $(".price__container span", itemContainer).html(formatCurrency(response.data.price));
                
                $(".header__cart__price span").html(formatCurrency(response.data.total_price));
                $(".shoping__checkout span").html(formatCurrency(response.data.total_price));
            },
        });
    }, 700));

    $('.pro-qty input').on('keyup', _.debounce(function () {
        const itemContainer = $(this).closest(".cart__container");
        const cartId = itemContainer.data("cart-id");

        const inputQty = $(".pro-qty input", itemContainer);
        const quantity = inputQty.val();

        let url = $("#cart_update_url").val();
        url = url.replace(":id", cartId);

        $.ajax({
            method: "PUT",
            url: url,
            data: {
                quantity
            },
            success: function(response){
                toastSuccess(response.message);
                inputQty.val(response.data.quantity);
                $(".price__container span", itemContainer).html(formatCurrency(response.data.price));
                
                $(".header__cart__price span").html(formatCurrency(response.data.total_price));
                $(".shoping__checkout span").html(formatCurrency(response.data.total_price));
            },
        });
    }, 700));
});


