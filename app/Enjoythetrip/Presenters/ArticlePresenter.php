<?php
/*
|--------------------------------------------------------------------------
| app/Enjoythetrip/Presenters/ArticlePresenter.php *** Copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------------------------
*/
namespace App\Enjoythetrip\Presenters; /* Part 23 */

/* Part 23 */
trait ArticlePresenter {
    

    public function getLinkAttribute()
    {
        return route('article',['id'=>$this->id]);
    }
    
    public function getTypeAttribute()
    {
        return $this->title.' article';
    }
    
}

