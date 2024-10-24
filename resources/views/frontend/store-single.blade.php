@extends('layouts.frontend')
@section('contents')
<!---->
 <style>
        section.map-hour ul {

            padding: 0;
            margin: 0;
            list-style: none;
        }

        section .timing-card {
            padding: 20px 40px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        section .col-md-7 img {
            border-radius: 10px;
        }

        select {
            padding: 8px 10px;
            background: #fff;
            border: none;
            border-radius: none;
        }

        select:focus {
            outline: none;
        }

        .col-12 iframe{
            border-radius: 10px;
           
        }
        .directions-map-single{
            text-align: center;
            display: flex;
            justify-content: space-between;
            padding-top: 20px;
        }
        .directions-map-single a, .directions-map-single button{
            text-decoration: none;
            color: var(--white);
            padding: 10px 30px;
            border-radius: 30px;
            background: var(--primary);
            font-weight: 500;
        }
        section.new-store-top{
            padding: 50px 0;
        }
        .store-manager img{
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            background: #fff;
        }
        .store-manager{
            display: flex;
            align-items: center;
        }
        section.new-store-top .col-md-4{
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            align-items: center;
        }
        .store-man-name{
            margin-left: -25px;
            z-index: -1;
            margin-top: 20px;
        }
        .store-man-name p{
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 0px;
            padding: 0px 0px 0px 40px;
            background: var(--primary);
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
            color: #000;
            
        }
        .store-man-name span{
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 0px;
            padding: 4px 10px 0 40px;
            color: var(--black);
        }
        .single-store-location h3{
            color: #000;
            font-weight: 700;
            margin-bottom: 0;
        }
        .bottom-line{
            width: 100%;
            position: relative;
        }
        .bottom-line::after{
            content:"";
            position: absolute;
            bottom: 0;
            height: 2px;
            left: 0;
            background: var(--black);
            width: 100%;
        }
        section.operating-hour{
            padding: 50px 0;
        }
        .for-time-line{
            position: relative;
        }
        .for-time-line::after{
            position: absolute;
            content: "";
            height: 100%;
            right: 0;
            background: #000;
            width: 2px;
            top: 0;
        }
        .parent-for-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(2, 1fr);
            grid-column-gap: 10px;
            grid-row-gap: 10px;
        }
            
        .parent-for-grid .div1 { 
            grid-area: 1 / 1 / 3 / 2;
            border-radius: 10px;
            }
        .parent-for-grid .div2 { 
            grid-area: 1 / 2 / 2 / 3;
            border-radius: 10px;
            }
        .parent-for-grid .div3 {
            grid-area: 2 / 2 / 3 / 3;
            border-radius: 10px;
        }
        .parent-for-grid .div1 img{
            height: 450px;
            object-fit: cover;
            border-radius: 10px;
        }
            
        .parent-for-grid .div2 img{
            height: 220px;
            border-radius: 10px;
        }
        
        .parent-for-grid .div3 img{
            height: 220px;
            border-radius: 10px;
        }
        .st-ds-content p:nth-child(2){
            background: #f1f1f1;
            padding: 15px 20px;
            text-align: left;
            margin: 0 80px 30px 80px;
            border-radius: 10px;
        }
        .st-ds-content p{
            text-align: left;
        }
         .store-image img{
                width: 70%;
        }
        .new-store-top .col-lg-4{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            justify-content: space-between;
        }
        
        .single-multiple-loc{
            padding: 50px 0;
            background: #f1f1f1;
        }
        .sp-s-nm:hover{
            color: var(--primary) !important;
            text-decoration: underline;
        }
        
        @media(max-width: 1025px){
            .single-store-location h3{
                font-size: 28px;
            }
            section .timing-card {
                padding: 20px 10px;
                
            }
            .directions-map-single a, .directions-map-single button{
                padding: 10px 20px;
            }
        }
        @media(max-width: 769px){
            section.new-store-top {
            padding: 15px 0;
            }
               .store-manager {
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 10px 0;
            }
            .store-image img{
                width: 50%;
            }
            .single-store-location{
                margin: 10px 0;
            }
            .parent-for-grid{
                display: block;
            }
            .parent-for-grid .div3{
                display: none;
            }
             .parent-for-grid .div2{
                display: none;
            }
            .for-time-line h5, .for-time-line-t h5{
                font-size: 14px;
            }
            section.operating-hour{
                padding-bottom: 0;
            }
            .st-ds-content p:nth-child(2){
                margin: 0 0 15px 0;
            }
             .single-store-location h3{
                font-size: 25px;
            }
            .st-ds-content p, .st-ds-content p:nth-child(2){
                text-align: left;
            }
            
        }
        @media(max-width: 600px){
         .directions-map-single a, .directions-map-single button {
            text-decoration: none;
            color: var(--white);
            padding: 8px 10px;
            font-size: 12px;
         }
         .directions-map-single{
             justify-content: space-around;
         }
         
         .for-row-padding{
             padding: 0 10px;
         }
         .for-row-padding .col-md-8{
             padding: 10px 0 5px 0;
             
         }
         .st-ds-content p:nth-child(2) {
                margin: 0 0 20px 0;
            }
             .single-store-location h3{
                font-size: 22px;
            }
            section.operating-hour {
                padding: 20px 0;
                
            }
            .st-ds-content p:first-child{
                display: none;
            }
            .st-ds-content p:nth-child(3){
                margin-bottom: 2px;
            }
            .parent-for-grid .div1 img {
                height: 350px;
            }
        }
            @media(max-width: 400px){
         .directions-map-single a:nth-child(3) {
          display: none;
         }
        }
        
        address {
            font-weight:bold;
            font-size: 180%;
        }
    </style>

