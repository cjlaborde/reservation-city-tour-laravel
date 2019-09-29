<?php

namespace App;/* Part 16 */

use Illuminate\Database\Eloquent\Model;/* Part 16 */

/* Part 16 */
class Comment extends Model
{

    use Enjoythetrip\Presenters\CommentPresenter; /* Part 16 */

    public $timestamps = false; /* Part 25 */

    /* Part 16 */
    public function commentable()
    {
        return $this->morphTo();
    }

    /* Part 16 */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
