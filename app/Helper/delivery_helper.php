<?php

use Carbon\Carbon;

function pureCalendar($store_id = 9, $type = 'pickup', $start_date = null, $end_date = null) {
    
    echo 'Calendar';
    
    $months = 5;
    
    $shippingMethod = findShippingMethod($type);
    
    $currentDate = now();
    $firstMonth = $currentDate->copy();
    $secondMonth = $currentDate->copy()->firstOfMonth()->addMonthNoOverflow();
    
    /************** Return if store or type is Invalid ************/
    
    /****************** Find the shipping Method *****************/
    
    /***************** Calculate Cutoff / Preparation time *******/ 
    
    /****************** Get the Store Timing *********************/
    
    /****************** Get Holidays ****************************/
    
    /***************** Get Holiday Timing *********************/
    
    /****************** Draw Calendar *************************/
    
    for($i=0;$i<$months;$i++) {
        echo drawCalendar($currentDate->copy()->addMonthNoOverflow($i)); 
    }
    
}

function drawCalendar($month) {
    
    $currentDate = now();
    $firstMonth = $currentDate->copy();
    $secondMonth = $currentDate->copy()->firstOfMonth()->addMonthNoOverflow();
    
    /********* Start drawing the Calendar ************/

    $result = '<div id="calendar-dropdown" class="position-absolute bg-light d-none text-center">
            <div class="calendar">';
    
    $currentMonth = $month; //$month === 0 ? $firstMonth : $secondMonth;

    $result .= '
        <div class="month month-0 d-none">
            <h6 class="text-center fw-bolder mt-1 mb-1">' . $currentMonth->format('F Y') . '</h6>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Sun</th>
                        <th scope="col">Mon</th>
                        <th scope="col">Tue</th>
                        <th scope="col">Wed</th>
                        <th scope="col">Thu</th>
                        <th scope="col">Fri</th>
                        <th scope="col">Sat</th>
                    </tr>
                </thead>
                <tbody>';

    $firstDayOfMonth    = $currentMonth->copy()->startOfMonth(); // Month Start Date
    $lastDayOfMonth     = $currentMonth->copy()->endOfMonth();  // Last day of Month
    $startDayOfWeek     = $firstDayOfMonth->dayOfWeek; // Start day of week
    $currentDate        = $firstDayOfMonth->copy()->subDays($startDayOfWeek); // Curret Date
    $today              = \Carbon\Carbon::today(); // TODAY
    $today_day          = $today->format('w'); // TODAY's Day name
    $isDisabled         = $currentDate->lt($today); 
    $currentDateTime    = Carbon::now(); // Current date and time
    $currentTime        = strtotime($currentDateTime->toDateTimeString());
    $hasafterAvailable  = false;
                        
    while ($currentDate <= $lastDayOfMonth) {
        $result .= '<tr>';
        
        for ($i = 0; $i < 7; $i++) {
            $result .= '<td>';
            
            $result .= '<span >' . $currentDate->format('j') . '</span>';
            
            $result .= '</td>';
            $currentDate = $currentDate->addDay();
        }
        $result .= '</tr>';
    }

    $result .= '</tbody>
            </table>
        </div>';
    
    
    $result .= '</div>
            <span class="text-center cursor-pointer fw-bold show-more-dates">More dates</a></div>';
    
    return $result;
}
    
    
function findShippingMethod($delivery_type){
    
    $session_string = session('session_string');	// Get Session String					
    $basket_items   = Basket::where('session',$session_string)->where('status',0)->first(); // Get the Basket ID
    $items          = Item::with('productShipping','productShipping.shipping')->where('basket_id',$basket_items->id)->get(); // Get the items in current cart...
    
    
    $maxShippingDays = [];

    $maxDaysshippingId = '';
    $maxDays           = 0;
    $maxPrepration     = 0;
        
    foreach ($items as $item) {
        
        // Iterate through the product shipping methods for the item
        foreach ($item->productShipping as $productShipping) {
          
            $shippingMethod = $productShipping->shipping;
            // $shippingMethod = $productShipping->shipping->where(function ($query) use ($delivery_type) {
            //                                         $query->where('order_type', $delivery_type)
            //                                               ->orWhere('order_type', '=', 'both');
            //                                     })
            //                                     ->where('name','!=','Pickup')
            //                                     ->where('name','!=','Delivery')->get();
                                  
            
            if($shippingMethod){                           
                if ($shippingMethod->name != 'Pickup' && $shippingMethod->name != 'Delivery' && ($shippingMethod->order_type == $delivery_type || $shippingMethod->order_type == 'both')) {
                        // Check if the shipping method has a delivery days attribute
                    if ($shippingMethod && $shippingMethod->preperation_time > $maxPrepration) {
                        $maxDays = $shippingMethod->days;
                        $maxPrepration = $shippingMethod->preperation_time;
                        $maxDaysshippingId = $shippingMethod->id;
                        
                    }
                }
            }
        }
    
        // Store the maximum days for this item
        // $maxShippingDays[$item->id] = $maxDays;
    }
    

    return $maxDaysshippingId;
}
