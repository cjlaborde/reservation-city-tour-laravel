<?php
/*
|--------------------------------------------------------------------------
| app/City.php *** Copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------------------------
*/

namespace App; /* Part 14 */

use Illuminate\Database\Eloquent\Model; /* Part 14 */

/* Part 14 */
class City extends Model
{
    //protected $table = 'table_name'; /* Part 14 */

    protected $guarded = []; /* Part 38 */
    public $timestamps = false; /* Part 38 */


    /* Part 19 */
    public function rooms()
    {
        return $this->hasManyThrough('App\Room', 'App\TouristObject','city_id','object_id');
    }


}
