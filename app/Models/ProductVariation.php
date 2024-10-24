<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;
    
    public function variationkey() {
        return $this->hasMany('App\Models\VariationKey','variation_id','id');
    } 
    
    public function products(){
         return $this->hasMany('App\Models\Product','id','product_id');
    }
    
    public function nutritions(){
         return $this->hasMany('App\Models\NutritionExplorer','variation_id', 'id');
    }
    
    public function productShipping(){
        return $this->hasMany('App\Models\ProductShipping','product_id','product_id');
    }

    public function getBoxQuantityAttribute($qty){
        return $qty ? : 1;
    }
    
    public function getPriceAttribute($price){
        if(auth()->check()){
            return auth()->user()->prices()->whereProductId($this->product_id)->first()->price ?? $price;
        }
        return $price;
    }
}
