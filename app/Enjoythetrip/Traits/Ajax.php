<?php
/*
|--------------------------------------------------------------------------
| app/Enjoythetrip/Traits/Ajax.php *** Copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------------------------
*/
namespace App\Enjoythetrip\Traits; /* Part 30 */

use Illuminate\Http\Request; /* Part 30 */

/* Part 30 */
trait Ajax {


    public function ajaxGetReservationData(Request $request)
    {

        $reservation = $this->bR->getReservationData($request);

        return response()->json([
                    'room_number' => $reservation->room->room_number,
                    'day_in' => $reservation->day_in,
                    'day_out' => $reservation->day_out,
                    'FullName' => $reservation->user->FullName,
                    'userLink' => route('person', ['id' => $reservation->user->id]),
                    'confirmResLink' => route('confirmReservation', ['id' => $reservation->id]), /* Part 33 */
                    'deleteResLink' => route('deleteReservation', ['id' => $reservation->id]), /* Part 33 */
                    'status' => $reservation->status
        ]);
    }


    /* Part 50 */
    public function ajaxSetReadNotification(Request $request)
    {
        return  $this->bR->setReadNotifications($request);
    }


    /* Part 51 */
    public function ajaxGetNotShownNotifications(Request $request)
    {

        $currentmodif = $this->bG->checkNotificationsStatus($request);

        // executed if while loop ends
        $response['notifications'] = $this->bR->getUserNotifications($request->user()->id); /* Part 52 */
        $response['timestamp'] = $currentmodif;

        return json_encode($response);
    }

    /* Part 52 */
    public function ajaxSetShownNotifications(Request $request)
    {
        return $this->bR->setShownNotifications($request);
    }

}
