<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    //
    protected $guarded = ['id'];
      
    public function car() {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
