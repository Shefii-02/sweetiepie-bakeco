@extends('layouts.frontend')
@section('styles')
<style>
   
     
</style>
@endsection
@section('contents')
<section class="product-listing-banner">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1>
              Menu
          </h1>
      
        </div>
      </div>
    </div>
</section>
  
<section class="product-listing page_section menu_page">
    <div class="container">
        <div class="row for-p-l-p">
            @foreach($categories as $items)
                <div class="col-12 mt-2 mb-2" style="overflow: hidden;">
                    <div class="for-product-category position-relative d-flex align-items-center">
                        <a href="{{url('menu/'.$items->slug)}}" class="w-100">
                            <div class="image-wrapper" style="overflow: hidden;">
                                <img class="w-100"
                                    src="{!!$items->picture != '' ? asset('images/categories/'.$items->picture):asset('assets/images/dummy-category.jpg')!!}"
                                    alt="">
                            </div>
                            <div class="position-absolute d-flex justify-content-center align-items-center w-100 h-100" style="top: 0;">
                                <h1 class=" text-white">{{$items->name}}</h1>
                            </div>
                            
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
    