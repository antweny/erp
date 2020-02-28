<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemCategoryRequest;
use App\ItemCategory;

class ItemCategoryController extends Controller
{
    /**
     * Auth constructor.
     */
    function __construct()
    {
        $this->middleware('auth:admin',['only'=> ['index','store','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            return view('store.itemCategories.index');
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemCategoryRequest $request)
    {
        $this->can_create($this->model());
        try {
            ItemCategory::create($request->only('name','desc','sort'));
            return back()->with('success','Item Category has been saved!');
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
            $itemCategory = $this->getID($id);
            return view('store.itemCategories.edit',compact('itemCategory'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemCategoryRequest $request, $id)
    {
        $this->can_update($this->model());
        try {
            $this->getID($id)->update($request->only('name','sort','desc'));
            return redirect()->route('itemCategories.index')->with('success','item category has been updated!');
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
            return redirect()->route('itemCategories.index')->with('success','item category has been deleted!');
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
        $data = ItemCategory::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return ItemCategory::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('itemCategories.index')->with('error','something went wrong');
    }
}
