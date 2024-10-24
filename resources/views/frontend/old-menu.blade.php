@extends('layouts.frontend')
@section('contents')
        
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Menu</h1>
                </div>
            </div>
        </div>
    </section>

    <main class="menu-content">
        @foreach($categories as $cat_items)
        <section class="menu-card">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        <h1>{{titleText($cat_items->name)}}</h1>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4  justify-content-center">
                        @foreach($cat_items->product_list as $listing)

                            @if($listing->product_single)
                                <div class="col">
                                    <a  href="{{url('product/'.$listing->product_single->slug)}}" class="cursor-pointer text-decoration-none">
                                      <div class="card h-100 border-0   rounded">
                                        <img class="w-100" src="{{asset('images/products/'.$listing->product_single->picture_small)}}" alt="" >
                                        <div class="card-body text-center">
                                           <h4 class="mb-3 fw-bold text-dark" >{{titleText($listing->product_single->name)}}</h4>
                                            <p class="text-center fw-bold text-dark">Starting from </p>
                                            <p class="text-center h3 fw-bold text-theme">{{min_price($listing->product_single->id)}}</p>
                                            @if($listing->product_single->nutrition_picture == 'dummy.png' || $listing->product_single->nutrition_picture == '')
                                            @else
                                                <div class="nutrient_details">
                                                    <a href="#" class="nutrientinfo" data-pic="{{asset('images/products/'.$listing->product_single->nutrition_picture)}}">
                                                        <i class="bi bi-card-checklist text-dark"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                      </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
    
        </section>
        @endforeach
    </main>

@endsection