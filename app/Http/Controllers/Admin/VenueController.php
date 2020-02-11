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

        return view('location.venues.index',compact('venues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Venue $venue)
    {
        $this->authorize('create',$venue);

        return $this->populate(__FUNCTION__, $venue);

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
    public function edit($id)
    {
        $this->authorize('update',$this->model());
        try {
            $venue = $this->getID($id);
            return $this->populate(__FUNCTION__, $venue);
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VenueRequest $request, $id)
    {
        $this->authorize('update',$this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('venues.index')->with('success',' Venue has been updated.');
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong')->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('delete',$venue);
        try {
            $this->getID($id)->delete();
            return back()->with('success','Venue deleted successfully!');
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
    }


    /*
     * Populate dropdowns values from different tables and return to forms
     */
    public function populate ($function_name,$venue)
    {
        $cities = City::select('name','id')->get();

        $districts = District::select('name','id')->get();

        $data = compact('cities','districts','venue');

        return view('location.venues.' .$function_name, $data);
    }

    /*
     * Get requested record ID
     */
    public function getID($id)
    {
        $data = Venue::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Venue::class;
    }

}
