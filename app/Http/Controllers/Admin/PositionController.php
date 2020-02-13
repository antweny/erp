<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\District;
use App\Http\Controllers\Controller;
use App\Individual;
use App\Organization;
use App\Position;
use App\Title;
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
        try {
            $positions = $position->with(['organization','title','city','district','individual','ward'])->get();
            return view('individuals.positions.index',compact('positions'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Position $position)
    {
        $this->authorize('create',$position);
        try{
            return $this->populate(__FUNCTION__,$position);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PositionRequest $request, Position $position)
    {
        $this->authorize('create',$position);
        try {
            $this->get_select_ids($request);
            $position->create($request->except('city','district','ward','title'));
            return back()->with('success','Individual Position has been added');
        }
        catch (\Exception $e) {
            return back()->with('error',' Something went wrong')->withInput($request->input());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('update',$this->model());
        try{
            $position = $this->getID($id);
            return $this->populate(__FUNCTION__,$position);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PositionRequest $request,$id)
    {
        $this->authorize('update',$this->model());
        try {
            $this->get_select_ids($request);
            $this->getID($id)->update($request->except('city','district','ward','title'));
            return redirect()->route('positions.index')->with('success','Individual Position has been added');
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('update',$this->model());
        try {
            $this->getID($id)->delete();
            return back()->with('success','Person position has been deleted');
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
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

    public function check_title($request)
    {
        $name = new Title();
        return $name->get_id($request);
    }

    /*
     * Populate dropdowns values from different tables and return to forms
     */
    public function populate($function_name, $position) {
        $cities = City::get_name_and_id();
        $districts = District::get_name_and_id();
        $wards = Ward::get_name_and_id();
        $organizations = Organization::get_name_and_id();
        $titles = Title::get_name_and_id();
        $individuals = Individual::get_name_and_id();
        $data = compact('position','cities','districts','wards','individuals','organizations','titles');
        return view('individuals.positions.'.$function_name , $data);
    }

    /*
    * Get requested record ID
    */
    public function getID($id)
    {
        $data = Position::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Position::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('positions.index')->with('error','something went wrong');
    }

    /*
     * Get dropdown select ID submitted by a user
     */
    public function get_select_ids ($request)
    {
        $request['city_id'] = $this->check_city($request['city']);
        $request['district_id'] = $this->check_district($request['district']);
        $request['ward_id'] = $this->check_ward($request['ward']);
        $request['title_id'] = $this->check_title($request['title']);
        return $request;
    }



}
