@extends('fundraiser.sickkids.layout')
    @section('content')
    <style>
        @media(max-width: 600px){
            .banner{
                margin-top: -1px;
            }
        }
    </style>
            <!-- Banner Section with Category Name -->
            <div class="banner h-100" >
                <a href="{{url('menu/cookie-cakes')}}">
                   <img src="{{url('assets/fundraiser/sickkidsbanner.jpg?v=1')}}" class="w-100">
                </a>
            </div>
            <div class="py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 order-0 order-lg-2">
                            <img src="{{url('assets/fundraiser/SickKids-section-1.jpg?v=1')}}" class="w-100 h-100 object-fit-cover">
                        </div>
                        <div class="col-lg-7 d-flex flex-column justify-content-between">
                            <div>
                                <p>Join Sweetie Pie this Family Day and let's celebrate together! Sweetie Pie and the Sick Kids Foundation are joining together to bring you a cookie with a purpose!</p>

                                <p>From January 2nd to February 19th, you can order a custom 10-inch Family Day Cookie Cake to share, send or keep for yourself. A portion of the proceeds from the sales of the custom cookies will be donated to the SickKids Hospital Foundation. What a sweet way to show you care and support a great cause!</p>
                                
                                <p>Help us reach our goal of 1000 cookie cakes sold!! and MAKE FAMILY DAY EVEN SWEETER WITH SWEETIE PIE.</p>
                            </div>
                            
                            <a  href="{{url('menu/cookie-cakes')}}" class="btn btn-theme w-100 rounded-0 p-2">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container product-explore">
                @if(isset($products) &&  $products->count() > 0)
                    <div class="row  justify-content-center productListing">
                        @foreach($products as $pListing)
                        @php
                            $productVari = $pListing->product_variation->first();
                        @endphp
                        @if($productVari)
                            <div class="col-lg-3 productList">
                                <a href="{{url('product/'.$pListing->slug)}}" class="cursor-pointer text-decoration-none">
                                    <div class="card h-100 border-0">
                                        <!-- Product image -->
                                        <img class="card-img-top" src="{!! ($pListing->thumbImages->count() && $pListing->thumbImages->first()->picture) != '' ? asset('images/products/' . $pListing->thumbImages->first()->picture) : asset('/assets/images/dummy-product.jpg') !!}" onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';" alt="Product Image">
                                        <!-- Product details -->
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <!-- Product name -->
                                                <h5 class="fw-bolder text-capitalize">{{ $pListing->name }}</h5>
                                              <span class="new-price">
                                                <span id="product_price">{{getPrice($productVari->price)}}</span>
                                                </span> 
                                                
                                                <small class="mt-2 ">{{--$pListing->description --}}</small>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </a>
                            </div>
                           
                        @endif
                        @endforeach
                    </div>
                    <div class="col-lg-6 mx-auto mt-2 mb-2 d-flex flex-column">
                         @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger "> {{ $error }}  <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button></div>
                                    @endforeach
                               
                        @endif
                        <div class="error_msg">
                            
                        </div>
                    </div>
                  
                   
                @else
                    <div class="col-lg-12 text-center">
                        <h2 class="mt-2">No products are available</h2>
                    </div>
                @endif
            </div>
         
            <div class="py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <img src="{{url('assets/fundraiser/SickKids-section-2.jpg?v=1')}}" class="w-100 h-100 object-fit-cover">
                        </div>
                        <div class="col-lg-7 d-flex flex-column justify-content-between">
                            <div class="mt-5">
                                <h2 class=" theme-color mb-3">HOW TO PARTICIPATE?</h2>
                                <br>
                                <p>Participating in our Family Day Cookie Cake event is simple, visit our website from January 2nd to February 19th and explore our Cookie Cakes designs and choose the type of cookie and colour of frosting. The hard part is to decide who its for. We do the rest!</p>
                                <p>And don't forget, with every purchase, you're contributing directly to the goals of the SickKids Foundation, supporting our children in having a happy and healthy future. Join us and make a meaningful impact this Family Day.</p>
                             </div>
                            <a href="{{url('menu/cookie-cakes')}}" class="btn btn-theme  w-100 rounded-0 p-2">Order Now</a>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="col-lg-12 bg-blue text-center mt-5">
                    <h2 class="theme-color fw-bold p-2">CAMPAIGN SUPPORTERS</h2>
                </div>
            </div>
            <div class="pt-3">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <img src="{{url('assets/fundraiser/sick_kids.png')}}" class="w-100 mb-4" style="max-width:200px; height:auto; ">
                        </div>
                        
                    </div>
                </div>
            </div>
            
    @endsection  
    
@section('scripts')
    <script>
         $('.orderBtn').on('click', function (e) {
             e.preventDefault()
            $('html, body').animate({
                scrollTop: $('.product-explore').offset().top
            });
        });
    </script>
@endsection