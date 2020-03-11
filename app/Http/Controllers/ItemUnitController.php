<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemUnitRequest;
use App\ItemUnit;


class ItemUnitController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            return view('store.itemUnits.index');
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemUnitRequest $request)
    {
        $this->can_create($this->model());
        try {
            ItemUnit::create($request->only('name','desc','sort'));
            return back()->with('success','Item Unit has been saved!');
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
            $itemUnit= $this->getID($id);
            return view('store.itemUnits.edit',compact('itemUnit'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemUnitRequest $request,$id)
    {
        $this->can_update($this->model());
        try {
            $this->getID($id)->update($request->only('name','sort','desc'));
            return redirect()->route('itemUnits.index')->with('success','item unit has been updated!');
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
            return redirect()->route('itemUnits.index')->with('success','item unit has been delete!');
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
        $data = ItemUnit::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return ItemUnit::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('itemUnits.index')->with('error','something went wrong');
    }


}
