<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
   
    public function imagesList() {
        return $this->hasMany('App\Models\VariationImage','picture_id','id');
    } 
}
