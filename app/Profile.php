<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Gallery;

class Profile extends Model
{
    //
    protected $guarded = ['id'];    

    public function parent() {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function galleryItems() {
        return $this->hasMany(Gallery::class, 'profile_id');
    }
}
