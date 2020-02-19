<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Employee\Controller;

use App\EventCategory;
use App\Http\Requests\EventCategoryRequest;

class EventCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EventCategory $eventCategory)
    {
        try {
            $eventCategories  = $eventCategory->latest()->get();
            return view('employee.events.categories.index',compact('eventCategories'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventCategoryRequest $request, EventCategory $eventCategory)
    {
        try {
            $eventCategory->create($request->only('name','desc'));
            return back()->with('success',' Event category has been saved');
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
        try{
            $eventCategory = $this->getID($id);
            return view('employee.events.categories.edit',compact('eventCategory'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventCategoryRequest $request, $id)
    {
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('employee.eventCategories.index')->with('success',' Event category has been updated');
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
        $data = EventCategory::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return EventCategory::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('employee.eventCategories.index')->with('error','something went wrong');
    }

}
