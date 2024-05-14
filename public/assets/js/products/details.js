$(document).ready(function(){
    let price = $(".product-item-price").val();
    $(".product__details__price span").first().html(formatCurrency(price));
});

$(document).on("click", ".variation__btn",async function(){
    try {
        const btnVariation = $(this);
        btnVariation.siblings().removeClass("active");
        btnVariation.addClass("active");
        const variationParent = btnVariation.parent();
        const variationNext = variationParent.next();
        const variationId = $(this).data("variation-id");
        if(variationNext && variationNext.hasClass("product__details__variations_item")){
            const depth = variationParent.data("depth");
            const html = await renderVariation(depth, variationId);
            variationNext.html(html);
            $(".variation__btn", variationNext).first().click();
            return;
        }
        const item = items.find((item) => item.product_variation_id == variationId);
        if(item){
            $(".product__details__price span").first().html(formatCurrency(item.price));
            $(".product__details__instock span").first().html(item.available);
            $(".product-item-id").val(item.id);
            $(".product-item-price").val(item.price);
            $(".product-item-quantity").val(item.available);
            $(".pro-qty input").val(1);
        }
    } catch (error) {
        console.log(error);
    }
});

async function renderVariation(depth, variationId){
    const variation = await getVariationByDepth(variations, variationId, depth);
    let html = `<h5 class="variation__label">${ variation.children[0].name }</h5>: `;
    variation.children.forEach((sub_variation, index) => {
        html += `<button 
                    class="variation__btn ${ index == 0 ? 'active' : ''}" 
                    data-variation-id="${sub_variation.id}"
                >
                    ${sub_variation.value}
                </button>`;
    });
    return html;
}

async function getVariationByDepth(variations, variationId, depth, depthCurrent = 0) {
    const isContinue = depth !== depthCurrent;
    for (const item of variations) {
        if (isContinue) {
            const result = await getVariationByDepth(item.children, variationId, depth, depthCurrent + 1);
            if (result) {
                return result;
            }
        }
        if (item.id == variationId) {
            return item;
        }
    }
}

$(document).on("click", ".btn__cart_add", function(){
    const productItemId = $(".product-item-id").val();
    const quantity = $(".pro-qty input").val();
    let url = $("#carts_store_url").val();
    const data = {
        product_item_id: productItemId,
        quantity: quantity
    }
    $.ajax({
        method: "POST",
        url: url,
        data,
        success: function(response){
            alertSuccess(response.message);
            $(".header__cart__count span").html(response.data.total_product);
            $(".header__cart__price span").html(formatCurrency(response.data.total_price));
        },
        error: function(res){
            alertError("Thêm sản phẩm vào giỏ hàng thất bại", res.responseJSON.message);
        }
    });
});