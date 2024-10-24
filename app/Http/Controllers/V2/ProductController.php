<?php

namespace App\Http\Controllers\V2;

use  App\Http\Controllers\MailController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\ProductEnquiry;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class ProductController extends MailController{

    public function index(Request $request, \App\Models\Category $category = null){
        return view(auth()->check() ? 'v2.shopping.index' : 'v2.products.index')->withProducts(\App\Models\Product::when(($category->id ?? null), function($q) use($category){
            return $q->whereHas('categories', fn($q) => $q->where('categories.id', $category->id));
        })->when($request->q, function($q) use($request){
            return $q->where('name', "LIKE", "%{$request->q}%")->orWhereHas('categories', fn($q) => $q->where('categories.name', 'LIKE', "%{$request->q}%"));
        })->whereHas('categories')->whereStatus('1')->paginate(24)->appends(request()->query()))
        ->withBanner(
            \App\Models\Banner::whereType('home_top_tile')->whereName($category->name ?? null)->first()
        )->withCategory($category)->withCategories(\App\Models\Category::all());
    }
    public function show(Request $request, \App\Models\Product $product){
        $suggested = \App\Models\SuggestedProduct::with('products','products.thumbImages')->where('suggested_products.product_id',$product->id)
            ->orderBy('suggested_products.id','asc')->get();

        $options = $product->option->groupBy('type')->map(function ($items, $key) {
            return $items->pluck('value')->unique()->values();
        });
        
        return ($request->ajax() ? response()->json([
            'html' => view('v2.shopping.product')->withProduct($product)->withOptions($options)->render()
        ]) : (auth()->check() ? $this->index($request) :  view('v2.products.product')->withProvinces(\App\Models\Province::all())->withProduct($product)->withSuggested($suggested)->withOptions($options)));
    }

    public function clear(){
        try{
            if($basket = \App\Models\Basket::where('session',session('session_string'))->where('status',0)->first()){
                $basket->delete();
            }
        }
        catch(\Exception $e){}
        return redirect(url('/menu'));
    }

    public function getCart(Request $request){
        refreshCart();
        $basket = \App\Models\Basket::where('session',session('session_string'))->where('status',0)->first();
        $items = ($basket->items ?? collect([]))->sortBy('product_name');
        if($request->sort == 'price'){
            $items = $items->sortBy('price_amount');
        }
        return response()->json([
            'item_count' => getCartCount(),
            'total' => $total = getPrice($items->sum(function ($item) {
                return $item->price_amount * $item->quantity;
            })),
            'cart_side' => view('v2.shopping.sideCart')->withItems($items)->withTotal($total)->render(),
            'cart_page' => view('v2.shopping.cart.table')->withItems($items)->withTotal($total)->render(),
        ]);
    }

    public function enquiry(\App\Http\Requests\EnquiryRequest $request, \App\Models\Product $product){
        
        $sendto= env('MAIL_TO_WHOLESALE') ?? env('MAIL_TO_ADDRESS');
            
            // if(env('APP_ENV')=='local')
            //     $sendto = 'developer@indigitalgroup.ca';
            try {
                try {
                    $response = \Illuminate\Support\Facades\Http::post(env('TNG_API_DOMAIN').'/api/savemessage', [
                        'api_key' => env('TNG_API_KEY'),
                        'name' => "{$request->firstname} {$request->lastname}",
                        'phone' => $request->input('phone'),
                        'email' => $request->input('email'),
                        'company_name' => $request->input('company_name'),
                        'website' => $request->input('website'),
                        'address' => $request->input('address'),
                        'city' => $request->input('city'),
                        'province' => $request->input('province'),
                        'postalcode' => $request->input('postalcode'),
                        'type' => 'enquiry',
                        'product' => $product->name,
                    ]);
                } catch (\Exception $e) {}
                
                
                $template = new ProductEnquiry($request);
                $template = $template->render();
                $subject = "Product Inquiry from  ". $request->firstname .' '.$request->lastname;
                
                $this->sendToMail($template,$sendto,$subject);
                // $mail = Mail::to($sendto)->send(new ProductEnquiry($request));
                
                return redirect()->back()->with('success', 'Thank you for your inquiry. Our team will be in touch with you shortly');
    
            } catch(\Exception $e) {
                dd($e);
            return redirect()->back()->with('error', 'An error occurred while sending the message. Please try again later.');
    
            }
    }
}