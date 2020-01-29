<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\ItemRequest;
use App\Item;
use App\ItemCategory;
use Illuminate\Http\Request;

class ItemController extends Controller
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
    public function index(Item $item)
    {
        $this->authorize('read',$item);

        $items = $item->with('item_category')->get()->sortBy('name');

        $itemCategories = ItemCategory::select('id','name')->get();

        return view('items.index',compact('items','itemCategories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request, Item $item)
    {
        $this->authorize('create',$item);

        $item->create($request->only('name','desc','item_category_id'));

        return back()->with('success','Item has been saved!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $this->authorize('update',$item);

        $itemCategories = ItemCategory::select('id','name')->get();

        return view('items.edit',compact('item','itemCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, Item $item)
    {
        $this->authorize('update',$item);

        $item->update($request->only('name','desc','item_category_id'));

        return redirect()->route('items.index')->with('success','Item has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $this->authorize('delete',$item);

        $item->delete();

        return redirect()->route('items.index')->with('success','Item has been delete');
    }
}
