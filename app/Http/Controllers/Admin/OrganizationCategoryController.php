<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationCategoryRequest;
use App\OrganizationCategory;

class OrganizationCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(OrganizationCategory $organizationCategory)
    {
        $this->authorize('read',$organizationCategory);
        try {
            $organizationCategories = $organizationCategory->latest()->get();
            return view('organizations.categories.index',compact('organizationCategories'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.e
     */
    public function store(OrganizationCategoryRequest $request, OrganizationCategory $organizationCategory)
    {
        $this->authorize('create',$organizationCategory);
        try {
            $organizationCategory->create($request->all());
            return back()->with('success',' Organization category has been saved');
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
            $category = $this->getID($id);
            return view('organizations.categories.edit',compact('category'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrganizationCategoryRequest $request, $id)
    {
        $this->authorize('update',$this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('categories.index')->with('success',' Organization category has been updated.');
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
            return back()->with('success','Organization category has been deleted');
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
        $data = OrganizationCategory::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return OrganizationCategory::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('organizationCategories.index')->with('error','something went wrong');
    }
}
