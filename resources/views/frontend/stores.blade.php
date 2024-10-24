@extends('layouts.frontend')
@section('styles')
    <style>
      .directions-map{
            padding: 10px 0;
        }
        .directions-map a{
            padding: 5px;
            background: var(--primary);
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 30px;
            outline: none !important;
            box-shadow: none !important;
            
         }
         
        .directions-map button{
            border: none;
            padding: 5px;
            background: var(--primary);
            color: #fff;
             padding: 5px 10px;
            border-radius: 30px;
        }
        .gm-style-iw-d span{
            font-weight: 400;
            font-size: 16px;
            line-height: 1.8;
            font-style: italic;
        }
        .gm-style-iw-d p{
            font-weight: 400;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 0;
        }
        .row.map-section{
            width: 100%;
        }
        .gm-style .gm-style-iw-c{
            border: 4px solid var(--primary);
            border-radius: 20px;
        }
        button.gm-ui-hover-effect{
            top: 0 !important;
            right: 0 !important;
        }
        .gm-style .gm-style-iw-tc::after {
            background: #000 !important;
        }
        .gm-ui-hover-effect{
            left: 0 !important;
        }
        .gm-ui-hover-effect span{
            width: 30px !important;
            height: 30px !important;
        }
        #map-area{
            height: 82vh;
        }
        .map-store-scroll{
             height: 82vh;
             overflow-y: scroll;
        }
        .map-store-scroll::-webkit-scrollbar-track
                {
                	/*-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);*/
                	/*background-color: #F5F5F5;*/
                }
                
                .map-store-scroll::-webkit-scrollbar
                {
                	width: 6px;
                	/*background-color: #f5f5f5;*/
                }
                
                .map-store-scroll::-webkit-scrollbar-thumb
                {
                	background-color: var(--primary);
                }
       
        
        @media(max-width: 1368px){
           
            /*.map-section .col-lg-8{*/
            /*     position: sticky;*/
            /*     height: 75vh;*/
            /*     top: 85px;*/
            /*     bottom: 10px;*/
            /*}*/
        }
        @media(max-width: 769px){
            .row.map-section .col-lg-8{
                height: 500px;
                padding: 0;
                margin: 10px 0;
            }
            .row.map-section{
                flex-direction: column-reverse;
                margin: 0;
            }
            
        }
        
       
        .store-name{
            cursor:pointer;
            padding: 5px 10px;
            
        }
        .active-store-name{
            background-color: var(--primary);
            color: #fff;
        }
        .store-box-border{
            border: 1px solid var(--primary);
        }
        section.map-page-store{
            padding-bottom: 3rem;
        }
        @media(max-width: 769px){
            section.map-page-store{
                padding-bottom: 0 !important;
            }
               .map-store-scroll{
             height: 100%;
             
        }
            
        }@media(max-width: 376px){
            .directions-map-single a, .directions-map-single button {
                padding: 8px 10px;
                font-size: 12px;
            }
        }
    
       
    </style>
@endsection
@section('contents')
<section class="map-page-store">
    <div class="col-lg-12">
        <div class="row map-section">
            <div class="col-lg-4 map-store-scroll">
                <div class="container">
                    <div class="row justify-content-center">
              
                        <div class="col-md-12">
                            <div class="row ">
                                @foreach(App\Models\Store::orderBy('display_order',)->get() as $stores)
                                <div class="col-md-6">
                               
                                    <div class="card mb-2 bg-body rounded store-box-border">
                                        <div class="card-body text-center  store-name" data-lat="{{ $stores->lat }}" data-lng="{{ $stores->lng }}">
                                            <div class="row g-0">
                                                <a class="mapScroll" style="text-decoration: none; color: #000;">
                                                <div class="col-12">
                                                    <img src="{{asset('images/store/'.$stores->picture_icon)}}" class=" p-2" style="width: 70%;">
                                                </div>
                                                <!--<div class="col-12">-->
                                                <!--    <h6 class="fw-bold">{{titleText('Sweetie Pie – '.$stores->name)}}</h6>-->
                                                <!--</div>-->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8" id="map-area">
                    <!-- Add this in your map.blade.php view -->
                <div id="map" class="w-100 h-100"></div>
            </div>
        </div>
        <style>
            .hover-place-map .card{
                width: 400px;
                padding: 10px;
                text-align: center;
            }
        </style>
    </div>


</section>


@endsection

@section('scripts')

<script>
var currentInfoWindow = null;
var markers = []; // Define markers as a global variable

function initMapStore() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        mapTypeControl: false,
        disableDefaultUI: true,
        zoomControl: true,
        styles: [{
            featureType: "poi",
            stylers: [
                { visibility: "off" }
            ]
        }]
    });

    var branches = {!! $branches->toJson() !!};

    var centerLat = 0;
    var centerLng = 0;

    branches.forEach(function (branch) {
        centerLat += branch.latitude;
        centerLng += branch.longitude;
    });

    centerLat /= branches.length;
    centerLng /= branches.length;

    var centerPoint = new google.maps.LatLng(centerLat, centerLng);

    map.setCenter(centerPoint);

    branches.forEach(function (branch) {
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(branch.latitude, branch.longitude),
            map: map,
            title: branch.name,
            icon: {
                url: 'assets/themes/{{$theme}}/images/sweetiepie-location.png',
            }
        });

        marker.addListener('click', function () {
            if (currentInfoWindow) {
                currentInfoWindow.close();
            }
            currentInfoWindow = new google.maps.InfoWindow({
                content: branch.address
            });
        
            currentInfoWindow.addListener('closeclick', function () {
                 $('.store-name').removeClass('active-store-name');
            });
        
            currentInfoWindow.open(map, marker);
        });

        markers.push(marker);
    });
}

$(document).on('click', '.store-name', function () {
    var lat = $(this).data('lat');
    var lng = $(this).data('lng');
     $('.store-name').removeClass('active-store-name');
    var marker = markers.find(function (marker) {
        return marker.getPosition().lat() === lat && marker.getPosition().lng() === lng;
    });

    if (marker) {
        google.maps.event.trigger(marker, 'click');
        $(this).addClass('active-store-name');
    }
});

$(document).ready(function () {
    initMapStore();
    $('body').on('click', '.storeTime', function () {
        var timing_div = $(this).data('timing');
        $('.' + timing_div).toggle();
    });
});

</script>

<script>

// const mapscroll = document.querySelector("#mapScroll");
// mapscroll.addEventListener("click", mapScrollClick, false);
// function mapScrollClick(event) {
//   event.preventDefault();
// }


$(document).ready(function() {
   
  function updateLink() {
    if ($(window).width() <= 769) {
      $(".mapScroll").attr("href", "#map-area");
    } else {
      $(".mapScroll").removeAttr("href");
    }
  }

  // Call the function on page load
  updateLink();

  // Attach the event listener to window resize
  $(window).on("resize", function() {
    updateLink();
  });
});

</script>



@endsection