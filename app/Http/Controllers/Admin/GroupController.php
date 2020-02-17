<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Controller;


use App\Group;
use App\Http\Requests\GroupRequest;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Group $group)
    {
        $this->authorize('read',$group);
        try {
            $groups = $group->latest()->get();
            return view('individuals.groups.index',compact('groups'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupRequest $request, Group $group)
    {
        $this->authorize('create',$group);
        try {
            $group->create($request->only('name','desc'));
            return back()->with('success',' Group has been saved');
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
            $group = $this->getID($id);
            return view('individuals.groups.edit',compact('group'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequest $request, $id)
    {
        $this->authorize('update',$this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('groups.index')->with('success',' Group has been updated');
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
            return back()->with('success','Group has been deleted');
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
        $data = Group::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Group::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('groups.index')->with('error','something went wrong');
    }

}
