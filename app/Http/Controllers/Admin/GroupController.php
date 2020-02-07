<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Group $group)
    {
        $this->authorize('read',$group);

        $groups = $group->latest()->get();

        return view('individuals.groups.index',compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupRequest $request, Group $group)
    {
        $this->authorize('create',$group);

        $group->create($request->only('name','desc'));

        return back()->with('success',' Group has been saved');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        $this->authorize('update',$group);

        return view('individuals.groups.edit',compact('group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequest $request, Group $group)
    {
        $this->authorize('update',$group);

        $group->update($request->only('name','desc'));

        return redirect()->route('groups.index')->with('success',' Group has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $this->authorize('delete',$group);

        $group->delete();

        return back()->with('success','Group has been deleted');
    }

}
