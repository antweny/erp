<?php

namespace App\Http\Controllers;

use App\EducationLevel;
use App\Http\Requests\EducationLevelRequest;

class EducationLevelController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $educationLevels = EducationLevel::orderBy('name','desc')->get();
            return view('education.levels.index',compact('educationLevels'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EducationLevelRequest $request)
    {
        $this->can_create($this->model());
        try {
            EducationLevel::create($request->all());
            return back()->with('success',' EducationLevel has been saved');
        }
        catch (\Exception $e) {
            return back()->with('error',' Something went wrong')->withInput($request->input());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->can_update($this->model());
        try{
            $educationLevel = $this->getID($id);
            return view('education.levels.edit',compact('educationLevel'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EducationLevelRequest $request, $id)
    {
        $this->can_update($this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('educationLevels.index')->with('success',' Education Level has been updated');
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
            return back()->with('success','Education Level has been deleted');
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
        $data = EducationLevel::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return EducationLevel::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('educationLevels.index')->with('error','something went wrong');
    }



}
