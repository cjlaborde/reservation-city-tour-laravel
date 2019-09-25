<?php
/*
|--------------------------------------------------------------------------
| app/TouristObject.php *** Copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------------------------
*/

namespace App; /* Lecture 12 */

use Illuminate\Database\Eloquent\Model; /* Lecture 12 */

/* Lecture 12 */
class TouristObject extends Model
{

    protected $table = 'objects';
    /* Lecture 15 */
    public function scopeOrdered($query)
    {
        return $query->orderBy('name', 'asc');
    }


    /* Lecture 14 */
    public function city()
    {
        return $this->belongsTo('App\City');
    }
    /* Lecture 14 */
    # users have many images
    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    /* Lecture 16 */
    // Many uses can like an TouristObject hence many to many morphToMany
    public function users()
    {
        return $this->morphToMany('App\User', 'likeable');
    }

    /* Lecture 16 */
    public function address()
    {
        return $this->hasOne('App\Address','object_id');
    }

    /* Lecture 16 */
    public function rooms()
    {
        return $this->hasMany('App\Room','object_id');
    }

    /* Lecture 16 */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    /* Lecture 16 */
    public function articles()
    {
        return $this->hasMany('App\Article','object_id');
    }
}
