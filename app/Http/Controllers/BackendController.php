<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Enjoythetrip\Interfaces\BackendRepositoryInterface; /* Lecture 27 */
use App\Enjoythetrip\Gateways\BackendGateway; /* Lecture 27 */

class BackendController extends Controller
{
    use \App\Enjoythetrip\Traits\Ajax; /* Lecture 30 */

    /* Lecture 27 */
    public function __construct(BackendGateway $backendGateway, BackendRepositoryInterface $backendRepository)
    {
        $this->bG = $backendGateway;
        $this->bR = $backendRepository;
    }


    /* Lecture 6 */
    public function index(Request $request /* Lecture 27 */)
    {
        $objects = $this->bG->getReservations($request); /* Lecture 27 */
        return view('backend.index',['objects'=>$objects]/* Lecture 27 */);
    }

    /* Lecture 6 */
    public function cities()
    {
        return view('backend.cities');
    }

    /* Lecture 6 */
    public function myobjects()
    {
        return view('backend.myobjects');
    }

    /* Lecture 6 */
    public function profile()
    {
        return view('backend.profile');
    }

    /* Lecture 6 */
    public function saveobject()
    {
        return view('backend.saveobject');
    }

    /* Lecture 6 */
    public function saveroom()
    {
        return view('backend.saveroom');
    }


    /* Lecture 33 */
    public function confirmReservation($id)
    {
        $reservation = $this->bR->getReservation($id); /* Lecture 35 */

        $this->authorize('reservation', $reservation); /* Lecture 35 */

        $this->bR->confirmReservation($reservation); /* Lecture 35 */

        $this->flashMsg ('success', __('Reservation has been confirmed'));  /* Lecture 35 */


        if (!\Request::ajax()) /* Lecture 35 */
        return redirect()->back(); /* Lecture 35 */
    }


    /* Lecture 33 */
    public function deleteReservation($id)
    {
        $reservation = $this->bR->getReservation($id); /* Lecture 35 */

        $this->authorize('reservation', $reservation); /* Lecture 35 */

        $this->bR->deleteReservation($reservation); /* Lecture 35 */

        $this->flashMsg ('success', __('Reservation has been deleted'));  /* Lecture 35 */

        if (!\Request::ajax()) /* Lecture 35 */
        return redirect()->back(); /* Lecture 34 */
    }

}
