<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class OrderController extends Controller{
    public $user;
    public function __construct(){
        $this->middleware(function(Request $request, $next){
            $this->user = auth()->user();
            View::share('user', $this->user);
            return $next($request);
        });
    }

    public function cart(Request $request){
        refreshCart();
        $basket = \App\Models\Basket::where('session',session('session_string'))->where('status',0)->first();
        $items = ($basket->items ?? collect([]))->sortBy('product_name');
        if($request->sort == 'price'){
            $items = $items->sortBy('price_amount');
        }
        return view('v2.shopping.cart.index')->withItems($items)->withBasket($basket)->withTotal($items->sum(function ($item) {
            return $item->price_amount * $item->quantity;
        }));
    }

    public function checkout(Request $request){
        
        
        refreshCart();
        
        if(session()->has('session_string') ) {
            $session_string = session('session_string');
            $basket = \App\Models\Basket::where('session',$session_string)->where('status',0)->first();
            if($basket){
                
                $items = \App\Models\Item::with('parentItem')
                            ->where('basket_id', $basket->id)
                            ->where(function ($query) {$query->whereNull('parent') ->orWhere('parent', '=', 0);})->get();
                if($items->count() > 0){
                    return view('v2.shopping.checkout.index', compact('items', 'basket'))->withProvinces(\App\Models\Province::all())
                    ->withAddresses(
                        \App\Models\Myaddress::whereUserId($this->user->id)->orderBy('base','DESC')->get()
                    )->withCalculation(
                        json_decode($this->GrandTotalCalculation($basket))
                    );
                }
            }
        }
        return redirect('/cart');

    }

    function GrandTotalCalculation($basket){
        $Calculation = getGrandCalculation($basket);
            
        return json_encode($Calculation);
    }
}
