<?php

namespace App\Policies; /* Part 45 */

use App\User; /* Part 45 */
use Illuminate\Auth\Access\HandlesAuthorization; /* Part 45 */


/* Part 45 */
class ArticlePolicy
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

    /* Part 45 */
    public function checkOwner(User $user, \App\Article $article)
    {
        return $user->id === $article->user_id;
    }
}
