<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    protected $guarded = ['id'];    

    public function car() {
        return $this->belongsTo(Car::class, 'car_id');
    }
    public function submittedByUser() {
        return $this->belongsTo(User::class, 'submitted_by');
    }

}
