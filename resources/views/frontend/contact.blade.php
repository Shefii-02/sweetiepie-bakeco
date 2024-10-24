@extends('layouts.frontend')
@section('styles')
    <style>
        input::placeholder,
        textarea::placeholder {
            color: #bbb !important;
            font-size: 90%;
        }

        h2 {
            font-weight: bolder;
        }



        .page_section {
            padding: 50px 0
        }

        .page_section h2 {
            margin-bottom: 30px;
        }

        #stores_list {
            background: #EEE;

        }

        .store_button {
            background: #333;
            color: #CCC;
            border-radius: 30px;
            padding: 5px 15px;
            font-size: 80%;
            margin: 0 1px 0 1px;
            min-width: 50px;
            text-decoration: none;
        }

        .store_button:hover {
            text-decoration: none;
            background: var(--primary);
            color: #FFF;
        }

        .contact_store {}

        .directions-map {
            padding: 10px 0;
            st
        }

        .directions-map a {
            padding: 5px;
            background: #f993c3;
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 30px;
            outline: none !important;
            box-shadow: none !important;

        }

        .directions-map button {
            border: none;
            padding: 5px;
            background: #f993c3;
            color: #fff;
            padding: 5px 10px;
            border-radius: 30px;
        }

        .gm-style-iw-d span {
            font-weight: 400;
            font-size: 16px;
            line-height: 1.8;
            font-style: italic;
        }

        .gm-style-iw-d p {
            font-weight: 400;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 0;
        }

        .row.map-section {
            width: 100%;
        }

        .gm-style .gm-style-iw-c {
            border: 4px solid #000;
            border-radius: 20px;
        }

        button.gm-ui-hover-effect {
            top: 0 !important;
            right: 0 !important;
        }




        @media(max-width: 1368px) {
            .map-section .col-lg-8 {
                position: sticky;
                height: 75vh;
                top: 85px;
                bottom: 10px;
            }
        }

        @media(max-width: 769px) {
            .row.map-section .col-lg-8 {
                height: 500px;
                padding: 0;
                margin: 10px 0;
            }

            .row.map-section {
                flex-direction: column-reverse;
                margin: 0;
            }
        }

        .gm-style-iw.gm-style-iw-c {
            max-width: 345px !important;
        }

        .store-name {
            cursor: pointer;
            padding: 5px 10px;

        }

        .active-store-name {
            background-color: #f993c3;
            color: #fff;
        }

        .store-box-border {
            border: 1px solid var(--primary);
        }
    </style>
@endsection
@section('contents')
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Contact</h1>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section id="contact_message" class="page_section bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-8 card border-0 shadow-none p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h2 class="text-center fw-semibold mb-0 text-dark">Talk To Us</h2>
                            </div>
                            @if ($errors->any())
                                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                            @endif


                            <form class="contact_form" data-classes="leadgenpro_form" action="{{ route('contact-send') }}"
                                method="POST" novalidate>
                                @csrf()

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="theme-input-group bg-light p-2 rounded-1">
                                            <label for="">First name</label>
                                            <input type="text" autocomplete="off" value="{{ old('first_name') }}"
                                            name="first_name" id="firstname" placeholder="First Name" class="form-control px-0 border-0 bg-light shadow-none"
                                            required>
                                        </div>
                                    
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="theme-input-group bg-light p-2 rounded-1">
                                            <label for="">First name</label>
                                            <input type="text" autocomplete="off" value="{{ old('last_name') }}"
                                            name="last_name" id="lastname" placeholder="Last Name" class="form-control px-0 border-0 bg-light shadow-none">
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="theme-input-group bg-light p-2 rounded-1">
                                            <label for="">Email address</label>
                                            <input type="email" autocomplete="off" value="{{ old('email') }}" required
                                            name="email" id="email" placeholder="Email Address" class="form-control px-0 border-0 bg-light shadow-none">
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="theme-input-group bg-light p-2 rounded-1">
                                            <label for="">Phone number</label>
                                            <input type="text" autocomplete="off" value="{{ old('phone') }}" required
                                            name="phone" maxlength="14" id="phone" placeholder="Contact Number"
                                            class="form-control px-0 border-0 bg-light shadow-none">
                                        </div>
                                        
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="theme-input-group bg-light p-2 rounded-1">
                                            <label for="">Subject</label>
                                            <input type="text" autocomplete="off" value="{{ old('subject') }}" name="subject"
                                            id="subject" placeholder="Subject" required class="form-control px-0 border-0 bg-light shadow-none">
                                        <input type="hidden" name="store" value="{{ app()->request->store }}">
                                        </div>
                                        
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="theme-input-group bg-light p-2 rounded-1">
                                            <label for="">Message</label>
                                            <textarea autocomplete="off" name="message" id="message" placeholder="Tell us your message" class="px-0 border-0 bg-light shadow-none form-control"
                                            rows="8">{{ old('message') }}</textarea>
                                        </div>
                                        
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="d-flex  mb-5">
                                        <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"
                                            data-callback="enableBtn"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-start  mb-3">
                                        <input type="hidden" name="success_url">
                                        <button type="submit" class="primary-btn border-0 px-5 mb-2 py-3 rounded-2">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </section>
        {{-- <section id="stores_list" class="page_section">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12">
                        <h2 class="text-center">Sweetie Pie Stores</h2>
                    </div>

                    <div class="col-lg-12">
                        <div class="container">
                            <div class="row justify-content-center">

                                @foreach (App\Models\Store::Orderby('display_order', 'asc')->get() as $store)
                                    <div class="col-md-6 col-lg-3">
                                        <div class="contact_store text-center mb-5">
                                            <img src="{{ asset('images/store/' . $store->picture_icon) }}"
                                                style="width:150px;height:auto;">
                                            <p style="line-height:110%;"><small>{{ $store->address }}
                                                    {{ $store->postal_code }} <br /> <strong>{{ $store->city }}</strong>
                                                    {{ $store->province }}</small></p>
                                            <p class="text-center d-flex flex-wrap justify-content-center">
                                                <a class="mb-1 store_button" href="tel:{{ $store->phone }}"><i
                                                        class="bi bi-telephone"></i> Call</a>
                                                <a class="mb-1 store_button"
                                                    href="{{ url('contact?store=' . $store->slug) }}"
                                                    class="store_ordernow"><i class="bi bi-envelope "></i> Inquiry</a>
                                                <a class="mb-1 store_button" target="map_new"
                                                    href="{{ $store->map_link }}"><i class="bi bi-geo"></i>
                                                    Directions</a>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </section> --}}
    </main>
@endsection

@section('scripts')
@endsection
