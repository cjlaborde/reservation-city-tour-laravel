<?php
/*
|--------------------------------------------------------------------------
| app/Listeners/OrderPlacedEventListener.php *** Copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------------------------
*/

namespace App\Listeners;

use App\Events\OrderPlacedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notification; /* Part 54 */

class OrderPlacedEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderPlacedEvent  $event
     * @return void
     */
    public function handle(OrderPlacedEvent $event)
    {
        /* Part 54 */
        Notification::create([

            'user_id'=>$id = $event->reservation->room->object->user_id,
            'content'=>__('Reservation has been made for room :number in :object object. Day in :dayin , day out :dayout',[
                'number'=>$event->reservation->room->room_number,
                'object'=>$event->reservation->room->object->name,
                'dayin'=>$event->reservation->day_in,
                'dayout'=>$event->reservation->day_out
            ]),
            'status'=>0,

        ]);


        $memcache = new \App\Enjoythetrip\Services\FakedMemcached(); /* Part 54 */

        $memcache->addServer('localhost', 11211) or die("Could not connect"); /* Part 54 */

        $memcache->set('userid_' . $id. '_notification_timestamp',time()); /* Part 54 */
    }
}
