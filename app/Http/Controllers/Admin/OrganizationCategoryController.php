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

        $organizationCategories = $organizationCategory->latest()->get();

        return view('organizations.categories.index',compact('organizationCategories'));
    }

    /**
     * Store a newly created resource in storage.e
     */
    public function store(OrganizationCategoryRequest $request, OrganizationCategory $organizationCategory)
    {
        $this->authorize('create',$organizationCategory);

        $organizationCategory->create($request->all());

        return back()->with('success',' Organization category has been saved');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrganizationCategory $category)
    {
        $this->authorize('update',$category);

        return view('organizations.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrganizationCategoryRequest $request, OrganizationCategory $category)
    {
        $this->authorize('update',$category);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success',' Organization category has been updated.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrganizationCategory $category)
    {
        $this->authorize('delete',$category);

        $category->delete();

        return back()->with('success','Organization category has been deleted');
    }
}
