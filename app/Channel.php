<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Link;
use App\Category;
use App\Region;
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

    public function addlinksToChannel($links, $channeld) {
        foreach($links as $link){
            $newLink = new Link([
                'channel_id' => $channeld,
                'url' => $link
            ]);
            $newLink->save();
        }
    }
    public function updateLinks($links, $channel) {
        foreach($channel->links as $link){
            $link->delete();
        }
        $this->addlinksToChannel($links, $channel->id);
    }

    public function links() {
        return $this->hasMany(Link::class);
    }

    public function Category() {
        return $this->belongsTo(Category::class);
    }

    public function Region() {
        return $this->belongsTo(Region::class);
    }
}
