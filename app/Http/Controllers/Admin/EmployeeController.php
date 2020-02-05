<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;
use App\Department;

class EmployeeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Employee $employee)
    {
        $this->authorize('read',$employee);

        $employees = $employee->with('department')->get();

        return view('employees.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Employee $employee)
    {
        $this->authorize('create',$employee);

        $admins = Admin::select('name','id')->get();

        $departments = Department::select('name','id')->get();

        return view('employees.create',compact('employee','departments','admins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request, Employee $employee)
    {
        $this->authorize('create',$employee);

        $employee->create($request->all());

        return back()->with('success','Employee has been saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $this->authorize('update',$employee);

        $admins = Admin::select('name','id')->get();

        $departments = Department::select('name','id')->get();

        return view('employees.edit',compact('employee','departments','admins'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $this->authorize('update',$employee);

        $employee->update($request->all());

        return redirect()->route('employee.index')->with('success','Employee has been saved!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $this->authorize('delete',$employee);

        $this->authorize('create',$employee);
    }
}
