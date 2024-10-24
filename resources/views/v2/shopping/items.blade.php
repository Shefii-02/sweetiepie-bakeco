<div class="col-md-12 main-stic">
    <div class="container p-0 m-auto">
        <div class="row product-row slim-row">
            <div class="col-12 slim-col">
                <div class="row aligin-items-center">
                    <div class="col-auto mr-sm-auto">
                        <h2 class="fw-normal">Shopping</h2>
                    </div>
                </div>
            </div>
            @forelse ($products as $product)
                <div class="slim-col col-xxl-2 col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-6 mb-3 product-col-container">
                    <div href="{{ url('product/' . $product->slug) }}" class="p-3 product-col h-100 cursor-pointer position-relative">
                        <span class="view-product"><span class="position-relative"><i
                                    class="fa-solid fa-arrow-up"></i></span></span>
                        <div class="product-image position-relative">
                            <img class="w-100" src="{!! $product->thumbImages->count()
                                ? asset('images/products/' . $product->thumbImages->first()->picture)
                                : asset('/assets/images/dummy-product.jpg') !!}"
                                onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';"
                                alt="{{ $product->name }}">
                        </div>
                        <div class="product-footer">
                            <p class="small shade brand-name">{{ $product->categories->pluck('name')->implode(', ') }}</p>
                            <p class="h6 product-name">{{ $product->name }}</p>
                            @if(!$product->has_variation)
                            <p class="h5 font-weight-bold">{{ getPrice($product->product_variant->price) }}</p>
                            <p class="mb-0">{{ getPrice($product->product_variant->price) }} <small class="fw-normal text-muted extra-small">per {{ $product->product_variant->weight }}</small></p>
                            @else
                            @php
                                $v = $product->product_variation()->orderBy('price')->first();
                            @endphp
                            <p class="h5 font-weight-bold"><span class="fw-normal text-muted extra-small">From</span> {{ getPrice($v->price) }}</p>
                            <p class="mb-0">{{ getPrice($v->price) }} <small class="fw-normal text-muted extra-small">per {{ $v->weight }}</small></p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
            <div class="col-12 text-center my-5">
                <div>
                    
                </div>
                <h1 class="text-muted display-4 fw-normal">No products found</h1>
                <div class="text-muted fs-5">Your search did not match any results, please try again</div>
            </div>
            @endforelse
            <div class="mt-4 col-12 slim-col mb-5">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
