<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Country;
use App\Http\Requests\ImportRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CountryImport;

class CountryController extends Controller
{
    /**
     * AdminController constructor.
     */
    function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Country $country)
    {
        $this->authorize('read',$country);

        $countries = $country->orderBy('name','asc')->get();

        return view('countries.index',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.e
     */
    public function store(CountryRequest $request, Country $country)
    {
        $this->authorize('create',$country);

        $country->create($request->all());

        return back()->with('success','Country has been saved');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        $this->authorize('update',$country);

        return view('locations.countries.edit',compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, Country $country)
    {
        $this->authorize('update',$country);

        $country->update($request->all());

        return redirect()->route('countries.index')->with('success',' Country has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $this->authorize('delete',$country);

        $country->delete();

        return back()->with('success','Country has been deleted');
    }

    /*
   * Import Data from Excel
   */
    public function import (ImportRequest $request,Country $country)
    {
        $this->authorize('create',$country);

        if ($request->file('imported_file')) {
            Excel::import(new CountryImport(), request()->file('imported_file'));
            return back()->with('success','Countries has been imported');
        }
    }
}
