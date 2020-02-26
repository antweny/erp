<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Http\Requests\ItemRequest;
use App\Imports\ItemsImport;
use App\Item;
use App\ItemCategory;
use App\ItemUnit;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{
    /**
     * AdminController constructor.
     */
    function __construct()
    {
        $this->middleware('auth:admin',['only'=> ['index','create','store','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Item $item)
    {
        $this->authorize('read',$item);
        try {
            $items = $item->with('item_category','item_unit')->get()->sortBy('name');
            $itemCategories = ItemCategory::select('id','name')->get();
            $itemUnits = ItemUnit::select('id','name')->get();
            return view('store.items.index',compact('items','itemCategories','itemUnits'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request, Item $item)
    {
        $this->authorize('create',$item);
        try {
            $item->create($request->all());
            return back()->with('success','Item has been saved!');
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
            $item = $this->getID($id);
            return $this->populate(__FUNCTION__,$item);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, $id)
    {
        $this->authorize('update',$this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('items.index')->with('success','Item has been updated!');
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
            return redirect()->route('items.index')->with('success','Item has been delete');
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /*
    * Import Data from Excel
    */
    public function import (ImportRequest $request)
    {
        $this->authorize('create',$this->model());
        //try {
            Excel::import(new ItemsImport,request()->file('imported_file'));
            return back()->with('success','Items imported successfully!');
       // }
       // catch (\Exception $e){
       //     return $this->errorReturn();
       // }
    }


    /*
    * Get requested record ID
    */
    public function getID($id)
    {
        $participant = Item::findOrFail($id);
        return $participant;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Item::class;
    }

    /*
    * Populate dropdowns values from different tables and return to forms
    */
    public function populate($function_name, $item) {
        $itemCategories = ItemCategory::select('id','name')->get();
        $itemUnits = ItemUnit::select('id','name')->get();
        $data = compact('item','itemCategories','itemUnits');
        return view('store.items.' .$function_name , $data);
    }

    /*
    * Exception Error return back
    */
    public function errorReturn()
    {
        return redirect()->route('items.index')->with('error','something went wrong');
    }


}
