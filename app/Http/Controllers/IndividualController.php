<?php

namespace App\Http\Controllers;

use App\EducationLevel;
use App\Http\Requests\ImportRequest;
use App\Imports\IndividualsImport;
use App\Individual;
use App\Repositories\IndividualRepository;
use App\Http\Requests\IndividualRequest;
use Maatwebsite\Excel\Facades\Excel;

class IndividualController extends Controller
{
    protected $individual = null;

    /**
     * Authorization constructor.
     */
    function __construct(IndividualRepository $individual)
    {
        $this->middleware('auth:admin',['only'=> ['index','store','create','edit','update','destroy','import']]);
        $this->individual = $individual;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $individuals =$this->individual->all();
            return view('individuals.index',compact('individuals'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->can_create($this->model());
        try {
            $individual = new Individual();
            return $this->populate(__FUNCTION__,$individual);
        }
        catch (\Exception $e) {
            dd($e->getMessage());
            return $this->errorReturn();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IndividualRequest $request)
    {
        $this->can_create($this->model());
        try {
            Individual::create($request->except('district','ward','city'));
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
        $this->can_update($this->model());
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
        $this->can_update($this->model());
        try {

            $this->getID($id)->update($request->except('district','ward','city'));
            return redirect()->route('individuals.index')->with('success',' Individual has been saved ');
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
        $this->can_delete($this->model());
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
        $this->can_create($this->model());
        try {
            Excel::import(new IndividualsImport,request()->file('imported_file'));
            return back()->with('success','Individual imported successfully!');
       }
        catch (\Exception $e){
            return $this->errorReturn();
        }
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
        $levels = EducationLevel::getNameID();
        $data = compact('individual','levels');
        return view('individuals.' .$function_name , $data);
    }

    /*
    * Exception Error return back
    */
    public function errorReturn()
    {
        return redirect()->route('individuals.index')->with('error','something went wrong');
    }


}
