<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesignationRequest;
use App\Designation;

class DesignationController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $designations  = Designation::latest()->get();
            return view('hr.designations.index',compact('designations'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DesignationRequest $request)
    {
        $this->can_create($this->model());
        try {
            Designation::create($request->only('name','desc'));
            return back()->with('success',' Designation has been saved');
        }
        catch (\Exception $e) {
            return back()->with('error',$e->getMessage())->withInput($request->input());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->can_update($this->model());
        try{
            $designation = $this->getID($id);
            return view('hr.designations.edit',compact('designation'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DesignationRequest $request, $id)
    {
        $this->can_update($this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('designations.index')->with('success',' Designation has been updated');
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
        $this->authorize('delete',$this->model());
        try {
            $this->getID($id)->delete();
            return back()->with('success','Designation has been deleted');
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
        $data = Designation::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Designation::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('designations.index')->with('error','something went wrong');
    }
}
