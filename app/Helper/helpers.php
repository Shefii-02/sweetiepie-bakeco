<?php

use App\Models\Menu;
use App\Models\Store;
use App\Models\SocialmediaSite;
use App\Models\Basket;
use App\Models\Item;
use App\Models\Holiday;
use App\Models\VariationImage;
use App\Models\ProductImage;
use Carbon\Carbon;
use Faker\Factory;
use App\Models\ProductVariation;
use App\Models\Shipping;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
include('delivery_helper.php');

function getMenu2($handle = 'main-menu',$attributes = null)
{
	$menu = Menu::with(['children'=>function($query){$query->whereStatus(1)->orderBy('weight','ASC');}])->whereSlug($handle)->whereStatus(1)->first();

	if(!$menu)
		return false;
	
	echo "\n\r".getSubMenu2($menu->children)."\n\r\n";
}

function getSubMenu2($children)
{
	$result = '';

	foreach($children as $key1 => $submenu)
	{
		$result .= '<li class="';
		if(count($submenu->children)>0)
		{
		 	$result .= 'nav-item dropdown'; 
		}
		else
		{
		 	$result .= 'nav-item';
		}
		
		 $result .='">'."\n\r";
		 
		$result .= '<a'; 
		if(count($submenu->children)>0)
		{
    		$result .= ' class="nav-link py-2 hp-2 px-2 dropdown-toggle " href="'.url($submenu->link == '' ? '#' : $submenu->link.'').'" id="navbarDropdown'.$key1.'" role="button"
    		 aria-expanded="false"';
		}
		else
		{
		    $result .= ' class="nav-link hp-2 py-2 px-2" ';
		}

		$result .='href="'.url($submenu->link.'').'">'.$submenu->name.'</a>'."\n\r";

		if(count($submenu->children)>0)
		{
			$result .= '<ul class="dropdown-menu border-0 shadow-sm p-3" aria-labelledby="navbarDropdown'.$key1.'">'."\n\r".getSubMenu2($submenu->children)."\n\r".'</ul>'."\n\r";
		}

		$result .= '</li>'."\n\r";
	}

	return $result;
}

//navbar main-menu section
function getMenu($handle,$attributes)
{
	$menu = Menu::with(['children'=>function($query){$query->whereStatus(1)->orderBy('weight','ASC');}])->whereSlug($handle)->whereStatus(1)->first();

	if(!$menu)
		return false;
	
	echo '<ul ';

	foreach($attributes as $key=>$val)
	{
		echo $key.'="'.$val.'" ';
	}

	echo 'class="menu">'."\n\r".getSubMenu($menu->children)."\n\r".'</ul>'."\n";
}
function getSubMenu($children)
{
	$result = '';

	foreach($children as $key1 => $submenu)
	{
		$result .= '<li class="';
		if(count($submenu->children)>0)
		{
		 	$result .= 'nav-item dropdown'; 
		}
		else
		{
		 	$result .= 'menu-item-has-children';
		 }
		 $result .='">'."\n\r";
		 
		$result .= '<a'; 
		if(count($submenu->children)>0)
		{
		$result .= ' class="nav-link dropdown-toggle" href="#" id="navbarDropdown'.$key1.'" role="button"
		data-bs-toggle="dropdown" aria-expanded="false"';
		}
		else
		{
		 $result .= ' class="dropdown-item" ';
		}

		$result .='href="'.url($submenu->link.'').'">'.$submenu->name.'</a>'."\n\r";

		if(count($submenu->children)>0)
		{
			$result .= '<ul class="dropdown-menu" aria-labelledby="navbarDropdown'.$key1.'">'."\n\r".getSubMenu($submenu->children)."\n\r".'</ul>'."\n\r";
		}

		$result .= '</li>'."\n\r";
	}

	return $result;
}
///end
//get SocialMedia list
function getSocialmedia(){
    $site =  SocialmediaSite::get();

    $result = '<ul>';
    foreach($site as $item){
        $result.='<li class="text-capitalize">
                    <a href="'.$item->link.'" title="'.$item->title.'"> <i class="fa '.$item->icon.'"></i> </a>
                </li>';
    }
    $result.='</ul>';
    
    return $result;
}
//end
//get Store List
function getStore(){
    $stores = Store::orderBy('display_order','ASC')->get()->toArray();

    // Split the array into two parts
    $firstFive = array_slice($stores, 0, 5);
    $remaining = array_slice($stores, 5);
    
    // Print the first 5 items
    $result = '<ul>';
    foreach ($firstFive as $item) {
        $result .= '<li class=""><a href="/stores/'.$item['slug'].'">' . $item['name'] . '<div class="li-hover">' .
            $item['name'] . ', ' . $item['address'] . ', ' . $item['city'] . ', ' . $item['postal_code'] . ', ' . $item['phone'] .
            '</div></a></li>';
    }
    $result .= '</ul>';
    
    // Print the remaining items
    $remainingResult = '<ul>';
    foreach ($remaining as $item) {
        $remainingResult .= '<li class=""><a href="/stores/'.$item['slug'].'">' . $item['name'] . '<div class="li-hover">' .
            $item['name'] . ', ' . $item['address'] . ', ' . $item['city'] . ', ' . $item['postal_code'] . ', ' . $item['phone'] .
            '</div></a></li>';
    }
    $remainingResult .= '</ul>';


    $result2 = "<div class='row'><div class='col-lg-6'>$result</div><div class='col-lg-6'>$remainingResult</div></div>";

    
    return $result2;
}
//end
function imageExisted($imagePath){
     if (File::exists(public_path($imagePath))) {
        $imageUrl = asset($imagePath);
    } else {
        $defaultImagePath = "/assets/images/9.png";
        $imageUrl = asset($defaultImagePath);
    }
    
    
    return $imageUrl;
}
function checkBasket(){
        if(session()->has('session_string')) {
            $session_string = session('session_string');;
            $basket = Basket::where('session',$session_string)->where('status',0)->first();
            if($basket){
                return 1;
            }
            else
            {
                return 0;
            }
        }
        else
    {
        return 0;
    }
}
function GetBasket(){ 
    $basket = array();
    if(session()->has('session_string')) {
        $session_string = session('session_string');;

        $basket = Basket::where('session',$session_string)->where('status',0)->first();
    }
   return $basket;
}
function getCartCount() {
    if(session()->has('session_string')) {
       
            $session_string = session('session_string');;
            $basket = Basket::where('session',$session_string)->where('status',0)->first();
          if($basket){
        return Item::whereBasketId($basket->id)->count();
          }
          else
          {
              return 0;
          }
    }
    else
    {
        return 0;
    }
}
function getPrice($value = 0, $decimal = 2) {
  return '$'.number_format($value,$decimal);
}
function titleTextSingle($text){
    $rewrittenText =   Str::title($text);
    return $rewrittenText;
}
function titleText($text){
    $rewrittenText = Str::title($text);
    return $rewrittenText;
}
function capitalText($text){
    $rewrittenText = strtoupper(str_replace('-','<br>',$text));
    return $rewrittenText;
}
function dateOnly($date){
    return date('d-M-Y',strtotime($date));
}
function dummy_text($keyword){
    
    // $faker = Factory::create();
    // $paragraph = $faker->realText(200, $indexSize = 2) . ' ' . $keyword . ' ' . $faker->realText(200);

    
    return ' ';
}


