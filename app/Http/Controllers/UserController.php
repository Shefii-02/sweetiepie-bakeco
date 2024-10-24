<?php

    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
    use Hash;
    use App\Models\Basket;
    use App\Models\Mycard;
    use App\Models\Myaddress;
    use App\Models\Order;
    use App\Models\Item;
    use Carbon\Carbon;
    use Config; 
    use App\Models\Province;
    use App\Models\User;
    use App\Mail\SignupMail;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Password;
    use Illuminate\Support\Str;
    use App\Http\Requests\SignupFormRequest;
    use App\Http\Requests\ProfileDetailsRequest;
    use App\Http\Requests\AddressDetailsRequest;
    use App\Http\Requests\GuestFormRequest;


class UserController extends Controller
{
    
    use \App\Service\SendDataTNG;
    
    function myaccount(){
        
        return view('frontend/myaccount');
    }
   
    function profile(){
        return view('frontend/profile');
    }

	function signin()
	{
	    if(auth()->check() == true){
		   return redirect('account');
	    }
	    else
	    {
	       return view('frontend/sign-in');
	    }
	}

	function postSignin(Request $request)
	{
		$request->validate(['email'		=>'bail|required|email',
							'password'	=> 'bail|required']);
        $rememberMe = $request->has('remember');
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1], $rememberMe)) {
            $session_string = session('session_string');						
            $basket = Basket::where('session',$session_string)->where('status',0)->first();
    
            if($basket){	
                $basket->user_id =  auth()->user()->id;
                $basket->email =  auth()->user()->email;
                $basket->save();
                
            }
			if($request->has('redirect_uri'))
			{
				return redirect($request->redirect_uri);
				exit;
			}

    		session()->flash('success', 'You have successfully logged in.');
    			return redirect()->back();
// 			return redirect('/myaccount');

		}
		else
		{
		    session()->flash('failed', 'Invalid login attempt');

			return redirect()->back();
		}

	}

	function signup()
	{
	    if(auth()->check() == true){
	 
		   return redirect('account');
	    }
	    else{
        return view('frontend/sign-up')
               ->withProvince(Province::orderBy('name','ASC')->get());
	    }
	}
	
	public function signout()
	{
		Auth::logout();
		session()->flash('success', 'Thank you for visiting SweetiePie Bake Co');

		return redirect('/');
	}


	function postSignup(SignupFormRequest $request)
	{
		$user               = new User();  
		$user->email 		= $request->email;
		$user->password 	= Hash::make($request->password);
		$user->firstname 	= $request->firstname;
		$user->lastname 	= $request->lastname;
		$user->name         = $request->firstname. ' ' . $request->lastname;
		$user->address  	= $request->address;
		$user->postalcode 	= $request->postalcode;
		$user->city 	 	= $request->city;
		$user->province 	= $request->province;
		$user->country  	= 'Canada';
		$user->phone    	= $request->phone;
		$user->province 	= $request->province;
		$user->birthday 	= $request->dob;
		$user->status 	 	= 1;
		try{
    		$user->save();
    		
    		$myadd              = new Myaddress();
    		$myadd->user_id	    = $user->id;
    		$myadd->firstname   = $user->firstname;
    		$myadd->lastname    = $user->lastname;
    		$myadd->address     = $user->address;
    		$myadd->postalcode  = $user->postalcode;
    		$myadd->city        = $user->city;
    		$myadd->province    = $user->province;
    		$myadd->country      = 'Canada';
    		$myadd->base        = 1;
    		$myadd->save();
		    try{
    	        Mail::to($user->email)->send(new SignupMail($user));
		    }
		    catch(\Exception $e){
		        
		    }
		    
		  //  $SignupApi = $this->signup_api($user);
		    $this->SendDataTrait();
		    
		    Auth::login($user);
		    $session_string = session('session_string');						
            $basket = Basket::where('session',$session_string)->where('status',0)->first();
    
            if($basket){	
                $basket->user_id =  auth()->user()->id;
                $basket->email =  auth()->user()->email;
                $basket->save();
                
            }
		    
    		session()->flash('success', 'Welcome to our site! Thank you for becoming a member.');
    		return redirect('/');
		}
		catch(\Exception $e){
		    session()->flash('failed', $e->message());
		    return redirect()->back();
		}
	}
	
