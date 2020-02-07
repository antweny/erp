<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\EventCategory;
use App\Http\Requests\EventCategoryRequest;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EventCategory $eventCategory)
    {
        $this->authorize('read',$eventCategory);

        $eventCategories  = $eventCategory->latest()->get();

        return view('events.categories.index',compact('eventCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventCategoryRequest $request, EventCategory $eventCategory)
    {
        $this->authorize('create',$eventCategory);

        $eventCategory->create($request->only('name','desc'));

        return back()->with('success',' Event category has been saved');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventCategory $eventCategory)
    {
        $this->authorize('update',$eventCategory);

        return view('events.categories.edit',compact('eventCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventCategoryRequest $request, EventCategory $eventCategory)
    {
        $this->authorize('update',$eventCategory);

        $eventCategory->update($request->only('name','desc'));

        return redirect()->route('eventCategories.index')->with('success',' Event category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventCategory $eventCategory)
    {
        $this->authorize('delete',$eventCategory);

        $eventCategory->delete();

        return back()->with('success','Event category has been deleted');
    }
}