function product_thumbImage($product_id){
    $picture = ProductImage::where('product_id', $product_id)->where('type','Thumbnail')->orderBy('id','ASC')->pluck('picture')->first();
    if(!$picture){
        $picture = ProductImage::where('product_id', $product_id)->where('type','Main Image')->orderBy('id','ASC')->pluck('picture')->first();
    }
    if(!$picture){
        $picture = ProductImage::where('product_id', $product_id)->where('type','Extra Image')->orderBy('id','ASC')->pluck('picture')->first();
    }
  return $picture;
}

function product_nutritional_facts($product_id){
    $picture = ProductImage::where('product_id', $product_id)->where('type','Nutritional Facts')->pluck('picture')->first();
    return $picture;
}
function product_nutritional_facts_all($product_id){
    
    //  $picture = VariationImage::leftJoin('product_images','variation_images.product_id','product_images.product_id')
    //                         ->where('product_images.product_id', $product_id)
    //                         ->where('product_images.type','Nutritional Facts')
    //                         ->select('product_images.picture', 'variation_id', 'product_images.type')
    //                         ->get();
    
    $picture = ProductImage::leftJoin('variation_images','variation_images.picture_id','product_images.id')
                            ->where('product_images.product_id', $product_id)
                            ->where('product_images.type','Nutritional Facts')
                            ->select('product_images.picture', 'variation_id', 'product_images.type')
                            ->get();
       
          return $picture;                 
}
function product_images($product_id){
    $picture = VariationImage::leftJoin('product_images','variation_images.product_id','product_images.product_id')
                            ->where('product_images.product_id', $product_id)
                            ->where('product_images.type','<>','Nutritional Facts')
                            ->select('product_images.picture', 'variation_id', 'product_images.type')
                            ->orderByRaw("CASE WHEN type = 'Main Image' THEN 0 ELSE 1 END, type ASC")
                            ->get();
                            
    $picture = ProductImage::leftJoin('variation_images','variation_images.picture_id','product_images.id')
                            ->where('product_images.product_id', $product_id)
                            ->where('product_images.type','<>','Nutritional Facts')
                            ->select('product_images.picture', 'variation_id', 'product_images.type')
                             ->orderByRaw("CASE WHEN type = 'Main Image' THEN 0 ELSE 1 END, type ASC")
                            ->get();

    // Initialize an empty array to store the grouped data
    $groupedData = [];
    
    foreach ($picture as $item) {
        $variation_id = $item->variation_id;
    
        // If the variation_id doesn't exist in the groupedData array, create a new array for it
        if (!isset($groupedData[$variation_id])) {
            $groupedData[$variation_id] = [];
        }
    
        if(in_array($item->picture, $groupedData[$variation_id])){
        }
        else{
        // Store the picture data in the corresponding variation_id array
            $groupedData[$variation_id][] = $item->picture;
        }
    }
    // dd($groupedData);
    return $groupedData;
}



// function product_thumbImage($product_id){
//     $picture = VariationImage::where('product_id', $product_id)->where('type','Thumbnail')->pluck('picture')->first();
//     if(!$picture){
//         $picture = VariationImage::where('product_id', $product_id)->where('type','Main Image')->pluck('picture')->first();
//     }
//   return $picture;
// }
// function product_nutritional_facts($product_id){
//     $picture = VariationImage::where('product_id', $product_id)->where('type','Nutritional Facts')->pluck('picture')->first();
//     return $picture;
// }
// function product_nutritional_facts_all($product_id){
//      $picture = VariationImage::where('product_id', $product_id)
//                             ->where('type','Nutritional Facts')
//                             ->select('picture', 'variation_id', 'type')
//                             ->get();
//           return $picture;                 
// }
// function product_images($product_id){
//     $picture = VariationImage::where('product_id', $product_id)
//                             ->where('type','<>','Nutritional Facts')
//                             ->select('picture', 'variation_id', 'type')
//                             ->orderByRaw("CASE WHEN type = 'Main Image' THEN 0 ELSE 1 END, type ASC")
//                             ->get();

//     // Initialize an empty array to store the grouped data
//     $groupedData = [];
    
//     foreach ($picture as $item) {
//         $variation_id = $item->variation_id;
    
//         // If the variation_id doesn't exist in the groupedData array, create a new array for it
//         if (!isset($groupedData[$variation_id])) {
//             $groupedData[$variation_id] = [];
//         }
    
//         // Store the picture data in the corresponding variation_id array
//         $groupedData[$variation_id][] = $item->picture;
//     }
//     return $groupedData;
// }




function max_price($product_id){
    
    $minimumPrice = ProductVariation::where('product_id', $product_id)->max('price');
   return $minimumPrice;
}

function max_price_special($product_id){
    
    $minimumPrice = ProductVariation::where('product_id', $product_id)->max('special_price');
   return $minimumPrice;

}

