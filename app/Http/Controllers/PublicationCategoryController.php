<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicationCategoryRequest;
use App\PublicationCategory;

class PublicationCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $publicationCategories = PublicationCategory::latest()->get();
            return view('library.publications.categories.index',compact('publicationCategories'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PublicationCategoryRequest $request)
    {
        $this->can_create($this->model());
        try {
            PublicationCategory::create($request->only('name','desc'));
            return back()->with('success','Publication Category has been saved!');
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
            $publicationCategory = $this->getID($id);
            return view('library.publications.categories.edit',compact('publicationCategory'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublicationCategoryRequest $request, $id)
    {
        $this->can_update($this->model());
        try {
            $this->getID($id)->update($request->only('name','desc'));
            return redirect()->route('publicationCategories.index')->with('success','publication category has been updated!');
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
            return redirect()->route('publicationCategories.index')->with('success','publication category has been deleted!');
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
        $data = PublicationCategory::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return PublicationCategory::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('publicationCategories.index')->with('error','something went wrong');
    }
}
