<?php

namespace App;  
use App\VodCategory;

use Illuminate\Database\Eloquent\Model;

class Vod extends Model
{
    protected $guarded = ['id'];    

    public function category() {
        return $this->belongsTo(VodCategory::class, 'category_id');
    }
     
}
