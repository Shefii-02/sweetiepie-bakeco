@extends('layouts.frontend')
@section('contents')
    <style>
        .crp-lnd img{
            height: 250px;
            object-fit: cover;
        }
    </style>
   
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 >{{titleText($site->page_name)}}</h1>
                </div>
            </div>
        </div>
    </section>
<div class="container mt-0 mt-md-4">
    

    
    
    <!--section1_image-->
      <section class="landing-simple-banner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="crp-lnd position-relative">
                        <img class="w-100 rounded" src="{{asset('images/LandingPage/'.$site->banner1_image)}}">
                        <div class="position-absolute w-100 h-100 top-0 d-flex justify-content-center align-items-center w-100">
                            <div>
                                <h1>{{$site->banner1_title}} </h1>
                                <p class="text-light">{{$site->banner1_description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--section2_image-->
      <section class="landing-product">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="landing-content mb-4 mb-lg-0">
                    <h2> {{$site->section1_title}} </h2>
                        <p>{{$site->section1_description}}</p>
                        <a href="{{$site->section1_button_link}}">{{$site->section1_button_text}}</a>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <img src="{{isset($site) && $site->section1_image != '' ? asset('images/LandingPage/'.$site->section1_image):asset('dummy.jpg')}}" alt="">
                </div>
            </div>
        </div>
    </section>
     
      <section class="landing-simple-banner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="crp-lnd position-relative">
                        <img class="w-100 rounded" src="{{asset('images/LandingPage/'.$site->banner1_image)}}">
                        <div class="position-absolute w-100 h-100 top-0 d-flex justify-content-center align-items-center w-100">
                            <div>
                                <h1>{{$site->banner1_title}} </h1>
                                <p class="text-light">{{$site->banner1_description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="landing-product">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6">
                    <img src="{{isset($site) && $site->section2_image != '' ? asset('images/LandingPage/'.$site->section2_image):asset('dummy.jpg')}}" alt="">
                </div>
                <div class="col-12 col-md-6">
                    <div class="landing-content">
                        <h2>{{$site->section2_title}} </h2>
                        <p>{{$site->section2_description}}</p>
                        <div class="connect">
                        <a href="{{$site->section2_button_link}}">{{$site->section2_button_text}}</a>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </section>
   
    <section class="landing-gallery">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4">
                    <h1>
                        Gallery
                    </h1>
    
                </div>
                <div class="col-12 col-md-8">
    
                    <div class="slick-gallery">
                        <div>
                            <img src="{{isset($site) && $site->gallery1 != '' ? asset('images/LandingPage/'.$site->gallery1):asset('dummy.jpg')}}" alt="">
                        </div>
                        <div>
                            <img src="{{isset($site) && $site->gallery2 != '' ? asset('images/LandingPage/'.$site->gallery2):asset('dummy.jpg')}}" alt="">
                        </div>
                        <div>
                            <img src="{{isset($site) && $site->gallery3 != '' ? asset('images/LandingPage/'.$site->gallery3):asset('dummy.jpg')}}" alt="">
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    
    </section>
    
    
    
    
   
   

</div>


@endsection