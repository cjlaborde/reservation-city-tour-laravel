<?php

namespace App\Policies; /* Part 43 */

use App\{User,TouristObject}; /* Part 43 */
use Illuminate\Auth\Access\HandlesAuthorization; /* Part 43 */


 /* Part 43 */
class ObjectPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function checkOwner(User $user, TouristObject $object)
    {
        return $user->id === $object->user_id;
    }
}
