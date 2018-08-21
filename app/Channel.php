<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Link;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Channel extends Model
{
    use SoftDeletes;

    // use Sluggable;
    // use SluggableScopeHelpers;

    protected $dates = ['deleted_at'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    // public function sluggable()
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'title'
    //         ]
    //     ];
    // }

    protected $guarded = ['id'];

    public function AddlinksToChannel($links, $channeld) {
        foreach($links as $link){
            $newLink = new Link([
                'channel_id' => $channeld,
                'url' => $link
            ]);
            $newLink->save();
        }
        return true;
    }
}
