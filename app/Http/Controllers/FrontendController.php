<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enjoythetrip\Interfaces\FrontendRepositoryInterface; /* Part 12 Part 13 FrontendRepositoryInterface  */
use App\Enjoythetrip\Gateways\FrontendGateway; /* Part 17 */
use App\Events\OrderPlacedEvent; /* Part 54 */
use Illuminate\Support\Facades\Cache; /* Part 55 */

class FrontendController extends Controller
{
    /* Part 12 */
    public function __construct(FrontendRepositoryInterface $frontendRepository, FrontendGateway $frontendGateway /* Part 17 */) /* Part 13 FrontendRepositoryInterface */
    {

        $this->middleware('auth')->only(['makeReservation','addComment','like','unlike']); /* Part 24 */

        $this->fR = $frontendRepository;
        $this->fG = $frontendGateway; /* Part 17 */
    }


    /* Part 6 */
    public function index()
    {
        $objects = $this->fR->getObjectsForMainPage(); /* Part 12 */
        //dd($objects);  /* Part 12 */
        return view('frontend.index',['objects'=>$objects]); /* Part 12 second argument */
    }

    /* Part 6 */
    public function article($id/* Part 22 */)
    {
        $article = $this->fR->getArticle($id); /* Part 22 */
        return view('frontend.article',compact('article')/* Part 22 */);
    }

    /* Part 6 */
    public function object($id) /* Part 15 $id */
    {
        $object = $this->fR->getObject($id); /* Part 15 */
        return view('frontend.object',['object'=>$object]); /* Part 16 second argument */
    }

    /* Part 6 */
    public function person($id/* Part 23 */)
    {
        $user = $this->fR->getPerson($id); /* Part 23 */
        return view('frontend.person', ['user'=>$user]/* Part 23 */);
    }

    /* Part 6 */
    public function room($id /* Part 20 */)
    {
        $room = $this->fR->getRoom($id); /* Part 20 */
        return view('frontend.room',['room'=>$room]/* Part 20 */);
    }


    /* Part 20 */
    public function ajaxGetRoomReservations($id)
    {

        $reservations = $this->fR->getReservationsByRoomId($id);

        return response()->json([
            'reservations'=>$reservations
        ]);
    }

    /* Part 6 */
    public function roomsearch(Request $request /* Part 18 */)
    {
        /* Part 18 */
        if($city = $this->fG->getSearchResults($request))
        {
            return view('frontend.roomsearch',['city'=>$city]);
        }
        else /* Part 18 */
        {
            if (!$request->ajax())
            return redirect('/')->with('norooms', __('No offers were found matching the criteria'));
        }

    }


    /* Part 17 */
    public function searchCities(Request $request)
    {

        $results = $this->fG->searchCities($request);

        return response()->json($results);
    }

    /* Part 24 */
    public function like($likeable_id, $type, Request $request)
    {
        $this->fR->like($likeable_id, $type, $request);

        Cache::flush(); /* Part 55 */

        return redirect()->back();
    }


    /* Part 24 */
    public function unlike($likeable_id, $type, Request $request)
    {
        $this->fR->unlike($likeable_id, $type, $request);

        Cache::flush(); /* Part 55 */

        return redirect()->back();
    }


    /* Part 25 */
    public function addComment($commentable_id, $type, Request $request)
    {
        $this->fG->addComment($commentable_id, $type, $request);

        Cache::flush(); /* Part 55 */

        return redirect()->back();
    }


    /* Part 26 */
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

            event( new OrderPlacedEvent($reservation) ); /* Part 54 */

            if (!$request->ajax())
            return redirect()->route('adminHome');
            else
            return response()->json(['reservation'=>$reservation]);
        }

    }


}
