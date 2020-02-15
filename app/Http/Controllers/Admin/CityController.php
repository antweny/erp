<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
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

        return view('location.cities.index',compact('countries','cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request, City $city)
    {
        $this->authorize('create',$city);
        try {
            $city->create($request->only('name','desc','country_id'));
            return back()->with('success',' City has been saved');
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('update',$this->model());
        $countries = Country::select('name','id')->get(); //Get countires list
        try {
            $city = $this->getID($id);
            return view('location.cities.edit',compact('city','countries'));
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, $id)
    {
        $this->authorize('update',$this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('cities.index')->with('success',' City has been updated.');
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
        $this->authorize('delete',$this->model());
        try {
            $this->getID($id)->delete();
            return back()->with('success','City has been deleted');
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
    }

    /*
     * Get requested record ID
     */
    public function getID($id)
    {
        $data = City::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return City::class;
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
