<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\District;
use App\EducationLevel;
use App\Http\Requests\ImportRequest;
use App\Imports\IndividualImport;
use App\Http\Controllers\Controller;
use App\Individual;
use App\Ward;
use App\Http\Requests\IndividualRequest;
use Maatwebsite\Excel\Facades\Excel;

class IndividualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Individual $individual)
    {
        $this->authorize('read',$individual);

        $individuals = $individual->orderBy('full_name','asc')->with(['country','city','district','ward','street','education_level'])->get();

        return view('individuals.index',compact('individuals'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Individual $individual)
    {
        $this->authorize('create',$individual);

        $cities = City::get_name_and_id();
        $districts = District::get_name_and_id();
        $wards = Ward::get_name_and_id();
        $levels = EducationLevel::get_name_and_id();

        return view('individuals.create',compact('individual','cities','districts','wards','levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IndividualRequest $request, Individual $individual)
    {
        $this->authorize('create',$individual);

        $request['city_id'] = $this->check_city($request['city']);
        $request['district_id'] = $this->check_district($request['district']);
        $request['ward_id'] = $this->check_ward($request['ward']);


        //Check if Individual Already Exist in the system
        if ($this->check_name_mobile_unique($request) > 0)
        {
            return back()->with('error','This user '.$request['full_name'].' already exists');
        }

        $individual->create($request->except('district','ward','city'));

        return back()->with('success',' Individual has been saved ');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Individual $individual)
    {
        $this->authorize('update',$individual);

        $cities = City::get_name_and_id();
        $districts = District::get_name_and_id();
        $wards = Ward::get_name_and_id();
        $levels = EducationLevel::get_name_and_id();

        return view('individuals.edit',compact('individual','cities','districts','wards','levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IndividualRequest $request, Individual $individual)
    {
        $this->authorize('update',$individual);

        $request['city_id'] = $this->check_city($request['city']);
        $request['district_id'] = $this->check_district($request['district']);
        $request['ward_id'] = $this->check_ward($request['ward']);

        $individual->update($request->except('district','ward','city'));

        return redirect()->route('individuals.index')->with('success',' Individual has been updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Individual $individual)
    {
        $this->authorize('delete',$individual);

        $individual->delete();

        return back()->with('success',' individual deleted successfully');
    }

    /*
     * Import Data from Excel
     */
    public function import (ImportRequest $request, Individual $individual)
    {
        $this->authorize('import',$individual);

        if ($request->file('imported_file')) {
            Excel::import(new IndividualImport(), request()->file('imported_file'));
            return back()->with('success','Individual imported successfully!');
        }
    }


    /*
     * Check if user already added as participant on the event on the same day
     */
    public function check_name_mobile_unique($request)
    {
        $query = Individual::where('full_name','LIKE','%' .$request['full_name']. '%')
            ->where('mobile',$request['mobile'])
            ->count();

        return $query;
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





















}