function min_price($product_id){
    
    $minimumPrice = ProductVariation::where('product_id', $product_id)->min('price');
   return getPrice($minimumPrice);
}
function formatTimeRange($start, $end){
    $startTime = date('h:i A', strtotime($start));
    $endTime = date('h:i A', strtotime($end));

    return $startTime . ' - ' . $endTime;
}
function showStoreTiming($store){
    $timings = App\Models\StoreTiming::where('store_id', $store->id)
                                    ->select('day', 'open', 'close')
                                    ->orderBy('day')
                                    ->get()
                                    ->toArray();
        
        $days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        
        $formattedTimings = [];
        
        $startDay = null;
        $endDay = null;
        $prevOpen = null;
        $prevClose = null;
        
        foreach ($timings as $index => $timing) {
            $day = $days[$timing["day"]];
            $open = date("h:i A", strtotime($timing["open"]));
            $close = date("h:i A", strtotime($timing["close"]));
        
            if ($prevOpen === null && $prevClose === null) {
                $startDay = $day;
                $endDay = $day;
            } elseif ($open !== $prevOpen || $close !== $prevClose) {
                $formattedTimings[] = [
                    "days" => $startDay !== $endDay ? $startDay . "-" . $endDay : $startDay,
                    "timings" => $prevOpen . " - " . $prevClose
                ];
                $startDay = $day;
                $endDay = $day;
            } else {
                $endDay = $day;
            }
        
            $prevOpen = $open;
            $prevClose = $close;
        
            if ($index === count($timings) - 1) {
                $formattedTimings[] = [
                    "days" => $startDay !== $endDay ? $startDay . "-" . $endDay : $startDay,
                    "timings" => $prevOpen . " - " . $prevClose
                ];
            }
        }


     return $formattedTimings;
    
    
}

// function showPickupCalender($store_id = null,$type = null){
    
//     $maxDaysshippingId = ShippingMethodFinding('pickup');
//     if($maxDaysshippingId != NULL){
//         $shipping   = Shipping::where('id', $maxDaysshippingId)->first();
//     }
//     else{
//         $shipping   = Shipping::where('order_type', 'pickup')->first();
//     }
    
    
//     $cuttoff    = $shipping->cut_off ?? strtotime('6:00 PM');
//     $store      = Store::with('store_timing', 'holidaytiming', 'holidaytiming.holiday')->where('status',1)->where('id', $store_id)->first();
//     $preparetime= $shipping->preperation_time * 3600 ?? env('PREPARATION_TIME');
    
//     $preSkipDay = intval($preparetime/86400);
    
//     $allow_after_days = $shipping->days ?? 1;
    
//     if($shipping->id==6 && time() > strtotime(date('Y-m-d').' '.$shipping->cut_off)) {
//         $allow_after_days++;
        
//         if(date('N')==5) {
//             $allow_after_days++;
//         }
//     }
//     elseif($shipping->id==6 && time() <= strtotime(date('Y-m-d').' '.$shipping->cut_off)) {
//         if(date('N')==6) {
//             $allow_after_days++;
//         }
//     }
    
//     $currentDate = now();
//     $firstMonth = $currentDate->copy();
//     // $secondMonth = $currentDate->copy()->addMonth();
//     $secondMonth = $currentDate->copy()->firstOfMonth()->addMonthNoOverflow();
    
//     $holidays = Holiday::with('holidaytiming')->where('the_date','>=',date('Y-m-d'))->pluck('the_date')->toArray();

//     $result = '<div id="calendar-dropdown" class="position-absolute bg-light d-none text-center">
//             <div class="calendar">';
    
//     for ($month = 0; $month < 2; $month++) {
//         // $currentMonth = $currentDate->copy()->addMonth($month);  
//         $currentMonth = $month === 0 ? $firstMonth : $secondMonth;
//         $sec_month = $month === 1 ? 'd-none' : '';

//         $result .= '
//             <div class="month month-'.$month.' '.$sec_month.'">
//                 <h6 class="text-center fw-bolder mt-1 mb-1">' . $currentMonth->format('F Y') . '</h6>
//                 <table class="table table-bordered">
//                     <thead>
//                         <tr>
//                             <th scope="col">Sun</th>
//                             <th scope="col">Mon</th>
//                             <th scope="col">Tue</th>
//                             <th scope="col">Wed</th>
//                             <th scope="col">Thu</th>
//                             <th scope="col">Fri</th>
//                             <th scope="col">Sat</th>
//                         </tr>
//                     </thead>
//                     <tbody>';
    
//         $firstDayOfMonth = $currentMonth->copy()->startOfMonth();
//         $lastDayOfMonth = $currentMonth->copy()->endOfMonth();
//         $startDayOfWeek = $firstDayOfMonth->dayOfWeek;
//         $currentDate = $firstDayOfMonth->copy()->subDays($startDayOfWeek);
//         $today = \Carbon\Carbon::today();
//         $today_day = $today->format('w');
//         $isDisabled = $currentDate->lt($today);
//         $currentDateTime = Carbon::now();
//         $currentTime = strtotime($currentDateTime->toDateTimeString());
    
//         while ($currentDate <= $lastDayOfMonth) {
//             $result .= '<tr>';
//             for ($i = 0; $i < 7; $i++) {
//                 $result .= '<td>';
//                 if ($currentDate->month === $currentMonth->month && $currentDate->gte($firstDayOfMonth)) {
//                     $date = $currentDate->format('Y-m-d');
//                     $day_number = $currentDate->format('w');
//                     $isHoliday = in_array($date, $holidays);
                    
//                     if($preSkipDay > 0){
//                         $allow_after = $today->copy()->addDay($allow_after_days+$preSkipDay);
//                     }
//                     else{
//                         $allow_after = $today->copy()->addDay($allow_after_days);  
//                     }
                    
                    
//                     $isDisabled = $currentDate->lt($allow_after);
//                     $isToday = $currentDate->isSameDay($today);
//                     $store_workingday = $store->store_timing->where('day', $day_number)->first();
                    
    
//                     if ($store_workingday) {
//                         $opening_time = strtotime($store_workingday->open);
//                         // $close_time = $store_workingday->close;
//                         $availableTime_on = strtotime($store_workingday->open) + $preparetime;
//                         // $availableTime_to = strtotime($store_workingday->close) - $preparetime;
//                         $availableTime_to = strtotime($cuttoff);
//                     }
                    
    
//                     $isAvailable = true;
//                     $isTimeExceeded = false;
                    
                    
//                     ///////////////Manual date skip code/////////////////////////////////
                    
//                     // if(time() >= strtotime('2023-12-18 17:55:00') && ($currentDate->format('Y-m-d') == '2023-09-18' || $currentDate->format('Y-m-d') == '2023-09-19')) {
//                     //     $isDisabled = true;
//                     // }
                   
