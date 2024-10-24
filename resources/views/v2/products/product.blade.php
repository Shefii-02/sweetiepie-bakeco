@extends('layouts.frontend')
@section('styles')
<style>
.carousel-indicators [data-bs-target] {
    width: 80px;
}
</style>
@endsection
@section('contents')
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 position-relative page_product-listing">
                    <h1>{!! titleTextSingle($product->name) !!}</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="product-detail-slider position-relative product-listing page_section">
        <div class="container">
            <div class="row mb-5">
                @include('v2.products.gallery')
                <div class="col-md-6">
                    <h1 class="fw-normal display-3">{!! titleTextSingle($product->name) !!}</h1>
                    <div class="">Category. <span
                            class="fw-semibold">{{ $product->categories->pluck('name')->implode(', ') }}</span></div>
                    @if (!$product->has_variation)
                        <div class="">SKU. <span class="fw-semibold">{{ $product->product_variant->sku }}</span></div>
                        <div class="">Weight. <span class="fw-semibold">{{ $product->product_variant->weight }}</span>
                        </div>
                        @if(!$product->cases()->count())
                        <div class="">No of units in a case. <span
                                class="fw-semibold">{{ $product->product_variant->box_quantity }}</span></div>
                        @else
                        <div class="">No of units. <span
                                class="fw-semibold">{{ $product->case_details }}</span></div>
                        @endif
                    @else
                        @foreach ($product->product_variation as $variation)
                            <div class="variation-details" style="display: none" id="details_{{ $variation->id }}">
                                <div class="">SKU. <span class="fw-semibold">{{ $variation->sku }}</span></div>
                                <div class="">Weight. <span class="fw-semibold">{{ $variation->weight }}</span></div>
                                <div class="">No of units in a case. <span
                                        class="fw-semibold">{{ $variation->box_quantity }}</span></div>
                            </div>
                        @endforeach
                        <div class="mt-4">
                            @foreach ($options as $type => $values)
                                <div class="mb-4">
                                    <div class="text-capitalize text-muted">{{ $type }}</div>
                                    <div class="d-flex flex-grow">
                                        @foreach ($values as $key => $value)
                                            <div>
                                                <input @checked($loop->first) hidden
                                                    class="product-variation form-control" type="radio"
                                                    id="{{ $type }}__{{ $key }}"
                                                    name="{{ $type }}" value="{{ $value }}">
                                                <label for="{{ $type }}__{{ $key }}"
                                                    class="bg-light btn border-0 small me-2 rounded-2"
                                                    role="button">{{ $value }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="mt-4">
                        <button data-bs-toggle="modal" data-bs-target="#enquiryModal"
                            class="primary-btn border-0 px-lg-5 py-lg-3 px-4 py-2 rounded-2 make-enquiry fw-bold mb-2">Make an inquiry</button>
                        <a href="{{ url('sign-in') }}" class="text-decoration-none"><button
                            class="primary-btn border-0 px-lg-5 py-lg-3 px-4 py-2 rounded-2 fw-bold mb-2">Sign In</button></a>
                        <!--<a href="{{ url('sign-in') }}" type="submit"-->
                        <!--    class="text-white text-decoration-none primary-btn border-0 px-5 py-3 rounded-2 fw-bold mb-2">Sign In</a>-->
                    </div>
                    
                    <div class="mt-5">
                    <ul class="nav" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active text-dark fw-semibold" id="desc-tab" data-bs-toggle="tab"
                                data-bs-target="#desc" type="button" role="tab"
                                aria-selected="true">Description</button>
                        </li>
                        @if( $product->contents)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-dark fw-semibold" id="ing-tab" data-bs-toggle="tab"
                                data-bs-target="#ing" type="button" role="tab"
                                aria-selected="false">Ingredients</button>
                        </li>
                        @endif
                        @if( $product->nutrition_image && $product->nutrition_image != 'dummy.png')
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-dark fw-semibold" id="nft-tab" data-bs-toggle="tab"
                                data-bs-target="#nft" type="button" role="tab"
                                aria-selected="false">Nutrition info</button>
                        </li>
                        @endif
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active fw-normal text-muted" id="desc" role="tabpanel"
                            aria-labelledby="desc-tab">
                            {!! $product->description !!}
                        </div>
                        <div class="tab-pane fade fw-normal text-muted" id="ing" role="tabpanel"
                            aria-labelledby="ing-tab">
                            {!! $product->contents !!}
                        </div>
                        <div class="tab-pane fade fw-normal text-muted" id="nft" role="tabpanel"
                            aria-labelledby="nft-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="{{ asset('images/products/' . $product->nutrition_image) }}"
                                                class="d-block w-100"
                                                onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';"
                                                alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            
            @if ($suggested->count())
                <div class="row">
                    <div class="col-12">
                        <div class="h2 fw-normal">Related products</div>
                    </div>
                    @foreach ($suggested as $item)
                        @include('v2.products.productCard', ['product' => $item->products])
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    <form method="POST" action="">
        @csrf
        <div class="modal" data-bs-backdrop="static" data-bs-keyboard="false" id="enquiryModal" tabindex="-1"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h1 class="modal-title fs-4 fw-normal" id="exampleModalLabel">MAKE AN ENQUIRY</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body border-0">
                        <div class="row">


                            <div class="col-lg-6">
                                <div class="mb-3 theme-input-group bg-light p-2 rounded-1">
                                    <label for="firstname" class="form-label">First Name<span class="text-danger">
                                            *</span></label>
                                    <input placeholder="Enter your first name" type="text" autocomplete="off"
                                        class="form-control px-0 border-0 bg-light shadow-none" name="firstname"
                                        id="firstname" value="{{ old('firstname') }}">
                                    <span>
                                        {{ $errors->first('firstname') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 theme-input-group bg-light p-2 rounded-1">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input placeholder="Enter your last name" type="text" autocomplete="off"
                                        class="form-control px-0 border-0 bg-light shadow-none" name="lastname"
                                        id="lastname">
                                    <span>
                                        {{ $errors->first('lastname') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 theme-input-group bg-light p-2 rounded-1">
                                    <label for="phone" class="form-label">Phone Number<span class="text-danger">
                                            *</span></label>
                                    <input placeholder="Enter your phone number" type="text" autocomplete="off"
                                        class="form-control px-0 border-0 bg-light shadow-none" name="phone"
                                        id="phone">
                                    <span>
                                        {{ $errors->first('phone') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 theme-input-group bg-light p-2 rounded-1">
                                    <label for="email" class="form-label">Email<span class="text-danger">
                                            *</span></label>
                                    <input placeholder="Enter your email address" type="email" name="email"
                                        autocomplete="off" id="email" value="{{ old('email') }}"
                                        class="px-0 border-0 bg-light shadow-none form-control">
                                    <span>
                                        {{ $errors->first('email') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 theme-input-group bg-light p-2 rounded-1">
                                    <label for="company" class="form-label">Company Name<span class="text-danger">
                                            *</span></label>
                                    <input placeholder="Enter your company name" type="text" autocomplete="off"
                                        class="form-control px-0 border-0 bg-light shadow-none" name="company_name"
                                        id="company" value="{{ old('company_name') }}">
                                    <span>
                                        {{ $errors->first('company') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 theme-input-group bg-light p-2 rounded-1">
                                    <label for="website" class="form-label">Website</label>
                                    <input placeholder="Enter your website" type="text" autocomplete="off"
                                        class="form-control px-0 border-0 bg-light shadow-none" name="website"
                                        id="website">
                                    <span>
                                        {{ $errors->first('website') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 theme-input-group bg-light p-2 rounded-1">
                                    <label for="address" class="form-label">Address<span class="text-danger">
                                            *</span></label>
                                    <input placeholder="Enter your address" class="form-control address_fill px-0 border-0 bg-light shadow-none"
                                        autocomplete="off" value="{{ old('address') }}" name="address" id="address">
                                    <span>
                                        {{ $errors->first('address') }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3 theme-input-group bg-light p-2 rounded-1">
                                    <label for="city" class="form-label">City<span class="text-danger">
                                            *</span></label>
                                    <input placeholder="Enter your city" type="text" autocomplete="off"
                                        class="form-control city_fill px-0 border-0 bg-light shadow-none"
                                        value="{{ old('city') }}" name="city" id="city">
                                    <span>
                                        {{ $errors->first('city') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 theme-input-group bg-light p-2 rounded-1">
                                    <label for="postal_code" class="form-label">Postal Code<span class="text-danger">
                                            *</span></label>
                                    <input placeholder="Enter your postcode" type="text" autocomplete="off"
                                        maxlength="7"
                                        class="form-control postalCode_fill px-0 border-0 bg-light shadow-none"
                                        id="postal_code" value="{{ old('postcode') }}" name="postalcode">
                                    <span>
                                        {{ $errors->first('postalcode') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 theme-input-group bg-light p-2 rounded-1">
                                    <label for="province" class="form-label">Province<span class="text-danger">
                                            *</span></label>

                                    <!--<input placeholder="Enter your province" type="text" autocomplete="off"-->
                                    <!--    maxlength="7"-->
                                    <!--    class="form-control province_fill px-0 border-0 bg-light shadow-none"-->
                                    <!--    id="postal_code" value="{{ old('province') }}" name="province">-->
                                    <select class="form-select px-0 border-0 bg-light shadow-none"
                                        name="province" id="province">
                                        <option value="">Select Province</option>
                                        @foreach ($provinces as $item)
                                            <option  {{ 'Ontario' == $item->name ? "selected" : '' }} value="{{ $item->name }}"
                                                {{ $item->code == old('province') ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <span>
                                        {{ $errors->first('province') }}
                                    </span>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex  mb-0">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 align-items-end">
                        <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"
                            data-callback="enableBtn"></div>
                        <button class="primary-btn border-0 ms-auto px-5 py-3 rounded-2">Send message</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        function findMatchingVariationId(attributes, query) {
            // Group attributes by variation_id
            const groupedByVariation = attributes.reduce((acc, attr) => {
                if (!acc[attr.variation_id]) {
                    acc[attr.variation_id] = {};
                }
                acc[attr.variation_id][attr.type] = attr.value;
                return acc;
            }, {});

            // Find variation_id that matches all query conditions
            for (const variation_id in groupedByVariation) {
                const matches = Object.entries(query).every(([key, value]) =>
                    groupedByVariation[variation_id][key] === value
                );
                if (matches) {
                    return parseInt(variation_id);
                }
            }

            // Return null if no match is found
            return null;
        }
        const variations = @json($product->option);
        $(document).on('click', '.product-variation', function() {
            setVariation();
        })
        const setVariation = async function() {
            let variants = [];
            $('.product-variation:checked').each(function() {
                variants[$(this).attr('name')] = $(this).val();
            })
            let variation = await findMatchingVariationId(variations, variants);
            $('.variation-sliders, .variation-details').hide();
            $("#image_" + variation).show();
            $("#details_" + variation).show();
        }
        $(function() {
            setVariation();
        });
    </script>
@endsection
