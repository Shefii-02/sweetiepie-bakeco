<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;


class Menu extends Model
{
    use HasFactory;
    
    public function parent() {
      	return $this->belongsTo(static::class, 'parent_id');
    }

  	public function children() 
    {
  	 //   return $this->hasMany(static::class, 'parent_id');
  	     // return $this->hasMany('App\Models\Menu', 'parent_id','master_id');
  	     return $this->hasMany('App\Models\Menu', 'parent_id','id');
  	 
  	}

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))->diffForHumans(Carbon::now());
    }
}
