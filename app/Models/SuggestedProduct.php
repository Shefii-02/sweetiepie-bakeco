<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestedProduct extends Model
{
    
    public function products(){
          return $this->hasOne('App\Models\Product','id','suggested_id');
    }
     public function thumbImages()
    {
        return $this->hasMany('App\Models\ProductImage','product_id','suggested_id')
                    ->where('type','<>','Nutritional Facts')
                    ->orderByRaw("CASE WHEN type = 'Thumbnail' THEN 0 ELSE 1 END, id ASC")
                    ->orderByRaw("CASE WHEN type = 'Main Image' THEN 0 ELSE 1 END, id ASC");;
    }
}

