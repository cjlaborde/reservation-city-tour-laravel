<?php
/*
|--------------------------------------------------------------------------
| app/Enjoythetrip/Presenters/ObjectPresenter.php *** Copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------------------------
*/
namespace App\Enjoythetrip\Presenters; /* Lecture 23 */

/* Lecture 23 */
trait ObjectPresenter {
    
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
    
    public function getLinkAttribute()
    {
        return route('object',['id'=>$this->id]);
    }
    
    public function getTypeAttribute()
    {
        return $this->name.' object';
    }
    
}

