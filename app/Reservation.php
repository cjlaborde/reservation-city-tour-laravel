<?php

namespace App; /* Part 19 */

use Illuminate\Database\Eloquent\Model; /* Part 19 */

/* Part 19 */
class Reservation extends Model
{
    public $timestamps = false; /* Part 26 */
    protected $guarded = ['id']; /* Part 26 */
    //protected $fillable = ['name']; /* Part 26 */

    /* Part 28 */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /* Part 30 */
    public function room()
    {
        return $this->belongsTo('App\Room');
    }


}
