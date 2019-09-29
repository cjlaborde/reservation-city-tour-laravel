<?php

namespace App; /* Part 16 */

use Illuminate\Database\Eloquent\Model; /* Part 16 */

/* Part 16 */
class Room extends Model
{
    public $timestamps = false; /* Part 48 */

    /* Part 16 */
    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    /* Part 17 */
    public function object()
    {
        return $this->belongsTo('App\TouristObject','object_id');
    }

    /* Part 19 */
    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }


}
