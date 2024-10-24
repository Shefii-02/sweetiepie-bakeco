<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\Myaddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AddressController extends Controller{
    public $user;
    public function __construct(){
        $this->middleware(function(Request $request, $next){
            $this->user = auth()->user();
            View::share('user', $this->user);
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return view('v2.account.address')->withAddresses(
            \App\Models\Myaddress::whereUserId($this->user->id)->orderBy('base','DESC')->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('v2.account.addressForm')->withProvinces(\App\Models\Province::all());;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\AddressRequest $request){
        \App\Models\Myaddress::create($request->validated())->update([
            'user_id' => $this->user->id,
        ]);
        session()->flash('success', 'The address has been successfully created.');
        return redirect()->route('address.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Myaddress $address){
        \App\Models\Myaddress::whereUserId($this->user->id)->orderBy('base','DESC')->findOrfail($address->id);
        return view('v2.account.addressForm')->withAddress($address)->withProvinces(\App\Models\Province::all());;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\App\Http\Requests\AddressRequest $request, Myaddress $address){
        \App\Models\Myaddress::whereUserId($this->user->id)->orderBy('base','DESC')->findOrfail($address->id)->update($request->validated());
        session()->flash('success', 'The address has been successfully updated.');
        return redirect()->route('address.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Myaddress $address){
        \App\Models\Myaddress::whereUserId($this->user->id)->findOrfail($address->id)->delete();
        session()->flash('success', 'The address has been successfully deleted.');
        return redirect(route('address.index'));
    }
}
