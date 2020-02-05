<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemCategoryRequest;
use App\ItemCategory;

class ItemCategoryController extends Controller
{
    /**
     * AdminController constructor.
     */
    function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ItemCategory $itemCategory)
    {
        $itemCategories = $itemCategory->get()->sortBy('sort');

        return view('items.categories.index',compact('itemCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemCategoryRequest $request, ItemCategory $itemCategory)
    {
        $itemCategory->create($request->only('name','desc','sort'));

        return back()->with('success','Item Category has been saved!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemCategory $itemCategory)
    {
        return view('items.categories.edit',compact('itemCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemCategoryRequest $request, ItemCategory $itemCategory)
    {
        $itemCategory->update($request->only('name','sort','desc'));

        return redirect()->route('itemCategories.index')->with('success','item category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemCategory $itemCategory)
    {
        $itemCategory->delete();

        return redirect()->route('itemCategories.index')->with('success','item category has been updated!');
    }
}
