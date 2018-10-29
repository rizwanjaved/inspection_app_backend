<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    
    protected $guarded = ['id'];    

    public function category() {
        return $this->belongsTo(VodCategory::class, 'category_id');
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }



}
