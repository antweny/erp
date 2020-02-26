<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth:admin',['only'=> ['index','store','edit','update','destroy','import']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Country $country)
    {
        $this->authorize('read',$country);
        $countries = $country->orderBy('name','asc')->get();
        return view('location.countries.index',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.e
     */
    public function store(CountryRequest $request, Country $country)
    {
        $this->authorize('create',$country);
        try {
            $country->create($request->all());
            return back()->with('success','Country has been saved');
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
        try {
            $country = $this->getID($id);
            return view('location.countries.edit',compact('country'));
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, $id)
    {
        $this->authorize('update',$this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('countries.index')->with('success',' Country has been updated.');
        }
        catch (\Exception $e) {
            return redirect()->route('countries.index')->with('error','something went Wrong')->withInput($request->all());
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
            return back()->with('success','Country has been deleted');
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
        $data = Country::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Country::class;
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
