@if ($category)
    @if ($banner)
        @php
            $bgd = $banner->picture
                ? asset('images/banners/' . $banner->picture)
                : url('/assets/themes/theme-1/images/Product-banner-bg.webp');
            $bgm = $banner->picture_small
                ? asset('images/banners/' . $banner->picture_small)
                : url('/assets/themes/theme-1/images/Product-banner-bg.webp');
        @endphp
        <section class="product-listing-banner has-cat {{ $banner->picture_small ? 'd-none d-md-block' : '' }}" style="background:url({{ url($bgd) }})">
            <div class="container-fluid h-100 category-background">
            <div class="row">
                <div class="col-12 position-relative page_product-listing">
                    <h1 class="text-white display-1">{{ $category->name ?? 'Shop' }}</h1>
                </div>
            </div>
        </div>
        </section>
        @if($banner->picture_small)
        <section class="product-listing-banner has-cat d-block d-md-none" style="background:url({{ url($bgm) }})">
            <div class="container-fluid h-100 category-background">
            <div class="row">
                <div class="col-12 position-relative page_product-listing">
                    <h1 class="text-white display-1">{{ $category->name ?? 'Shop' }}</h1>
                </div>
            </div>
        </div>
        </section>
        @endif
    @else
        @php
            $bg = $category->picture
                ? asset('images/categories/' . $category->picture)
                : url('/assets/themes/theme-1/images/Product-banner-bg.webp');
        @endphp
        <section class="product-listing-banner has-cat d-block" style="background:url({{ url($bg) }})">
            <div class="container-fluid h-100 category-background">
            <div class="row">
                <div class="col-12 position-relative page_product-listing">
                    <h1 class="text-white display-1">{{ $category->name ?? 'Shop' }}</h1>
                </div>
            </div>
        </div>
        </section>
    @endif
@else
    <section class="product-listing-banner no-cat">
        <div class="container-fluid h-100">
            <div class="row">
                <div class="col-12 position-relative page_product-listing">
                    <h1 class="">{{ $category->name ?? 'Shop' }}</h1>
                </div>
            </div>
        </div>
    </section>
@endif
<style>
.category-background {
    background: linear-gradient(#ffffff00, #00000061);
}
</style>