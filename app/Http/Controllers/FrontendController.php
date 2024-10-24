<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use App\Models\Banner;
use App\Models\Product;
use App\Models\HomepageProduct;
use App\Models\Gallery;
use App\Models\Media;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogCategoryList;
use App\Models\Faq;
use App\Models\LandingPage;
use App\Models\Page;
use App\Models\Subscribe;
use App\Models\CareerJob;
use App\Models\MenuCategory;
use App\Models\OrderFeedback;
use App\Models\Store;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Models\StoreTiming;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Collection;
use App\Models\BakingInstruction;

class FrontendController extends Controller
{
    
    use \App\Service\WebHookUrl;

    //
    public function index(Request  $request)
    {
        
        $title = "Home";
        
        $slider = Banner::whereType('home_slider')->where('status', 1)
    						->orderBy('display_order','ASC')->get();
    						
        $career_stores = Store::orderBy('display_order','asc')->get();
          
        $front_products = HomepageProduct::with('product_list')->first();
        
        $tiles         = Banner::whereType('home_tiles')->where('status', 1)->orderBy('display_order','ASC')->get();

    	return view('frontend.index',compact('slider','front_products','career_stores','title', 'tiles'));
    }
    
    public function nutritions(Request $request){
        /*$products = \App\Models\Product::query()->where(function($q) use($request){
            $nfts = array_map('trim', explode(',', str_replace(' ', ',', $request->search)));
            
            return $q->where('name', 'LIKE', "%{$request->search}%")
                     ->orWhere('description', 'LIKE', "%{$request->search}%")
                     ->orWhere(function($q) use($nfts){
                         $q->whereHas('product_variation', function($q2) use($nfts){
                             $q2->whereHas('nutritions', function($n) use($nfts){
                                 foreach($nfts as $nft){
                                     $n->where(function($ns) use($nft){
                                         $ns->where('nutrition_title', 'LIKE', "%{$nft}%")
                                            ->whereRaw("CAST(nutrition_value AS DECIMAL(10, 2)) > 0");
                                     });
                                 }
                             });
                         });
                     });
        })->whereRegular(1)->whereOnline(1)->get();*/
        
        $products = \App\Models\Product::query()->where(function($q) use($request){
            $nfts = array_map('trim', explode(',', str_replace(' ', ',', $request->search)));
            
            return $q->where('name', 'LIKE', "%{$request->search}%")
                     ->orWhere('description', 'LIKE', "%{$request->search}%")
                     ->orWhere(function($q) use($nfts){
                         $q->whereHas('product_variation', function($q2) use($nfts){
                             foreach($nfts as $nft){
                                $q2->whereHas('nutritions', function($n) use($nft){
                                     $n->where(function($ns) use($nft){
                                         $ns->where('nutrition_title', 'LIKE', "%{$nft}%")
                                            ->whereRaw("CAST(nutrition_value AS DECIMAL(10, 2)) > 0");
                                     });
                                });
                             }
                         });
                     });
        })->whereRegular(1)->whereOnline(1)->get();
        
        return response()->json([
            'success' => true,
            'html' => view('frontend.nutrition-explorer-products')->withProducts($products)->render(),
        ]);
    }
    
    
    public function get_positions(Request $request){
        
        $postions = CareerJob::where('store_id',$request->store_id)
                                  ->where('status','1')
                                  ->get();
                                      
        $result= '<option value="general">General</option>';
        
        if($postions){                          
            foreach($postions as $item) {
                $result .='<option value="'.$item->job_possition.'">'.$item->job_possition.'</option>';
            }
        }
        else
        {
            $result .='<option value="" disabled>No positions available</option>';
        }
        
        
        return $result;
                                  
    }
    
    public function stores(){
      
        
        $title = "Stores";

        $branches = Store::select('id','name','address','city','postal_code','province','lat as latitude','lng as longitude','phone','email','map_link','status','slug')->get()  ->map(function ($branch) {
        return (object) [
                        'id' => $branch->id,
                        'name' => $branch->name,
                        'latitude' => (float) $branch->latitude,
                        'longitude' => (float) $branch->longitude,
                        'address' => $this->getAddressByBranchId($branch),
                    ];
                });
            
        return view('frontend.stores',compact('branches','title'));
    }
   
    function getAddressByBranchId($branch)
    {   
        $store = Store::with('store_timing')->where('id',$branch->id)->first();
        $timings = $this->storeTimingShow($store);
        return view('frontend.branchmap')->withBranch($branch)->withStore($store)->withTimings($timings)->render();

    }
    
