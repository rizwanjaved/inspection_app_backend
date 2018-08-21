<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Channel;

class Event extends Model
{
    //
    protected $guarded = ['id'];

     public function channels()
    {
       return $this->belongsToMany('App\Channel', 'channel_event', 'event_id', 'channel_id');
    }

    public function attachChannels($chs) {
        foreach($chs as $chId){
            $channel = Channel::find($chId);
            $this->channels()->attach($channel);
        }
    }
}
