<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    //
    public function inspectedBy() {
        return $this->belongsTo(User::class, 'inspected_by');
    }
     public function appointment() {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
    public function car() {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
