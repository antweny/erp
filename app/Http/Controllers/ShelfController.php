<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShelfRequest;
use App\Shelf;
use Illuminate\Http\Request;

class ShelfController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $shelves = Shelf::get();
            return view('library.shelves.index',compact('shelves'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.e
     */
    public function store(ShelfRequest $request)
    {
        $this->can_create($this->model());
        try {
            Shelf::create($request->all());
            return back()->with('success','Shelf has been saved');
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->can_update($this->model());
        try {
            $shelf = $this->getID($id);
            return view('library.shelves.edit',compact('shelf'));
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShelfRequest $request, $id)
    {
        $this->can_update($this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('shelves.index')->with('success',' Shelf has been updated.');
        }
        catch (\Exception $e) {
            return redirect()->route('countries.index')->with('error','something went Wrong')->withInput($request->all());
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
            return back()->with('success','Shelf has been deleted');
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
    }
    /*
     * Get requested record ID
     */
    public function getID($id)
    {
        $data = Shelf::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Shelf::class;
    }

}
