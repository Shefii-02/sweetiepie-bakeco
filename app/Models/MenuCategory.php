<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class MenuCategory extends Model
{
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    
    protected $table = 'menu_categories';
    
    public function products() {
        return $this->hasMany('App\Models\Product','menu_category_id');
    }
    
     public function product_list() {
      return $this->hasMany('App\Models\MenucategoryProducts','category_id','id');
    }
    
    
    
 
}