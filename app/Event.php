<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Channel;
use Carbon\Carbon;

class Event extends Model
{
    //
    protected $guarded = ['id'];

    protected $appends = ['f_from', 'f_to'];

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
    public function updateChannels($channels, $event) {
        foreach($event->channels as $channel){
            $this->channels()->detach($channel);
        }
        $this->attachChannels($channels);
    }
    public function detachAllChannels() {
        foreach($this->channels as $channel){
            $this->channels()->detach($channel);
        }
        return true;
    }
    public function getFToAttribute()
    {
        return $this->formateDate($this->time_to);
    }
      public function getFFromAttribute()
    {
        return $this->formateDate($this->time_from);
    }
    public function formateDate($d) {
        $date=date_create($d); 
        return date_format($date,"d-m-Y D H:i:s:a");
    }
}
