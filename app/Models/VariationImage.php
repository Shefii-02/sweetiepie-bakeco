<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationImage extends Model
{
    // protected $table = 'variation_images_old';
    use HasFactory;
    public function images_list() {
        return $this->hasMany('App\Models\ProductImage','id','picture_id');
    } 
}
