<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        $wards = Ward::select('name','id')->get();

        $streets = $street->latest()->with('ward')->get(); //Get cities list

        return view('streets.index',compact('wards','streets'));
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
    public function edit(Street $street)
    {
        $this->authorize('update',$street);

        $wards = Ward::select('name','id')->get(); //Get countires list

        return view('streets.edit',compact('wards','street'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StreetRequest $request, Street $street)
    {
        $this->authorize('update',$street);

        $street->update($request->all());

        return redirect()->route('streets.index')->with('success',' Street has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Street $street)
    {
        $this->authorize('delete',$street);

        $street->delete();

        return back()->with('success','Street has been deleted');
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
}
