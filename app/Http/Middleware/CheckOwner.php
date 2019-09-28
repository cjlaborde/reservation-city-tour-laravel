<?php

namespace App\Http\Middleware;

use Closure; /* Lecture 36 */
use Illuminate\Support\Facades\Auth; /* Lecture 36 */


 /* Lecture 36 */
class CheckOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( Auth::user()->hasRole(['owner','admin']) )

        // if owner or admin it will be executed
        return $next($request);

        else
        // otherwise will be redirected
        return redirect('/admin');
    }
}
