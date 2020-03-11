<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests\CityRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\CityImport;
use Maatwebsite\Excel\Facades\Excel;

class CityController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $cities = City::latest()->with('country')->get();
            return view('location.cities.index',compact('cities'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        $this->can_create($this->model());
        try {
            City::create($request->only('name','desc','country_id'));
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
        $this->can_update($this->model());
        try {
            $city = $this->getID($id);
            return view('location.cities.edit',compact('city'));
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
        $this->can_update($this->model());
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
        $this->can_delete($this->model());
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
    public function import (ImportRequest $request)
    {
        $this->can_import($this->model());
        Excel::import(new CityImport(), request()->file('imported_file'));
        return back()->with('success','Country imported successfully!');
    }
    

}
