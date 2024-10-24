<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }
    public function address()
    {
        return $this->hasMany(Address::class);
    }
    
    public function items()
	{
		return $this->hasMany('App\Models\Item');
	}
	public function orderItems()
	{
		return $this->hasMany('App\Models\Item','basket_id','basket_id');
	}
	
}
