<ul class="product__details__instock mb-2">
    <li>
        <b>Còn lại</b>
        <span>{{ $variation->quantity }}</span>
    </li>
</ul>
<input type="hidden" class="product-item-price" value="{{ $variation->price }}">
<input type="hidden" class="product-item-id" value="{{ $variation->product_item_id }}">
<input type="hidden" class="product-item-quantity" value="{{ $variation->quantity }}">