// 	function signup_api($user){
// 	    $apiDomain = env('TNG_API_DOMAIN'); 
            
//         $url = $apiDomain."/api/website/new-customer";
       
//         $post = ['first_name'   => $user->firstname,
//                  'name'         => $user->name,
//                  'last_name'    => $user->lastname,
//                  'email'        => $user->email,
//                  'password'     => $user->password,
//                  'address'      => $user->address,
//                  'postalcode'   => $user->postalcode,
//                  'city'         => $user->city,
//                  'province'     => $user->province,
//                  'country'      => $user->country,
//                  'phone'        => $user->phone
                 
//                 ];
//         $result__api = CurlSendPostRequest($url,$post);
//         $result__api = json_decode($result__api);
//         return 1;
// 	}
	
	

    function getRetrievePassword(Request $request) {
        
        if($request->has('token') && $request->has('email')){
            
            $user = User::where('email', $request->email)->first();
            $token = $request->query('token');
            $email = $request->query('email');
            $tokenIsValid = Password::tokenExists($user, $token);
            if($tokenIsValid){
                return view('frontend.reset-password', ['token' => $token, 'email' => $email]);
            }
        }
        
    	return view('frontend/forget-password')->with(['title'=>'Retrieve Account']);
    }


    function postRetrievePassword(Request $request) {

    	$request->validate(['email'=>'required|exists:users,email']);

    	    $status =  Password::sendResetLink(
                        $request->only('email')
                       );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => 'Reset link sent successfully. Please check your email.'])
            : back()->withErrors(['email' => __($status)]);
    	
    	

    }
    
    public function postResetpassword(Request $request)
    {
         $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

            $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
            }
        );
     
        return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
    }
    
    public function orders(Request $request){
        
        if($request->has('filter') && ($request->filter != NULL)){
            $year = $request->filter;
            
           $startDay = Carbon::create($year, 1, 1, 0, 0, 0)->toDateTimeString(); // Start day of the year with time
            $endDay = Carbon::create($year, 12, 31, 23, 59, 59)->toDateTimeString(); // End day of the year with time

        }
        else{
            $year = Carbon::now()->format('Y');
            $startDay = Carbon::create($year, 1, 1, 0, 0, 0)->toDateTimeString(); // Start day of the year with time
            $endDay = Carbon::now()->year($year)->toDateTimeString(); // Current day of the year
        }
        
        $user_id = auth()->user()->id;
            
        $orders = Order::with(['basket.items','address'])
                        ->leftJoin('baskets', 'baskets.id', '=', 'orders.basket_id')
                         ->where('orders.user_id', $user_id)
                        ->whereBetween('orders.created_at', [$startDay, $endDay])
                        ->where('orders.status',1)
                        ->select('orders.*')
                        ->orderBy('id','desc')
                        ->get();
                       
        
        return view('frontend/orders',compact('orders'));
    }
    public function login_security(){
        $account    = User::whereId(auth()->user()->id)->first() ?? abort(404);
        return view('frontend/login-security',compact('account'));
    }
    
    public function payment_options(){
        $mycard = Mycard::whereUserId(auth()->user()->id)->get();
        return view('frontend/my-cards',compact('mycard'));
    }
    
    public function contact_us(){
        return view('frontend/contact-suppot');
        
    }
    public function address(){
        $myadd = Myaddress::whereUserId(auth()->user()->id)->orderBy('base','DESC')->get();
        $province = Province::orderBy('name','ASC')->get();
        return view('frontend/my-address',compact('myadd','province'));
    }
    
    public function address_add(AddressDetailsRequest $request){
   
    	$myadd              = new Myaddress();
    	$myadd->user_id	    = auth()->user()->id;
    	$myadd->firstname   = $request->firstname;
    	$myadd->lastname    = $request->lastname;
    	$myadd->address     = $request->address;
    	$myadd->postalcode  = $request->postalcode;
    	$myadd->city        = $request->city;
    	$myadd->province    = $request->province;
    	$myadd->country     = 'Canada';
    	$myadd->base        = $request->has('base') ? '1' : '0';
    	
    	try{
            $myadd->save();
            
            if($myadd->base == '1'){
                $user               = User::whereId(auth()->user()->id)->first() ?? abort(404);
        		$user->address  	= $request->address;
        		$user->postalcode 	= $request->postalcode;
        		$user->city 	 	= $request->city;
        		$user->province 	= $request->province;
        		$user->country  	= 'Canada';
        		$user->save();
        		Myaddress::where('base','1')->whereUserId(auth()->user()->id)->where('id','<>',$myadd->id)->update(['base' => '0']);
            }
    		session()->flash('success', 'The address has been successfully created');
    		return redirect()->back();
        }
        catch(\Exception $e)
        {
            session()->flash('failed', $e->message());
    		return redirect()->back();
        }
     }
     
    public function address_edit(AddressDetailsRequest $request){
     
     
        $myadd = Myaddress::whereId($request->id)->whereUserId(auth()->user()->id)->first();
    
        $myadd->firstname   = $request->firstname;
        $myadd->lastname    = $request->lastname;
    	$myadd->address     = $request->address;
    	$myadd->postalcode  = $request->postalcode;
    	$myadd->city        = $request->city;
    	$myadd->province    = $request->province;
    	$myadd->base        = $request->has('base') ? '1' : '0';
    	
    	try{
            $myadd->save();
            
            if($myadd->base == '1'){
                $user               = User::whereId(auth()->user()->id)->first() ?? abort(404);
        		$user->address  	= $request->address;
        		$user->postalcode 	= $request->postalcode;
        		$user->city 	 	= $request->city;
        		$user->province 	= $request->province;
        		$user->save();
        		Myaddress::where('base','1')->whereUserId(auth()->user()->id)->where('id','<>',$myadd->id)->update(['base' => '0']);
            }
            
    		session()->flash('success', 'The address has been successfully updated.');
    		return redirect()->back(); 
    	    
    	}
        catch(\Exception $e)
        {
            session()->flash('failed', $e->message());
    		return redirect()->back();
        }
		
    }
    
    public function address_delete($id){
        $my_add = Myaddress::whereUserId(auth()->user()->id)->get();
        if($my_add->count() >1){
            $address = Myaddress::whereId($id)->whereUserId(auth()->user()->id)->first();
     
            if($address->base == '1'){
                $newBase = Myaddress::whereUserId(auth()->user()->id)->first();
                $newBase->base ='1';
                $newBase->save();
            }
            else{
                $any_base = Myaddress::whereUserId(auth()->user()->id)->where('base',1)->first();
                if(!$any_base){
                    $newBase = Myaddress::whereUserId(auth()->user()->id)->first();
                    $newBase->base ='1';
                    $newBase->save();
                }
            }
            
            $address->delete();
    		session()->flash('success', 'The address has been successfully deleted.');
			return redirect()->back(); 
        }
        else
        {
            session()->flash('failed', 'At least one Address must be included');
			return redirect()->back();
        }
        
     }


    public function profile_edit(ProfileDetailsRequest $request){
        $acc        = User::whereId(auth()->user()->id)->first() ?? abort(404);
        $acc->firstname = $request->firstname;
        $acc->lastname  = $request->lastname;
        $acc->name      = $request->firstname .' '. $request->lastname;
        $acc->email = $request->email;
        $acc->phone = $request->phone;
        try{
            $acc->save();
    		session()->flash('success', 'The profile has been successfully updated.');
			return redirect()->back();
        }
        catch(\Exception $e)
        {
            session()->flash('failed', $e->message());
			return redirect()->back();
        }
    }
    
    public function password_edit(Request $request){
        $acc    = User::whereId(auth()->user()->id)->first() ?? abort(404);
        $acc->password = Hash::make($request->password);
        try{
            $acc->save();
    		session()->flash('success', 'The password has been successfully updated.');
			return redirect()->back();
        }
        catch(\Exception $e)
        {
            session()->flash('failed', $e->message());
			return redirect()->back();
        }
    }
    
    
    public function gustSignin(GuestFormRequest $request){
        $session_string = session('session_string');						
        $basket = Basket::where('session',$session_string)->where('status',0)->first();

        if($basket){	
            $basket->email =  $request->email;
            $basket->save();
            	session()->flash('success', 'Continue as a Guest');
			return redirect()->back();
        }
        else
        {
            session()->flash('failed', 'The Shopping Cart is Empty!');
			return redirect()->back();
        }
    }
    
    

        
}