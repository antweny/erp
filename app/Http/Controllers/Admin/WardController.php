<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\District;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\WardRequest;
use App\Imports\WardImport;
use App\Ward;
use Maatwebsite\Excel\Facades\Excel;

class WardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Ward $ward)
    {
        $this->authorize('read',$ward);

        $districts = District::select('name','id')->get();

        $wards = $ward->orderBy('name', 'desc')->with('district')->get();

        return view('wards.index',compact('districts','wards'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(WardRequest $request, Ward $ward)
    {
        $this->authorize('create',$ward);

        $ward->create($request->only('name', 'desc', 'district_id'));

        return back()->with('success','Ward has been saved');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ward $ward, District $district)
    {
        $this->authorize('update',$ward);

        $districts = District::select('name','id')->get(); //Get countires list

        return view('wards.edit',compact('districts','ward'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WardRequest $request, Ward $ward)
    {
        $this->authorize('update',$ward);

        $ward->update($request->only('name', 'desc', 'district_id'));

        return redirect()->route('wards.index')->with('success',' Ward has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ward $ward)
    {
        $this->authorize('delete',$ward);

        $ward->delete();

        return back()->with('success','Ward has been deleted');
    }

    /*
     * Import Data from Excel
     */
    public function import (ImportRequest $request, Ward $ward)
    {
        $this->authorize('import',$ward);

        if ($request->file('imported_file')) {
            Excel::import(new WardImport(), request()->file('imported_file'));
            return back()->with('success','Ward imported successfully!');
        }
    }
}
