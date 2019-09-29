<?php

namespace App\Enjoythetrip\Presenters; /* Part 16 */

/* Part 16 */
trait UserPresenter {

    /* Part 16 */
    public function getFullNameAttribute()
    {
        return $this->name.' '.$this->susername;
    }

}
