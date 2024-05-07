<div class="d-flex align-items-center justify-content-between">
    <a href="{{ route("products", ["category" => $category->slug]) }}">
        {{ $category->name }}
    </a>
    <i class="fa fa-angle-right mr-3"></i>
</div>
