<?php

namespace App\Http\Controllers;


use App\Department;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Department $department)
    {
        $this->can_read($this->model());
        try {
            $departments = Department::get();
            return view('hr.departments.index',compact('departments'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $this->can_create($this->model());
        try {
            Department::create($request->all());
            return back()->with('success','Department has been saved!');
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
            $department = $this->getID($id);
            return view('hr.departments.edit',compact('department'));
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, $id)
    {
        $this->can_update($this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('departments.index')->with('success','Department has been updated!');
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong')->withInput($request->all());
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
            return redirect()->route('departments.index')->with('success','Department has been updated!');
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
        $data = Department::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Department::class;
    }
}
