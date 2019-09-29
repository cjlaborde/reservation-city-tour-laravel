<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Enjoythetrip\Interfaces\BackendRepositoryInterface; /* Part 27 */
use App\Enjoythetrip\Gateways\BackendGateway; /* Part 27 */
use Illuminate\Support\Facades\Auth; /* Part 39 */
use Illuminate\Support\Facades\Storage; /* Part 40 */
use App\Events\ReservationConfirmedEvent; /* Part 54 */
use Illuminate\Support\Facades\Cache; /* Part 55 */


class BackendController extends Controller
{
    use \App\Enjoythetrip\Traits\Ajax; /* Part 30 */

    /* Part 27 */
    public function __construct(BackendGateway $backendGateway, BackendRepositoryInterface $backendRepository)
    {

        $this->middleware('CheckOwner')->only(['confirmReservation','saveRoom','saveObject','myObjects']);/* Part 36 */

        $this->bG = $backendGateway;
        $this->bR = $backendRepository;
    }


    /* Part 6 */
    public function index(Request $request /* Part 27 */)
    {
        $objects = $this->bG->getReservations($request); /* Part 27 */
        return view('backend.index',['objects'=>$objects]/* Part 27 */);
    }

    /* Part 6 */
    public function myobjects(Request $request /* Part 46 */)
    {
        $objects = $this->bR->getMyObjects($request); /* Part 46 */
        //dd($objects); /* Part 46 */

        return view('backend.myobjects',['objects'=>$objects]/* Part 46 */);
    }

    /* Part 6 */
    public function profile(Request $request /* Part 39 */)
    {
        /* Part 39 */
        if ($request->isMethod('post'))
        {

            $user = $this->bG->saveUser($request);

            if ($request->hasFile('userPicture'))
            {
                $path = $request->file('userPicture')->store('users', 'public'); /* Part 40 */

                /* Part 40 */
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

        return view('backend.profile',['user'=>Auth::user()]/* Part 39 */);
    }

    /* Part 39 */
    public function deletePhoto($id)
    {

        $photo = $this->bR->getPhoto($id); /* Part 40 */

        $this->authorize('checkOwner', $photo);

        $path = $this->bR->deletePhoto($photo); /* Part 40 */

        Storage::disk('public')->delete($path); /* Part 40 */

        Cache::flush(); /* Part 55 */

        return redirect()->back();
    }


    /* Part 6 */
    public function saveobject($id = null, Request $request /* Part 41 two args */)
    {
        /* Part 41 */
        if($request->isMethod('post'))
        {
            if($id)
            $this->authorize('checkOwner', $this->bR->getObject($id));

            $this->bG->saveObject($id, $request);

            Cache::flush(); /* Part 55 */

            if($id)
            return redirect()->back();
            else
            return redirect()->route('myObjects');

        }


        /* Part 41 */
        if($id)
        return view('backend.saveobject',['object'=>$this->bR->getObject($id),'cities'=>$this->bR->getCities()]);
        else
        return view('backend.saveobject',['cities'=>$this->bR->getCities()]);
    }

    /* Part 47 */
    public function saveRoom($id = null, Request $request)
    {

        if($request->isMethod('post'))
        {
            if($id) // editing room
            $this->authorize('checkOwner', $this->bR->getRoom($id));
            else // adding a new room
            $this->authorize('checkOwner', $this->bR->getObject($request->input('object_id')));

            $this->bG->saveRoom($id, $request);

            Cache::flush(); /* Part 55 */

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

    /* Part 47 */
    public function deleteRoom($id)
    {
        $room =  $this->bR->getRoom($id); /* Part 48 */

        $this->authorize('checkOwner', $room); /* Part 48 */

        $this->bR->deleteRoom($room); /* Part 48 */

        Cache::flush(); /* Part 55 */

        return redirect()->back(); /* Part 48 */
    }


    /* Part 33 */
    public function confirmReservation($id)
    {
        $reservation = $this->bR->getReservation($id); /* Part 35 */

        $this->authorize('reservation', $reservation); /* Part 35 */

        $this->bR->confirmReservation($reservation); /* Part 35 */

        $this->flashMsg ('success', __('Reservation has been confirmed'));  /* Part 35 */

        event( new ReservationConfirmedEvent($reservation) ); /* Part 54 */

        if (!\Request::ajax()) /* Part 35 */
        return redirect()->back(); /* Part 35 */
    }


    /* Part 33 */
    public function deleteReservation($id)
    {
        $reservation = $this->bR->getReservation($id); /* Part 35 */

        $this->authorize('reservation', $reservation); /* Part 35 */

        $this->bR->deleteReservation($reservation); /* Part 35 */

        $this->flashMsg ('success', __('Reservation has been deleted'));  /* Part 35 */

        if (!\Request::ajax()) /* Part 35 */
        return redirect()->back(); /* Part 34 */
    }


    /* Part 44 */
    public function deleteArticle($id)
    {
        $article =  $this->bR->getArticle($id); /* Part 45 */

        $this->authorize('checkOwner', $article); /* Part 45 */

        $this->bR->deleteArticle($article); /* Part 45 */

        Cache::flush(); /* Part 55 */

        return redirect()->back(); /* Part 45 */
    }


    /* Part 44 */
    public function saveArticle($object_id = null, Request $request /* Part 45 */)
    {
        /* Part 45 */
        if(!$object_id)
        {
           $this->flashMsg ('danger', __('First add an object'));
           return redirect()->back();
        }

        $this->authorize('checkOwner', $this->bR->getObject($object_id)); /* Part 45 */

        $this->bG->saveArticle($object_id,$request); /* Part 45 */

        Cache::flush(); /* Part 55 */

        return redirect()->back(); /* Part 45 */
    }


    /* Part 46 */
    public function deleteObject($id)
    {
        $this->authorize('checkOwner', $this->bR->getObject($id));

        $this->bR->deleteObject($id);

        Cache::flush(); /* Part 55 */

        return redirect()->back();

    }


    /* Part 53 */
    public function getNotifications()
    {
        return response()->json( $this->bR->getNotifications() ); // for mobile
    }


    /* Part 53 */
    public function setReadNotifications(Request $request)
    {
        return  $this->bR->setReadNotifications($request); // for mobile
    }


}
