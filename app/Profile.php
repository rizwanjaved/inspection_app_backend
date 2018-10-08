<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{
    //
    protected $guarded = ['id'];    

    public function parent() {
        return $this->belongsTo(User::class, 'parent_id');
    }
}