    function storeTimingShow($store){

        $wdays = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
          
            $timings = StoreTiming::where('store_id', $store->id)
                                    ->select('day', 'open', 'close')
                                    ->orderBy('day')
                                    ->get()->toArray();
                                    
            $formatted = array();
            $extended = array();
                                
            for($i=0;$i<=6;$i++) {
                $formatted[$i] = isset($timings[$i]) ? date('h:ia',strtotime($timings[$i]['open'])) .'-'. date('h:ia',strtotime($timings[$i]['close'])):'Closed';
            }
            
            $loop = 0;
            
            while($loop <= 6) {
                if($loop == 6 && $formatted[0] != $formatted[1] && $formatted[$loop] == $formatted[0]) {
                    $extended[0] = $wdays[$loop].'-'.$wdays[0] . ' - ' . $formatted[$loop];
                    $loop++;
                    continue;
                }
                
                $line = $wdays[$loop];
                
                while(isset($formatted[$loop+1]) && $formatted[$loop] == $formatted[$loop+1]) {
                    $loop++;
                    $line = substr($line,0,3) .'-'. $wdays[$loop];
                }
                
                $extended[] =  $line . ':' . $formatted[$loop] ;
                $loop++;
            }
            
           return $extended;
    }
    
    public function store_single($slug){
        
        $store = Store::with('store_timing','store_images')->where('slug',$slug)->first() ?? abort(404);
        
        $title = $store->name;
        $description = Str::limit(strip_tags($store->description), 160); 
        
        $otherstore = Store::orderBy('display_order','asc')->where('slug','<>',$slug)->get();
        return view('frontend.store-single',compact('store','otherstore','title','description'));
    }

    // public function menu()
    // {
    //     $categories = MenuCategory::with('product_list','product_list.product_single')->orderBy('display_order')->get();
        
    //     return view('frontend.menu',compact('categories'));
    // }
    
    public function blogs()
    {
        
        $title = "Blogs";

        $blog_category = BlogCategoryList::orderby('id','desc')->whereType('blog')->get();
        $blogs         = Blog::orderBy('published_at','DESC')->whereType('blog')->get();
        return view('frontend.blogs',compact('blog_category','blogs','title'));
    }
    
    public function blog_catgory($category)
    {
        
        $title = "Blog Category";

        $blog_category = BlogCategoryList::where('slug','<>',$category)->orderby('id','desc')->whereType('blog')->get();
        $blogs         = Blog::orderBy('published_at','DESC')->whereType('blog')->get();
        return view('frontend.blogs',compact('blog_category','blogs','title'));
    }
    public function blog_single($single)
    {
        $blog_category = BlogCategoryList::orderby('id','desc')->whereType('blog')->get();
        $single_blog   = Blog::where('slug',$single)->whereType('blog')->firstOrfail();
        $blogs         = Blog::orderBy('published_at','DESC')->whereType('blog')->Limit(5)->get();
        
        $title = $single_blog->name;
        $description = Str::limit(strip_tags($single_blog->description), 160); 
        
        return view('frontend.single-blog',compact('blogs','single_blog','blog_category','title','description'));
    }
    
    public function gallery()
    {
        
        $title = "Gallery";

        $gallery = Gallery::where('status', 1)->orderBy('id','DESC')->get();
        return view('frontend.gallery',compact('gallery','title'));
    }
    
     
    public function media()
    {
        
        $title = "Media";

        $media = Media::where('status', 1)->orderBy('position','ASC')->get();
        return view('frontend.media',compact('media','title'));
    }
    
    
    public function faq()
    {
        
        $title = "Faq";

        $general        = Faq::where('type', 'General')->orderBy('display_order','ASC')->get();
        $substitutions  = Faq::where('type', 'Substitutions')->orderBy('display_order','ASC')->get();
        $discounts      = Faq::where('type', 'Discounts')->orderBy('display_order','ASC')->get();
        $returns        = Faq::where('type', 'Returns')->orderBy('display_order','ASC')->get();
        return view('frontend.faq',compact('general','substitutions','discounts','returns','title'));
    }
    
    public function wholesale()
    {
        
        $title = "WholeSale";

        return view('frontend.wholesale',compact('title'));
    }
  
    public function page_view($slug){
        
        $site = LandingPage::where('page_url',$slug)->first();
        if(!$site){
            $site = Page::where('slug',$slug)->first(); 
            if($site){
                $title = $site->heading;
                $description =Str::limit(strip_tags($site->html), 160);
                return view('frontend.page',compact('site','title','description'));
            }
            /**
             * Redirect seo sites if available
             */
            else if($redirect = \App\Models\Redirect::whereFromUrl(ltrim(request()->getRequestUri(),'/'))->firstOrfail()){
                return redirect(url($redirect->to_url), 301);
            }
            else
            {
                abort(404);
            }
        }
        else
        {
            $title = $site->seo_title != NULL ? $site->seo_title : 'Sweetiepie-'.$site->heading;
            $description = $site->seo_description != NULL  ? Str::limit(strip_tags($site->seo_description), 160) : Str::limit(strip_tags($site->section1_description), 160);
            return view('frontend.site',compact('site','description','title'));
        }
      
    }
    
