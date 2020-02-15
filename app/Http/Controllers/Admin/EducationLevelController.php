<?php

namespace App\Http\Controllers\Admin;

use App\EducationLevel;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\EducationLevelRequest;
use Illuminate\Http\Request;

class EducationLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EducationLevel $educationLevel)
    {
        $this->authorize('read',$educationLevel);
        try {
            $educationLevels = $educationLevel->orderBy('name','desc')->get();
            return view('education.levels.index',compact('educationLevels'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EducationLevelRequest $request, EducationLevel $educationLevel)
    {
        $this->authorize('create',$educationLevel);
        try {
            $educationLevel->create($request->all());
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
        $this->authorize('update',$this->model());
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
        $this->authorize('update',$this->model());
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
        $this->authorize('delete',$this->model());
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
