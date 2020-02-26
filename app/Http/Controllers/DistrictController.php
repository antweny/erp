<?php

namespace App\Http\Controllers;

use App\City;
use App\District;
use App\Http\Requests\DistrictRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\DistrictImport;
use Maatwebsite\Excel\Facades\Excel;

class DistrictController extends Controller
{
    /**
     * AdminController constructor.
     */
    function __construct()
    {
        $this->middleware('auth:admin',['only'=> ['index','store','edit','update','destroy','import']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(District $district)
    {
        $this->authorize('read',$district);

        $districts = $district->orderBy('name','desc')->with('city')->get();

        $cities = City::getNameID(); // Get cities list

        return view('location.districts.index',compact('districts','cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DistrictRequest $request, District $district)
    {
        $this->authorize('create',$district);

        $district->create($request->only('name', 'desc', 'city_id'));

        return back()->with('success',' district saved successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('update',$this->model());

        $cities = City::getNameID(); // Get cities list

        try {
            $district = $this->getID($id);
            return view('location.districts.edit',compact('district','cities'));
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DistrictRequest $request, $id)
    {
        $this->authorize('update',$this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('districts.index')->with('success',' District has been updated.');
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
            return back()->with('success','District deleted successfully!');
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
        $data = District::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return District::class;
    }

    /*
   * Import Data from Excel
   */
    public function import (ImportRequest $request, District $district)
    {
        $this->authorize('import',$district);

        if ($request->file('imported_file')) {
            Excel::import(new DistrictImport(), request()->file('imported_file'));
            return back()->with('success','District imported successfully!');
        }
    }
}
