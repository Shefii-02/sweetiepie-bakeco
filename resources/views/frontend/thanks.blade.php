
@extends('layouts.frontend')
    @section('contents')
        <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Order Complete</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="">
         <div class=" pb-3 pt-3  d-flex justify-content-center align-items-center for-t-h">
            <div class="col-md-6">
                <div class=""></div>
                <div class=" bg-white p-3">
                    <div class="mb-4 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-theme" width="75" height="75"
                            fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                        </svg>
                    </div>
                    <div class="text-center">
                        <h1 style="font-weight: 800">Thank You!</h1>
                        <p>Your order has been completed and placed successfully. <br> A confirmation email has been sent to the email address you provided. <br>  Your invoice number is #{{$invoice_id}} </p>
                        @auth 
                        <a href="/myaccount" style="padding: 10px 30px; color: #fff; border-radius: 30px; background: var(--primary); text-decoration: none;" class="">BACK TO MY ACCOUNT</a>
                        
                        @else
                        
                        <a href="/" class="for-home-t">BACK TO HOME</a>
                        
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
    
    
    @section('scripts')
       <script>
            gtag("event", "purchase", {!! json_encode($googlecode) !!});
        </script>
    @endsection
    