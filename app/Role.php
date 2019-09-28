<?php

namespace App; /* Lecture 27 */

use Illuminate\Database\Eloquent\Model; /* Lecture 27 */

class Role extends Model
{

    public $guarded = []; /* Lecture 36 */
    public $timestamps = false; /* Lecture 36 */


    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
