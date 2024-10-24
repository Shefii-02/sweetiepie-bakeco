<?php
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\BakingInstruction;
use App\Models\BlogCategory;
use App\Models\BlogCategoryList;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\City;
use App\Models\Country;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Media;
use App\Models\Holiday;
use App\Models\LandingPage;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use App\Models\Province;
use App\Models\Shipping;
use App\Models\Store;
use App\Models\StoreTiming;
use App\Models\User;
use App\Models\CountryShipping;
use App\Models\LocationShipping;
use App\Models\ProductShipping;
use App\Models\SocialmediaSite;
use App\Models\HomepageProductList;
use App\Models\HomepageProduct;
use App\Models\MenuCategory;
use App\Models\MenucategoryProducts;
use App\Models\VariationKey;
use App\Models\Option;
use App\Models\Tax;
use App\Models\TaxValue;
use App\Models\Coupon;
use App\Models\AddonProduct;
use App\Models\CareerJob;
use App\Models\ProductCity;
use App\Models\HolidayTiming;
use App\Models\ProductSpecialization;
use App\Models\NutritionExplorer;
use App\Models\StoreImage;
use App\Models\VariationImage;
use App\Models\SuggestedProduct;
use App\Models\Order;
use App\Models\Theme;
use App\Models\Nutrition;
use App\Mail\OrderInvoiceMail;
use App\Models\ShippingRule;
use App\Models\{ProductPage,ProductPageCategory,ProductPageContent};



function CurlSendPostRequest($url,$post){
    
    $apiKey = env('TNG_API_KEY'); 
    
    try{
       $ch = curl_init($url);
       $options =  array(
                       CURLOPT_RETURNTRANSFER => true,         // return web page
                       CURLOPT_HEADER         => false,        // don't return headers
                       CURLOPT_FOLLOWLOCATION => false,         // follow redirects
                      // CURLOPT_ENCODING       => "utf-8",           // handle all encodings
                       CURLOPT_AUTOREFERER    => true,         // set referer on redirect
                       CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect
                       CURLOPT_TIMEOUT        => 120,          // timeout on response
                       CURLOPT_POST            => 1,            // i am sending post data
                       CURLOPT_POSTFIELDS     => json_encode($post),    // this are my post vars
                       CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
                       CURLOPT_SSL_VERIFYPEER => false,        //
                       CURLOPT_VERBOSE        => 1,
                       CURLOPT_HTTPHEADER     => array(
                           'Authorization: ' . $apiKey,
                           "Content-Type: application/json"
                       )
                   );

       curl_setopt_array($ch,$options);
       $data = curl_exec($ch);
       $curl_errno = curl_errno($ch);
       $curl_error = curl_error($ch);
       //echo $curl_errno;
       //echo $curl_error;
       curl_close($ch);
       return $data;
       
   }
   catch(Exception $e){
       dd($e);
       die();
   }
}



