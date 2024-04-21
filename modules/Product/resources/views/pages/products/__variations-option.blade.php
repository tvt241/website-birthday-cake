<div class="my-2 product__details__variations_item" data-depth="{{ $variations[0]->depth }}">
    <h5 class="variation__label">{{ $variations[0]->name  }}</h5>
    :
    @foreach ($variations as $key => $variation)
        <button 
            class="variation__btn {{ $key == 0 ? "active" : "" }}" 
            data-variation-id="{{ $variation->id }}"
        >
            {{ $variation->value }}
        </button>
    @endforeach 
</div>

@if($variations[0]->children->count())
    @include("product::pages.products.__variations-option", ["variations" => $variations[0]->children])
@else
    @include("product::pages.products.__instock", ["variation" => $variations[0]])
@endif