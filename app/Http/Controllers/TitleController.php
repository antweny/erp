<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Http\Requests\TitleRequest;
use App\Imports\TitleImport;
use App\Title;
use Maatwebsite\Excel\Facades\Excel;

class TitleController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $titles = Title::latest()->get();
            return view('individuals.titles.index',compact('titles'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TitleRequest $request)
    {
        $this->can_create($this->model());
        try {
            Title::create($request->only('name','desc'));
            return back()->with('success',' Title has been saved');
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
            $title =$this->getID($id);
            return view('individuals.titles.edit',compact('title'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TitleRequest $request,$id)
    {
        $this->can_update($this->model());
        try {
            $this->getID($id)->update($request->only('name','desc'));
            return redirect()->route('titles.index')->with('success',' Title has been updated');
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
            return back()->with('success','Position title has been deleted');
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /*
     * Get requested record ID
      */
    public function getID($id)
    {
        $data = Title::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Title::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('titles.index')->with('error','something went wrong');
    }

   /*
    * Import Data from Excel
    */
    public function import (ImportRequest $request)
    {
        $this->can_create($this->model());
        Excel::import(new TitleImport, request()->file('imported_file'));
        return back()->with('success','titles imported successfully!');
    }


}