//                     if($isToday && date('Y-m-d') == '2023-12-24') {
//                         $isDisabled = true;
//                     }
                    
//                     ///////////////Manual date skip code/////////////////////////////////
    
//                     if (!$isHoliday && $store_workingday && !$isDisabled) {
//                         if ($isToday && ($currentTime <= $availableTime_to)) {
                            
//                                 if($currentTime > $opening_time){
//                                     $RoundavailableTime_on = $currentTime + $preparetime;
//                                     $availableTime_on = roundTimeToNearestInterval($RoundavailableTime_on, 900);
//                                 }
//                             if($availableTime_on <= $availableTime_to){
//                                 $result .= '<span class="date today valid_date" data-start="'.date('H:i',$availableTime_on).'" data-end="'.date('H:i',$availableTime_to).'" data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</span>';
//                             } 
//                             else {
//                                 $isTimeExceeded = true;
//                             }
//                         } 
//                         else {
//                             $isTimeExceeded = true;
//                         }
//                     }
    
//                     if ($isHoliday) {
//                         $holi_Day = Holiday::where('the_date', $date)->first();
//                         $checkStoreAvailability = Holiday::leftJoin('holiday_timings', 'holiday_timings.holiday_id', 'holidays.id')
//                             ->where('store_id', $store_id)
//                             ->where('the_date', $date)
//                             ->first();
    
//                         if (!$checkStoreAvailability || $isDisabled) {
//                             $result .= '<span title="' . $holi_Day->name . '- Store off day" class="date holiday">' . $currentDate->format('j') . '</span>';
//                         } 
//                         elseif($isToday && strtotime($checkStoreAvailability->cut_off) <= time()){
//                             $result .= '<span title="Time exceeded. Today is not available" class="date holiday disabled" data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</span>';
//                         }
//                         else {
                            
                           
                            
                            
//                             $opening_time = $checkStoreAvailability->online_pickup_open ?? $checkStoreAvailability->open;
//                             $close_time = $checkStoreAvailability->online_pickup_close ?? $checkStoreAvailability->close;
//                             // $close_time = $cuttoff;
                            
//                             if($opening_time != null){
//                                 if($opening_time == null){
//                                         $opening_time = $store_workingday->open;
//                                 }
                            
//                                 if($close_time == null){
//                                     // $close_time = $store_workingday->close ?? '00:00';
//                                     $close_time = $cuttoff;
//                                 }
                    
//                                 $availableTime_on = strtotime($opening_time) + $preparetime;
//                                 $availableTime_to = strtotime($close_time);
                                   
//                                 if($isToday){
//                                     $currentTime = $currentTime + $preparetime;
//                                 }
                           
//                                 if($isToday && $currentTime > $opening_time && $currentTime <= $availableTime_to){
//                                     $RoundavailableTime_on = $currentTime;
//                                     $availableTime_on = roundTimeToNearestInterval($RoundavailableTime_on, 900);
//                                     $result .= '<a href="#" title="' . $holi_Day->name . '" class="valid_date date holiday-allow" data-start="'.date('H:i',$availableTime_on).'" data-end="'.date('H:i',$availableTime_to).'"  data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</a>';
                                  
//                                 }
//                                 elseif($isToday && $currentTime > $availableTime_to){
                              
//                                     $result .= '<span title="Time exceeded. Today is not available" class="date holiday disabled" data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</span>';
//                                 }
//                                 else{
                                   
//                                     $result .= '<a href="#" title="' . $holi_Day->name . '" class="valid_date date holiday-allow" data-start="'.date('H:i',$availableTime_on).'" data-end="'.date('H:i',$availableTime_to).'"  data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</a>';
//                                 }
//                             }
//                             else{
                        
//                                 $result .= '<span title="Store not available" class="date holiday disabled">' . $currentDate->format('j') . '</span>';
//                             }
//                         }
//                     } elseif ($isDisabled || !$store_workingday) {
//                         $result .= '<span title="Store not available" class="date disabled">' . $currentDate->format('j') . '</span>';
//                     } elseif ($isAvailable && !$isToday) {
//                         $result .= '<a href="#" class="valid_date date" data-start="'.date('H:i',$availableTime_on).'" data-end="'.date('H:i',$availableTime_to).'"  data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</a>';
//                     } elseif ($isTimeExceeded) {
//                         $result .= '<span title="Time exceeded. Today is not available" class="date holiday disabled" data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</span>';
//                     }
//                 } else {
//                     $result .= '<span class="date disabled">' . $currentDate->format('j') . '</span>';
//                 }
    
//                 $result .= '</td>';
//                 $currentDate = $currentDate->addDay();
//             }
//             $result .= '</tr>';
//         }
    
//         $result .= '</tbody>
//                 </table>
//             </div>';
//     }
    
    
//     $result .= '</div>
//             <span class="text-center cursor-pointer fw-bold show-more-dates">More dates</a></div>';
    
//     return $result;

// }
// /*************** DELIVERY CALENDAR *****************/
// function showDeiveryCalender($store_id = null,$type = null){
//     $maxDaysshippingId = ShippingMethodFinding('delivery');
//     if($maxDaysshippingId != NULL){
//         $shipping   = Shipping::where('id', $maxDaysshippingId)->first();
//     }
//     else{
//         $shipping   = Shipping::where('order_type', 'delivery')->first();
//     }

//     $preparetime= $shipping->preperation_time * 3600 ?? env('PREPARATION_TIME');
//     $preSkipDay = intval($preparetime/86400);
              
//     $cuttoff = strtotime($shipping->cut_off) ?? strtotime('2:30 PM');
//     $allow_after_days = $shipping->days ?? 1;
    
//     if($shipping->id==7 && time() > strtotime(date('Y-m-d').' '.$shipping->cut_off)) {
//         $allow_after_days++;
        
//         if(date('N')==5) {
//             $allow_after_days++;
//         }
//     }
//     elseif($shipping->id==7 && time() <= strtotime(date('Y-m-d').' '.$shipping->cut_off)) {
//         if(date('N')==6) {
//             $allow_after_days++;
//         }
//     }
    
//     $currentDate = now();
//     $firstMonth = $currentDate->copy();
//     // $secondMonth = $currentDate->copy()->addMonth();
//     $secondMonth = $currentDate->copy()->firstOfMonth()->addMonthNoOverflow();
//     $holidays = Holiday::with('holidaytiming')->where('the_date','>=',date('Y-m-d'))->pluck('the_date')->toArray();
    
