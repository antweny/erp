<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\ItemRequest;
use App\Item;
use App\ItemCategory;
use App\ItemUnit;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Item $item)
    {
        $this->authorize('read',$item);

        $items = $item->with('item_category','item_unit')->get()->sortBy('name');

        $itemCategories = ItemCategory::select('id','name')->get();

        $itemUnits = ItemUnit::select('id','name')->get();

        return view('items.index',compact('items','itemCategories','itemUnits'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request, Item $item)
    {
        $this->authorize('create',$item);

        $item->create($request->all());

        return back()->with('success','Item has been saved!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $this->authorize('update',$item);

        $itemCategories = ItemCategory::select('id','name')->get();

        $itemUnits = ItemUnit::select('id','name')->get();

        return view('items.edit',compact('item','itemCategories','itemUnits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, Item $item)
    {
        $this->authorize('update',$item);

        $item->update($request->all());

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
