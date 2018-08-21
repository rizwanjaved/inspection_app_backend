<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    protected $guarded = ['id'];
    protected $fillable = ['name', 'slug'];
}
