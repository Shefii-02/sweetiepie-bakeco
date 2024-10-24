<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HolidayTiming extends Model
{
    use HasFactory;
     public function holiday() {
        return $this->hasMany('App\Models\Holiday','id','holiday_id');
    }
}
