<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Admin;
use App\Employee;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;
use App\Department;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Employee $employee)
    {
        $this->authorize('read',$employee);

        $employees = $employee->with('department')->get();

        return view('hr.employees.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Employee $employee)
    {
        $this->authorize('create',$employee);

        return $this->populate(__FUNCTION__,$employee);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request, Employee $employee)
    {
        $this->authorize('create',$employee);
        try {
            $this->generatePassword($request);

            $employee->create($request->all());

            return back()->with('success','Employee has been saved!');
        }
        catch (\Exception $e) {
            return back()->with('error',$e->getMessage())->withInput($request->input());
        }
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
    public function edit($id)
    {
        $this->authorize('update',$this->model());

        try {
            $employee = $this->getID($id);
            return $this->populate(__FUNCTION__,$employee);
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request,$id)
    {
        $this->authorize('update',$this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('employee.index')->with('success','Employee has been saved!');
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong')->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $this->authorize('create',$employee);
    }


    /*
    * Populate dropdowns values from different tables and return to forms
    */
    public function populate ($function_name,$employee)
    {
        $admins = Admin::select('name','id')->get();

        $departments = Department::get_name_and_id();

        $data = compact('admins','departments','employee');

        return view('hr.employees.' .$function_name, $data);
    }

    /*
     * Get requested record ID
     */
    public function getID($id)
    {
        $data = Employee::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Employee::class;
    }

    /*
     * Generate  Password based from First name
     */

    public function generatePassword ($request)
    {
        $request['password'] = Hash::make($request['first_name']);

        return $request;
    }


}
