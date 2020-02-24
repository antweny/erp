<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Controller;

use App\Http\Requests\EmploymentTypeRequest;
use App\EmploymentType;

class EmploymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EmploymentType $employmentType)
    {
        $this->authorize('read',$employmentType);
        try {
            $employmentTypes  = $employmentType->latest()->get();
            return view('hr.employment.types.index',compact('employmentTypes'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmploymentTypeRequest $request, EmploymentType $employmentType)
    {
        $this->authorize('create',$employmentType);
        try {
            $employmentType->create($request->only('name','desc'));
            return back()->with('success',' Employment Type has been saved');
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
            $employmentType = $this->getID($id);
            return view('hr.employment.types.edit',compact('employmentType'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmploymentTypeRequest $request, $id)
    {
        $this->authorize('update',$this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('employmentTypes.index')->with('success',' Employment Type has been updated');
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
            return back()->with('success','EmploymentType has been deleted');
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
        $data = EmploymentType::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return EmploymentType::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('employmentTypes.index')->with('error','something went wrong');
    }
}
