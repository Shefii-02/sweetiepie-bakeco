<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    public function products(){
        return $this->hasMany('App\Models\Product', 'id','product_id');
    }
    
}
