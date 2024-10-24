@extends('fundraiser.layout')
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
               <img src="{{url('assets/images/Rosedale_Fundraiser.jpg')}}" class="w-100">
            </div>
            <form action="{{route('ready-to-pickup')}}" method="POST" id="add-cart"> @csrf </form>
            <div class="container py-4 py-md-5 px-lg-5">
                @if(isset($products) &&  $products->count() > 0)
                    <div class="row  justify-content-center">
                        @foreach($products as $pListing)
                        @php
                            $productVari = $pListing->product_variation->first();
                        @endphp
                        @if($productVari)
                            <div class="col-lg-4 mb-4 mb-md-5 productList">
                                    <div class="card h-100 ">
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
                                                <small class="mt-2">{!!$pListing->description!!}</small>
                                            </div>
                                            
                                            <div class="form-group--number quantitybox d-flex py-2" style="width:220px;text-align:center;margin:0px auto;display: inline-block;max-width:100%;">
                                                <button class="minus btn btn-dark p-2" style="border-radius: 45px 0 0 45px;float: left;padding: 4px;"><span>-</span></button>
                                                <input form="add-cart" class="form-control major-qty text-center qty-input" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="@if($basketItems) {{$basketItems->where('product_variation_id',$productVari->id)->pluck('quantity')->first() ?? 0}} @else 0  @endif" name="quantity[{{ $productVari->id }}]" readonly="">
                                                <button class="plus btn btn-dark p-2" style="border-radius:0 45px 45px 0;float: left;padding: 4px;"><span>+</span></button>
                                            </div>
                                        </div>
                                    </div>
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
                    <div class="py-3 text-center">
                        <button form="add-cart" class=" btn btn-primary text-uppercase rounded-5 btn-block p-3" type="submit">Proceed To Checkout </button>
                    </div>
                   
                @else
                    <div class="col-lg-12 text-center">
                        <h2 class="mt-2">No products are available</h2>
                    </div>
                @endif
            </div>
    @endsection  
    
