<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
     function tax_values(){
        return $this->hasMany('App\TaxValue','tax_id','id');
    }
}
