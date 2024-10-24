<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function addon_products() {
      return $this->hasMany('App\Models\AddonProduct','product_id','product_id');
    }
    
    public function parentItem()
    {
        return $this->hasMany('App\Models\Item','parent','id');
    }
        
    public function product(){
         return $this->hasOne('App\Models\Product','id','product_id');
    }
    
      
    public function product_variation(){
         return $this->hasOne('App\Models\ProductVariation','id','product_variation_id');
    }
    
    
     
    public function productShipping(){
        return $this->hasMany('App\Models\ProductShipping','product_id','product_id');
    }
    
    // public function getPriceAmountAttribute($value)
    // {
    //       $price = $value;
    //     $today = now()->format('Y-m-d');

    //     if ($this->has_special_price == 1 &&
    //         $this->special_price_from <= $today &&
    //         $this->special_price_to >= $today
    //     ) {
    //         return $this->special_price;
    //     } else {
    //         return $price;
    //     }
    // }
}
