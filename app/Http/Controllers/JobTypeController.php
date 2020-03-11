<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobTypeRequest;
use App\JobType;

class JobTypeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $jobTypes  = JobType::latest()->get();
            return view('hr.job.types.index',compact('jobTypes'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobTypeRequest $request)
    {
        $this->can_create($this->model());
        try {
            JobType::create($request->only('name','desc'));
            return back()->with('success',' Job Type has been saved');
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
            $jobType = $this->getID($id);
            return view('hr.job.types.edit',compact('jobType'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobTypeRequest $request, $id)
    {
        $this->can_update($this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('jobTypes.index')->with('success',' Job Type has been updated');
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
            return back()->with('success','JobType has been deleted');
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
        $data = JobType::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return JobType::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('jobTypes.index')->with('error','something went wrong');
    }
}
