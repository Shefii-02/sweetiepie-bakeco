@if($product)
<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
    <a href="{{ url('product/' . $product->slug) }}" class="cursor-pointer text-decoration-none">
        <div>
            <img class="w-100" src="{!! $product->thumbImages->count()
                ? asset('images/products/' . $product->thumbImages->first()->picture)
                : asset('/assets/images/dummy-product.jpg') !!}"
                onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';" alt="{{ $product->name }}">
            <div class="text-center">
                <div class="fw-semibold fs-5">{{ $product->name }}</div>
                <div class="text-muted">{{ $product->categories->pluck('name')->implode(', ') }}</div>
            </div>
        </div>
    </a>
</div>
@endif