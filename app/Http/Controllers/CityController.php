<?php

namespace App\Http\Controllers; /* Part 37 */

use Illuminate\Http\Request; /* Part 37 */

use App\Enjoythetrip\Gateways\BackendGateway; /* Part 37 */
use App\Enjoythetrip\Interfaces\BackendRepositoryInterface; /* Part 37 */

/* Part 37 */
class CityController extends Controller
{

    /* Part 37 */
    public function __construct(BackendGateway $backendGateway, BackendRepositoryInterface $backendRepository)
    {
        $this->middleware('CheckAdmin');
        $this->bG = $backendGateway;
        $this->bR = $backendRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.cities.index',['cities'=>$this->bR->getCities()]); /* Part 37 */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.cities.create'); /* Part 37 */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->bG->createCity($request); /* Part 37 */
        return redirect()->route('cities.index'); /* Part 37 */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.cities.edit',['city'=>$this->bR->getCity($id)]); /* Part 37 */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->bG->updateCity($request, $id); /* Part 37 */
        return redirect()->route('cities.index'); /* Part 37 */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->bR->deleteCity($id); /* Part 37 */
        return redirect()->route('cities.index'); /* Part 37 */
    }
}
