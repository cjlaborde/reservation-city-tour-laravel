<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enjoythetrip\Interfaces\FrontendRepositoryInterface; /* Lecture 12 Lecture 13 FrontendRepositoryInterface  */
use App\Enjoythetrip\Gateways\FrontendGateway; /* Lecture 17 */

class FrontendController extends Controller
{
    /* Lecture 12 */
    public function __construct(FrontendRepositoryInterface $frontendRepository, FrontendGateway $frontendGateway /* Lecture 17 */) /* Lecture 13 FrontendRepositoryInterface */
    {

        $this->middleware('auth')->only(['makeReservation','addComment','like','unlike']); /* Lecture 24 */

        $this->fR = $frontendRepository;
        $this->fG = $frontendGateway; /* Lecture 17 */
    }


    /* Lecture 6 */
    public function index()
    {
        $objects = $this->fR->getObjectsForMainPage(); /* Lecture 12 */
        //dd($objects);  /* Lecture 12 */
        return view('frontend.index',['objects'=>$objects]); /* Lecture 12 second argument */
    }

    /* Lecture 6 */
    public function article($id/* Lecture 22 */)
    {
        $article = $this->fR->getArticle($id); /* Lecture 22 */
        return view('frontend.article',compact('article')/* Lecture 22 */);
    }

    /* Lecture 6 */
    public function object($id) /* Lecture 15 $id */
    {
        $object = $this->fR->getObject($id); /* Lecture 15 */
        return view('frontend.object',['object'=>$object]); /* Lecture 16 second argument */
    }

    /* Lecture 6 */
    public function person($id/* Lecture 23 */)
    {
        $user = $this->fR->getPerson($id); /* Lecture 23 */
        return view('frontend.person', ['user'=>$user]/* Lecture 23 */);
    }

    /* Lecture 6 */
    public function room($id /* Lecture 20 */)
    {
        $room = $this->fR->getRoom($id); /* Lecture 20 */
        return view('frontend.room',['room'=>$room]/* Lecture 20 */);
    }


    /* Lecture 20 */
    public function ajaxGetRoomReservations($id)
    {

        $reservations = $this->fR->getReservationsByRoomId($id);

        return response()->json([
            'reservations'=>$reservations
        ]);
    }

    /* Lecture 6 */
    public function roomsearch(Request $request /* Lecture 18 */)
    {
        /* Lecture 18 */
        if($city = $this->fG->getSearchResults($request))
        {
            return view('frontend.roomsearch',['city'=>$city]);
        }
        else /* Lecture 18 */
        {
            if (!$request->ajax())
            return redirect('/')->with('norooms', __('No offers were found matching the criteria'));
        }

    }


    /* Lecture 17 */
    public function searchCities(Request $request)
    {

        $results = $this->fG->searchCities($request);

        return response()->json($results);
    }

    /* Lecture 24 */
    public function like($likeable_id, $type, Request $request)
    {
        $this->fR->like($likeable_id, $type, $request);

        return redirect()->back();
    }


    /* Lecture 24 */
    public function unlike($likeable_id, $type, Request $request)
    {
        $this->fR->unlike($likeable_id, $type, $request);

        return redirect()->back();
    }


    /* Lecture 25 */
    public function addComment($commentable_id, $type, Request $request)
    {
        $this->fG->addComment($commentable_id, $type, $request);

        return redirect()->back();
    }


    /* Lecture 26 */
    public function makeReservation($room_id, $city_id, Request $request)
    {

        $avaiable = $this->fG->checkAvaiableReservations($room_id, $request);

        if(!$avaiable)
        {
            if (!$request->ajax())
            {
                $request->session()->flash('reservationMsg', __('There are no vacancies'));
                return redirect()->route('room',['id'=>$room_id,'#reservation']);
            }

            return response()->json(['reservation'=>false]);
        }
        else
        {
            $reservation = $this->fG->makeReservation($room_id, $city_id, $request);

            if (!$request->ajax())
            return redirect()->route('adminHome');
            else
            return response()->json(['reservation'=>$reservation]);
        }

    }


}
