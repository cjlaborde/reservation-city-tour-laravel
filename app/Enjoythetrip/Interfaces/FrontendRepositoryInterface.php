<?php
/*
|--------------------------------------------------------------------------
| app/Enjoythetrip/Interfaces/FrontendRepositoryInterface.php *** Copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------------------------
*/

namespace App\Enjoythetrip\Interfaces; /* Part 13 */


/* Part 13 */
interface FrontendRepositoryInterface   {

    /* Part 13 */
    public function getObjectsForMainPage();

    /* Part 15 */
    public function getObject($id);
}