//     $result = '<div id="calendar-dropdown" class="position-absolute bg-light d-none text-center">
//         <div class="calendar">';
//     for ($month = 0; $month < 2; $month++) {
//         $currentMonth = $month === 0 ? $firstMonth : $secondMonth;
//         $sec_month = $month === 1 ? 'd-none' : '';
//         $result .= '
//             <div class="month month-'.$month.' '.$sec_month.'">
//                 <h6 class="text-center fw-bolder mt-1 mb-1">' . $currentMonth->format('F Y') . '</h6>
//                 <table class="table table-bordered">
//                     <thead>
//                         <tr>
//                             <th scope="col">Sun</th>
//                             <th scope="col">Mon</th>
//                             <th scope="col">Tue</th>
//                             <th scope="col">Wed</th>
//                             <th scope="col">Thu</th>
//                             <th scope="col">Fri</th>
//                             <th scope="col">Sat</th>
//                         </tr>
//                     </thead>
//                     <tbody>';
    
//         $firstDayOfMonth = $currentMonth->copy()->startOfMonth();
//         $lastDayOfMonth = $currentMonth->copy()->endOfMonth();
//         $startDayOfWeek = $firstDayOfMonth->dayOfWeek;
//         $currentDate = $firstDayOfMonth->copy()->subDays($startDayOfWeek);
//         $today = \Carbon\Carbon::today();
//         $today_day = $today->format('w');
//         $isDisabled = $currentDate->lt($today);
//         $tomorrow = $today->copy()->addDay();
//         $tomorrow_day = $tomorrow->format('w');
//         $currentDateTime = Carbon::now();
//         $currentTime = strtotime($currentDateTime->toDateTimeString());

//         while ($currentDate <= $lastDayOfMonth) {
//             $result .= '<tr>';
//             for ($i = 0; $i < 7; $i++) {
//                 $result .= '<td>';
//                 if ($currentDate->month === $currentMonth->month && $currentDate->gte($firstDayOfMonth)) {
//                     $date = $currentDate->format('Y-m-d');
//                     $day_number = $currentDate->format('w');
//                     $day_name = strtolower($currentDate->format('l'));
//                     $isHoliday = in_array($date, $holidays);
    
//                     if($preSkipDay > 0){
//                         $allow_after = $today->copy()->addDay($allow_after_days+$preSkipDay);
//                     }
//                     else{
//                         $allow_after = $today->copy()->addDay($allow_after_days);  
//                     }
                    
                    
                      
//                     // $allow_after = $today->copy()->addDay($allow_after_days);
//                     $isDisabled = $currentDate->lt($allow_after);
//                     $isTomorrow = $currentDate->isSameDay($tomorrow);
//                     $isToday = $currentDate->isSameDay($today);
//                     $day_available = $shipping->$day_name == 1;
    
//                     $isAvailable = true;
//                     $isTimeExceeded = false;
                    
                    
//                     $currentDayOfWeek = strtolower($currentDate->format('l'));
    
//                     if($shipping->{$currentDayOfWeek} == 0){
//                         $isDisabled = true;
//                     }
    
//                     if (!$isHoliday && $day_available && !$isDisabled) {
//                         if ($isToday && ($currentTime < $cuttoff)) {
//                             $result .= '<span class="date today valid_date" data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</span>';
//                         } elseif ($isTomorrow && ($currentTime < $cuttoff)) {
//                             $result .= '<span class="date valid_date" data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</span>';
//                         } else {
//                             $isTimeExceeded = true;
//                         }
//                     }
    
//                     if ($isHoliday) {
//                         $holi_Day = Holiday::where('the_date', $date)->first();
//                         $checkStoreAvailability = Holiday::where('the_date', $date)->where('block_delivery', 0)->first();
    
//                         if (!$checkStoreAvailability || $isDisabled) {
//                             $result .= '<span title="' . $holi_Day->name . '- Off day" class="date holiday">' . $currentDate->format('j') . '</span>';
//                         } else {
//                             $holi_cuttoff = strtotime($holi_Day->cut_off);
                            
//                             if($isToday){
//                                 $currentTime = $currentTime + $preparetime;
//                             }
                           
//                             if($isToday && $currentTime > $opening_time && $currentTime <= $holi_cuttoff){
//                                 $RoundavailableTime_on = $currentTime;
//                                 $availableTime_on = roundTimeToNearestInterval($RoundavailableTime_on, 900);
//                                 $result .= '<a href="#" title="' . $holi_Day->name . '" class="valid_date date holiday-allow"  data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</a>';
                              
//                             }
//                             elseif($isToday && $currentTime > $holi_cuttoff){
                          
//                                 $result .= '<span title="Time exceeded. Today is not available" class="date holiday disabled" data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</span>';
//                             }
//                             else{
                               
//                                 $result .= '<a href="#" title="' . $holi_Day->name . '" class="valid_date date holiday-allow"   data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</a>';
//                             }
    
//                             // if ($currentTime < $holi_cuttoff) {
//                             //     $result .= '<a href="#" title="' . $holi_Day->name . '" class="valid_date date holiday-allow" data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</a>';
//                             // } else {
//                             //     $result .= '<span title="Time exceeded. Date not available" class="date holiday disabled " data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</span>';
//                             // }
//                         }
//                     } elseif ($isDisabled && $isToday) {
//                         $result .= '<span class="date today disabled" data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</span>';
//                     } elseif ($isDisabled || !$day_available) {
//                         $result .= '<span title="Off day.." class="date disabled">' . $currentDate->format('j') . '</span>';
//                     } elseif ($isAvailable && !$isToday && !$isTomorrow) {
//                         $result .= '<a href="#" class="valid_date date" data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</a>';
//                     } elseif ($isTimeExceeded) {
//                         $result .= '<span title="Time exceeded. This day  not available" class="date  disabled " data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</span>';
//                     }
//                 } else {
//                     $result .= '<span class="date disabled">' . $currentDate->format('j') . '</span>';
//                 }
    
//                 $result .= '</td>';
//                 $currentDate = $currentDate->addDay();
//             }
//             $result .= '</tr>';
//         }
    
//         $result .= '</tbody>
//                 </table>
//             </div>';
//     }
    
