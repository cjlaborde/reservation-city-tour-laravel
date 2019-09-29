<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Enjoythetrip\Interfaces\BackendRepositoryInterface; /* Lecture 27 */
use App\Enjoythetrip\Gateways\BackendGateway; /* Lecture 27 */
use Illuminate\Support\Facades\Auth; /* Lecture 39 */
use Illuminate\Support\Facades\Storage; /* Lecture 40 */
use App\Events\ReservationConfirmedEvent; /* Lecture 54 */


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
    public function myobjects(Request $request /* Lecture 46 */)
    {
        $objects = $this->bR->getMyObjects($request); /* Lecture 46 */
        //dd($objects); /* Lecture 46 */

        return view('backend.myobjects',['objects'=>$objects]/* Lecture 46 */);
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
    public function saveobject($id = null, Request $request /* Lecture 41 two args */)
    {
        /* Lecture 41 */
        if($request->isMethod('post'))
        {
            if($id)
            $this->authorize('checkOwner', $this->bR->getObject($id));

            $this->bG->saveObject($id, $request);

            if($id)
            return redirect()->back();
            else
            return redirect()->route('myObjects');

        }


        /* Lecture 41 */
        if($id)
        return view('backend.saveobject',['object'=>$this->bR->getObject($id),'cities'=>$this->bR->getCities()]);
        else
        return view('backend.saveobject',['cities'=>$this->bR->getCities()]);
    }

    /* Lecture 47 */
    public function saveRoom($id = null, Request $request)
    {

        if($request->isMethod('post'))
        {
            if($id) // editing room
            $this->authorize('checkOwner', $this->bR->getRoom($id));
            else // adding a new room
            $this->authorize('checkOwner', $this->bR->getObject($request->input('object_id')));

            $this->bG->saveRoom($id, $request);

            if($id)
            return redirect()->back();
            else
            return redirect()->route('myObjects');

        }

        if($id)
        return view('backend.saveroom',['room'=>$this->bR->getRoom($id)]);
        else
        return view('backend.saveroom',['object_id'=>$request->input('object_id')]);
    }

    /* Lecture 47 */
    public function deleteRoom($id)
    {
        $room =  $this->bR->getRoom($id); /* Lecture 48 */

        $this->authorize('checkOwner', $room); /* Lecture 48 */

        $this->bR->deleteRoom($room); /* Lecture 48 */

        return redirect()->back(); /* Lecture 48 */
    }


    /* Lecture 33 */
    public function confirmReservation($id)
    {
        $reservation = $this->bR->getReservation($id); /* Lecture 35 */

        $this->authorize('reservation', $reservation); /* Lecture 35 */

        $this->bR->confirmReservation($reservation); /* Lecture 35 */

        $this->flashMsg ('success', __('Reservation has been confirmed'));  /* Lecture 35 */

        event( new ReservationConfirmedEvent($reservation) ); /* Lecture 54 */

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


    /* Lecture 44 */
    public function deleteArticle($id)
    {
        $article =  $this->bR->getArticle($id); /* Lecture 45 */

        $this->authorize('checkOwner', $article); /* Lecture 45 */

        $this->bR->deleteArticle($article); /* Lecture 45 */

        return redirect()->back(); /* Lecture 45 */
    }


    /* Lecture 44 */
    public function saveArticle($object_id = null, Request $request /* Lecture 45 */)
    {
        /* Lecture 45 */
        if(!$object_id)
        {
           $this->flashMsg ('danger', __('First add an object'));
           return redirect()->back();
        }

        $this->authorize('checkOwner', $this->bR->getObject($object_id)); /* Lecture 45 */

        $this->bG->saveArticle($object_id,$request); /* Lecture 45 */

        return redirect()->back(); /* Lecture 45 */
    }


    /* Lecture 46 */
    public function deleteObject($id)
    {
        $this->authorize('checkOwner', $this->bR->getObject($id));

        $this->bR->deleteObject($id);

        return redirect()->back();

    }


    /* Lecture 53 */
    public function getNotifications()
    {
        return response()->json( $this->bR->getNotifications() ); // for mobile
    }


    /* Lecture 53 */
    public function setReadNotifications(Request $request)
    {
        return  $this->bR->setReadNotifications($request); // for mobile
    }


}
