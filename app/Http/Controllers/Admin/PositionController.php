<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\District;
use App\Http\Controllers\Controller;
use App\Individual;
use App\Organization;
use App\Position;
use App\Ward;
use App\Http\Requests\PositionRequest;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Position $position)
    {
        $this->authorize('read',$position);

        $positions = $position->get();

        return view('individuals.positions.index',compact('positions'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Position $position)
    {
        $this->authorize('create',$position);

        $cities = City::get_name_and_id();
        $districts = District::get_name_and_id();
        $wards = Ward::get_name_and_id();
        $organizations = Organization::get_name_and_id();

        $individuals = Individual::get_name_and_id();
        //$titles = Title::select('name')->get();

        return view('individuals.positions.create',compact('position','cities','districts','wards','individuals','organizations'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PositionRequest $request, Position $position)
    {
        $this->authorize('create',$position);

        $request['city_id'] = $this->check_city($request['city']);
        $request['district_id'] = $this->check_district($request['district']);
        $request['ward_id'] = $this->check_ward($request['ward']);
        //$request['title_id'] = $this->check_title($request['title']);
        $request['organization_id'] = $this->check_organization($request['organization']);

        $position->create($request->except('city','organization'));

        return back()->with('success','Individual Position has been added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        $this->authorize('update',$position);

        $cities = City::get_name_and_id();
        $districts = District::get_name_and_id();
        $wards = Ward::get_name_and_id();
        $organizations = Organization::get_name_and_id();

        $individuals = Individual::get_name_and_id();

        return view('individuals.positions.edit',compact('position','cities','districts','wards','individuals','organizations'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PositionRequest $request, Position $position)
    {
        $this->authorize('update',$position);

        $request['city_id'] = $this->check_city($request['city']);
        $request['district_id'] = $this->check_district($request['district']);
        $request['ward_id'] = $this->check_ward($request['ward']);
        //$request['title_id'] = $this->check_title($request['title']);
        $request['organization_id'] = $this->check_organization($request['organization']);

        $position->update($request->except('city','organization'));

        return redirect()->route('positions.index')->with('success','Person Position has been updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $this->authorize('update',$position);

        $position->delete();

        return back()->with('success','Person position has been deleted');

    }




    /*
     * Check if resource exist get ID if not create and get ID
     */
    public function check_city($request)
    {
        $name = new City();
        return $name->get_id($request);
    }

    public function check_district($request)
    {
        $name = new District();
        return $name->get_id($request);
    }

    public function check_ward($request)
    {
        $name = new Ward();
        return $name->get_id($request);
    }

    public function check_organization($request)
    {
        $name = new Organization();
        return $name->get_id($request);
    }




}