    public function store_datas(Request $request){
            $expiration = 60 * 24 * 21; 
            Cookie::queue('postalCode', $request->postalCode, $expiration);
            Cookie::queue('city', $request->city, $expiration);
            Cookie::queue('street_address', $request->street_address, $expiration);
            Cookie::queue('order_type', $request->order_type, $expiration);
            return 1;
    }
    
    public function subscription_submit(Request $request){
        
        if(Subscribe::where('email',$request->email)->first()){
            
              
    // 		session()->flash('failed', 'Email already Subscribed..');
    		$type="error";
    		$message = 'Email already Subscribed..';
	
            $apiDomain = env('TNG_API_DOMAIN'); 
                    
                $url = $apiDomain."/api/website/new-subscriber";
               
                $post = ['email'        => $request->email];
                $result__api = CurlSendPostRequest($url,$post);
                $result__api = json_decode($result__api);
        }
        else
        {
            $new = new Subscribe();
            $new->email = $request->email;
            $new->save();
            
            //subscriber api
               $apiDomain = env('TNG_API_DOMAIN'); 
                    
                $url = $apiDomain."/api/website/new-subscriber";
               
                $post = ['email'        => $new->email];
                $result__api = CurlSendPostRequest($url,$post);
                $result__api = json_decode($result__api);
                
    // 		session()->flash('success', 'Successfully Subscribed..');
    	    $type="success";
    		$message = 'Successfully Subscribed..';
	
        	   
	
        }
        
        
        $response['type'] = $type;
        $response['message'] = $message;
        
        return $response;
    }
    
    public function order_inquiry(Request $request){
        
        
        $title = "Order Inquiry";


        $session = $request->token;
        $invoiceId = $request->invoiceId;
        
        $order_details = Order::with('basket', 'orderItems', 'address')
            ->where('invoice_id', $invoiceId)
            ->whereHas('basket', function ($query) use ($session) {
                $query->where('session', $session);
            })
            ->firstOrFail();
        
        $basketExists = isset($order_details->basket);
        
        if (!$basketExists) {
            abort(404);
        }
        
        return view('frontend.order-inquiry', compact('order_details','title'));

    }
    
    public function share_feedback(Request $request){
        $title = "Order Feedback";
        $session = $request->token;
        $invoiceId = $request->invoiceId;
        
        $order_details = Order::with('basket', 'orderItems', 'address')
            ->where('invoice_id', $invoiceId)
            ->whereHas('basket', function ($query) use ($session) {
                $query->where('session', $session);
            })
            ->firstOrFail();
        
        $basketExists = isset($order_details->basket);
        
        if (!$basketExists) {
            abort(404);
        }
      
        $exist = OrderFeedback::where('invoice_id',$invoiceId)->first();
  
        if($exist){
            $msg = 'Your feedback had already submitted';
            return view('frontend.share-feedback', compact('msg'));
        }
        else{  
            return view('frontend.share-feedback', compact('order_details','title'));
        }
    }
    
    public function SitemapFunction(){
        //static links
        $static_urls    =   [url('menu'),url('gifts'),url('product'),url('products'),url('category'),url('stores'),url('wholesale'),url('catering'),url('contact'),url('order-inquiry'),
                            url('blog'),url('baking-instructions'),url('gallery'),url('media'),
                            url('cart'),url('checkout'),url('sign-up'),url('sign-in'),url('forget-password'),
                            url('account')];
        
        //dymaic links    
            $menu_category = MenuCategory::pluck('slug')->map(function ($item) {return url('menu/' . $item);});

            $products = Product::where('status', 1)->pluck('slug')->map(function ($item) {return url('product/' . $item);});
            
            $blogs = Blog::where('status', 1)->pluck('slug')->map(function ($item) {return url('blog/' . $item);});
            
            $blog_category = BlogCategoryList::where('status', 1)->pluck('slug')->map(function ($item) {return url('blog/category/' . $item);});
            
            $baking_instr = BakingInstruction::where('status', 1)->pluck('slug')->map(function ($item) {return url('baking-instructions/' . $item);});
            
            $landingPage = LandingPage::where('published', 1)->pluck('page_url')->map(function ($item) {return url('/'. $item);});
            
            $pages = Page::where('published', 1)->pluck('slug')->map(function ($item) {return url('/'. $item);});
            
            $stores = Store::pluck('slug')->map(function ($item) {return url('stores/' . $item);});
            
            $dynamic_urls = $menu_category
                ->merge($products)
                ->merge($blogs)
                ->merge($blog_category)
                ->merge($baking_instr)
                ->merge($landingPage)
                ->merge($pages)
                ->merge($stores);
    
        // Generate the XML content
        $xml = view('layouts.sitemap', compact('static_urls', 'dynamic_urls'))->render();

        // Set the appropriate header for XML output
        return Response::make($xml, 200, ['Content-Type' => 'application/xml']);
     }
    
    
    
    public function hook_url(){
        
        return $this->GetDataTrait();
    }
    
    
    
  
    
}
