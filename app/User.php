<?php namespace App;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentTaggable\Taggable;
use Laravel\Passport\HasApiTokens;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Authenticatable;
use App\Profile;



class User extends EloquentUser//Authenticatable
{
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'users';

	/**
	 * The attributes to be fillable from the model.
	 *
	 * A dirty hack to allow fields to be fillable by calling empty fillable array
	 *
	 * @var array
	 */
    use HasApiTokens;
	use Taggable;
	Use Authenticatable;

	protected $fillable = [];
	protected $guarded = ['id'];
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	* To allow soft deletes
	*/
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $with = ['profiles'];

    protected $appends = ['full_name'];
    public function getFullNameAttribute()
    {
        return str_limit($this->first_name . ' ' . $this->last_name, 30);
    }
    public function country() {
        return $this->belongsTo( Country::class );
	}
	public function profiles() {
        return $this->hasMany(Profile::class, 'parent_id');
	}
	public function car() {
        return $this->hasOne(Car::class, 'owner_id');
	}
	

}
