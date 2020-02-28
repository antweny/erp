<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Http\Requests\ItemRequest;
use App\Imports\ItemsImport;
use App\Item;
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
    public function index()
    {
        $this->can_read($this->model());
        try {
            $items = Item::with('item_category','item_unit')->get()->sortBy('name');
            return view('store.items.index',compact('items'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $this->can_create($this->model());
        try {
            Item::create($request->all());
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
        $this->can_update($this->model());
        try{
            $item = $this->getID($id);
            return view('store.items.edit',compact('item'));
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
        $this->can_update($this->model());
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
        $this->can_delete($this->model());
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
        $this->can_import($this->model());
        Excel::import(new ItemsImport,request()->file('imported_file'));
        return back()->with('success','Items imported successfully!');
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
    * Exception Error return back
    */
    public function errorReturn()
    {
        return redirect()->route('items.index')->with('error','something went wrong');
    }


}
