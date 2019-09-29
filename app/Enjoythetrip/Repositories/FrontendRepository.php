<?php

namespace App\Enjoythetrip\Repositories; /* Part 12 */

use App\Enjoythetrip\Interfaces\FrontendRepositoryInterface;  /* Part 13 */
use App\{TouristObject,City/*Part 17*/,Room/* Part 20 */,Reservation/* Part 20 */,Article/* Part 22 */,User/* Part 23 */,Comment/* Part 25 */}; /* Part 12 */

/* Part 12 */
class FrontendRepository implements FrontendRepositoryInterface  {   /* Part 13 implements FrontendRepositoryInterface */

    /* Part 12 */
    public function getObjectsForMainPage()
    {
        // return TouristObject::all(); /* Part 15 */
        return TouristObject::with(['city','photos'])->ordered()->paginate(8); /* Part 15 */
    }


    /* Part 15 */
    public function getObject($id)
    {
        //return TouristObject::find($id); /* Part 15 */


        // rooms.object.city   for json mobile because there is no lazy loading there
        return  TouristObject::with(['city','photos', 'address','users.photos','rooms.photos','comments.user','articles.user','rooms.object.city'])->find($id); /* Part 17 */
    }


    /* Part 17 */
    public function getSearchCities( string $term)
    {
        return  City::where('name', 'LIKE', $term . '%')->get();
    }


    /* Part 18 */
    public function getSearchResults( string $city)
    {
        // rooms.object.photos  for json mobile
        return  City::with(['rooms.reservations','rooms.photos','rooms.object.photos'])->where('name',$city)->first() ?? false;  /* Part 19 */
    }


    /* Part 20 */
    public function getRoom($id)
    {
        // with - for mobile json
        return  Room::with(['object.address'])->find($id);
    }


    /* Part 20 */
    public function getReservationsByRoomId( $room_id )
    {
        return  Reservation::where('room_id',$room_id)->get();
    }


    /* Part 22 */
    public function getArticle($id)
    {
        return  Article::with(['object.photos','comments'])->find($id);
    }

    /* Part 23 */
    public function getPerson($id)
    {
        return  User::with(['objects','larticles','comments.commentable'])->find($id);
    }


    /* Part 24 */
    public function like($likeable_id, $type, $request)
    {
        $likeable = $type::find($likeable_id);

        return $likeable->users()->attach($request->user()->id);
    }

    /* Part 24 */
    public function unlike($likeable_id, $type, $request)
    {
        $likeable = $type::find($likeable_id);

        return $likeable->users()->detach($request->user()->id);
    }


    /* Part 25 */
    public function addComment($commentable_id, $type, $request)
    {
        $commentable = $type::find($commentable_id);

        $comment = new Comment;

        $comment->content = $request->input('content');

        $comment->rating = $type == 'App\TouristObject' ? $request->input('rating') : 0;

        $comment->user_id = $request->user()->id;

        return $commentable->comments()->save($comment);
    }


    /* Part 26 */
    public function makeReservation($room_id, $city_id, $request)
    {
        return Reservation::create([
                'user_id'=>$request->user()->id,
                'city_id'=>$city_id,
                'room_id'=>$room_id,
                'status'=>0,
                'day_in'=>date('Y-m-d', strtotime($request->input('checkin'))),
                'day_out'=>date('Y-m-d', strtotime($request->input('checkout')))
            ]);
    }

}

