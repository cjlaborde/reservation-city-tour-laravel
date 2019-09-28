<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Enjoythetrip\Interfaces\BackendRepositoryInterface; /* Lecture 27 */
use App\Enjoythetrip\Gateways\BackendGateway; /* Lecture 27 */
use Illuminate\Support\Facades\Auth; /* Lecture 39 */
use Illuminate\Support\Facades\Storage; /* Lecture 40 */


class BackendController extends Controller
{
    use \App\Enjoythetrip\Traits\Ajax; /* Lecture 30 */

    /* Lecture 27 */
    public function __construct(BackendGateway $backendGateway, BackendRepositoryInterface $backendRepository)
    {

        $this->middleware('CheckOwner')->only(['confirmReservation','saveRoom','saveObject','myObjects']);/* Lecture 36 */

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
    public function myobjects()
    {
        return view('backend.myobjects');
    }

    /* Lecture 6 */
    public function profile(Request $request /* Lecture 39 */)
    {
        /* Lecture 39 */
        if ($request->isMethod('post'))
        {

            $user = $this->bG->saveUser($request);

            if ($request->hasFile('userPicture'))
            {
                $path = $request->file('userPicture')->store('users', 'public'); /* Lecture 40 */

                /* Lecture 40 */
                if (count($user->photos) != 0)
                {
                    $photo = $this->bR->getPhoto($user->photos->first()->id);

                    Storage::disk('public')->delete($photo->storagepath);
                    $photo->path = $path;

                    $this->bR->updateUserPhoto($user,$photo);

                }
                else
                {
                    $this->bR->createUserPhoto($user,$path);
                }

            }


            return redirect()->back();
        }

        return view('backend.profile',['user'=>Auth::user()]/* Lecture 39 */);
    }

    /* Lecture 39 */
    public function deletePhoto($id)
    {

        $photo = $this->bR->getPhoto($id); /* Lecture 40 */

        $this->authorize('checkOwner', $photo);

        $path = $this->bR->deletePhoto($photo); /* Lecture 40 */

        Storage::disk('public')->delete($path); /* Lecture 40 */

        return redirect()->back();
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
