<?php

namespace App\Policies; /* Part 39 */

use App\{User,Photo}; /* Part 39 */
use Illuminate\Auth\Access\HandlesAuthorization; /* Part 39 */


/* Part 39 */
class PhotoPolicy
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


    /* Part 39 */
    public function checkOwner(User $user, Photo $photo)
    {
        if($photo->photoable_type == 'App\User')
        return $user->id === $photo->photoable_id;
        elseif($photo->photoable_type == 'App\TouristObject')
        return $user->id === $photo->photoable->user_id;
        elseif($photo->photoable_type == 'App\Room')
        return $user->id === $photo->photoable->object->user_id;

    }


}
