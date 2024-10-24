@extends('layouts.frontend')
@section('styles')

@endsection
@section('contents')
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 position-relative page_product-listing">
                    <h1 >{!!titleTextSingle($product->name)!!}</h1>
                      <div class="position-absolute">
                        <a href="{{url('menu')}}" class="btn btn-dark btn-sm text-light"><i class="bi bi-arrow-left"></i> Back to Menu</a>
                      </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="product-detail-slider position-relative product-listing page_section">
        <div class="container">
            <div class="row">
                <!-- card left -->
                <div class="col-12 col-md-6 position-relative productImageStick">
                     <!------------------------images---->
                        @foreach($variation_images as $key => $keys) 
                            @php
                                $keys = $keys->where('type','<>','Nutritional Facts');                              
                            @endphp
                            <div class="for-sticky-p-s prdct_img slider_{{$key}} slider_images"  data-category="{{$key}}" style="display:none">
                                <div class="slider-for"> 
                                    @foreach($keys as $images_src)
                                        <div>
                                            <img class="w-100 h-auto cursor-pointer " onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';"  alt="{{$product->name}}"  src="{{asset('images/products/'.$images_src->picture)}}" width="50">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="slider-nav "> 
                                    @foreach($keys as $images_src)
                                        <div >
                                            <img class="w-100 h-auto cursor-pointer " src="{{asset('images/products/'.$images_src->picture)}}" onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';" alt="{{$product->name}}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    <!------------------------images---->
                </div>
                
                <!-- card right -->
                <div class="col-12 col-md-6 p-d-bg">
                    <div class="product-content" >
                <!--////////////////////////////////////Product Name/////////////////////////////////////////-->  
                        <h2 class="product-title">{!! titleText($product->name) !!}</h2>
                        <div class="product-price">
                            <h4 class="new-price"><span id="product_price">{{getPrice($product->product_variation->first()->price)}}</span></h4>
                        </div>
                        @if($product->description != '')
                            <div class="product-detail d-none d-md-block" > 
                                {!! $product->description !!}
                            </div>
                            <div class="product-detail d-block d-md-none " > 
                                {!! $product->description !!}
                                 <a class="read-more-link">Read More</a>
                                 <a class="show-less-link" style="display: none;">Show Less</a>
                            </div>                         
                        @endif
                        <div class="product__variations">
                            <div class="row position-relative d-flex align-items-center w-100" >
                                 <div class="col-lg-12">
                                    @foreach($options as $optionkey=>$option)
                                            <div class="row">
                                                <div class="col-3">
                                                    <h5 class="mb-0 mt-3">Select {{titleText($optionkey)}}</h5>
                                                </div>
                                                <div class="col-9">
                                                    <div class="row" >
                                                        <ul class="options">
                                                            @foreach($option as $subkey=>$suboption)
                                                                <li><label><input class="option" type="radio" name="{{$optionkey}}" value="{{$subkey}}"  data-variation-ids="{{implode(',',$suboption)}}" data-attr="{{$optionkey.':'.$subkey}}">{{$subkey}}</label></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                </div>
                                {{--  @foreach($options as $optionkey=>$option)
                                    <div class="col-3">
                                            <h5 class="mb-0 mt-3">Select {{titleText($optionkey)}}</h5>
                                    </div>
                                    <div class="col-9">
                                        <div class="row" >
                                                @foreach($option as $subkey=>$suboption)
                                                    <!--<div class="col-6 col-lg-4 text-center option_vals cursor-pointer">  -->
                                                        <ul class="options">
                                                            @foreach($option as $subkey=>$suboption)
                                                                <li><label><input class="option" type="radio" name="{{$optionkey}}" value="{{$subkey}}"  data-variation-ids="{{implode(',',$suboption)}}" data-attr="{{$optionkey.':'.$subkey}}">{{$subkey}}</label></li>
                                                            @endforeach
                                                        </ul>
                                                    <!--</div>-->
                                                @endforeach
                                        </div>
                                    </div>
                                @endforeach --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        
        $(document).ready(function(){
            $(".options").each(function(){
                $(this).find(".option").first().attr("checked","checked");
            });
            
            function selectVariant() {
                var choosen_vars = [];
                $('.slider_images, .nutri_images').hide();
                
                $(".options").each(function(){
                    $(this).find(".option").each(function(){
                        if($(this).is(":checked")) {
                            var vars = $(this).attr("data-variation-ids");
                            choosen_vars.push(vars.split(","));
                        }
                    })
                });
                
                var final = choosen_vars[0];
                
                for(i=1;i<choosen_vars.length;i++) {
                    var final = $(final).filter(choosen_vars[i]);
                    
                }
                
                var idClicked =  final[0];
                var price = $("#"+idClicked).val();
                console.log(idClicked);
                console.log(price);
                
                $("#selected-price").html(price)
                $('.slider_'+idClicked).show();
                $('.nutri_'+idClicked).show();
    
    
            }
            
            $(".option").click(function(){
                selectVariant();
            })
            
            selectVariant();
            
            
        })
        
    </script>
     
@endsection       