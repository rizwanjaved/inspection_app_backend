<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contravention extends Model
{
    //
    protected $guarded = ['id']; 
    
    public function type() {
        return $this->belongsTo(ContraventionType::class, 'contravention_type');
    }
     public function car() {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
