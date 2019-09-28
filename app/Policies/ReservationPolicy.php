<?php

namespace App\Policies; /* Lecture 35 */

use App\{User,Reservation}; /* Lecture 35 */
use Illuminate\Auth\Access\HandlesAuthorization; /* Lecture 35 */

/* Lecture 35 */
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

    /* Lecture 35 */
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