<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\City;
use App\District;
use App\Http\Requests\DistrictRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\DistrictImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(District $district, City $city)
    {
        $this->authorize('read',$district);

        $districts = $district->orderBy('name','desc')->with('city')->get();

        $cities = City::select('name','id')->get();

        return view('districts.index',compact('districts','cities'));
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
    public function edit(District $district,City $city)
    {
        $this->authorize('update',$district);

        $cities = City::select('name','id')->get(); // Get cities list

        return view('districts.edit',compact('district','cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DistrictRequest $request, District $district)
    {
        $this->authorize('update',$district);

        $district->update($request->only('name', 'desc', 'city_id'));

        return redirect()->route('districts.index')->with('success',' District has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district)
    {
        $this->authorize('delete',$district);

        $district->delete();

        return back()->with('success','District deleted successfully!');
    }

    /*
   * Import Data from Excel
   */
    public function import (ImportRequest $request, District $district)
    {
        $this->authorize('import',$district);

        if ($request->file('imported_file')) {
            Excel::import(new DistrictImport(), request()->file('imported_file'));
            return back()->with('success','Country imported successfully!');
        }
    }
}