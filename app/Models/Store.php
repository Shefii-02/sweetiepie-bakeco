<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    
    
    
    public function store_timing() {
        return $this->hasMany('App\Models\StoreTiming');
    }
    
    public function holidaytiming() {
        return $this->hasMany('App\Models\HolidayTiming');
    }
    
     public function store_images()
    {
        return $this->hasMany('App\Models\StoreImage','store_id','id');
    }
}
