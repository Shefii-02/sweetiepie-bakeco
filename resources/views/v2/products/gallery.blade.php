<div class="col-md-6">
                    @if (!$product->has_variation)
                        <div id="image_all" class="carousel slide" >
                            <div class="carousel-inner">
                                @foreach ($product->otherImages as $image)
                                    <div class="carousel-item @if ($loop->first) active @endif">
                                        <img src="{{ asset('images/products/' . $image->picture) }}" class="d-block w-100"
                                            onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';"
                                            alt="...">
                                    </div>
                                @endforeach
                            </div>
                            @if ($product->otherImages()->count() > 1)
                                <ol class="carousel-indicators">
                                    @foreach ($product->otherImages as $k => $image)
                                    <li data-bs-target="#image_all" data-bs-slide-to="{{ $k }}" class="@if ($loop->first) active @endif">
                                        <img src="{{ asset('images/products/' . $image->picture) }}" class="d-block w-100"
                                            onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';"
                                            alt="...">
                                    </li>
                                    @endforeach
                              </ol>
                                <button class="carousel-control-prev" type="button" data-bs-target="#image_all"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#image_all"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    @else
                        @php
                            $images = product_images($product->id);
                        @endphp
                        @foreach ($images as $key => $gallery)
                            <div id="image_{{ $key }}" style="display: none"
                                class="carousel slide variation-sliders">
                                <div class="carousel-inner">
                                    @foreach ($gallery as $image)
                                        <div class="carousel-item @if ($loop->first) active @endif">
                                            <img src="{{ asset('images/products/' . $image) }}" class="d-block w-100"
                                                onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';"
                                                alt="...">
                                        </div>
                                    @endforeach
                                </div>
                                @if (count($gallery) > 1)
                                    <ol class="carousel-indicators">
                                        @foreach ($product->otherImages as $k => $image)
                                        <li data-bs-target="#image_{{ $key }}" data-bs-slide-to="{{ $k }}" class="@if ($loop->first) active @endif">
                                            <img src="{{ asset('images/products/' . $image->picture) }}" class="d-block w-100"
                                                onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';"
                                                alt="...">
                                        </li>
                                        @endforeach
                                  </ol>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#image_{{ $key }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#image_{{ $key }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>