<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;
    public function items()
    {
        return $this->hasMany(Item::class);
    }
   
	public function basket()
    {
    	return $this->belongsTo('App\Models\Basket');
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }

}
