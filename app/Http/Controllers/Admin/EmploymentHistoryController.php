<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\EmploymentHistory;
use App\EmploymentType;
use App\Designation;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\EmploymentHistoryRequest;
use Illuminate\Http\Request;

class EmploymentHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EmploymentHistory $employmentHistory)
    {
        //$this->authorize('read',$this->model());
        try {
            $employmentHistory  = $employmentHistory->with('employee','designation','employment_type')->latest()->get();
            return $this->populate(__FUNCTION__,$employmentHistory);
        }
        catch (\Exception $e) {
            abort(404);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(EmploymentHistoryRequest $request, EmploymentHistory $employmentHistory)
    {
        $this->authorize('create',$this->model());
        try {
            $employmentHistory->create($request->all());
            return back()->with('success',' Employment Historry  has been saved');
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
            $employmentHistory = $this->getID($id);
            return $this->populate(__FUNCTION__,$employmentHistory);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmploymentHistoryRequest $request, $id)
    {
        $this->authorize('update',$this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('employmentHistories.index')->with('success',' Employment History has been updated');
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
        //$this->authorize('delete',$this->model());
        try {
            $this->getID($id)->delete();
            return back()->with('success','Employment History has been deleted');
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }


    /*
    * Populate dropdowns values from different tables and return to forms
    */
    public function populate($function_name, $employmentHistory) {
        $employees = Employee::get_full_name_and_id();
        $employmentTypes = EmploymentType::getNameID();
        $designations = Designation::getNameID();
        $data = compact('employmentHistory','employees','employmentTypes','designations');
        return view('hr.employment.histories.' .$function_name , $data);
    }

    /*
    * Get requested record ID
    */
    public function getID($id)
    {
        $data = EmploymentHistory::findOrFail($id);
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
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('employmentHistories.index')->with('error','something went wrong');
    }
}
