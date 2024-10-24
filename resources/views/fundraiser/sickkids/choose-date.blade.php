@extends('fundraiser.sickkids.layout')
@section('content')

<div class="pt-5">
    <div class="container">
        <div class="col-lg-6 mx-auto">
            <h4 class="py-2 text-center"> Select a pickup date & time <br> after proceed to checkout</h4>
            <div class="card">
                <div class="row w-100 m-0">
                    <form action="{{route('sickkids2024-add-cart')}}" method="POST" id="datechoose" />
                        @csrf <input type="hidden" name="postvars" value="{{$postvars}}"/>
                    </form>
                    <div class="col-12 col-md-6 p-0" style="border-bottom: 1px solid #DDD;border-right: 1px solid #DDD;">
                        <div class="text-center">
                            <h6 class="fw-bold pt-2">Pick up from</h6>
                            <img src="{{ asset('images/store/' . $store->picture_icon) }}" class="w-50 p-0 p-md-3">
                            <p>{{$store->name}}<br>{{$store->address}}<br>{{$store->city}}, {{$store->postal_code}}</p>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6 p-0" style="border-bottom: 1px solid #DDD;">
                        <div id="date-select" class="h-100" style="display: flex;flex-direction: column;align-items: stretch;justify-content: space-evenly;">
                            <label style="display: flex;padding: 24px;text-align: center;cursor: pointer;margin: 0px;border-left: 0px;align-items: center;justify-content: center;">
                                <input type="radio" form="datechoose" name="pickup_date" value="2024-02-12" @if($basket && $basket->serve_date == '2024-02-12') checked="checked"  @else checked="checked" @endif >
                                &nbsp;   12<sup>th</sup> &nbsp; <span>February, 2024</span>
                            </label>

                            <label style="display: flex;border: 1px solid #DDD;padding: 23.5px;text-align: center;cursor: pointer;margin: 0px;border-left: 0px;border-right: 0px;align-items: center;justify-content: center;">
                                <input type="radio" form="datechoose" name="pickup_date" value="2024-02-13"  @if($basket && $basket->serve_date == '2024-02-13') checked="checked" @endif  >
                                &nbsp; 13<sup>th</sup> &nbsp; <span>February, 2024</span>
                            </label>

                            <label style="display: flex;padding: 23.5px;text-align: center;cursor: pointer;margin: 0px;border-left: 0px;align-items: center;justify-content: center;">
                                <input type="radio" form="datechoose" name="pickup_date" value="2024-02-14"  @if($basket && $basket->serve_date == '2024-02-14') checked="checked" @endif >
                                &nbsp; 14<sup>th</sup> &nbsp; <span>February, 2024</span>
                            </label>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="ps-3 pe-3 text-center">
                <div class="row mt-3 mb-3">
                    
                    <div class="col-lg-12 form-group mb-3" >
                        <label for="" class="float-start mb-2">Pickup Time</label>
                        <select form="datechoose"  name="pickup_time"  class="form-select"   id="pickup_time" required>
                                   
                        </select>
                        <span class="text-danger time_exceeded"></span>
                    </div>
                    @if(!auth()->check())
                    <div class="col-lg-12 form-group mb-3">
                        <label for="" class="float-start mb-2">Email</label>
                        <input  form="datechoose" class="form-control" value="@if($basket) {{$basket->email}} @endif" type="email" id="b_email" name="b_email" placeholder="Enter your email"  required="" autocomplete="off">
                    </div>
                    @endif
                </div>
                
                    <a class=" btn btn-outline-dark border border-dark-subtle text-uppercase rounded-5 btn-block p-3 mb-2" href="{{route('sickkids2024')}}">Back to home</a>
                <button form="datechoose" class=" btn btn-primary text-uppercase rounded-5 btn-block p-3 mb-2" type="submit">Proceed To Checkout </button>
            </div>
        </div>
    </div>
          <div class="col-lg-12 bg-blue text-center mt-5">
                <div class="py-3">
                    <h1 class="theme-color fw-bold ">CAMPAIGN SUPPORTERS</h1>
                </div>
            </div>
            <div class="pt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="{{url('assets/fundraiser/rbc-bank.png')}}" class="w-100 mb-2">
                        </div>
                        <div class="col-lg-3">
                            <img src="{{url('assets/fundraiser/rbc-bank.png')}}" class="w-100 mb-2">
                        </div>
                        <div class="col-lg-3">
                            <img src="{{url('assets/fundraiser/rbc-bank.png')}}" class="w-100 mb-2">
                        </div>
                        <div class="col-lg-3">
                            <img src="{{url('assets/fundraiser/rbc-bank.png')}}" class="w-100 mb-2">
                        </div>
                    </div>
                </div>
            </div>
    <div class="col-lg-12 pt-5">
        <div id="map" style="width:100%;height:400px;border:0"></div>
        <div class="map-icon" onclick="goToMap()"></div>
    </div>
    
</div>
@endsection

@section('scripts')

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap&libraries=places,geometry&v=weekly" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

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
            url: '/assets/themes/{{$theme}}/images/sweetiepie-location.png',
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


  
    $(document).ready(function() {
        pickuptimeListing('11:00','20:00');
        
        function pickuptimeListing(startTime, endTime) {
                
            var interval = 15; // 15 minutes
            var options = '';
        
            // Parse the start and end times using Moment.js
            var startDate = moment(startTime, 'HH:mm');
            var endDate = moment(endTime, 'HH:mm');
            
            if(startDate <= endDate){
                while (startDate <= endDate) {
                    var time12Hour = startDate.format('hh:mm A'); // Format as 12-hour time with AM/PM
                    var time24Hour = convert12HourTo24Hour(time12Hour); // Convert to 24-hour format
            
                    options += '<option value="' + time24Hour + '">' + time12Hour + '</option>';
            
                    // Increment time by 15 minutes
                    startDate.add(interval, 'minutes');
                }
            }
            else
            {
                $('.time_exceeded').html('Time exceeded please choose another date');
            }
            $('#pickup_time').html(options);
            
            @if(isset($basket))
                @if($basket->serve_time != NULL)
                    var time = moment(`{{$basket->serve_time}}`, 'HH:mm').format('HH:mm');
                    $('#pickup_time').val(time)     
                @endif
            @endif
                
        }
        
           
            function convert12HourTo24Hour(time12Hour) {
                return moment(time12Hour, 'hh:mm A').format('HH:mm');
            }
            
    });
</script>
@endsection