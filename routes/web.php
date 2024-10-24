<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('sitemap.xml','FrontendController@SitemapFunction');
Route::get('email808','UtilityController@emailCampaign');
Route::post('email808','UtilityController@sendEmail');


// Route::get('header', function () {
//          echo $_SERVER['REMOTE_ADDR'];
//     });

Route::get('time', function () {
    $currentTimeZone = Config::get('app.timezone');
    
    echo 'Current Date/time: ' . date('Y-m-d H:i:s') . '<br>';
    echo 'Timestamp : ' .strtotime(date('Y-m-d H:i:s')).'<br>';
});


// Route::get('email',function(){
//     return view('layouts.email');
// });

Route::get('prod-detail/{id}','ProductController@showDetails');


Route::group(['middleware' => 'web'], function () {
    Route::get('type_search', 'AutoAddressController@quickSearch')->name('get.type');
    
    Route::get('auto-complete-address', [AutoAddressController::class, 'googleAutoAddress']);
    Route::any('/','FrontendController@index');
    Route::get('get_positions','FrontendController@get_positions'); 
    Route::post('subscribe','FrontendController@subscribe');
    Route::get('/blog','FrontendController@blogs');
    Route::get('/blog/category/{slug}','FrontendController@blog_catgory');
    Route::get('/blog/{slug}','FrontendController@blog_single');
    Route::get('/baking-instructions','RecipeController@instructions');
    //Route::get('/baking-instructions/category/{slug}','RecipeController@blog_catgory');
    Route::get('/baking-instructions/{slug}','RecipeController@instruction_single');
    Route::get('/gallery','FrontendController@gallery');
    Route::get('/media','FrontendController@media');
    // Route::get('/faqs','FrontendController@faq');
    Route::get('/wholesale','FrontendController@wholesale');
    // Route::get('menu','FrontendController@menu');
    Route::get('stores','FrontendController@stores');
    Route::get('stores/{slug}','FrontendController@store_single');

    // Route::get('menu','ProductController@category');
    // Route::get('menu/{slug}','ProductController@category_single');

    Route::get('menu','V2\ProductController@index');
    Route::get('menu/{category:slug?}','V2\ProductController@index');

 
    Route::get('product',  function () { return redirect('/menu'); });
    Route::get('products', function () { return redirect('/menu'); });
    Route::get('category', function () { return redirect('/menu'); })->name('category');
    
    Route::get('order-inquiry','FrontendController@order_inquiry');
    Route::post('order-inquiry/{id}/{session}','MailController@order_inquiry')->name('order-inquiry');
    Route::get('share-feedback','FrontendController@share_feedback');
    Route::post('share-feedback/{id}/{session}','MailController@share_feedback')->name('share-feedback');
    
    Route::get('/catering', function () { return view('frontend.catering'); });
    Route::get('/thanks', function () { return view('frontend.thanks'); }); 
    Route::get('gifts','ProductController@gift_cards');
    Route::get('contact', function () { return view('frontend.contact'); });
    Route::post('contact','MailController@contact_send')->name('contact-send');
    Route::post('wholesale','MailController@wholesaleForm_send')->name('wholesaleForm-send');
    Route::post('catering','MailController@catering_send')->name('catering-send');
    Route::post('store-career-request','MailController@StoreCareerRequest');    
    // Route::get('cart','OrderController@cart')->middleware("auth");
    Route::get('cart','V2\OrderController@cart')->middleware("auth");
    Route::get('cart/productadd','OrderController@productadd');
    Route::any('cart/get_addons','OrderController@get_addons');

    Route::get('cart/pickupTime','OrderController@pickupTime');
    
    Route::any('cart/continue','OrderController@cart_continue');
    
    //Route::any('checkout','OrderController@checkout')->middleware("auth");
    Route::any('checkout','V2\OrderController@checkout')->middleware("auth");
    
    Route::any('checkout/calculation','OrderController@CheckOutCalculation');
    
    Route::post('place-order','OrderController@place_order')->middleware("auth");
    Route::get('gift_code_apply','OrderController@gift_code_apply');
    Route::post('subscription-submit','FrontendController@subscription_submit');
    Route::get('select-location','OrderController@create_sessions');
    Route::get('check-available-city','ProductController@check_available_city');

    Route::get('basket/cart','V2\ProductController@getCart')->middleware("auth");
    
    Route::any('basket/add','OrderController@addToBasket')->middleware("auth");
   
    
    Route::get('/product/variation_id_get','ProductController@variation_id_get');
    Route::get('/product/get_product_variation','ProductController@get_product_variation');
    //Route::any('/product/{slug}','ProductController@product_single');
    Route::any('/product/{product:slug}','V2\ProductController@show')->name('product-single');
    Route::post('/product/{product:slug}','V2\ProductController@enquiry');
    Route::any('/shopping/clear','V2\ProductController@clear');
    Route::get('sign-up','UserController@signup'); 
    Route::post('sign-up','UserController@postSignup');
    Route::get('sign-in','UserController@signin')->name('signin');
    Route::post('sign-in','UserController@postSignin')->name('login')->middleware('throttle:20,1');
    Route::post('guest','UserController@gustSignin')->name('guest');
    Route::get('signout','UserController@signout')->name('logout');
    Route::get('forget-password','UserController@getRetrievepassword')->name('password.reset');
    Route::post('reset-password','UserController@postRetrievepassword');
    Route::post('new-password','UserController@postResetpassword');
    
    
    Route::get('thankyou','OrderController@thankyou');
    
    Route::group(['middleware' => 'auth'], function () {
        Route::get('myaccount','UserController@myaccount');
        Route::get('myaccount/order-history','UserController@orders');
        Route::get('myaccount/login-security','UserController@login_security');
        Route::get('myaccount/payment-options','UserController@payment_options');
        Route::get('myaccount/contact-us','UserController@contact_us');
        Route::get('myaccount/address','UserController@address');
        
        Route::post('myaccount/address/add','UserController@address_add');
        Route::post('myaccount/address/edit','UserController@address_edit');
        Route::post('myaccount/address/{id}/delete','UserController@address_delete')->name('address_delete');
        
        // Route::post('myaccount/payment-options/add','UserController@payment_options_add');
        // Route::post('myaccount/payment-options/edit','UserController@payment_options_edit');
        // Route::post('myaccount/payment-options/{id}/delete','UserController@payment_options_delete')->name('card_delete');
        
        Route::post('myaccount/login-security','UserController@profile_edit');
        Route::post('myaccount/login-security/password-edit','UserController@password_edit');
    });

    Route::group(['middleware' => 'auth'], function () {
        
        Route::get('account','V2\AccountController@index');
        Route::get('account/profile','V2\AccountController@profile');
        Route::post('account/profile','V2\AccountController@updateProfile');
        Route::get('account/password','V2\AccountController@password');
        Route::post('account/password','V2\AccountController@changePassword');

        Route::resource('account/address', V2\AddressController::class)->except(['show']);
        // Route::resource('account/orders', V2\AddressController::class)->only(['index', 'show']);
        Route::get('account/orders/','V2\AccountController@orders');
        Route::get('account/orders/{order}','V2\AccountController@order');
    });
    
    
    Route::get('send-data','OrderController@sendData');
    
    /*Route::get('/nutrition-explorer', function () {
        return view('frontend.nutrition-explorer');
    });*/
    // Route::get('/baking-instructions-test', function () {
    //     return view('frontend.baking-instructions');
    // });
    
    //testing
    Route::get('order-details', function () {
        $order_details = App\Models\Order::orderBy('id','DESC')->first();
        return view('emails.order-notification',compact('order_details'));
    });
    
    Route::get('order-details/{invoice_id}', function ($invoice_id) {
     
        $order_details = App\Models\Order::orderBy('id', 'DESC')->where('invoice_id', $invoice_id)->first();
        return view('emails.order-notification', compact('order_details'));
    });
    
    
    Route::get('order-email/{invoice_id}','OrderController@sendOrderConfirmation');
    
    
    
        
    Route::get('fundraiser','FundraiserController@index')->name('fundraiser');
    Route::get('fundraiser/add-cart', function () {return redirect()->route('fundraiser');});
    Route::get('fundraiser/ready-to-pickup', function () {return redirect()->route('fundraiser');});
    Route::post('fundraiser/ready-to-pickup','FundraiserController@readyTopickup')->name('ready-to-pickup');
    Route::post('fundraiser/add-cart','FundraiserController@addCart')->name('add-cart');
   
    
    
    
    
    Route::get('sickkids2024','NewFundraiserController@index')->name('sickkids2024');
    Route::get('sickkids2024/add-cart', function () {return redirect()->route('sickkids2024');});
    Route::get('sickkids2024/ready-to-pickup', function () {return redirect()->route('sickkids2024');});
    Route::post('sickkids2024/ready-to-pickup','NewFundraiserController@readyTopickup')->name('sickkids2024-ready-to-pickup');
    Route::post('sickkids2024/add-cart','NewFundraiserController@addCart')->name('sickkids2024-add-cart');
    
    
    
    
    Route::get('fairbank','FundraiserFairbankController@index')->name('fairbank2024');
    Route::get('fairbank/add-cart', function () {return redirect()->route('fairbank2024');});
    Route::get('fairbank/ready-to-pickup', function () {return redirect()->route('fairbank2024');});
    Route::post('fairbank/ready-to-pickup','FundraiserFairbankController@readyTopickup')->name('fairbank2024-ready-to-pickup');
    Route::post('fairbank/add-cart','FundraiserFairbankController@addCart')->name('fairbank2024-add-cart');
    
   
    
    Route::get('/{slug}','FrontendController@page_view');
    Route::any('/{page_slug}/{category}/{city}','PageBuilderController@index')->name('product-page-builder');

    
    // Route::get('/{redirect}', function ($url) {
    //     $redirect = \App\Models\Redirect::whereFromUrl(ltrim(request()->getRequestUri(),'/'))->firstOrfail();
    //     return redirect(url($redirect->to_url), 301);
    // })->where('redirect', '.*');
    
}); 