<!---->
    
<section class="product-listing-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{$store->name}}</h1>
            </div>
        </div>
    </div>
</section>

<!---->

<section class="new-store-top">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-12 col-md-12 col-lg-4 ">
                <div class="store-image text-center">
                      <img
                        src="{{asset('images/store/'.$store->picture_icon)}}"
                        alt="">
                </div>
                @if($store->manager_name != '')
                    <div class="store-manager">
                        <img src="{{asset('images/store/'.$store->manager_picture)}}" class="rounded-circle">
                        <div class="store-man-name">
                            <p>{{titleText($store->manager_name)}}</p>
                                <span>Store Manager</span>
                        </div>
                    </div>
                @endif
                <div class="single-store-location">
                    <address class="text-center ">{{titleText($store->address)}}
                    {{titleText($store->postal_code)}} {{titleText($store->city)}} {{strtoupper($store->province)}}</address>
                </div> 
            </div>
            <div class="col-12 col-md-12 col-lg-8 ps-lg-5 ps-md-0">
                <div id="map" style="width:100%;height:400px;border:0"></div>
                <div class="map-icon" onclick="goToMap()"></div>

                <div class="directions-map-single">
                    <a target="map_new" href="{{$store->map_link}}"> <i class="bi bi-geo-alt"></i> Directions</a>
                    <a href="tel:{{$store->phone}}"> <i class="bi bi-telephone" style="margin-right: 5px"></i>Call Now</a>
                    <a href="{{url('contact?store='.$store->slug)}}" class="store_mail"><i class="bi bi-envelope" style="margin-right: 5px"></i>Inquiry</a>
                    <a href="{{url('select-location?ordertype=pickup&pickup_store='.$store->id.'&redirect=menu')}}" class="store_mail"><i class="bi bi-cart" style="margin-right: 5px"></i>Order Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!---->
<section class="for-bottom-line">
    <div class="container">
        <div class="bottom-line">
            
        </div>
    </div>
</section>


<!---->