function action_activity_getdata($data){
  
   $data = json_decode($data);
   try{
        foreach($data->data as $item){
              
               $url    = $item->url;
               $post   = ['data_id' => $item->data_id];
               
               $action_id = ['id' => $item->id];
               $apiDomain = env('TNG_API_DOMAIN'); 
               $action_url= $apiDomain."/api/website/action-activity-update";
               $action_url_error= $apiDomain."/api/website/action-activity-error";
             
                $result ='';
               if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                 
                   $result = CurlSendPostRequest($url,$post);
                   $result = json_decode($result); 
                 
               }
               
                     //dd($result);
            if($result != null || $item->action == 'DELETE'){
                  
               
               if($item->function == 'Banner'){
                  
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                     
                       $bnr = Banner::where('master_id',$result->data->id)->first();
                     
                       if(!$bnr){
                             $bnr = new Banner();
                              $bnr->master_id      = $result->data->id;
                       }
                           $bnr->name           = $result->data->name;
                           $bnr->type           = $result->data->type;
                           $bnr->link           = $result->data->link;
                           $bnr->window         = $result->data->window;
                           $bnr->status         = $result->data->status;
                           $bnr->description    = $result->data->description;
                           $bnr->weight         = $result->data->weight; 
                           $bnr->display_order  = $result->data->display_order; 
                           $bnr->file_type      = $result->data->file_type;
                           if($result->data->file_type == 'video'){
                                if($image_name = store_video_url("images/banners/",$result->data->picture)){
                                   DeleteImage($bnr->picture,'images/banners/');
                                   $bnr->picture        = $image_name;
                               }
                           }
                           else{
                               if($image_name = store_image_url("images/banners/",$result->data->picture)){
                                  
                                    //   DeleteImage($bnr->picture,'images/banners/');
                                       $bnr->picture        = $image_name;
                                   
                               }
                                if($image_name2         = store_image_url("images/banners/",$result->data->picture_small)){
                                  
                                    //   DeleteImage($bnr->picture_small,'images/banners/');
                                       $bnr->picture_small  = $image_name2;
                                    
                               }
                           }
                           
                           $bnr->save();
                       
                   }
                   elseif($item->action == 'DELETE'){
                       $bnr = Banner::where('master_id',$item->data_id)->first();
                       if($bnr){
                           DeleteImage($bnr->picture,'images/banners/');
                           DeleteImage($bnr->picture_small,'images/banners/');
                           $bnr->delete();
                       }
                   }
               }
                elseif($item->function == 'Menu'){
                
                
                    // dd($result->data);
                   
                   if($item->action == 'UPDATE' || $item->action == 'CREATE'){
                     
                        $parent = Menu::where('master_id',$result->data->id)->first(); 
                        if($parent){
                            deleteMenuOption($parent->id);
                        }
                        
                        
                        $data           = $result->data;
                     
                        $menu           = new Menu(); 
                        $menu->name     = $data->name;
                        $menu->slug     = Str::slug($data->name);
                        $menu->link     = $data->link;
                        $menu->parent_id= null;
                        $menu->weight   = $data->weight;
                        $menu->status   = $data->status;
                        $menu->master_id= $data->id;
                        $menu->save();
                           
                        if($data->children != null){
                            addMenuOption($data->children,$menu->id);
                        }
                        
                   }
                   if($item->action == 'DELETE'){
                       $menu = Menu::where('master_id',$item->data_id)->first();
                       if($menu){
                       Menu::where('parent_id',$menu->id)->update(['parent_id'=>NULL]);
                       $menu->delete();
                       }
                   }
               }
                elseif($item->function == 'Page'){
                  
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                        $content = Page::where('master_id',$result->data->id)->first();
                     
                       $bnr = Banner::where('master_id',$result->data->banner_id)->first();
                       if(!$content){
                          $content = new Page(); 
                          $content->master_id      = $result->data->id;  
                       }
                           
                           $content->heading   = $result->data->heading;
                           $content->type      = $result->data->type;
                           $content->banner_id = $bnr ? $bnr->id : 0;
                           $content->slug      = Str::slug($result->data->heading);
                           $content->html      = $result->data->html;
                           $content->published = $result->data->published;
                           try{
                           $content->save(); 
                           }
                           catch(Exception $e){
                             dd($e);
                           }
                       
                   }
                   if($item->action == 'DELETE'){
                        $page = Page::where('master_id',$item->data_id)->first();
                        if($page){
                            $page->delete();
                        }
                   }
               }
                elseif($item->function == 'Landing Page'){
                 
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                       $site = LandingPage::where('master_id',$result->data->id)->first();
                       if(!$site){
                           $site                       = new LandingPage;
                           $site->master_id             = $result->data->id;
                       }
                       
                       
                       $site->page_url             = $result->data->page_url;
                       $site->page_name            = $result->data->page_name;
                       $site->category_id          = $result->data->category_id;
                       $site->seo_title            = $result->data->seo_title; 
                       $site->seo_description      = $result->data->seo_description; 
                       $site->seo_keywords         = $result->data->seo_keywords; 
                       $site->banner1_title        = $result->data->banner1_title; 
                       $site->banner1_description  = $result->data->banner1_description; 
                       $site->section1_title       = $result->data->section1_title; 
                       $site->section1_description = $result->data->section1_description; 
                       $site->section1_button_text = $result->data->section1_button_text; 
                       $site->section1_button_link = $result->data->section1_button_link; 
                       $site->banner2_title         = $result->data->banner2_text; 
                       $site->banner2_description  = $result->data->banner2_description; 
                       $site->banner2_button_text  = $result->data->banner2_button_text;
                       $site->banner2_button_link  = $result->data->banner2_button_link;
                       $site->section2_title       = $result->data->section2_title; 
                       $site->section2_description = $result->data->section2_description; 
                       $site->section2_button_text = $result->data->section2_button_text; 
                       $site->section2_button_link = $result->data->section2_button_link;
                       $site->published            = $result->data->published;
                     
                       if($p1=store_image_url('/images/LandingPage/',$result->data->banner1_image)){
                        //   DeleteImage($site->banner1_image,'images/LandingPage/');
                           $site->banner1_image    = $p1;    
                       }
                       
                       if($p2=store_image_url('/images/LandingPage/',$result->data->section1_picture)){
                        //   DeleteImage($site->section1_image,'images/LandingPage/');
                           $site->section1_image = $p2;    
                       }
                       
                       if($p3=store_image_url('/images/LandingPage/',$result->data->banner2_image)){
                        //   DeleteImage($site->banner2_image,'images/LandingPage/');
                           $site->banner2_image    = $p3;    
                       }
                       
                       if($p4=store_image_url('/images/LandingPage/',$result->data->section2_picture)){
                        //   DeleteImage($site->section2_image,'images/LandingPage/');
                           $site->section2_image = $p4;    
                       }
                       
                       if($p5=store_image_url('/images/LandingPage/',$result->data->gallery1)){
                        //   DeleteImage($site->gallery1,'images/LandingPage/');
                           $site->gallery1         = $p5;    
                       }
                       
                       if($p6=store_image_url('/images/LandingPage/',$result->data->gallery2)){
                        //   DeleteImage($site->gallery2,'images/LandingPage/');
                           $site->gallery2         = $p6;    
                       }
                       
                       if($p7=store_image_url('/images/LandingPage/',$result->data->gallery3)){
                        //   DeleteImage($site->gallery3,'images/LandingPage/');
                           $site->gallery3         = $p7;    
                       }
                       
                       try{
                           $site->save();
                       }
                       catch(Exception $e){   
                         dd($e);
                       }
                       
                       
                   }
                   if($item->action == 'DELETE'){
                       $site = LandingPage::where('master_id',$item->data_id)->first();
                       if($site){
                           DeleteImage($site->banner1_image,'images/LandingPage/');
                           DeleteImage($site->section1_picture,'images/LandingPage/');
                           DeleteImage($site->banner2_image,'images/LandingPage/');
                           DeleteImage($site->section2_picture,'images/LandingPage/');
                           DeleteImage($site->gallery1,'images/LandingPage/');
                           DeleteImage($site->gallery2,'images/LandingPage/');
                           DeleteImage($site->gallery3,'images/LandingPage/');
                           $site->delete();
                       }
                   }
               }
                elseif($item->function == 'Customer'){
               
                   if($item->action == 'UPDATE' || $item->action == 'CREATE'){
                      
                       $user =User::where('master_id',$result->data->id)->first();
                     
                       if(!$user){
                           $user             = new User(); 
                           $user->master_id      = $result->data->id;
                       }
                       
                       $user->name           = $result->data->name;
                       $user->password       = $result->data->password;
                       $user->firstname      = $result->data->first_name;
                       $user->lastname       = $result->data->last_name;
                       $user->phone          = $result->data->phone;
                       $user->email          = $result->data->email;
                       $user->type           = 'customer';
                       $user->status         = 1;
                       $user->reset_token    = Str::random(60);
                       $user->master_id      = $result->data->id;
                       $user->address        = $result->data->address;    
                       $user->postalcode     = $result->data->postalcode;      
                       $user->city           = $result->data->city;   
                       $user->province       = $result->data->province;  
                       
                       try{
                       $user->save();
                       }
                       catch(Exception $e){
                         dd($e);
                       }
           
                   }
                   if($item->action == 'DELETE'){
                 
                           $user =User::where('master_id',$item->data_id)->first();
                           if($user){
                               $user->delete();
                           }
                      
                   }
                }
                
                elseif($item->function == 'Product Customer Price'){
               
                    $product = \App\Models\Product::whereMasterId($result->data->id)->first();
                    $product->customer_prices()->delete();
                    if($product){
                        foreach($result->data->customer_prices as $price){
                            $user = User::where('master_id', $price->customer->id)->first();
                            $user = $user ? : User::where('id', $price->customer->master_id)->first();
                            
                            $customerprice = new \App\Models\CustomerPrice;
                            $customerprice->product_id = $product->id;
                            $customerprice->customer_id = $user->id;
                            $customerprice->price = $price->price;
                            $customerprice->save(); 
                            
                        }
                    }
                    
                }
                
                elseif($item->function == 'Customer Product Price'){
               
                      
                    $user = User::where('master_id', $result->data->id)->first();
                    $user = $user ? : User::where('id', $result->data->master_id)->first();
                    
                    if($user){
                        \App\Models\CustomerPrice::whereCustomerId($user->id)->delete();
                        foreach($result->data->prices as $price){
                            
                            $product = \App\Models\Product::whereMasterId($price->product_id)->first();
                            if($product){
                                $customerprice = new \App\Models\CustomerPrice;
                                $customerprice->product_id = $product->id;
                                $customerprice->customer_id = $user->id;
                                $customerprice->price = $price->price;
                                $customerprice->save(); 
                            }
                            
                        }
                    }
                }
                elseif($item->function == 'Blog Category'){
                
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                         
                           $parent_category = BlogCategoryList::where('master_id',$result->data->parent_id)->pluck('id')->first() ?? NULL;
                       
                           $category               = BlogCategoryList::where('master_id',$result->data->id)->first();
                           
                         
                           if(!$category){
                                $category               = new BlogCategoryList();
                                $category->master_id    = $result->data->id;
                           }
                           $category->name         = $result->data->name;
                           $category->type         = $result->data->type;
                           $category->slug         = Str::slug($result->data->name);
                           $category->parent_id    = $result->data->parent_id == 'null' ? NULL:$parent_category;
                           $category->description  = $result->data->description;
                           $category->status       = $result->data->status;
                        
                         
                      try{
                           if($image_name          = store_image_url("images/blogs/",$result->data->picture)){
                            //   DeleteImage($category->picture,'images/blogs/');
                               $category->picture        = $image_name;
                           }
                           
                           $category->save();
                       
                       }
                       catch(Exception $e){
                           dd($e);
                       }
                   }
                   if($item->action == 'DELETE'){
                        $category = BlogCategoryList::where('master_id',$item->data_id)->first();
                       if($category){
                        BlogCategoryList::where('parent_id', $category->id)->update(['parent_id' => NULL]);
                           DeleteImage($category->picture,'images/blogs/');
                           $category->delete();
                           BlogCategoryList::where('category_id',$item->data_id)->delete();
                       }
                   }
                }
                elseif($item->function == 'Blog'){
                  
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
        
                       $blogs               = Blog::where('master_id',$result->data->id)->first();
                       if(!$blogs){
                          $blogs               = new Blog(); 
                          $blogs->master_id    = $result->data->id;
                       }
                       $blogs->name         = $result->data->name;
                       $blogs->type         = $result->data->type;
                       $blogs->slug         = Str::slug($result->data->name);
                       $blogs->published_at = $result->data->published_at;
                       $blogs->description  = $result->data->description;
                       $blogs->status       = $result->data->status;
                       try{
                           
                           if($image_name          = store_image_url("images/blogs/",$result->data->picture)){
                            //   DeleteImage($blogs->picture,'images/blogs/');
                               $blogs->picture        = $image_name;
                           }
                           
                           $blogs->save();
                           
                           BlogCategory::where('blog_id',$blogs->id)->delete();
                            if(count($result->data->category) > 0){
                               foreach($result->data->category as $cat){
                                   
                                   $category_id = BlogCategoryList::where('master_id',$cat->category_id)->pluck('id')->first() ?? NULL;
                                    $blogs_category = new BlogCategory();
                                   $blogs_category->category_id  = $category_id;
                                   $blogs_category->blog_id = $blogs->id;
                                   $blogs_category->save();
                               }
                           }
                           
                       }
                       catch(Exception $e){
                           dd($e);
                       }
                   }
                   if($item->action == 'DELETE'){
                      $blogs = Blog::where('master_id',$item->data_id)->first();
                       if($blogs){
                           DeleteImage($blogs->picture,'images/blogs/');
                           $blogs->delete();
                           BlogCategory::where('blog_id',$item->data_id)->delete();
                       }
                   }
                }
                elseif($item->function == 'Baking Instructions'){
                                  
                	if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                
                		$instructions               = BakingInstruction::where('master_id',$result->data->id)->first();
                		if(!$instructions){
                		   $instructions               = new BakingInstruction(); 
                		   $instructions->master_id    = $result->data->id;
                		}
                		$instructions->name         = $result->data->name;
                		$instructions->slug         = Str::slug($result->data->name);
                		$instructions->baking  = $result->data->baking;
                        $instructions->warming  = $result->data->warming;
                		$instructions->status       = $result->data->status;
                		try{
                			
                			if($image_name          = store_image_url("images/blogs/",$result->data->picture)){
                				// DeleteImage($instructions->picture,'images/blogs/');
                				$instructions->picture        = $image_name;
                			}
                			
                			$instructions->save();
                			
                		}
                		catch(Exception $e){
                			dd($e);
                		}
                	}
                	if($item->action == 'DELETE'){
                	   $instructions = BakingInstruction::where('master_id',$item->data_id)->first();
                		if($instructions){
                			DeleteImage($instructions->picture,'images/blogs/');
                			$instructions->delete();
                		}
                	}
                 }
                elseif($item->function == 'Gallery'){
                  
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                       $gallery = Gallery::where('master_id',$result->data->id)->first();
              
                       if(!$gallery){
                       $gallery               = new Gallery();
                       }
                       else{
                           DeleteImage($gallery->picture,'/images/gallery/');
                       }
                       $gallery->title        = $result->data->title;
                       $gallery->position     = $result->data->position ?? 0;
                       $gallery->share_link   = $result->data->share_link ?? 0;
                       $gallery->picture      = store_image_url("images/gallery/",$result->data->picture);
                       $gallery->status       = $result->data->status; 
                       $gallery->master_id    = $result->data->id;
                       try{
                           $gallery->save();
                       }
                       catch(Exception $e){
                           dd($e);
                       }
                       
                   }
                   if($item->action == 'DELETE'){
                       $gallery = Gallery::where('master_id',$item->data_id)->first();
                       if($gallery){
                           DeleteImage($gallery->picture,'/images/gallery/');
                           $gallery->delete();
                       }
                   }
                }
                elseif($item->function == 'Media'){
                  
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                       $media = Media::where('master_id',$result->data->id)->first();
              
                       if(!$media){
                       $media               = new Media();
                       }
                       else{
                           DeleteImage($media->image,'/images/media/');
                       }
                       $media->title        = $result->data->title;
                       $media->position     = $result->data->position ?? 0;
                       $media->image      = store_image_url("images/media/",$result->data->picture);
                       $media->status       = $result->data->status; 
                       $media->link       = $result->data->link; 
                       $media->master_id    = $result->data->id;
                       try{
                           $media->save();
                       }
                       catch(Exception $e){
                           dd($e);
                       }
                       
                   }
                   if($item->action == 'DELETE'){
                       $media = Media::where('master_id',$item->data_id)->first();
                       if($media){
                           DeleteImage($media->picture,'/images/media/');
                           $media->delete();
                       }
                   }
                }
                elseif($item->function == 'Holiday'){
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                       $holi = Holiday::where('master_id',$result->data->id)->first(); 
                       if(!$holi){
                           $holi             =  new Holiday();
                           $holi->master_id   = $result->data->id;
                       }
                
                       $holi->name       = $result->data->name;
                       $holi->slug       = Str::slug($result->data->name);
                       $holi->the_date   = $result->data->the_date;
                       $holi->cut_off    = $result->data->cut_off;
                       $holi->description= $result->data->description;
                       $holi->block_delivery= $result->data->block_delivery;
                       $holi->status     = $result->data->status;
                       try{
                           $holi->save();
                       }
                       catch(Exception $e){
                           dd($e->getMessage());
                       }
                   }
                   if($item->action == 'DELETE'){
                       $holi = Holiday::where('master_id',$item->data_id)->first();
                       if($holi){
                           $holi->delete();
                       }
                       
                   }
                   
                }
                elseif($item->function == 'Shipping'){
                   
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                       
                       $newone = Shipping::where('master_id',$result->data->id)->first();
                       if(!$newone){
                       $newone             = new Shipping();
                       $newone->master_id  = $result->data->id;
                       }
                       else
                       {
                          DeleteImage($newone->picture,'/images/shipping/'); 
                       }
                       
                       $newone->name       = $result->data->name;
                       $newone->slug       = Str::slug($result->data->name);
                       $newone->description= $result->data->description;
                       $newone->charge     = $result->data->charge;
                       $newone->days       = $result->data->days;
                       $newone->max_days   = $result->data->max_days;
                       $newone->cut_off    = $result->data->cutoff;
                       $newone->order_type = $result->data->order_type;
                       $newone->preperation_time= $result->data->preperation_time;
                       $newone->info_line  = $result->data->info_line;
                       $newone->policy_id  = $result->data->policy_id;
                       $newone->sunday     = $result->data->sunday;
                       $newone->monday     = $result->data->monday;
                       $newone->tuesday    = $result->data->tuesday;
                       $newone->wednesday  = $result->data->wednesday;
                       $newone->thursday   = $result->data->thursday;
                       $newone->friday     = $result->data->friday;
                       $newone->saturday   = $result->data->saturday;
                       $newone->require_date = $result->data->require_date;
                       $newone->status     = $result->data->status;
                       $newone->priority   = $result->data->priority;
                       $newone->picture    = store_image_url("images/shipping/",$result->data->picture);
                       try {
                           $newone->save();
                           LocationShipping::where('shipping_id',$newone->id)->delete();
                           if(count($result->data->province_name)>0){
                               foreach($result->data->province_name as $key => $provice){
                                   $pro_ship = new LocationShipping();
                                   $pro_ship->province     = $provice->province;
                                   $pro_ship->country      = $provice->country;
                                   $pro_ship->shipping_id  = $newone->id;
                                   $pro_ship->charge       = $provice->charge;
                                   $pro_ship->save();
                               }
                              
                           }
                           CountryShipping::where('shipping_id',$newone->id)->delete();
                           if(count($result->data->country_name)>0){
                               foreach($result->data->country_name as $key2 => $country){
                                   $co_ship            = new CountryShipping();
                                   $co_ship->country   = $country->country;
                                   $co_ship->shipping_id= $newone->id;
                                   $co_ship->charge    = $country->charge;
                                   $co_ship->save();
                               }
                           }
                           
                           ShippingRule::where('shipping_id',$newone->id)->delete();
                           							
                            if(count($result->data->rules)>0){
                               foreach($result->data->rules as $key2 => $rule){
                                   $rule_ship                   = new ShippingRule();
                                   $rule_ship->shipping_id      = $newone->id;
                                   $rule_ship->day              = $rule->day;
                                   $rule_ship->cutoff           = $rule->cutoff;
                                   $rule_ship->after_day        = $rule->after_day;
                                   $rule_ship->after_time       = $rule->after_time;
                                   $rule_ship->before_day       = $rule->before_day;
                                   $rule_ship->before_time      = $rule->before_time;
                                   $rule_ship->status           = $rule->status;
                                   $rule_ship->save();
                               }
                           }
                           
                       }
                       catch(Exception $e){
                           dd($e->getMessage());
                       }
                   }
                   if($item->action == 'DELETE'){
                       $newone = Shipping::where('master_id',$item->data_id)->first();
                       if($newone){
                       DeleteImage($newone->picture,'/images/shipping/'); 
                       
                       LocationShipping::where('shipping_id',$newone->id)->delete();
                       CountryShipping::where('shipping_id',$newone->id)->delete();
                       Shipping::where('master_id',$item->data_id)->delete();
                       }
                   }
                }
                elseif($item->function == 'FAQ'){
       
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){        
                
                       $faq                = Faq::where('master_id',$result->data->id)->first();
                       if(!$faq){
                           $faq                = new Faq;
                           $faq->master_id     = $result->data->id;
                       }
                       $faq->type          = $result->data->type;
                       $faq->question      = $result->data->question;
                       $faq->answer        = $result->data->answer;
                       $faq->status        = $result->data->status;
                       $faq->display_order = $result->data->display_order; 
       
                       try{
                           $faq->save();
                       }
                       catch(Exception $e){
                           dd($e);
                       }
                   }
                   if($item->action == 'DELETE'){
                       
                       $faq = Faq::where('master_id',$item->data_id)->first();
                       if($faq){
                           $faq->delete();
                       }
                   }
                }
                elseif($item->function == 'Country'){
                  
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                       $Co                = Country::where('master_id',$result->data->id)->first();
                       if(!$Co){
                           $Co             = new Country;
                           $Co->master_id  = $result->data->id;
                       }
                       $Co->name           = $result->data->name;
                       $Co->code           = $result->data->code;
                       $Co->base           = $result->data->base;
                       $Co->status         = $result->data->status;
                       $Co->page_id        = $result->data->page_id;
       
                       try{
                           $Co->save();
                       }
                       catch(Exception $e){
                           dd($e);
                       }
                   }
                   if($item->action == 'DELETE'){
                      $cnty = Country::where('master_id',$item->data_id)->first();
                      if($cnty){
                          $cnty->delete();
                      }
                   }
                }
                elseif($item->function == 'Province'){
                  
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                       $province                = Province::where('master_id',$result->data->id)->first();
                       if(!$province){
                           $province             = new Province;
                           $province->master_id  = $result->data->id;
                       }
                       $province->name         = $result->data->name;
                       $province->code         = $result->data->code;
                       $province->country      = $result->data->country;
                       $province->base         = $result->data->base;
                       $province->status       = $result->data->status;
                       $province->all_products = $result->data->all_products;
       
                       try{
                           $province->save();
                       }
                       catch(Exception $e){
                           dd($e);
                       }
                   }
                   if($item->action == 'DELETE'){
                      $province = Province::where('master_id',$item->data_id)->first();
                      if($province){
                          $province->delete();
                      }
                   }
                }
                elseif($item->function == 'City'){
                
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                      $city                = City::where('master_id',$result->data->id)->first();
                       if(!$city){
                           $city           = new City;
                           $city->master_id= $result->data->id;
                       }
                       $city->name         = $result->data->name;
                       $city->master_id    = $result->data->id;
                       $city->code         = $result->data->code;
                       $city->province     = $result->data->province;
                       $city->status       = $result->data->status;
       
                       try{
                           $city->save();
                           
                             ProductCity::where('city_id',$city->id)->delete();
                           if(count($result->data->products) > 0){
                              foreach($result->data->products as $items){
                                    $product = Product::where('master_id',$items->product_id)->first();
                                   
                                    if($product){
                                        $pdct_city              = new ProductCity();
                                        $pdct_city->product_id	= $product->id; 
                                        $pdct_city->city_id     = $result->data->id;
                                        $pdct_city->save();
                                    }
                              }
                          }
                          
                       }
                       catch(Exception $e){
                           dd($e);
                       }
                   }
                   if($item->action == 'DELETE'){
                      $city = City::where('master_id',$item->data_id)->first();
                      if($city){
                          $city->delete();
                          
                          ProductCity::where('city_id',$item->data_id)->delete();
                      }
                   }
                }
                elseif($item->function == 'Category'){
                
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                   
                       $parent_category        = Category::where('master_id',$result->data->parent_id)->pluck('id')->first() ?? NULL;
                      
                       $category               = Category::where('master_id',$result->data->id)->first();
                       if(!$category){
                           $category           = new Category();
                           $category->master_id= $result->data->id;
                       }    
                     
                       $category->name         = $result->data->name;
                       $category->slug         = Str::slug($result->data->name);
                       $category->parent_id    = $result->data->parent_id;
                       $category->description  = $result->data->description;
                       $category->status       = $result->data->status;
                       try{
                           if($image_name          = store_image_url("images/categories/",$result->data->picture)){
                            //   DeleteImage($category->picture,'images/categories/');
                               $category->picture        = $image_name;
                           }
                           
                           $category->save();
                           
                           
                           CategoryProduct::where('category_id',$category->id)->delete();
                           
                            foreach($result->data->category_products ?? [] as $itmsCate)
                              {
                                  $product = Product::where('master_id',$itmsCate->product_id)->pluck('id')->first();
                                  if($product){
                                      $category_product                   = new CategoryProduct();
                                      $category_product->category_id      = $category->id;  
                                      $category_product->product_id       = $product; 
                                      $category_product->display_order    = $itmsCate->display_order ?? 0;
                                      $category_product->save();
                                  }
                                     
                              }
                       }
                       catch(Exception $e){
                           dd($e);
                       }
                   }
                   if($item->action == 'DELETE'){
                       $category = Category::where('master_id',$item->data_id)->first();
                       if($category){
                           Category::where('parent_id', $category->id)->update(['parent_id' => NULL]);
                           DeleteImage($category->picture,'images/categories/');
                           $category->delete();
                       }
                   }
                }
                elseif($item->function == 'Product'){
                   
                   if($item->action == 'UPDATE' || $item->action == 'CREATE'){
                       $product                    = Product::where('master_id',$result->data->id)->first();
                       if(!$product){
                           $product                    = new Product();
                           $product->master_id         = $result->data->id;
                       }
                       $product->name               = $result->data->name;
                       $product->slug               = Str::slug($result->data->name);
                       $product->description        = $result->data->description ?? "";
                       $product->contents           = $result->data->contents ?? "";
                       $product->availability       = $result->data->availability;
                       $product->display_order      = $result->data->display_order;
                       $product->status             = $result->data->status; 
                       $product->mark_stock_status  = $result->data->mark_stock_status;
                       $product->seo_title          = $result->data->seo_title;
                       $product->seo_alt            = $result->data->seo_alt_text;
                       $product->seo_description    = $result->data->seo_description;
                       $product->seo_keyword        = $result->data->seo_keywords;   
                       $product->product_type       = $result->data->product_type;
                       $product->tax_id             = $result->data->tax_id;
                       $product->has_variation      = $result->data->has_variation;
                       $product->addon              = $result->data->addon;
                       $product->gift_card          = $result->data->gift_card;
                       $product->greeting_card      = $result->data->greeting_card;
                       $product->regular            = $result->data->regular;
                       $product->in_store           = $result->data->in_store;
                       $product->online             = $result->data->online;
                       $product->cooktime           = $result->data->cooktime;
                       $product->energy             = $result->data->energy;
                       $product->serving            = $result->data->serving;
                        $product->baking_info        = $result->data->baking_info;
                        $product->seasonal_availability    = $result->data->seasonal_availability;
                        $product->seasonal_date_start      = $result->data->seasonal_date_start;
                        $product->seasonal_date_end        = $result->data->seasonal_date_end;
                        $product->seasonal_show_start      = $result->data->seasonal_show_start;
                        $product->seasonal_show_end        = $result->data->seasonal_show_end;
                        $product->has_customization        = $result->data->has_customization;
                        $product->customization_color_one = $result->data->customization_color_one;
                        $product->customization_color_two = $result->data->customization_color_two;
                        
                        $product->has_special_price = $result->data->has_special_price;
                        $product->special_price_from= $result->data->special_price_from;
                        $product->special_price_to  = $result->data->special_price_to;
                        $product->discount_value    = $result->data->discount_value;
                        $product->discount_type     = $result->data->discount_type;
            
                       
                       try{
                           $product->save();
                         
                            $pdct_image = ProductImage::where('product_id',$product->id)->get();
                            if($pdct_image){
                                foreach($pdct_image as $val){
                                    DeleteImage($val->picture,'images/products/');
                                    ProductImage::where('id',$val->id)->delete();
                                }
                            }
                            Option::where('product_id',$product->id)->delete();
                            ProductVariation::where('product_id',$product->id)->delete();
                            CategoryProduct::where('product_id',$product->id)->delete();
                            ProductShipping::where('product_id',$product->id)->delete();
                            ProductCity::where('product_id',$product->id)->delete();
                            ProductSpecialization::where('product_id',$product->id)->delete();
                            AddonProduct::where('product_id',$product->id)->delete();
                            NutritionExplorer::where('product_id',$product->id)->delete(); 
                            VariationImage::where('product_id',$product->id)->delete();
                            SuggestedProduct::where('product_id',$product->id)->delete();
                            VariationKey::where('product_id',$product->id)->delete();
                            \App\Models\ProductCase::where('product_id',$product->id)->delete();
                            
                            // $pdct_vari = ProductVariation::where('product_id',$product->id)->get();
                            // foreach($pdct_vari as $vari){
                            //     // @unlink('images/products/'.$vari->images);
                            // }
                
                            if(count($result->data->option) > 0){
                                foreach($result->data->option as $key=>$value)
                                {   
                                    $option             =   new Option;
                                    $option->product_id =   $product->id;
                                    $option->master_id  =   $value->product_id;
                                    $option->name       =   $value->name; 
                                    $option->value      =   $value->value; 
                                    $option->save();
                                        
                                }
                           }
                           
                           if(count($result->data->cases) > 0){
                                foreach($result->data->cases as $case)
                                {   
                                    $option             =   new \App\Models\ProductCase;
                                    $option->master_id = $case->id;
                                    $option->product_id =   $product->id;
                                    $option->quantity  =   $case->quantity;
                                    $option->name       =   $case->name; 
                                    $option->price      =   $case->price;
                                    $option->save();
                                        
                                }
                           }
                           
                           
                          
                           if(count($result->data->product_variation) > 0){
                               
                                
                               foreach($result->data->product_variation as $itms)
                               {
                                    $product_variation                  = new ProductVariation();
                                    $product_variation->master_id        = $itms->id;
                                    $product_variation->product_id	    = $product->id;
                                    $product_variation->sku	            = $itms->sku;
                                    $product_variation->variation_name	= $itms->variation_name;
                                    $product_variation->box_quantity	= $itms->box_quantity;
                                    $product_variation->variation	    = $itms->variation;
                                    $product_variation->weight	        = $itms->weight.($itms->weight_type ? : 'gm');
                                    $product_variation->price	        = $itms->price;
                                    $product_variation->stock_status    = $itms->stock_status;
                                    $product_variation->in_stock        = $itms->in_stock;
                                    $product_variation->serving         = $itms->serving;
                                    $product_variation->cook_time       = $itms->cooktime;
                                    $product_variation->energy          = $itms->energy;
                                    $product_variation->description     = $itms->description;
                                    $product_variation->ingredients     = $itms->ingredients;
                                    $product_variation->in_store        = $result->data->in_store;
                                    $product_variation->online          = $result->data->online;
                                    $product_variation->special_price   = $itms->special_price;
                                    
                                    $product_variation->save();
                                    if(count($itms->variationkey)>0){
                                        foreach($itms->variationkey as $vari_key){
                                            $new_key                = new VariationKey();
                                            $new_key->variation_id  = $product_variation->id;
                                            $new_key->product_id    = $product->id;
                                            $new_key->value         = $vari_key->value;
                                            $new_key->type          = $vari_key->type;
                                	        $new_key->save();
                                        }
                                    }
                               }
                           }    
                           
                          if(count($result->data->category_products) > 0){
                              foreach($result->data->category_products as $itms)
                              {
                                  $category_id = Category::where('master_id',$itms->category_id)->pluck('id')->first();
                                  if($category_id){
                                      $category_product                   = new CategoryProduct();
                                      $category_product->category_id      = $category_id;  
                                      $category_product->product_id       = $product->id; 
                                      $category_product->save();
                                  }
                              }
                          }
                         
                          if(count($result->data->shipping_method) > 0){
                              
                              foreach($result->data->shipping_method as $items){
                                $shipping_id = Shipping::where('master_id',$items->shipping_id)->pluck('id')->first();
                                  if($shipping_id){
                                      $pdct_shipping                  = new ProductShipping();
                                      $pdct_shipping->product_id	   = $product->id; 
                                      $pdct_shipping->shipping_id     = $shipping_id;
                                      $pdct_shipping->save();
                                  }
                              }
                          }
                          
                            if(count($result->data->menu_category)>0){
                                MenucategoryProducts::where('product_id',$product->master_id)->delete();
                                foreach($result->data->menu_category as $items){
                                    $menu = MenuCategory::where('master_id',$items->category_id)->first();
                                    $menu_items = new MenucategoryProducts();
                                    $menu_items->product_id=$product->master_id;			
                                    $menu_items->category_id=isset($menu) ? $menu->id : 0;
                                    $menu_items->save();
                                }
                            }
                        
                        if(count($result->data->product_city) > 0){
                            
                              foreach($result->data->product_city as $items){
                                    $pdct_city              = new ProductCity();
                                    $pdct_city->product_id	= $product->id; 
                                    $pdct_city->city_id     = $items->city_id;
                                    $pdct_city->save();
                              }
                          }
                          
                          if(count($result->data->specializations) > 0){
                              foreach($result->data->specializations as $items){
                                    $pdct_speci                         = new ProductSpecialization();
                                    $pdct_speci->product_id	            = $product->id; 
                                    $pdct_speci->specialization_id      = $items->specialization_id;
                                    $pdct_speci->save();
                              }
                          }
                        
                           
                           
                            if(count($result->data->addon_products) > 0){
                                foreach($result->data->addon_products as $items){
                                   $pdct_addn                   = new AddonProduct();
                                   $pdct_addn->product_id	    = $product->id; 
                                   $pdct_addn->veriation_id     = $items->addon_id;
                                   $pdct_addn->save();
                                }
                           }
                           
                            if(count($result->data->nutrition_info) > 0){
                                foreach($result->data->nutrition_info as $NutriListing){
                                    
                                        $variation_p                    = ProductVariation::where('master_id',$NutriListing->variation_id)->first();
                                        if($variation_p){
                                            $nutrition                      = new NutritionExplorer();
                                            $nutrition->master_product_id   = $NutriListing->product_id;
                                            $nutrition->master_variation_id = $NutriListing->variation_id;
                                            $nutrition->nutrition_title	    = $NutriListing->nutrition_title;
                                            $nutrition->nutrition_value	    = $NutriListing->nutrition_value;
                                            $nutrition->variation_id	    = $variation_p->id;
                                            $nutrition->product_id          = $product->id;
                                            $nutrition->nutrition_id	    = $NutriListing->nutrition_id;
                                            $nutrition->save();
                                        }
                                }
                            }
                           
                            if(count($result->data->suggested_products) > 0){
                                foreach($result->data->suggested_products as $SuggListing){
                                        $product_sugg       = Product::where('master_id',$SuggListing->suggested_id)->first();
                                        if($product_sugg){
                                            $p_sug              = new SuggestedProduct();
                                            $p_sug->product_id  = $product->id;
                                            $p_sug->suggested_id=  $product_sugg->id;
                                            $p_sug->save();
                                        }
                                }
                            }
                            
                            if(count($result->data->product_images) > 0){
                              foreach($result->data->product_images as $more_img){
                                 
                                  if($more_picture = store_image_url("images/products/",$more_img->picture)) {
                                        $product_img = new ProductImage;
                                        $product_img->picture      = $more_picture;
                                        $product_img->product_id   = $product->id;
                                        $product_img->type         = $more_img->type;
                                        $product_img->save();
                                        if(count($more_img->variation_id) > 0){
                                            foreach($more_img->variation_id as $variantId){
                                                $variant                = ProductVariation::where('master_id',$variantId)->first();
                                                if($variant){
                                                    $vari_img               = new VariationImage;
                                                    $vari_img->variation_id = $variant->id;
                                                    $vari_img->picture_id   = $product_img->id;
                                                    $vari_img->product_id   = $product->id;
                                                    $vari_img->save();
                                                }
                                            }
                                        }
                                  }
                              }
                            }
                           
                               
                       }
                       catch(\Exception $e) {
                           
                           die($e->getMessage());
               
                           exit;
                       }
                   }
                   if($item->action == 'DELETE'){
                      try{
                           $pdct = Product::where('master_id',$item->data_id)->first();
                           if($pdct){
                               DeleteImage($pdct->picture,'images/products/');
                               DeleteImage($pdct->picture_small,'images/products/');
                               DeleteImage($pdct->nutrion_picture,'images/products/');
                               DeleteImage($pdct->ingredients_picture,'images/products/');
                               
                              $pdct_image = ProductImage::where('product_id',$pdct->id)->get();
                              if($pdct_image){
                                  foreach($pdct_image as $val){
                                      DeleteImage($val->picture,'images/products/');
                                       
                                      ProductImage::where('id',$val->id)->delete();
                                  }
                                } 
                                
                                // $pdct_vari = ProductVariation::where('product_id',$pdct->id)->get();
                                
                                // foreach($pdct_vari as $vari){
                                //     // @unlink('images/products/'.$vari->images); 
                                //     // ::where('variation_id',$vari->id)->delete();
                                // }
                                
                                Option::where('product_id',$pdct->id)->delete();
                                
                                VariationKey::where('product_id',$pdct->id)->delete();
                               
                                ProductVariation::where('product_id',$pdct->id)->delete(); 
                                HomepageProductList::where('product_id',$item->data_id)->delete();
                                AddonProduct::where('veriation_id',$item->data_id)->delete();
                                MenucategoryProducts::where('product_id',$item->data_id)->delete();   
                                CategoryProduct::where('product_id',$pdct->id)->delete();
                                ProductShipping::where('product_id',$pdct->id)->delete(); 
                                AddonProduct::where('product_id',$pdct->id)->delete();
                                ProductCity::where('product_id',$pdct->id)->delete();
                                ProductSpecialization::where('product_id',$pdct->id)->delete();
                                Product::where('id',$pdct->id)->delete();
                                NutritionExplorer::where('product_id',$pdct->id)->delete(); 
                                SuggestedProduct::where('product_id',$pdct->id)->delete();
                                VariationImage::where('product_id',$pdct->id)->delete();
                           }
                           
                           
                           
                          
                       }
                       catch(Exception $e) {
                           dd($e);
                       }
                   }
                }
                elseif($item->function == 'Store'){
         
                    if($item->action == 'UPDATE' || $item->action == 'CREATE'){
                        $store              = Store::where('master_id',$result->data->id)->first();
                        if(!$store){
                           $store              = new Store();
                           $store->master_id     = $result->data->id;
                        }
                        $store->name        = $result->data->name;
                        $store->slug        = Str::slug($result->data->name);
                        $store->store_code  = $result->data->store_code;
                        $store->address     = $result->data->address;
                        $store->city        = $result->data->city;
                        $store->postal_code = $result->data->postalcode;
                        $store->province    = $result->data->province;
                        $store->phone       = $result->data->phone;
                        $store->email       = $result->data->email;
                        $store->secondary_email = $result->data->secondary_email;
                        $store->map_link    = $result->data->map_code;
                        $store->shipping    = $result->data->shipping;
                        $store->lat         = $result->data->lat;
                        $store->lng         = $result->data->lng;
                        $store->description = $result->data->description;
                        $store->display_order= $result->data->display_order;
                        $store->manager_name = $result->data->manager_name;
                        $store->status      = $result->data->status;
                        
                        if($manager_picture = store_image_url("images/store/",$result->data->manager_picture)){
                           $store->manager_picture = $manager_picture;
                        }
                        if($picture = store_image_url("images/store/",$result->data->picture)){
                           $store->picture = $picture;
                        }
                        if($picture2 = store_image_url("images/store/",$result->data->picture_icon)){
                           $store->picture_icon = $picture2;
                        }
                       
                       try {
                             
                           $store->save();
                           if($store->shipping == 1){
                                Store::where('id','<>',$store->id)->update(['shipping' => '0','shipping' => 0]);
                            }
            
                           StoreTiming::where('store_id',$store->id)->delete();
                           foreach($result->data->timing as $day => $time) {
                               $storet           = new StoreTiming();
                               $storet->store_id = $store->id;
                               $storet->day      = $time->day;
                               $storet->open     = $time->open;
                               $storet->close    = $time->close;
                               $storet->save();
                           }
                           
                            StoreImage::where('store_id',$store->id)->delete();
                            if(count($result->data->store_images) > 0){
                               	
                               foreach($result->data->store_images as $more_img){
                                   if($more_picture = store_image_url("images/store/",$more_img->image)) {
                                       $store_img = new StoreImage;
                                       $store_img->image = $more_picture;
                                       $store_img->store_id = $store->id;
                                       $store_img->save();
                                   }
                               }
                            }
                           
                       }
                       catch(Exception $e) {
                           
                       }    
                   }
                   if($item->action == 'DELETE'){
                        try {
                            $store = Store::where('master_id',$item->data_id)->first();
                            if($store){
                                if($store->shipping == 1){
                                    $base_store = Store::where('id','<>',$store->id)->first();
                                    $base_store->shipping;
                                    $base_store->save();
                                }
                                StoreTiming::where('store_id',$store->id)->delete();
                                $store->delete();
                            }
                            
                        }
                       catch(Exception $e) {
                           
                       } 
                   }
                }
                elseif($item->function == 'Social Media'){
              
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                       $newone                = SocialmediaSite::where('master_id',$result->data->id)->first();
                       if(!$newone){
                           $newone             = new SocialmediaSite;
                           $newone->master_id  = $result->data->id;
                       }
                       
                       $newone->title           = $result->data->title;
                       $newone->icon           = $result->data->icon;
                       $newone->link           = $result->data->link;
                       $newone->position         = $result->data->position;
                       $newone->status        = $result->data->status;
       
                       try{
                           $newone->save();
                       }
                       catch(Exception $e){
                           dd($e);
                       }
                   }
                   if($item->action == 'DELETE'){
                      $cnty = SocialmediaSite::where('master_id',$item->data_id)->first();
                      if($cnty){
                          $cnty->delete();
                      }
                   }
                }
                elseif($item->function == 'Home Page Products'){
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                        $data = HomepageProduct::first();
                        if($data){
                            HomepageProductList::where('homepage_id',$data->id)->delete();
                            $data->delete();
                        }
                        $homepage = new HomepageProduct();
                        $homepage->master_id  = $result->data->id;
                        $homepage->title      = $result->data->title;
                        $homepage->short_desc = $result->data->short_desc;
                        try{
                            $homepage->save();
                            if(count($result->data->product_list)>0){
                                foreach($result->data->product_list as $items){
                                    $p_h = new HomepageProductList();
                                    $p_h->homepage_id = $homepage->id;
                                    $p_h->product_id  = $items->product_id;
                                    $p_h->save();
                                }
                            }
                        }
                        catch(Exception $e){
                              dd($e);
                        }
        
                   }
                   if($item->action == 'DELETE'){
                        $data = HomepageProduct::where('master_id',$item->data_id)->first();
                        if($data){
                            HomepageProductList::where('homepage_id',$data->id)->delete();
                            $data->delete();
                        }
                   }
                }
                elseif($item->function == 'Menu Page'){
                    //  dd($result->data);
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                
                        $menu = MenuCategory::with('product_list')->where('master_id',$item->data_id)->first();
                        if($menu){
                             DeleteImage($menu->picture,'images/categories/');
                             DeleteImage($menu->picture_small,'images/categories/');
                            MenucategoryProducts::where('category_id',$menu->id)->delete();
                            $menu->delete();
                        }
                        else{
                            $menu = new MenuCategory();
                        }
                        
                          
                        $menu->name = $result->data->name;
                        $menu->type = $result->data->type;
                        $menu->slug = Str::slug($result->data->name);
                        $menu->status = $result->data->status;
                        $menu->master_id  = $result->data->id;
                        $menu->display_order = $result->data->display_order;     
                        try{
                            $menu->save();
                            
                            if($picture = store_image_url("images/categories/",$result->data->picture)){
                               $menu->picture = $picture;
                               $menu->save();
                            }
                            if($picture1 = store_image_url("images/categories/",$result->data->picture_small)){
                               $menu->picture_small = $picture1;
                               $menu->save();
                            }
                            if(count($result->data->product_list)>0){
                                foreach($result->data->product_list as $items){
                                    $menu_items = new MenucategoryProducts();
                                    $menu_items->product_id=$items->product_id;			
                                    $menu_items->category_id=$menu->id;
                                    $menu_items->save();
                                }
                            }
                        }
                        catch(Exception $e){
                               dd($e);
                        }
                   }
                   if($item->action == 'DELETE'){
                       $menu = MenuCategory::with('product_list')->where('master_id',$item->data_id)->first();
                        if($menu){
                            DeleteImage($menu->picture,'images/categories/');
                            MenucategoryProducts::where('category_id',$menu->id)->delete();
                            $menu->delete();
                        }
                   }
               }
                elseif($item->function == 'Coupon'){
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                        $coupons = Coupon::where('master_id',$result->data->id)->first();
                        if(!$coupons){
                            $coupons = new Coupon();
                        }
                        $coupons->master_id     = $result->data->id;
                        $coupons->code          = $result->data->code;
                        $coupons->value         = $result->data->value;
                        $coupons->value_type    = $result->data->value_type;
                        $coupons->max_count     = $result->data->max_count;
                        $coupons->cur_count     = $result->data->cur_count;
                        $coupons->min_sales     = $result->data->min_sales;
                        $coupons->store_id      = $result->data->store_id;
                        $coupons->start_time    = $result->data->start_time;
                        $coupons->end_time      = $result->data->end_time;
                        $coupons->availability  = $result->data->availability;
                        $coupons->store_availability  = $result->data->store_availability;
                        $coupons->status        = $result->data->status;
                        try{
                            $coupons->save();
                        }
                        catch(Exception $e){
                              dd($e);
                        }
                   }
                   if($item->action == 'DELETE'){
                        $data = Coupon::where('master_id',$item->data_id)->first();
                        if($data){
                            $data->delete();
                        }
                   }
                }
                elseif($item->function == 'Career'){
                   if($item->action == 'CREATE' || $item->action == 'UPDATE'){
 
                        $new_one = CareerJob::where('master_id',$result->data->id)->first();
                        if(!$new_one){
                            $new_one = new CareerJob();
                        }
                        $new_one->master_id     = $result->data->id;
                        $new_one->store_id      = $result->data->store_id;
                        $new_one->job_possition = $result->data->job_position;
                        $new_one->status        = $result->data->status;
                        try{
                            $new_one->save();
                        }
                        catch(Exception $e){
                              dd($e);
                        }
                   }
                   if($item->action == 'DELETE'){
                        $data = CareerJob::where('master_id',$item->data_id)->first();
                        if($data){
                            $data->delete();
                        }
                   }
                }
                elseif($item->function == 'Tax'){
                    
                    if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                        $new_one                 = Tax::where('master_id',$result->data->id)->first();
                        if(!$new_one){
                            $new_one = new Tax();
                        }
                        $new_one->tax_name          = $result->data->tax_name;
                        $new_one->description       = $result->data->description;
                        $new_one->type              = $result->data->type;
                        $new_one->status            = $result->data->status;
                        $new_one->master_id         = $result->data->id;
                        $new_one->save();
                         TaxValue::where('tax_id',$new_one->id)->delete();
                        if(count($result->data->tax_values)>0){
                            foreach($result->data->tax_values as $key => $listing){
                                $new                = new TaxValue;
                                $new->tax_percentage= $listing->tax_percentage;
                                $new->tax_id        = $new_one->id;
                                $new->province_id   = $listing->province_id;
                                $new->save();
                            }
                        }
                
                    }
                    if($item->action == 'DELETE'){
                        $data = Tax::where('master_id',$item->data_id)->first();
                      
                        if($data){  
                            TaxValue::where('tax_id',$data->id)->delete();
                            $data->delete();
                        }
                    }
                    
                    
                }
                elseif($item->function == 'Holiday Timing'){
                    if($item->action == 'UPDATE'){
                  
                        $holi = Holiday::where('master_id',$item->data_id)->first(); 
                        
                        HolidayTiming::where('holiday_id',$holi->id)->delete();
                        foreach($result->data as $listing){
                            $store              = Store::where('master_id',$listing->store_id)->first();
                            $new                    = new HolidayTiming();				
                            $new->holiday_id        = $holi->id;
                            $new->store_id          = $store->id;
                            $new->open              = $listing->open;
                            $new->close             = $listing->close;
                            $new->online_pickup_open= $listing->online_pickup_open;
                            $new->online_pickup_close= $listing->online_pickup_close;
                            $new->status            = $listing->status;
                            $new->save();
                        }
                    }
                }
                elseif($item->function == 'Order Email Send'){
                    if($result->data->order_number){
                        $sendto = env('MAIL_TO_COPY');
                        // $order = ;
                        $order_details = Order::with('basket','orderItems','address')->where('id',$result->data->order_number)->first();
                        if($order_details){
                        if($billing = $order_details->address->where('type','billing')->first())
                            $to = $billing->email;
                        else
                            die("Order doesn't have an email address");
                        
                        try {
                            \Mail::to($to)->bcc($sendto)->send(new OrderInvoiceMail($order_details));
                        }
                        catch(Exception $e) {
                            
                        }
                        }
                    }
                }
                elseif($item->function == 'Theme Settings'){
                    $theme = Theme::first();
                    if(!$theme){
                        $theme = new Theme();
                    }
                    $theme->theme_code = $result->data;
                    $theme->save();
                    
                }
                elseif($item->function == 'Product Page Builder'){
                     if($item->action == 'CREATE' || $item->action == 'UPDATE'){
                       $new_one = ProductPage::where('master_id', $result->data->id)->first();
                        if (!$new_one) {
                            $new_one = new ProductPage();
                        }
                        
                        $new_one->master_id     = $result->data->id;
                        $new_one->title         = $result->data->title;
                        $new_one->h1            = $result->data->h1;
                        $new_one->slug          = $result->data->slug;
                        $new_one->seo_title     = $result->data->seo_title;
                        $new_one->seo_description = $result->data->seo_description;
                        $new_one->seo_keywords  = $result->data->seo_keywords;
                        $new_one->published     = $result->data->published;
                        $new_one->company_id    = $result->data->company_id;
                        $new_one->keyword       = $result->data->keyword;
                        $new_one->keyword_slug  = $result->data->keyword_slug;
                        $new_one->parent_id     = $result->data->parent_id;
                        $new_one->category_id   = $result->data->category_id;
                        $new_one->category_slug = $result->data->category_slug;
                        $new_one->save();
                        
                        ProductPageContent::where('page_id', $new_one->id)->delete();
                        ProductPageCategory::where('page_id', $new_one->id)->delete();
                        
                        foreach ($result->data->contents ?? [] as $listing) {
                            $new = new ProductPageContent;
                            $new->page_id = $new_one->id;
                            $new->contents = $listing->contents;
                            $new->type = $listing->type;
                            $new->position = $listing->position;
                            $new->save();
                        }
                        
                        $categ_ids = collect($result->data->categories)->pluck('id')->toArray();
                        
                        $categories = Category::whereIn('master_id', $categ_ids)->pluck('id');
                        
                        $new_one->categories()->sync($categories);
                
                    }
                    if($item->action == 'DELETE'){
                        $data = ProductPage::where('master_id',$item->data_id)->first();
                      
                        if($data){  
                            ProductPageContent::where('page_id',$data->id)->delete();
                            ProductPageCategory::where('page_id',$data->id)->delete();
                            $data->delete();
                        }
                    }
                    
                }
                elseif($item->function == 'Nutrition Explorer'){
                    if($item->action == 'UPDATE'){
                       
                    }
                }
                elseif($item->function == 'Product Images'){
                    if($item->action == 'UPDATE'){
                      
                    }
                }
                
       
               
              CurlSendPostRequest($action_url,$action_id);
                return response()->json(['success' => true], 200); 
            }
            else{
                CurlSendPostRequest($action_url_error,$action_id);
                return response()->json(['success' => false], 200); 
            }
        }
            
           
         
   }
   catch(Exception $e){
       dd($e);
       exit();
       return response()->json(['success' => false], 501);        
   }
          
}    


    function addMenuOption($data,$parent = null){
        foreach($data ?? [] as $subMenus){
            $childMenu           = new Menu(); 
            $childMenu->name     = $subMenus->name;
            $childMenu->slug     = Str::slug($subMenus->name);
            $childMenu->link     = $subMenus->link;
            $childMenu->parent_id= $parent;
            $childMenu->weight   = $subMenus->weight;
            $childMenu->status   = $subMenus->status;
            $childMenu->save();
            
            if($subMenus->children != null){
                addMenuOption($subMenus->children,$childMenu->id);
            }
        }
                           
    }
    
    function deleteMenuOption($id){
        $menuSubList = Menu::where('parent_id',$id)->get();
        if($menuSubList->count() > 0){
            foreach($menuSubList as $sub){
                deleteMenuOption($sub->id);
            }
            
             Menu::where('id',$id)->delete();
        }
        else{
            Menu::where('id',$id)->delete();
        }
        
    }

