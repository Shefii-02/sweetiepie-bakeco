@extends('layouts.frontend')
@section('styles')
    <style>
         .bannerSection li {
            display: inline-block;
            margin: 0 0 10px 0;
            width: 100%;
            font-size:16px;
        }
        
        .page-container:before, .page-container:after {
            display: table;
            content: " ";
        }
        .page-container a{
            margin-bottom:3px;
            color:gray;
            font-size:13px;
        } 
    </style>

@endsection

@section('contents')
    
    @foreach($page->contents()->orderBy('position')->get() as $content)
        @php
            if($content->type == 'banner'){
                $banners = $content->content->banners;
            }
            elseif($content->type == 'content' &&  $content->position == 1){
                $top_content = $content->content->description;
            }
            elseif($content->type == 'product'){
       
                $products = $content->products;
                $product_title = $content->content->products_title;
            }
            elseif($content->type == 'content' &&  $content->position == 3){
                  $bottom_content = $content->content->description;
            }
        @endphp
    @endforeach
        

        
    <section class="bannerSection pt-3">
        <div class="container">
             <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3 bg-theme px-1 py-3 text-center">
                        <h5 class="py-3">FLOWERS IN CANADA</h5>
                        <ul class="m-0 px-3">
                          
                            @if(count($page->categories)>0)
                                @foreach($page->categories ?? [] as $pageCategory)
                                    <li>
                                        <a href="{{route('product-page-builder',[$page_slug,$pageCategory->slug,$city])}}" class="text-light text-uppercase">{{$pageCategory->name}} in {{$city}}</a>
                                    </li>
                                @endforeach
                            @else
                                @foreach($allCategories ?? [] as $categoyItems)
                                    <li>
                                        <a href="{{route('category',[$categoyItems->slug])}}" class="text-light text-uppercase">{{$categoyItems->name}} in {{$city}}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                      
                    </div>
                    <div class="col-lg-9 p-0 order-0 order-lg-2">
                        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($banners ?? [] as $key => $b_item)
                                        @php
                                            $catg = \App\Models\Category::where('master_id',$b_item->category)->first();
                                        @endphp
                                        <div class="carousel-item @if($key  == 0) active @endif" data-bs-interval="10000">
                                            <a href="@if($catg) {{url('category/'.$catg->slug)}} @endif">
                                                <img src="{{env('TNG_API_DOMAIN').'/images/banners/'.$b_item->image}}" class="d-block w-100" alt="{{$b_item->text}}">
                                            </a>
                                        </div>
                                    @endforeach
                                    
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon bg-theme text-light" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                                    <span class="carousel-control-next-icon bg-theme text-light" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <section class="pt-5">
        <div class="container">
            
            <div class="col-lg-12">
                <h1 class="text-center text-uppercase">
                    {{$page->h1}}
                </h1>
            </div>
            
            <div class="col-lg-12 py-3">
                @if($top_content)
                    {!! $top_content !!}
                @endif
            </div>
            <div class="col-lg-12 bg-theme">
                <div class="row">
                    <h1 class="py-2 ps-4 text-capitalize h4">{{$product_title}}</h1>
                </div>
            </div>
            <div class="col-lg-12 pt-5 border">
                <div class="row justify-content-center">
                   @foreach($products ?? [] as $pitems)
                        <div class="col-12 col-md-3 mb-3 ">
                            <a class="text-decoration-none product_card" href="{{route('product-single',$pitems->slug)}}">
                                <div class="product_shop_hover position-relative">
                                    <img src="{{asset('images/products/'.$pitems->thumbImages->first()->picture)}}"  class="w-100 fixed-height" alt="">
                                   
                                </div>
                                <h5 class="fw-bold text-dark text-center my-3">{{$pitems->name}}</h5>
                                <h5 class="fw-bold text-primary-color text-center my-3">{{getPrice($pitems->MinPrice->price)}}</h5>
                            </a>
                        </div>
                    @endforeach 
                </div>
            </div>
             <div class="col-lg-12 py-5">
                @if($bottom_content)
                    {!! $bottom_content !!}
                @endif
            </div>
        </div>
    </section>
    <div class="container">
        <hr>
    </div>
    
    <div class="text-center mt-3 mb-3">
         <div class="container page-container">
             @foreach($related_page_links ?? [] as $rel_item)
                <a class="text-uppercase" href="{{route('product-page-builder',[$rel_item->slug,$rel_item->category_slug != null ? $rel_item->category_slug : 'all',$rel_item->keyword_slug])}}"> {{$rel_item->category_slug != null ? str_replace('-',' ',$rel_item->category_slug) : $rel_item->title}}  IN {{$rel_item->keyword}}</a> 
                {{ !$loop->last ? '|' : ''  }}
             @endforeach
         </div>
    </div>
@endsection