<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\DesignationRequest;
use Illuminate\Http\Request;
use App\Designation;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Designation $designation)
    {
        $this->authorize('read',$designation);
        try {
            $designations  = $designation->latest()->get();
            return view('hr.designations.index',compact('designations'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DesignationRequest $request, Designation $designation)
    {
        $this->authorize('create',$designation);
        try {
            $designation->create($request->only('name','desc'));
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
        $this->authorize('update',$this->model());
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
        $this->authorize('update',$this->model());
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