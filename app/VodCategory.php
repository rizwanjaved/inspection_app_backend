<?php

namespace App;
use App\Vod;

use Illuminate\Database\Eloquent\Model;

class VodCategory extends Model
{
    //
    protected $guarded = ['id'];    
     protected $fillable = ['name'];

    public function vods() {
        return $this->hasMany(Vod::class, 'category_id');
    }
}
