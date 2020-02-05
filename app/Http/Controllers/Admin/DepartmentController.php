<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Department;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Department $department)
    {
        $this->authorize('read',$department);

        $departments = $department->get()->sortBy('sort');

        return view('departments.index',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request, Department $department)
    {
        $this->authorize('create',$department);

        $department->create($request->only('name','desc','sort'));

        return back()->with('success','Department has been saved!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $this->authorize('update',$department);

        return view('departments.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $this->authorize('update',$department);

        $department->update($request->only('name','sort','desc'));

        return redirect()->route('departments.index')->with('success','Department has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $this->authorize('delete',$department);

        $department->delete();

        return redirect()->route('departments.index')->with('success','Department has been updated!');
    }
}
