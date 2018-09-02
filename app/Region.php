<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Channel;


class Region extends Model
{
    //
    protected $guarded = ['id'];
    protected $fillable = ['name', 'slug'];

    public function channels() {
        return $this->hasMany(Channel::class);
    }
    
}
