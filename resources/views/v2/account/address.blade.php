@extends('layouts.frontend')
@section('styles')
@endsection
@section('contents')
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 position-relative page_product-listing">
                    <h1>My account</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="product-detail-slider position-relative product-listing page_section bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-xxl-3 stick-1 mb-4 mb-md-0">
                        @include('v2.account.sidebar')
                    </div>
                    <div class="col-md-8 col-lg-8 col-xxl-9 stic-2 payment-holder">
                        <div class="fs-2 text-overflow mb-4">
                            Your addresses
                        </div>
                        <div class="row">
                            @forelse ($addresses as $address)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="card border-0">
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <div class="text-overflow fs-5 fw-semibold">
                                                    {{ $address->firstname }} {{ $address->lastname }}
                                                </div>
                                                <div class="text-overflow text-muted">{{ $address->address }},
                                                    {{ $address->city }}</div>
                                                <div class="text-overflow text-muted">{{ $address->province }},
                                                    {{ $address->postalcode }}</div>
                                            </div>
                                            <div class="border-0">
                                                <a href="{{ route('address.edit', ['address' => $address]) }}" class="text-decoration-none me-2"><i class="bi bi-pencil-square"></i> Edit</a>
                                                <a data-method="DELETE" href="{{ route('address.destroy', ['address' => $address]) }}" data-confirm="Are you sure want to delete this address?"
                                                    class="text-decoration-none text-danger"><i class="bi bi-trash3"></i> Delete</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @empty
                                <div class="col-12 fs-5">
                                    Opps, seems like you have no address saved.
                                </div>
                            @endforelse
                        </div>
                        <div>
                            <div class="text-start text-right d-flex mt-3">
                                <a href="{{ route('address.create') }}"
                                    class="primary-btn border-0 px-5 py-3 text-decoration-none text-white rounded-2">Add new
                                    address</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset("assets/js/rail.js") }}"></script>
    <script></script>
@endsection
