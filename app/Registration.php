<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    //
    public function car() {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