<section class="operating-hour">
    <div class="container">
        <div class="row for-row-padding">
            <div class="col-md-4 timing-card" style="background: #f1f1f1;color:#333;">

                    <h4 class="text-center fw-bold mb-3 mb-md-0"><i class="bi bi-clock"></i> OPERATING HOURS</h4>
                   
                        <div class="col-12">
                            <div class="row">
                                @php
                                $days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']; 
                                $sortedTimings = $store->store_timing->sortBy('day');
                                @endphp
                            
                                    @foreach($days as $key => $list) 
                                        @php 
                                        $litsing = $store->store_timing()->where('day',$key)->first();
                                        @endphp
                                        <div class="col-5 for-time-line pt-1 pb-1">
                                            <big class="">{{$list}}</big>
                                        </div>
                                        <div class="col-7 for-time-line-t pt-1 pb-1 text-center">   
                                            @if($sortedTimings->count() >0)
                                                @if($litsing)
                                                    <big class="fw-semi-bold text-center">{{date('h:iA', strtotime($litsing->open))}} - {{date('h:iA', strtotime($litsing->close))}}</big>
                                                @else
                                                    <big class="fw-semi-bold text-center">Closed</big>
                                                @endif
                                            @else
                                                <big class="fw-semi-bold text-center">---- : ----</big>
                                            @endif
                                        </div>
                                    @endforeach
                            </div>
                        </div>

                </div>
                <div class="col-md-8">
                    
                    <div class="parent-for-grid ps-lg-4 ps-md-0">
                        <div class="div1"> <img class="w-100" src="{{asset('images/store/'.$store->picture)}}"> </div>
                        @if($firstImage = $store->store_images->pluck('image')->first())
                            <div class="div2"> <img class="w-100" src="{{asset('images/store/'.$firstImage)}}"> </div>
                        
                        @endif
                        @if($secondImage = $store->store_images->pluck('image')->skip(1)->first())
                            <div class="div3"> <img class="w-100" src="{{asset('images/store/'.$secondImage)}}"> </div>
                        @endif
                        
                   </div>
                </div>
        </div>
    </div>
</section>
<!---->
<!---->
<section class="store-description">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="st-ds-content p-md-3 p-sm-0">
                    <p class="text-center">{!! str_replace('&nbsp;&nbsp;&nbsp;&nbsp;','',$store->description) !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!---->

<section class="page_section" id="stores_list" >
    <div class="container text-center">
        <div class="row">
            <div class="col-12 text-center">
                <h2>Our other Locations</h2>
            </div>
        </div>
        <div class="row">
            @foreach($otherstore as $items)
                <div class="col-12 col-md-4 text-left text-md-center mb-2">
                    <a href="{{url('stores/'.$items->slug)}}" class="text-black fw-bold text-decoration-none sp-s-nm" title="{{$items->name}}">Sweetie Pie {{$items->name}}</a>
                </div>
            @endforeach
        </div>
    </div>
</section>



<!---->
@endsection


@section('scripts')

<script>
$(document).ready(function(){
singletMapStore();
// Initialize the map
function singletMapStore() {
  // Coordinates of the location to display
  var latitude = {{$store->lat}}; // Replace with your desired latitude
  var longitude = {{$store->lng}}; // Replace with your desired longitude
  var storename = `{{$store->name}}`
  var map_link = `{{$store->map_link}}`
  // Create a map centered on the specified coordinates
  var map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: latitude, lng: longitude },
    zoom: 12, // Adjust the zoom level as needed,
    mapTypeControl: false,
        disableDefaultUI: true,
            zoomControl: true,
            styles : [
                {
                  featureType: "poi",
                  stylers: [
                   { visibility: "off" }
                  ]   
                 }
             ],
  });

  // Add a marker at the specified coordinates
  var marker = new google.maps.Marker({
    position: { lat: latitude, lng: longitude },
    map: map,
    title: storename,
    icon: {
        url: '/assets/themes/theme-2/images/sweetiepie-location.png',
    }
  });
  // Function to navigate to the map
  // Add an event listener to the map
  map.addListener("click", function() {
    window.open(map_link);
  });
  // Add a click event listener to the marker
  marker.addListener("click", function() {
    window.open(map_link);
  });
}


});
</script>
@endsection