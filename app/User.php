<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Enjoythetrip\Presenters\UserPresenter;

    public static $roles = []; /* Part 27 */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'surname'   /* Part 7 surname */
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /* Part 16 */
    public function objects()
    {
        return $this->morphedByMany('App\TouristObject', 'likeable');
    }


    /* Part 22 */
    public function larticles()
    {
        return $this->morphedByMany('App\Article', 'likeable');
    }

    /* Part 16 */
    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    /* Part 23 */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /* Part 49 */
    public function unotifications()
    {
        return $this->hasMany('App\Notification');
    }

    /* Part 27 */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }


    /* Part 27 */
    public function hasRole(array $roles)
    {

        foreach($roles as $role)
        {

            if(isset(self::$roles[$role]))
            {
                if(self::$roles[$role])  return true;

            }
            else
            {
                self::$roles[$role] = $this->roles()->where('name', $role)->exists();
                if(self::$roles[$role]) return true;
            }

        }


        return false;

    }

}
