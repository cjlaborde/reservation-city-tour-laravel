<?php

namespace App\Http\Middleware; /* Part 37 */

use Closure; /* Part 37 */
use Illuminate\Support\Facades\Auth; /* Part 37 */

/* Part 37 */
class CheckAdmin
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
        /* Part 37 */
        if( Auth::user()->hasRole(['admin']) )
            return $next($request);
        else
            return redirect('/admin');
    }
}
