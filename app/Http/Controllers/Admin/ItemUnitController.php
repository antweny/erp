<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemUnitRequest;
use App\ItemUnit;


class ItemUnitController extends Controller
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
    public function index(ItemUnit $itemUnit)
    {
        $this->authorize('read',$itemUnit);

        $itemUnits = $itemUnit->get();

        return view('items.units.index',compact('itemUnits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemUnitRequest $request, ItemUnit $itemUnit)
    {
        $this->authorize('create',$itemUnit);

        $itemUnit->create($request->only('name','desc','sort'));

        return back()->with('success','Item Unit has been saved!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemUnit $itemUnit)
    {
        $this->authorize('update',$itemUnit);

        return view('items.units.edit',compact('itemUnit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemUnitRequest $request, ItemUnit $itemUnit)
    {
        $this->authorize('update',$itemUnit);

        $itemUnit->update($request->only('name','sort','desc'));

        return redirect()->route('itemUnits.index')->with('success','item unit has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemUnit $itemUnit)
    {
        $this->authorize('delete',$itemUnit);

        $itemUnit->delete();

        return redirect()->route('itemUnits.index')->with('success','item unit has been updated!');
    }
}
