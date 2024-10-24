<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationKey extends Model
{
    use HasFactory;
    
    public function product_variation() {
      return $this->hasMany('App\Models\ProductVariation','id','variation_id');
    }
    
    public function productvariaton_ID(){
        return $this->hasMany('App\Models\VariationKey','variation_id','variation_id');
    }
}
