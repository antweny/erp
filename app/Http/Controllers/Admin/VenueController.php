<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\City;
use App\Venue;
use App\Http\Requests\VenueRequest;
use App\District;


class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Venue $venue)
    {
        $this->authorize('read',$venue);

        $venues = $venue->latest()->with('city','district')->paginate(30);

        return view('venues.index',compact('venues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Venue $venue)
    {
        $this->authorize('create',$venue);

        $cities = City::select('name','id')->get();

        $districts = District::select('name','id')->get();

        return view('venues.create',compact('venue','cities','districts'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(VenueRequest $request, Venue $venue)
    {
        $this->authorize('create',$venue);

        $venue->create($request->all());

        return back()->with('success',' Venue has been saved');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venue $venue)
    {
        $this->authorize('update',$venue);

        $cities = City::select('name','id')->get();

        $districts = District::select('name','id')->get();

        return view('venues.edit',compact('venue','cities','districts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VenueRequest $request, Venue $venue)
    {
        $this->authorize('update',$venue);

        $venue->update($request->all());

        return redirect()->route('venues.index')->with('success',' Venue has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        $this->authorize('delete',$venue);

        $venue->delete();

        return back()->with('success','Venue deleted successfully!');
    }

}
