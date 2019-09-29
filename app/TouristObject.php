<?php

namespace App; /* Part 12 */

use Illuminate\Database\Eloquent\Model; /* Part 12 */
use Illuminate\Support\Facades\Auth; /* Part 24 */

/* Part 12 */
class TouristObject extends Model
{

    protected $table = 'objects';
    public $timestamps = false; /* Part 44 */

    use Enjoythetrip\Presenters\ObjectPresenter; /* Part 23 */

    /* Part 15 */
    public function scopeOrdered($query)
    {
        return $query->orderBy('name', 'asc');
    }


    /* Part 14 */
    public function city()
    {
        return $this->belongsTo('App\City');
    }

    /* Part 35 */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /* Part 14 */
    # users have many images
    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    /* Part 16 */
    // Many uses can like an TouristObject hence many to many morphToMany
    public function users()
    {
        return $this->morphToMany('App\User', 'likeable');
    }

    /* Part 16 */
    public function address()
    {
        return $this->hasOne('App\Address','object_id');
    }

    /* Part 16 */
    public function rooms()
    {
        return $this->hasMany('App\Room','object_id');
    }

    /* Part 16 */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    /* Part 16 */
    public function articles()
    {
        return $this->hasMany('App\Article','object_id');
    }

    /* Part 24 */
    public function isLiked()
    {
        return $this->users()->where('user_id', Auth::user()->id)->exists();
    }


}
