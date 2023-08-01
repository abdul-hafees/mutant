<div class="row d-flex">
    <a class="button-edit" href="{{ route('admin.products.edit', $product->id) }}">
        <i class="fas fa-edit ml-3"></i>
    </a>

    @if($product->variants()->count() > 0)
        <a class="button-show" href="{{ route('admin.products.show', $product->id) }}"><i class="fas fa-eye ml-2"></i></a>
    @endif

    <a class="button-destroy text-danger"
       href="{{ route('admin.products.destroy', $product->id) }}">
        <i class="fas fa-trash ml-3"></i>
    </a>

    <a class="manage-stock text-success ml-3"
       href="#" data-id="{{$product->id}}"
       data-name="{{$product->base_name}}{{$product->variant_name}}"
       data-price="{{$product->price}}"
       data-qty="{{$product->available_stock_qty}}"
       data-discount-price="{{$product->discount_price}}">
        <button class="btn btn-sm btn-success">Manage Stock</button>
    </a>
</div>
