<?php

namespace App\Enjoythetrip\Repositories; /* Lecture 12 */

use App\Enjoythetrip\Interfaces\FrontendRepositoryInterface;  /* Lecture 13 */
use App\{TouristObject,City/*Lecture 17*/}; /* Lecture 12 */

/* Lecture 12 */
class FrontendRepository implements FrontendRepositoryInterface  {   /* Lecture 13 implements FrontendRepositoryInterface */

    /* Lecture 12 */
    public function getObjectsForMainPage()
    {
        // return TouristObject::all(); /* Lecture 15 */
        return TouristObject::with(['city','photos'])->ordered()->paginate(8); /* Lecture 15 */
    }


    /* Lecture 15 */
    public function getObject($id)
    {
        //return TouristObject::find($id); /* Lecture 15 */


        // rooms.object.city   for json mobile because there is no lazy loading there
        return  TouristObject::with(['city','photos', 'address','users.photos','rooms.photos','comments.user','articles.user','rooms.object.city'])->find($id); /* Lecture 17 */
    }


    /* Lecture 17 */
    public function getSearchCities( string $term)
    {
        return  City::where('name', 'LIKE', $term . '%')->get();
    }


    /* Lecture 18 */
    public function getSearchResults( string $city)
    {
        // rooms.object.photos  for json mobile
        return  City::with(['rooms.reservations','rooms.photos','rooms.object.photos'])->where('name',$city)->first() ?? false;  /* Lecture 19 */
    }


}

