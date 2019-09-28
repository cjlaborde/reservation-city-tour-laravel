<?php
namespace App\Enjoythetrip\Gateways; /* Lecture 27 */

use App\Enjoythetrip\Interfaces\BackendRepositoryInterface; /* Lecture 27 */


/* Lecture 27 */
class BackendGateway {


    use \Illuminate\Foundation\Validation\ValidatesRequests; /* Lecture 37 */


    public function __construct(BackendRepositoryInterface $bR )
    {
        $this->bR = $bR;
    }



    public function getReservations($request)
    {
        if ($request->user()->hasRole(['owner','admin']))
        {

            $objects = $this->bR->getOwnerReservations($request);

        }
        else
        {

            $objects = $this->bR->getTouristReservations($request);
        }

        return $objects;
    }


    /* Lecture 37 */
    public function createCity($request)
    {
        $this->validate($request,[
        'name'=>"required|string|unique:cities",
        ]);

        $this->bR->createCity($request);
    }


    /* Lecture 37 */
    public function updateCity($request, $id)
    {
        $this->validate($request,[
        'name'=>"required|string|unique:cities",
        ]);

        $this->bR->updateCity($request, $id);
    }


    /* Lecture 39 */
    public function saveUser($request)
    {
        $this->validate($request,[
        'name'=>"required|string",
        'surname'=>"required|string",
        'email'=>"required|email",
        ]);

        if ($request->hasFile('userPicture'))
        {
            $this->validate($request,[
            'userPicture'=>"image|max:100",

            ]);
        }

        return $this->bR->saveUser($request);
    }


    /* Lecture 42 */
    public function saveObject($id, $request)
    {

        $this->validate($request,[
            'city'=>"required|string",
            'name'=>"required|string",
            'street'=>"required|string",
            'number'=>"required|integer",
            'description'=>"required|string|min:100",
        ]);


        if($id)
        {
            $object = $this->bR->updateObjectWithAddress($id, $request);
        }
        else
        {
            $object = $this->bR->createNewObjectWithAddress($request);
        }


        if ($request->hasFile('objectPictures'))
        {

            $this->validate($request, \App\Photo::imageRules($request,'objectPictures')); /* Lecture 43 */

            /* Lecture 43 */
            foreach($request->file('objectPictures') as $picture)
            {
                $path = $picture->store('objects', 'public');

                $this->bR->saveObjectPhotos($object, $path);
            }

        }


        return $object;


    }


    /* Lecture 45 */
    public function saveArticle($object_id,$request)
    {
        $this->validate($request,[
            'content'=>"required|min:10",
            'title'=>"required|min:3",
        ]);

        return $this->bR->saveArticle($object_id,$request);

    }


}

