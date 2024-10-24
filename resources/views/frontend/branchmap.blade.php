

<div class="text-center">
    <div class="text-center">
        <h2 class="fw-bold">{{$branch->name}}</h2>
        <span>{{titleText($branch->address)}}</span><br>
        <span class="text-center">{{$branch->postal_code}}, {{$branch->city}}, {{$branch->province}}</span>
    </div>
    @php
        $today_storetime = $store->store_timing->first();
    @endphp
 
    @if($today_storetime)
    <div>
        <div class="current-timing" style="text-align: center;">
            <span><i class="bi bi-clock"></i></span>
            @if($today_storetime->open < date('H:i:s'))
                <span class="text-success">Open</span> 
            @else
                <span class="text-danger">Closed</span>
            @endif
            -
            <span>Opens: {{date('h:i A',strtotime($today_storetime->open))}} </span> 
            <span class="bi bi-caret-down-fill storeTime cursor-pointer" data-timing="store_{{$branch->id}}"></span>
        </div>
        <div class="store_{{$branch->id}}" style="display:none">
            <ul class="list-group" >
                @foreach($timings as $ext)
                   <li class="list-group-item fw-bolder">{{ $ext }}</li> 
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <div class="directions-map d-flex">
        <form action="{{url('select-location')}}" method="GET" id="store_selected_form">
            <input type="hidden" form="store_selected_form" name="ordertype" value="pickup">
            <input type="hidden" form="store_selected_form" name="pickup_store" value="{{$branch->id}}">
            <input type="hidden" form="store_selected_form" name="redirect" value="menu"/>
        </form>
                
                        <a target="_new" href="tel:{{$branch->phone}}"><i class="bi bi-telephone "></i> Call Now</a>
                         <a target="map_new" href="{{$branch->map_link}}"><i class="bi bi-geo "></i>Directions</a>
                    
                    
                         <button @if($branch->status == 0) readonly disabled  @endif type="submit" class="store_ordernow border @if($branch->status == 0)  cursor-no-drop  @endif  " form="store_selected_form" value="Order Now"><i class="bi bi-shop-window" ></i>Order Now </button>
                            <a target="map_new" href="{{url('stores/'.$branch->slug)}}"><i class="bi bi-shop" style="margin-right: 5px;"></i>Spotlight</a> 
                  
                
                  
          
               
           
       
        
        
    </div>
    
</div>
                    
