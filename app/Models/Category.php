<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function category_products(){
         return $this->hasMany('App\Models\CategoryProduct', 'category_id','master_id');
    }
    public function products()
	{
		return $this->belongsToMany('App\Models\Product')->withPivot('position');
	}

    public function parent() 
    {
    	return $this->belongsTo(static::class, 'parent_id');
  	}

	public function children() 
  	{
	    return $this->hasMany(static::class, 'parent_id');
	}
}
