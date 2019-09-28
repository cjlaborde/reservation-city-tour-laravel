<?php
/*
|--------------------------------------------------------------------------
| app/City.php *** Copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------------------------
*/

namespace App; /* Lecture 14 */

use Illuminate\Database\Eloquent\Model; /* Lecture 14 */

/* Lecture 14 */
class City extends Model
{
    //protected $table = 'table_name'; /* Lecture 14 */

    protected $guarded = []; /* Lecture 38 */
    public $timestamps = false; /* Lecture 38 */


    /* Lecture 19 */
    public function rooms()
    {
        return $this->hasManyThrough('App\Room', 'App\TouristObject','city_id','object_id');
    }


}
