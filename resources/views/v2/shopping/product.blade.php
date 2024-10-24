<div class="modal-content">
    <div class="modal-header border-0 align-items-start">
        <!--<div>-->
        <!--    <div class="mb-0">{{ $product->categories->pluck('name')->implode(', ') }}</div>-->
        <!--    <h1 class="modal-title fs-5" id="product-pop">{{ $product->name }}</h1>-->
        <!--</div>-->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body pt-0">
        <section class="">
            <div class="">
                <div class="row mb-5">
                    @include('v2.products.gallery')
                    <div class="col-md-6">
                        <h1 class="fw-normal display-3">{!! titleTextSingle($product->name) !!}</h1>
                        <div class="">Category. <span
                                class="fw-semibold">{{ $product->categories->pluck('name')->implode(', ') }}</span>
                        </div>
                        @if (!$product->has_variation)
                            <div class="">SKU. <span
                                    class="fw-semibold">{{ $product->product_variant->sku }}</span></div>
                            <div class="">Weight. <span
                                    class="fw-semibold">{{ $product->product_variant->weight }}</span>
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
                                    <div class="">SKU. <span class="fw-semibold">{{ $variation->sku }}</span>
                                    </div>
                                    <div class="">Weight. <span
                                            class="fw-semibold">{{ $variation->weight }}</span></div>
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
                            @if (!$product->has_variation)
                                <div>
                                    <p class="h4 font-weight-bold">{{ getPrice($product->product_variant->price) }}</p>
                                    <p class="mb-0">{{ getPrice($product->product_variant->price) }} <small
                                            class="fw-normal text-muted extra-small">per
                                            {{ $product->product_variant->weight }}</small></p>
                                    @if($product->cases()->count())
                                    <div class="d-flex flex-grow mb-3 mt-2">
                                            @foreach ($product->cases as $case)
                                                <div class="">
                                                    <input @checked($loop->first) hidden
                                                        class="product-case form-control" type="radio"
                                                        id="case_{{ $case->id }}"
                                                        name="case_id" value="{{ $case->id }}">
                                                    <label for="case_{{ $case->id }}"
                                                        class="bg-light btn border-0 small me-2 rounded-2"
                                                        role="button">{{ $case->quantity }} items per {{ $case->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                    <p class="">{{ $product->product_variant->box_quantity }} units per case</p>
                                    @endif
                                </div>
                            @else
                                @foreach ($product->product_variation as $variation)
                                    <div id="price_{{ $variation->id }}" class="prices" style="display: none">
                                        <p class="h4 font-weight-bold">{{ getPrice($variation->price) }}</p>
                                        <p class="mb-0">{{ getPrice($variation->price) }} <small
                                                class="fw-normal text-muted extra-small">per
                                                {{ $variation->weight }}</small></p>
                                        <p class="">{{ $variation->box_quantity }} units per case</p>
                                    </div>
                                @endforeach
                            @endif
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center me-2 popqControl">
                                    <input type="hidden" class="quantity" value="1">
                                    <div class="minus-quantity change-quanity ml-2 popq q-less shadow-sm me-2"><i
                                            class="fa-solid fa-minus m-auto" aria-hidden="true"></i></div>
                                    <div class="quantity-count d-flex align-items-center"><span
                                            class="m-auto single-quantity popQuantity">1</span></div>

                                    <div class="plus-quantity change-quanity mr-2 popq q-plus shadow-sm ms-2"><i
                                            class="fa-solid fa-plus m-auto" aria-hidden="true"></i></div>

                                </div>
                                <div>
                                    <button case="{{ $product->cases()->first()->id ?? null }}" product="{{ $product->product_variant->id ?? null }}"
                                        class="primary-btn addTocard border-0 text-decoration-none text-white rounded-2">Add
                                        to card</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-0">
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
                                <div class="col-md-6">
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
        </section>
    </div>
</div>
<script>
    variations = @json($product->option);
</script>
