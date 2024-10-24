@extends('layouts.frontend')
@section('styles')
@endsection
@section('contents')
    @include('v2.products.banner')
    <section class="product-detail-slider position-relative product-listing page_section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 mb-5">
                    <form action="" class="not-ajax search-form">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="input-group mb-3">
                                    <input name="q" value="{{ request()->q }}" type="text"
                                        class="form-control border-0 text-overflow form-control-lg shadow-none bg-light"
                                        placeholder="Search by name, categories etc">
                                    <button class="btn bg-light border-0 btn-lg shadow-none" type="submit"><i
                                            class="bi bi-search"></i>
                                        <span class="d-none d-lg-inline">Search</span></button>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <select name=""
                                    class="product-category form-select ms-auto form-select-lg w-auto form-control shadow-none border-0 bg-light form-control-lg"
                                    id="">
                                    <option value="{{ url('menu') }}">All categories</option>
                                    @foreach ($categories as $cat)
                                        <option @selected(($category->id ?? null) == $cat->id) value="{{ url('menu/' . $cat->slug) }}">
                                            {{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>

                </div>
                @forelse ($products as $item)
                    @include('v2.products.productCard', ['product' => $item])
                @empty
                    <div class="col-12 text-center my-5">
                        <div>
                            <img class="" width="200"
                                src="https://res.cloudinary.com/rr6/image/upload/v1721202459/95f54e2fc2a83d5cd7bb9b3efc26dae2_hoeb0d.png"
                                alt="">
                        </div>
                        <h1 class="text-muted display-4 fw-normal">No products found</h1>
                        <div class="text-muted fs-5">Your search did not match any results, please try again</div>
                    </div>
                @endforelse
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        $('.product-category').on('change', function(e) {
            $('form.search-form').attr('action', $(this).val()).submit();
        });

        function fixHeader() {
            $('body').css({
                'padding-top': $('header').height(),
            })
        }

        $(window).scroll(function() {
            fixHeader();
        });
        $(window).resize(function() {
            fixHeader();
        });
        fixHeader();
    </script>
@endsection
