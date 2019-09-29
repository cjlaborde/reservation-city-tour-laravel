<?php

namespace App\Policies; /* Lecture 47 */

use App\User; /* Lecture 47 */
use Illuminate\Auth\Access\HandlesAuthorization; /* Lecture 47 */


 /* Lecture 47 */
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


    /* Lecture 47 */
    public function checkOwner(User $user, \App\Room $room)
    {
        return $user->id === $room->object->user_id;
    }
}
