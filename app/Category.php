<?php

namespace App;
use App\Channel;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
      protected $guarded = ['id'];
      protected $fillable = ['name', 'slug'];
      protected $with=['channels'];


  public function channels() {
    return $this->hasMany(Channel::class);
  }
}