//     $result .= '</div>
    
//             <span class="text-center cursor-pointer fw-bold show-more-dates">More dates</a>
//             </div>';

// return $result;
// }


// /****************** PREORDER PICKUP CALENDER *******************************/
// function showPreOrderPickupCalender($start_date, $end_date,$store_id = null) {
//     $holidays = Holiday::with('holidaytiming')->where('the_date','>=',date('Y-m-d',strtotime($start_date)))->pluck('the_date')->toArray();
//     $store = Store::with('store_timing', 'holidaytiming', 'holidaytiming.holiday')->where('status',1)->where('id', $store_id)->first();
    
//     $shipping = Shipping::where('order_type', 'pickup')->first();
//     $cuttoff = $shipping->cut_off ?? strtotime('6:00 PM');
    
//     $preparetime = $shipping->preperation_time * 3600 ?? env('PREPARATION_TIME');
    
//     $allow_after_days = $shipping->days ?? 1;
     
//     // Convert start and end dates to Carbon instances
//     $startDate = \Carbon\Carbon::parse($start_date);
//     $endDate = \Carbon\Carbon::parse($end_date);

//     $currentDate = $startDate->copy();
//     $today = \Carbon\Carbon::today();
//     $firstMonth = $currentDate->copy();
//     $secondMonth = $currentDate->copy()->addMonth();
//     $currentDateTime = Carbon::now();
//     $currentTime = strtotime($currentDateTime->toDateTimeString());
    
//     if($today > $startDate){
//         $startDate = $today;
//     }

//     $result = '<div id="calendar-dropdown" class="position-absolute bg-light d-none text-center">
//         <div class="calendar" style="margin-bottom:0">';
//     $month = 0;
//     while ($currentDate <= $endDate) {
//         $currentMonth = $month === 0 ? $firstMonth : $secondMonth;
//         $sec_month = $month === 1 ? 'd-none' : '';

//         $result .= '<div class="month mt-2 month-'.$month.' '.$sec_month.'">';
//         $result .= '<h6 class="text-center fw-bolder mt-1 mb-1">' . $currentDate->format('F Y') . '</h6>';
//         $result .= '<table class="table table-bordered">
//             <thead>
//                 <tr>
//                     <th scope="col">Sun</th>
//                     <th scope="col">Mon</th>
//                     <th scope="col">Tue</th>
//                     <th scope="col">Wed</th>
//                     <th scope="col">Thu</th>
//                     <th scope="col">Fri</th>
//                     <th scope="col">Sat</th>
//                 </tr>
//             </thead>
//             <tbody>';

//         $firstDayOfMonth = $currentDate->copy()->startOfMonth();
//         $lastDayOfMonth = $currentDate->copy()->endOfMonth();
//         $startDayOfWeek = $firstDayOfMonth->dayOfWeek;
//         $currentDate = $firstDayOfMonth->copy()->subDays($startDayOfWeek);

//         while ($currentDate <= $lastDayOfMonth) {
//             $result .= '<tr>';
//             for ($i = 0; $i < 7; $i++) {
//                 $result .= '<td>';
//                 if ($currentDate->month === $currentDate->month && $currentDate->gte($firstDayOfMonth)) {
//                     $date = $currentDate->format('Y-m-d');
//                     $day_number = $currentDate->format('w');
//                     $isHoliday = in_array($date, $holidays);
//                     $allow_after = $today->copy()->addDay($allow_after_days);
//                     $isDisabled = $currentDate->lt($allow_after);
//                     $isToday = $currentDate->isSameDay($today);
//                     $store_workingday = $store->store_timing->where('day', $day_number)->first();

                    
//                     if ($store_workingday) {
//                         $opening_time = strtotime($store_workingday->open);
//                         $availableTime_on = strtotime($store_workingday->open) + $preparetime;
//                         $availableTime_to = strtotime($cuttoff);
//                     }

//                     $isAvailable = true;
//                     $isTimeExceeded = false;

//                     if($currentDate < $startDate || $currentDate > $endDate) {
//                         $isDisabled = true;
//                     }

//                     if (!$isHoliday && $store_workingday && !$isDisabled) {
                        
                        
//                         if ($isToday && ($currentTime <= $availableTime_to)) {
//                             if($currentTime > $opening_time){
//                                 $RoundavailableTime_on = $currentTime + $preparetime;
//                                 $availableTime_on = roundTimeToNearestInterval($RoundavailableTime_on, 900);
//                             }

//                             $result .= '<span class="date today valid_date" data-start="'.date('H:i',$availableTime_on).'" data-end="'.date('H:i',$availableTime_to).'" data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</span>';
//                         } else {
//                             $isTimeExceeded = true;
//                         }
//                     }

//                     if ($isHoliday) {
//                         $holi_Day = Holiday::where('the_date', $date)->first();
//                         $checkStoreAvailability = Holiday::leftJoin('holiday_timings', 'holiday_timings.holiday_id', 'holidays.id')
//                             ->where('store_id', $store_id)
//                             ->where('the_date', $date)
//                             ->first();

//                         if (!$checkStoreAvailability || $isDisabled) {
//                             $result .= '<span title="' . $holi_Day->name . '- Store off day" class="date holiday">' . $currentDate->format('j') . '</span>';
//                         } else {
//                             $opening_time = $checkStoreAvailability->online_pickup_open;
//                             $close_time = $checkStoreAvailability->online_pickup_close;

//                             if($opening_time == null){
//                                 $opening_time = $store_workingday->open;
//                             }
//                             if($close_time == null){
//                                 $close_time = $cuttoff;
//                             }
//                             $availableTime_on = strtotime($opening_time) + $preparetime;
//                             $availableTime_to = strtotime($close_time);

//                             if($isToday){
//                                 $currentTime = $currentTime + $preparetime;
//                             }

