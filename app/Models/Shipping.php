<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    
    public function rules(){
        
        return $this->hasMany('App\Models\ShippingRule','shipping_id','id');
    }
}
