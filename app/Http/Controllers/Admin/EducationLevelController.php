<?php

namespace App\Http\Controllers\Admin;

use App\EducationLevel;
use App\Http\Controllers\Controller;
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

        $educationLevels = $educationLevel->orderBy('name','desc')->get();

        return view('education.levels.index',compact('educationLevels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EducationLevelRequest $request, EducationLevel $educationLevel)
    {
        $this->authorize('create',$educationLevel);

        $educationLevel->create($request->all());

        return back()->with('success',' EducationLevel has been saved');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EducationLevel $educationLevel)
    {
        $this->authorize('update',$educationLevel);

        return view('education.levels.edit',compact('educationLevel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EducationLevelRequest $request, EducationLevel $educationLevel)
    {
        $this->authorize('update',$educationLevel);

        $educationLevel->update($request->all());

        return redirect()->route('educationLevels.index')->with('success',' Education Level has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EducationLevel $educationLevel)
    {
        $this->authorize('delete',$educationLevel);

        $educationLevel->delete();

        return back()->with('success','Education Level has been deleted');
    }



}