//                             if($isToday && $currentTime > $opening_time && $currentTime <= $availableTime_to){
//                                 $RoundavailableTime_on = $currentTime;
//                                 $availableTime_on = roundTimeToNearestInterval($RoundavailableTime_on, 900);
//                                 $result .= '<a href="#" title="' . $holi_Day->name . '" class="valid_date date holiday-allow" data-start="'.date('H:i',$availableTime_on).'" data-end="'.date('H:i',$availableTime_to).'"  data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</a>';
//                             }
//                             elseif($isToday && $currentTime > $availableTime_to){
//                                 $result .= '<span title="Time exceeded. Today is not available" class="date holiday disabled" data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</span>';
//                             }
//                             else{
//                                 $result .= '<a href="#" title="' . $holi_Day->name . '" class="valid_date date holiday-allow" data-start="'.date('H:i',$availableTime_on).'" data-end="'.date('H:i',$availableTime_to).'"  data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</a>';
//                             }
//                         }
//                     } elseif ($isDisabled || !$store_workingday) {
//                         $result .= '<span title="Store not available" class="date disabled">' . $currentDate->format('j') . '</span>';
//                     } elseif ($isAvailable && !$isToday) {
//                         $result .= '<a href="#" class="valid_date date" data-start="'.date('H:i',$availableTime_on).'" data-end="'.date('H:i',$availableTime_to).'"  data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</a>';
//                     } elseif ($isTimeExceeded) {
//                         $result .= '<span title="Time exceeded. Today is not available" class="date holiday disabled" data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</span>';
//                     }
//                 } else {
//                     $result .= '<span class="date disabled">' . $currentDate->format('j') . '</span>';
//                 }

//                 $result .= '</td>';
//                 $currentDate = $currentDate->addDay();
//             }
//             $result .= '</tr>';
//         }

//         $result .= '</tbody>
//             </table></div>';
            
//         $month = $month+1;
//     }

//     $result .= '</div>';
//     $result .= '<span class="text-center cursor-pointer fw-bold show-more-dates">More dates</span></div>';

//     return $result;
// }


// /****************** PREORDER DELIVERY CALENDER *******************************/
// function showPreOrderDeliveryCalender($start_date, $end_date,$store_id = null) {
//     $holidays = Holiday::with('holidaytiming')->where('the_date','>=',date('Y-m-d',strtotime($start_date)))->pluck('the_date')->toArray();

//     $shipping = Shipping::where('order_type', 'delivery')->first();
//     $cuttoff = $shipping->cut_off ?? strtotime('6:00 PM');
    
//     $allow_after_days = $shipping->days ?? 1;
     
//     // Convert start and end dates to Carbon instances
//     $startDate = \Carbon\Carbon::parse($start_date);
//     $endDate = \Carbon\Carbon::parse($end_date);

//     $today = \Carbon\Carbon::today();
//     $currentDate = $today->copy(); // calender start date
//     $firstMonth = $currentDate->copy();
//     $secondMonth = $currentDate->copy()->addMonth();
//     $currentDateTime = Carbon::now();
//     $currentTime = strtotime($currentDateTime->toDateTimeString());

//     $today_day = $today->format('w');
//     $isDisabled = $currentDate->lt($today);
//     $tomorrow = $today->copy()->addDay();
//     $tomorrow_day = $tomorrow->format('w');
    
//     if($today > $startDate){
//         $startDate = $today;
//     }

//     $result = '<div id="calendar-dropdown" class="position-absolute bg-light d-none text-center">
//         <div class="calendar" style="margin-bottom:0">';
//     $month = 0;
//     while ($currentDate <= $endDate) {
//         $currentMonth = $month === 0 ? $firstMonth : $secondMonth;
//         $sec_month = $month === 1 ? 'd-none' : '';

//         $result .= '<div class="month mt-2 month-'.$month.' '.$sec_month.'">';
//         $result .= '<h6 class="text-center fw-bolder mt-1 mb-1">' . $currentDate->format('F Y') . '</h6>';
//         $result .= '<table class="table table-bordered">
//             <thead>
//                 <tr>
//                     <th scope="col">Sun</th>
//                     <th scope="col">Mon</th>
//                     <th scope="col">Tue</th>
//                     <th scope="col">Wed</th>
//                     <th scope="col">Thu</th>
//                     <th scope="col">Fri</th>
//                     <th scope="col">Sat</th>
//                 </tr>
//             </thead>
//             <tbody>';

//         $firstDayOfMonth = $currentDate->copy()->startOfMonth();
//         $lastDayOfMonth = $currentDate->copy()->endOfMonth();
//         $startDayOfWeek = $firstDayOfMonth->dayOfWeek;
//         $currentDate = $firstDayOfMonth->copy()->subDays($startDayOfWeek);
        
//         while ($currentDate <= $lastDayOfMonth) {
//             $result .= '<tr>';
//             for ($i = 0; $i < 7; $i++) {
//                 $result .= '<td>';
//                 if ($currentDate->month === $currentDate->month && $currentDate->gte($firstDayOfMonth)) {
                   
//                     $date = $currentDate->format('Y-m-d');
//                     $day_number = $currentDate->format('w');
//                     $day_name = strtolower($currentDate->format('l'));
//                     $isHoliday = in_array($date, $holidays);
    
//                     $allow_after = $today->copy()->addDay($allow_after_days);
//                     $isDisabled = $currentDate->lt($allow_after);
//                     $isTomorrow = $currentDate->isSameDay($tomorrow);
//                     $isToday = $currentDate->isSameDay($today);
//                     $day_available = $shipping->$day_name == 1;
    
//                     $isAvailable = true;
//                     $isTimeExceeded = false;
                    
//                     $isAvailable = true;
//                     $isTimeExceeded = false;

//                     if($currentDate < $startDate || $currentDate > $endDate) {
//                         $isDisabled = true;
//                     }

//                     if (!$isHoliday && !$isDisabled) {
//                         if ($isToday && ($currentTime <= $availableTime_to)) {
//                             $result .= '<span class="date today valid_date" data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</span>';
//                         } else {
//                             $isTimeExceeded = true;
//                         }
//                     }

//                     if ($isHoliday) {
//                         $holi_Day = Holiday::where('the_date', $date)->first();
//                         $checkStoreAvailability = Holiday::where('the_date', $date)->where('block_delivery', 0)->first();
    
//                         if (!$checkStoreAvailability || $isDisabled) {
//                             $result .= '<span title="' . $holi_Day->name . '- Off day" class="date holiday">' . $currentDate->format('j') . '</span>';
//                         } else {
//                             $holi_cuttoff = strtotime($holi_Day->cut_off);
                            
//                             if($isToday){
//                                 $currentTime = $currentTime + $preparetime;
//                             }
                           
