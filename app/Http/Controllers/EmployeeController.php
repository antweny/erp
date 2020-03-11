<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Employee;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\PasswordResetRequest;
use Illuminate\Http\Request;
use App\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Authorization constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth:admin',['only'=> ['index','store','create','edit','update','destroy']]);
        $this->middleware(['auth:admin','role:superAdmin'],['only'=> ['employeeLogin','resetPasswordForm','update_employee_roles_form','']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Employee $employee)
    {
        $this->can_read($this->model());
        try {
            $employees = $employee->with('department')->get();
            return view('hr.employees.index',compact('employees'));
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
            $employee = new Employee();
            DB::commit();
            return $this->populate(__FUNCTION__,$employee);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return $this->errorReturn();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $this->can_create($this->model());
        DB::beginTransaction();
        try {
            $this->generatePassword($request);
            $employee = Employee::create($request->all());
            $employee->assignRole('employee');
            DB::commit();
            return back()->with('success','Employee has been saved!');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error',$e->getMessage())->withInput($request->input());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->can_update($this->model());
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
        $this->can_update($this->model());
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
        $this->can_delete($this->model());
    }


    /*
    * Populate dropdowns values from different tables and return to forms
    */
    public function populate ($function_name,$employee)
    {
        $departments = Department::getNameID();
        $data = compact('departments','employee');
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
    protected function generatePassword ($request)
    {
        $request['password'] = Hash::make($request['first_name']);

        return $request;
    }

    /*
    * Exception Error return back
    */
    public function errorReturn()
    {
        return redirect()->route('employee.index')->with('error','something went wrong');
    }


    /*
     * Get List of Employee Login Credentials
     */
    protected function employeeLogin()
    {
        try {
            $employees = Employee::select('first_name','last_name','email','employee_no','id')->get();
            return view('security.employee.index',compact('employees'));
        }
        catch (\Exception $e) {
            abort(401);
        }
    }

    /*
     * Get Password Reset Form
     */
    public function resetPasswordForm($id)
    {
        try {
            $employee = $this->getID($id);
            return view('security.employee.reset_password')->with(compact('employee'));
        }
        catch (\Exception $e) {
            abort(401);
        }
    }

    /*
     * Password Reset Form
     */
    public function reset_password(PasswordResetRequest $request,$id)
    {
        try {
            $employee = $this->getID($id);
            $this->password_encryption($request);
            $employee->update($request->only('password'));
            return redirect()->route('employeeLogin')->with('success','Password for employee '.$employee->full_name. ' updated successfuly');
        }
        catch (\Exception $e) {
            return redirect()->route('employeeLogin')->with('error','Something went wrong');
        }
    }

    /*
     * Encrypt the Password
     */
    protected function password_encryption($request)
    {
        $request['password'] = Hash::make($request['password']);
        return $request;
    }

    /*
     * Get form to update Employee Roles
     */
    protected function update_employee_roles_form($id) {
        try{
            $employee = $this->getID($id);
            return view('security.employee.edit')->with(compact('employee'));
        }
        catch (\Exception $e) {
            return redirect()->route('employeeLogin')->with('error','Something went wrong');
        }
    }

    /*
     * Get form to update Employee Roles
     */
    protected function update_employee_roles(Request $request, $id)
    {
        $this->validate($request, [
            'roles' => 'required',
        ]);

        $roles = $request->roles; //Get all assign roles
        DB::beginTransaction();
        try {
            $employee = $this->getID($id);
            if (isset($roles)) {
                $employee->roles()->sync($roles);  //If one or more role is selected associate user to roles
            }
            else {
                $employee->roles()->detach(); //If no role is selected remove exisiting role associated to a user
            }
            DB::commit();
            return redirect()->route('employeeLogin')->with('success','Employee Roles Updated');
        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->errorReturn();
        }
    }


}
