@extends('fundraiser.fairbank.layout')
@section('content')

<div class="pt-5">
    <div class="container">
        <div class="col-lg-6 mx-auto">
            <h4 class="py-2 text-center"> Select a pickup date & time <br> after proceed to checkout</h4>
            <div class="card">
                <div class="row w-100 m-0">
                    <form action="{{route('fairbank2024-add-cart')}}" method="POST" id="datechoose" />
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
                            @php
                                $atLeastOneChecked = false;
                            @endphp
                            
                            @foreach($availableDateTime ?? [] as $date => $availabeDate)
                                @if($availabeDate['available'] == 0)
                                    <strike>
                                @endif
                            
                                <label style="display: flex;padding: 24px;text-align: center;cursor: pointer;margin: 0px;border-left: 0px;align-items: center;justify-content: center;">
                                    <input type="radio" form="datechoose" data-timestart="{{$availabeDate['open']}}" {{$availabeDate['available'] == 0 ? 'disabled' : ''}} data-closetime="{{$availabeDate['close']}}" name="pickup_date" value="{{$date}}" {{ $basket && $basket->serve_date == $date  && $availabeDate['available'] != 0 ? 'checked' : '' }}>
                                    &nbsp;   {!! date('j<\s\u\p>S</\s\u\p> F, Y', strtotime($date)) !!}
                                </label>
                            
                                @if($availabeDate['available'] == 0)
                                    </strike>
                                @endif
                            
                                @if(!$atLeastOneChecked && $availabeDate['available'] != 0)
                                    @php
                                        $atLeastOneChecked = true;
                                    @endphp
                                @endif
                            @endforeach
                            
                            
                            
                         
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
                
                    <a class=" btn btn-outline-dark border border-dark-subtle text-uppercase rounded-5 btn-block p-3 mb-2" href="{{route('fairbank2024')}}">Back to home</a>
                <button form="datechoose" class=" btn btn-primary text-uppercase rounded-5 btn-block p-3 mb-2" type="submit">Proceed To Checkout </button>
            </div>
        </div>
    </div>
    
    <div class="col-lg-12 pt-5">
        <div id="map" style="width:100%;height:400px;border:0"></div>
        <div class="map-icon" onclick="goToMap()"></div>
    </div>
    
</div>
@endsection


@php
    if (!$atLeastOneChecked && count($availableDateTime) > 0) {
        $firstDate = reset($availableDateTime);
    }
@endphp



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
            
            
             $('input[name="pickup_date"]').click(function() {
                    if ($(this).is(':checked')) {
                        // Get data-startime and data-closetime attributes of the checked radio button
                        var startTime = $(this).data('timestart');
                        var endTime = $(this).data('closetime');
                
                        // Call the pickuptimeListing function with start and end times
                        pickuptimeListing(startTime, endTime);
                    }
                });
    });
</script>


    <script>
        $(document).ready(function() {
            var checked = false;
            $('input[name="pickup_date"]').each(function() {
                if (!$(this).is(':disabled')) {
                    checked = true;
                    $(this).prop('checked', true);
                    return false; // Exit the loop once a radio button is checked
                }
            });
        
            if (!checked && $('input[name="pickup_date"]:enabled').length > 0) {
                $('input[name="pickup_date"]:enabled:first').prop('checked', true);
            }
            
            
            $('input[name="pickup_date"]:checked').trigger('click');

           

           
        });
    </script>

@endsection