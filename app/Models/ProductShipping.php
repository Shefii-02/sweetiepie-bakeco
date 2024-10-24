<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShipping extends Model
{
    use HasFactory;
     public function shipping(){
        return $this->hasOne('App\Models\Shipping','id','shipping_id');
    }
}
