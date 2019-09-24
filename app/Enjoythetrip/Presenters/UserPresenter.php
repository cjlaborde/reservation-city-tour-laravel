<?php

namespace App\Enjoythetrip\Presenters; /* Lecture 16 */

/* Lecture 16 */
trait UserPresenter {

    /* Lecture 16 */
    public function getFullNameAttribute()
    {
        return $this->name.' '.$this->susername;
    }

}
