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
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            return view('location.countries.index');
        }
        catch (\Exception $e) {
           abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.e
     */
    public function store(CountryRequest $request)
    {
        $this->can_create($this->model());
        try {
            Country::create($request->all());
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
        $this->can_update($this->model());
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
        $this->can_update($this->model());
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
        $this->can_delete($this->model());
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
    public function import (ImportRequest $request)
    {
        $this->can_create($this->model());
        Excel::import(new CountryImport(), request()->file('imported_file'));
        return back()->with('success','Countries has been imported');
    }
}
