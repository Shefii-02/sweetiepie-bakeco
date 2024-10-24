<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    public function holidaytiming() {
        return $this->hasMany('App\Models\HolidayTiming','holiday_id','id');
    }
}
