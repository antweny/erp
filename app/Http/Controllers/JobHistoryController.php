<?php

namespace App\Http\Controllers;

use App\JobHistory;
use App\JobType;
use App\Designation;
use App\Http\Requests\JobHistoryRequest;
use Illuminate\Http\Request;

class JobHistoryController extends Controller
{
    /**
     * Authorization constructor.
     */
    function __construct()
    {
        $this->middleware('auth:admin',['only'=> ['index','store','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $jobHistory  = JobHistory::with('employee','designation','job_type')->latest()->get();
            return $this->populate(__FUNCTION__,$jobHistory);
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobHistoryRequest $request)
    {
        $this->can_create($this->model());
        try {
            JobHistory::create($request->all());
            return back()->with('success',' Job Historry  has been saved');
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
            $jobHistory = $this->getID($id);
            return $this->populate(__FUNCTION__,$jobHistory);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobHistoryRequest $request, $id)
    {
        $this->can_update($this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('jobHistories.index')->with('success',' Job History has been updated');
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
            return back()->with('success','Job History has been deleted');
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /*
    * Populate dropdowns values from different tables and return to forms
    */
    public function populate($function_name, $jobHistory) {
        $jobTypes = JobType::getNameID();
        $designations = Designation::getNameID();
        $data = compact('jobHistory','jobTypes','designations');
        return view('hr.job.histories.' .$function_name , $data);
    }

    /*
    * Get requested record ID
    */
    public function getID($id)
    {
        $data = JobHistory::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return JobHistory::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('jobHistories.index')->with('error','something went wrong');
    }
}
