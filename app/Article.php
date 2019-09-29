<?php

namespace App; /* Part 16 */

use Illuminate\Database\Eloquent\Model; /* Part 16 */
use Illuminate\Support\Facades\Auth; /* Part 24 */

/* Part 16 */
class Article extends Model
{

    use Enjoythetrip\Presenters\ArticlePresenter; /* Part 23 */

    protected $guarded = []; /* Part 45 */
    public $timestamps = false; /* Part 45 */

    /* Part 16 */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /* Part 22 */
    public function users()
    {
        return $this->morphToMany('App\User', 'likeable');
    }

    /* Part 22 */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    /* Part 22 */
    public function object()
    {
        return $this->belongsTo('App\TouristObject','object_id');
    }

    /* Part 24 */
    public function isLiked()
    {
        return $this->users()->where('user_id', Auth::user()->id)->exists();
    }
}
