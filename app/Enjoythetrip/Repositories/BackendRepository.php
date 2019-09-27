<?php
/*
|--------------------------------------------------------------------------
| app/Enjoythetrip/Repositories/BackendRepository.php *** Copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------------------------
*/

namespace App\Enjoythetrip\Repositories; /* Lecture 27 */

use App\Enjoythetrip\Interfaces\BackendRepositoryInterface;  /* Lecture 27 */
use App\{TouristObject/* Lecture 28 */,Reservation/* Lecture 30 */};

/* Lecture 27 */
class BackendRepository implements BackendRepositoryInterface  {


    /* Lecture 28 */
    public function getOwnerReservations($request)
    {
        return TouristObject::with([

                  'rooms' => function($q) {
                        $q->has('reservations'); // works like where clause for Room
                    }, // give me rooms only with reservations, if it wasn't there would be rooms without reservations

                    'rooms.reservations.user'

                  ])
                    ->has('rooms.reservations') // ensures that it gives me only those objects that have at least one reservation, has() here works like where clause for Object
                    ->where('user_id', $request->user()->id)
                    ->get();
    }


    /* Lecture 28 */
    public function getTouristReservations($request)
    {

       return TouristObject::with([

                    'rooms.reservations' => function($q) use($request) { // filters reserervations of other users

                            $q->where('user_id',$request->user()->id);

                    },

                    'rooms'=>function($q) use($request){
                        $q->whereHas('reservations',function($query) use($request){
                            $query->where('user_id',$request->user()->id);
                        });
                    },

                    'rooms.reservations.user'

                  ])

                    ->whereHas('rooms.reservations',function($q) use($request){  // acts like has() with additional conditions

                        $q->where('user_id',$request->user()->id);

                    })
                    ->get();
    }

    /* Lecture 30 */
    public function getReservationData($request)
    {
        return  Reservation::with('user', 'room')
                ->where('room_id', $request->input('room_id'))
                ->where('day_in', '<=', date('Y-m-d', strtotime($request->input('date'))))
                ->where('day_out', '>=', date('Y-m-d', strtotime($request->input('date'))))
                ->first();
    }


}

