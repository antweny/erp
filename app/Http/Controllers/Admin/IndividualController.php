<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Controller;

use App\City;
use App\District;
use App\EducationLevel;
use App\Http\Requests\ImportRequest;
use App\Imports\IndividualsImport;
use App\Individual;
use App\Repositories\IndividualRepository;
use App\Ward;
use App\Http\Requests\IndividualRequest;
use Maatwebsite\Excel\Facades\Excel;

class IndividualController extends Controller
{
    protected $individual = null;

    public function __construct(IndividualRepository $individual)
    {
        parent::__construct();
        $this->individual = $individual;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('read',$this->model());
        try {
            $individuals = $this->individual->all();
            return view('individuals.index',compact('individuals'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Individual $individual)
    {
        $this->authorize('create',$individual);
        try {
            return $this->populate(__FUNCTION__,$individual);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IndividualRequest $request, Individual $individual)
    {
        $this->authorize('create',$individual);
        try {
            $this->get_select_ids($request);
            $individual->create($request->except('district','ward','city'));
            return back()->with('success',' Individual has been saved ');
        }
        catch (\Exception $e) {
            return back()->with('error','This user '.$request['full_name'].' already exists')->withInput($request->all());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('update',$this->model());
        try {
            $individual = $this->getID($id);
            return $this->populate(__FUNCTION__,$individual);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IndividualRequest $request, $id)
    {
        $this->authorize('update',$this->model());
        try {
            $this->get_select_ids($request);
            $this->getID($id)->update($request->except('district','ward','city'));
            return back()->with('success',' Individual has been saved ');
        }
        catch (\Exception $e) {
            return back()->with('error','This user '.$request['full_name'].' already exists')->withInput($request->all());
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
            return back()->with('success',' individual deleted successfully');
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /*
     * Import Data from Excel
     */
    public function import (ImportRequest $request)
    {
        $this->authorize('import',$this->model());
        try {
            Excel::import(new IndividualsImport,request()->file('imported_file'));
            return back()->with('success','Individual imported successfully!');
       }
        catch (\Exception $e){
            return $this->errorReturn();
        }
    }

    /*
     * Check if resource exist get ID if not create and get ID
     */
    public function check_city($request)
    {
        $name = new City();
        return $name->get_id($request);
    }
    public function check_district($request)
    {
        $name = new District();
        return $name->get_id($request);
    }
    public function check_ward($request)
    {
        $name = new Ward();
        return $name->get_id($request);

    }

    /*
     * Get requested record ID
     */
    public function getID($id)
    {
        $participant = Individual::findOrFail($id);
        return $participant;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Individual::class;
    }

    /*
    * Populate dropdowns values from different tables and return to forms
    */
    public function populate($function_name, $individual) {
        $cities = City::getNameID();
        $districts = District::getNameID();
        $wards = Ward::getNameID();
        $levels = EducationLevel::getNameID();

        $data = compact('individual','cities','districts','wards','levels');
        return view('individuals.' .$function_name , $data);
    }

    /*
    * Exception Error return back
    */
    public function errorReturn()
    {
        return redirect()->route('individuals.index')->with('error','something went wrong');
    }

    /*
     * Get dropdown select ID submitted by a user
     */
    public function get_select_ids ($request)
    {
        $request['city_id'] = $this->check_city($request['city']);
        $request['district_id'] = $this->check_district($request['district']);
        $request['ward_id'] = $this->check_ward($request['ward']);
        return $request;
    }


}
