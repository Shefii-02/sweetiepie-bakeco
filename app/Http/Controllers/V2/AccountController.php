<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AccountController extends Controller{
    public $user;
    public function __construct(){
        $this->middleware(function(Request $request, $next){
            $this->user = auth()->user();
            View::share('user', $this->user);
            return $next($request);
        });

        
    }
    public function index(){
        return view('v2.account.index');
    }

    public function profile(){
        return view('v2.account.profile')->withProvinces(\App\Models\Province::all());
    }

    public function updateProfile(\App\Http\Requests\ProfileRequest $request){
        try{
            $this->user->update($request->validated());
    		session()->flash('success', 'The profile has been successfully updated.');
			return redirect()->back();
        }
        catch(\Exception $e)
        {
            session()->flash('failed', $e->message());
			return redirect()->back();
        }
    }

    public function password(){
        return view('v2.account.password');
    }

    public function changePassword(\App\Http\Requests\PasswordRequest $request){
        $this->user->password = \Hash::make($request->password);
        try{
            $this->user->save();
    		session()->flash('success', 'The password has been successfully updated.');
			return redirect()->back();
        }
        catch(\Exception $e)
        {
            session()->flash('failed', $e->message());
			return redirect()->back();
        }
    }

    public function orders(Request $request){
        $orders = \App\Models\Order::whereUserId($this->user->id)->latest()->paginate(6);
        return view('v2.account.orders.index')->withOrders($orders);
    }

    public function order(Request $request, \App\Models\Order $order){
        $order = \App\Models\Order::whereUserId($this->user->id)->findOrfail($order->id);
        return view('v2.account.orders.order')->withOrder($order)
        ->withDeliveryAddress($order->address()->whereType('delivery')->first())
        ->withBillingAddress($order->address()->whereType('billing')->first());
    }
}
