<?php

namespace App\Policies; /* Part 47 */

use App\User; /* Part 47 */
use Illuminate\Auth\Access\HandlesAuthorization; /* Part 47 */


 /* Part 47 */
class RoomPolicy
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


    /* Part 47 */
    public function checkOwner(User $user, \App\Room $room)
    {
        return $user->id === $room->object->user_id;
    }
}
