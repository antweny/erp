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
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $wards = Ward::orderBy('name', 'desc')->with('district')->get();
            return view('location.wards.index',compact('wards'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WardRequest $request)
    {
        $this->can_create($this->model());
        try {
            Ward::create($request->only('name', 'desc', 'district_id'));
            return back()->with('success','Ward has been saved');
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
            $ward = $this->getID($id);
            return view('location.wards.edit',compact('ward'));
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
        $this->can_update($this->model());
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
        $this->can_delete($this->model());
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
    public function import (ImportRequest $request)
    {
        $this->can_create($this->model());
        Excel::import(new WardImport(), request()->file('imported_file'));
        return back()->with('success','Ward imported successfully!');
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