//                             if($isToday && $currentTime > $opening_time && $currentTime <= $holi_cuttoff){
//                                 $RoundavailableTime_on = $currentTime;
//                                 $availableTime_on = roundTimeToNearestInterval($RoundavailableTime_on, 900);
//                                 $result .= '<a href="#" title="' . $holi_Day->name . '" class="valid_date date holiday-allow"  data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</a>';
                              
//                             }
//                             elseif($isToday && $currentTime > $holi_cuttoff){
                          
//                                 $result .= '<span title="Time exceeded. Today is not available" class="date holiday disabled" data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</span>';
//                             }
//                             else{
                               
//                                 $result .= '<a href="#" title="' . $holi_Day->name . '" class="valid_date date holiday-allow"   data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</a>';
//                             }
    
//                         }
//                     } elseif ($isDisabled && $isToday) {
//                         $result .= '<span class="date today disabled" data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</span>';
//                     } elseif ($isDisabled || !$day_available) {
//                         $result .= '<span title="Off day.." class="date disabled">' . $currentDate->format('j') . '</span>';
//                     } elseif ($isAvailable && !$isToday && !$isTomorrow) {
//                         $result .= '<a href="#" class="valid_date date" data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</a>';
//                     } elseif ($isTimeExceeded) {
//                         $result .= '<span title="Time exceeded. This day  not available" class="date  disabled " data-date="' . $currentDate->format('Y-m-d') . '">' . $currentDate->format('j') . '</span>';
//                     }
                    
//                 } else {
//                     $result .= '<span class="date disabled">' . $currentDate->format('j') . '</span>';
//                 }

//                 $result .= '</td>';
//                 $currentDate = $currentDate->addDay();
//             }
//             $result .= '</tr>';
//         }

//         $result .= '</tbody>
//             </table></div>';
            
//         $month = $month+1;
//     }

//     $result .= '</div>';
//     $result .= '<span class="text-center cursor-pointer fw-bold show-more-dates">More dates</span></div>';

//     return $result;
// }


function refreshCart(){
    if (session()->has('session_string')) {
        $session_string = session('session_string');
        $basket = \App\Models\Basket::where('session',$session_string)->where('status',0)->first();
        if($basket){
            $items = \App\Models\Item::where('basket_id',$basket->id)->get();
            if($items){
                foreach($items as $listing){
                    if($listing->product_variation){
                        if($listing->has_special_price == 1){
                            $checkSpecialPrice    = $listing->product->has_special_price == 1 && $listing->product->special_price_from <= date('Y-m-d') && $listing->product->special_price_to >= date('Y-m-d');   
                            if(!$checkSpecialPrice && $listing->product->has_special_price == 1)
                            {
                                \App\Models\Item::where('id',$listing->id)->update(['has_special_price' => 0,'price_amount' => $listing->product->price,'special_price_from' => null,'special_price_to' =>null]);
                            }
                        }
                    }
                    else{
                        \App\Models\Item::where('id',$listing->id)->delete(); 
                    }
                    
                }
            }
        }
    }
}

function getGrandCalculation($basket){
    $Calculation['subTotal']       = 0;
        $Calculation['Discount']       = 0;
        $Calculation['ShippingCharge'] = 0;
        $Calculation['itemTotalTax']   = 0;
        $Calculation['shippingTax']    = 0;
        $Calculation['TotalTax']       = 0;
        $Calculation['grandTotal']     = 0;
        $Calculation['DiscountCode']   = '';
        
        $itemttlTax = array();
        $discount      = 0;
        
        $date_now       = date('Y-m-d h:i:s');
        $items = \App\Models\Item::where('basket_id',$basket->id)->get();
        $itemCount = $items->count() ?? 0;
   
            $coupon_details = \App\Models\Coupon::where('id',$basket->coupon_id)->where('start_time','<=',$date_now)->where('end_time','>=',$date_now)->first();
            if($coupon_details && $basket->coupon_id != '' && $basket->coupon_id != NULL){
                if($coupon_details->value_type == 'amount'){
                    $discount = floatval($coupon_details->value);
                    $discount_amount = 0;
                    if($itemCount > 0){
                        $discount_amount = floatval($discount/$itemCount);
                    }
                   
                    foreach ($items as $listing){
                        $itemSubTtl      = floatval($listing->price_amount * $listing->quantity);
                        $itemSub_total   = $itemSubTtl - $discount_amount;
                        $itemttlTax[]    = ($itemSub_total * $listing->tax_percentage) / 100;
                        $subTotal[]      = $itemSubTtl;
                    }
                }
                else
                {
                    $dicountPercentage = $coupon_details->value;
                    $ttlDiscount = array();
                    foreach ($items as $listing){
                        $itemSubTtl = floatval($listing->price_amount * $listing->quantity);
                        $discount_amount = ( $itemSubTtl * $dicountPercentage) / 100;
                        $itemSub_total   = $itemSubTtl - $discount_amount;
                        $itemttlTax[]    = ($itemSub_total * $listing->tax_percentage) / 100;
                        $ttlDiscount[]   =  $discount_amount;
                        $subTotal[]      = $itemSubTtl;
                    }
                    
                    $discount = array_sum($ttlDiscount);
                }
                
                
                $Calculation['DiscountCode'] =  $coupon_details->code;
            }
            else{
                foreach ($items as $listing){
                   
                        $amnt           = $listing->price_amount;
                    
                    	        
                    $itemSubTtl     = floatval($amnt * $listing->quantity);
                    $itemttlTax[]   = ($itemSubTtl * $listing->tax_percentage) / 100;
                    $subTotal[]     = $itemSubTtl;
                }
            }
            
            //shipping charge
            $shiping_method = \App\Models\Shipping::where('order_type',$basket->order_type)->first();
            $discount = min($discount, array_sum($subTotal));
            $Calculation['subTotal']        = array_sum($subTotal);
            $Calculation['itemTotalTax']    = array_sum($itemttlTax);
            $Calculation['Discount']        = $discount;
            $Calculation['ShippingCharge']  = $shiping_method->charge;
            $Calculation['shippingTax']     = ($shiping_method->charge * 13) / 100; 
            $Calculation['TotalTax']        = $Calculation['itemTotalTax'] + $Calculation['shippingTax'];
            $Calculation['grandTotal']      = ($Calculation['subTotal'] - $Calculation['Discount']) + $Calculation['ShippingCharge'] + $Calculation['TotalTax'] ;

            return $Calculation;
}