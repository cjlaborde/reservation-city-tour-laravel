<?php

namespace App; /* Lecture 16 */

use Illuminate\Database\Eloquent\Model; /* Lecture 16 */

/* Lecture 16 */
class Article extends Model
{

    use Enjoythetrip\Presenters\ArticlePresenter; /* Lecture 23 */

    /* Lecture 16 */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /* Lecture 22 */
    public function users()
    {
        return $this->morphToMany('App\User', 'likeable');
    }

    /* Lecture 22 */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    /* Lecture 22 */
    public function object()
    {
        return $this->belongsTo('App\TouristObject','object_id');
    }
}
