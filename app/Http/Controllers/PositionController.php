<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Imports\PositionImport;
use App\Position;
use App\Title;
use App\Http\Requests\PositionRequest;
use Maatwebsite\Excel\Facades\Excel;

class PositionController extends Controller
{
    /**
     * Authorization constructor.
     */
    function __construct()
    {
        $this->middleware('auth:admin',['only'=> ['index','store','create','edit','update','destroy','import']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $positions = Position::with(['organization','title','city','district','individual','ward'])->get();
            return view('individuals.positions.index',compact('positions'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Position $position)
    {
        $this->can_create($this->model());
        try{
            return $this->populate(__FUNCTION__,$position);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PositionRequest $request)
    {
        $this->can_create($this->model());
        try {
            //dd($request->all());
            $this->get_select_ids($request);
            Position::create($request->all());
            return back()->with('success','Individual Position has been added');
        }
        catch (\Exception $e) {
            return back()->with('error',' Something went wrong')->withInput($request->input());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->can_update($this->model());
        try{
            $position = $this->getID($id);
            return $this->populate(__FUNCTION__,$position);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PositionRequest $request,$id)
    {
        $this->can_update($this->model());
        try {
            $this->get_select_ids($request);
            $this->getID($id)->update($request->except('city','district','ward','title'));
            return redirect()->route('positions.index')->with('success','Individual Position has been added');
        }
        catch (\Exception $e) {
            return $this->errorReturn();
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
            return back()->with('success','Person position has been deleted');
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
        //try {
            Excel::import(new PositionImport,request()->file('imported_file'));
            return back()->with('success','Individual Positions imported successfully!');
        //}
        //catch (\Exception $e){
          //  return redirect()->route('positions.index')->with('error',$e->getMessage());
            //return $this->errorReturn($e);
        //}
    }



    /*
     * Check if resource exist get ID if not create and get ID
     */
    public function check_title($request)
    {
        $name = new Title();
        return $name->get_id($request);
    }

    /*
     * Populate dropdowns values from different tables and return to forms
     */
    public function populate($function_name, $position) {
        $titles = Title::get_name_and_id();
        $data = compact('position','titles');
        return view('individuals.positions.'.$function_name , $data);
    }

    /*
    * Get requested record ID
    */
    public function getID($id)
    {
        $data = Position::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Position::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('positions.index')->with('error','something went wrong');
    }

    /*
     * Get dropdown select ID submitted by a user
     */
    public function get_select_ids ($request)
    {
        $request['title_id'] = $this->check_title($request['title']);
        return $request;
    }


}
