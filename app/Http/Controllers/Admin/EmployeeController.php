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
     * AdminController constructor.
     */
    function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Employee $employee)
    {
        $employees = $employee->with('department')->get();

        return view('employees.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Employee $employee)
    {
        $admins = Admin::select('name','id')->get();

        $departments = Department::select('name','id')->get();

        return view('employees.create',compact('employee','departments','admins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request, Employee $employee)
    {
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
        $admins = Admin::select('name','id')->get();

        $departments = Department::select('name','id')->get();

        return view('employees.edit',compact('employee','departments','admins'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->all());

        return redirect()->route('employee.index')->with('success','Employee has been saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
