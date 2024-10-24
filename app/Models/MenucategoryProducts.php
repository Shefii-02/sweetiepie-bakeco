<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MenucategoryProducts extends Model
{
    
    public function product_single() {
      return $this->hasOne('App\Models\Product','master_id','product_id');
    }
}