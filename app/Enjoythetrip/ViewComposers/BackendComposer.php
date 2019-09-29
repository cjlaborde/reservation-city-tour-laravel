<?php
namespace App\Enjoythetrip\ViewComposers; /* Part 49 */

use Illuminate\View\View; /* Part 49 */
use App\Notification; /* Part 49 */
use Illuminate\Support\Facades\Auth; /* Part 49 */

 /* Part 49 */
class BackendComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('notifications', Notification::where('user_id', Auth::user()->id )->where('status',0)->get());
    }
}