function store_image_url($path, $url) {
    try {
        if ($url != '') {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $imageData = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200 && $imageData !== false) {
                $image_name = basename($url);
                if (!$image_name) {
                    $image_name = Str::random(30) . '.png';
                }

                Storage::put($path . $image_name, $imageData);
            } else {
                $image_name = 'dummy.png';
            }
        } else {
            $image_name = 'dummy.png';
        }
    } catch (Exception $e) {
        // dd($e); // Debugging output for exception
        $image_name = 'dummy.png'; 
    }

    return $image_name;
}



function store_video_url($path, $url) {
    try {
        if ($url != '') {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $imageData = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200 && $imageData !== false) {
                $urlParts = parse_url($url);
                $image_name = basename($urlParts['path']); // Extracts the filename from the URL's path
                if (!$image_name) {
                    $image_name = Str::random(30) . '.mp4'; // Fallback with random filename
                }

                Storage::put($path . $image_name, $imageData);
            } else {
                $image_name = 'dummy.png';
            }
        } else {
            $image_name = 'dummy.png';
        }

        return $image_name;
    } catch (Exception $e) {
        $image_name = 'dummy.png';
    }
}



    
// function store_image_url($path,$url){
//   try{
//       if($url != ''){
//           $imageData = file_get_contents($url);
//           $image_name = basename($url);
           
//           if(!$image_name){
//             $image_name = Str::random(30) . '.png';
//           }
           
//           if($imageData !== False){
//                 Storage::put($path.$image_name, $imageData);
//           }
//           else{
//               $image_name = 'dummy.png';
//           }
//       }
//       else
//       {
//           $image_name = 'dummy.png';
//       }
//   }
//   catch(Exception $e){
//       dd($e);
//         $image_name = 'dummy.png';
//   }
   
   
//   return $image_name;
// }


// function store_video_url($path,$url){
//     try{
//         if($url != ''){
//           $image_name = Str::random(30) . '.mp4';
//           $imageData = file_get_contents($url);
//           if($imageData !== False){
//           Storage::put($path.$image_name, $imageData);
//           }
//           else{
//               $image_name = 'dummy.png';
//           }
//       }
//       else
//       {
//           $image_name = 'dummy.png';
//       }
        
//       return $image_name;
//     }
//     catch(Exception $e){
//         $image_name = 'dummy.png';
//     }
// }


function DeleteImage($existing = '',$path = null) {
   if($existing != '')
   @unlink($path.$existing);
}
