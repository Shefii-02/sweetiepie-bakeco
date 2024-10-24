<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class HomepageProduct extends Model
{
    
    public function product_list() {
      return $this->hasMany('App\Models\HomepageProductList','homepage_id','id');
    }
}