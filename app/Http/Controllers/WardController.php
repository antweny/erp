<?php

namespace App\Http\Controllers;

use App\District;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\WardRequest;
use App\Imports\WardImport;
use App\Ward;
use Maatwebsite\Excel\Facades\Excel;

class WardController extends Controller
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
    public function index(Ward $ward)
    {
        $this->authorize('read',$ward);
        $districts = District::getNameID();
        $wards = $ward->orderBy('name', 'desc')->with('district')->get();
        return view('location.wards.index',compact('districts','wards'));
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
    public function edit($id)
    {
        $this->authorize('update',$this->model());
        $districts = District::getNameID(); //Get districts list
        try {
            $ward = $this->getID($id);
            return view('location.wards.edit',compact('districts','ward'));
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WardRequest $request, $id)
    {
        $this->authorize('update',$this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('wards.index')->with('success',' Ward has been updated.');
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
            return back()->with('success','Ward has been deleted');
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
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

    /*
    * Get requested record ID
    */
    public function getID($id)
    {
        $data = Ward::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Ward::class;
    }
}
