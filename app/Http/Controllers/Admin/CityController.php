<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\City;
use App\Country;
use App\Http\Requests\CityRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\CityImport;
use Maatwebsite\Excel\Facades\Excel;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(City $city)
    {
        $this->authorize('read',$city);

        $cities = $city->latest()->with('country')->get();

        $countries = Country::select('name','id')->get(); //Get countries list

        return view('cities.index',compact('countries','cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request, City $city)
    {
        $this->authorize('create',$city);

        $city->create($request->only('name','desc','country_id'));

        return back()->with('success',' City has been saved');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        $this->authorize('update',$city);

        $countries = Country::select('name','id')->get(); //Get countires list

        return view('cities.edit',compact('countries','city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, City $city)
    {
        $this->authorize('update',$city);

        $city->update($request->only('name','desc','country_id'));

        return redirect()->route('cities.index')->with('success',' City has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $this->authorize('delete',$city);

        $city->delete();

        return back()->with('success','City has been deleted');
    }

    /*
    * Import Data from Excel
    */
    public function import (ImportRequest $request, City $city)
    {
        $this->authorize('create',$city);

        if ($request->file('imported_file')) {
            Excel::import(new CityImport(), request()->file('imported_file'));
            return back()->with('success','Country imported successfully!');
        }
    }
    

}
