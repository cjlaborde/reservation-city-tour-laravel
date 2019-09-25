<?php

namespace App; /* Lecture 16 */

use Illuminate\Database\Eloquent\Model; /* Lecture 16 */

/* Lecture 16 */
class Article extends Model
{
    /* Lecture 16 */
    // each article was wrote by one user that user has many articles
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
