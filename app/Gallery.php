<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //
    protected $guarded = ['id'];   

     public function profile() {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

}
