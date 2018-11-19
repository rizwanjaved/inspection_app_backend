<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    
    protected $guarded = ['id'];
     protected $with = ['type'];    

    public function category() {
        return $this->belongsTo(VodCategory::class, 'category_id');
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function type() {
        return $this->belongsTo(CarType::class, 'car_type_id');
    }



}
