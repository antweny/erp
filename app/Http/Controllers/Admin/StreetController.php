<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\StreetRequest;
use App\Imports\StreetImport;
use App\Street;
use App\Ward;
use Maatwebsite\Excel\Facades\Excel;

class StreetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Street $street)
    {
        $this->authorize('read',$street);

        $wards = Ward::get_name_and_id();

        $streets = $street->latest()->with('ward')->get(); //Get cities list

        return view('location.streets.index',compact('wards','streets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StreetRequest $request, Street $street)
    {
        $this->authorize('create',$street);

        $street->create($request->only('name', 'desc', 'ward_id'));

        return back()->with('success',' Street has been saved.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('update',$this->model());

        $wards = Ward::get_name_and_id(); //Get countires list
        try {
            $street = $this->getID($id);
            return view('location.streets.edit',compact('wards','street'));
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StreetRequest $request, $id)
    {
        $this->authorize('update',$this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('streets.index')->with('success',' Street has been updated.');
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
            return back()->with('success','Street has been deleted');
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
    }

    /*
     * Import Data from Excel
     */
    public function import (ImportRequest $request, Street $street)
    {
        $this->authorize('import',$street);

        if ($request->file('imported_file')) {
            Excel::import(new StreetImport(), request()->file('imported_file'));
            return back()->with('success','Street imported successfully!');
        }
    }

    /*
   * Get requested record ID
   */
    public function getID($id)
    {
        $data = Street::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Street::class;
    }
}
