<?php

use Illuminate\Support\Facades\Route;


Route::get('/nutrition-explorer', function () {
    return view('frontend.nutrition-explorer');
});

Route::post('/nutrition-explorer', 'FrontendController@nutritions');
Route::any('/nutrition-explorer/{slug}','ProductController@nutrition_product_single');