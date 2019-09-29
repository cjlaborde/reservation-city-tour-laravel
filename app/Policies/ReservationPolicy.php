<?php

namespace App\Policies; /* Part 35 */

use App\{User,Reservation}; /* Part 35 */
use Illuminate\Auth\Access\HandlesAuthorization; /* Part 35 */

/* Part 35 */
class ReservationPolicy
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

    /* Part 35 */
    public function reservation(User $user, Reservation $reservation)
    {
        if($user->hasRole(['owner','admin']))
        // room reservation belongs to user logged in.
        return $user->id === $reservation->room->object->user->id;
        else
        // otherwise just provide id column
        return $user->id === $reservation->user_id;
    }
}
