<?php

namespace App; /* Part 27 */

use Illuminate\Database\Eloquent\Model; /* Part 27 */

class Role extends Model
{

    public $guarded = []; /* Part 36 */
    public $timestamps = false; /* Part 36 */


    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
