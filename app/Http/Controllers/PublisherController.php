<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublisherRequest;
use App\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $publishers = Publisher::latest()->get();
            return view('library.publishers.index',compact('publishers'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PublisherRequest $request)
    {
        $this->can_create($this->model());
        try {
            Publisher::create($request->all());
            return back()->with('success',' Publisher has been saved');
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
            $publisher = $this->getID($id);
            return view('library.publishers.edit',compact('publisher'));
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublisherRequest $request, $id)
    {
        $this->can_update($this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('publishers.index')->with('success',' Publisher has been updated.');
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong')->withInput($request->all());
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
            return back()->with('success','Publisher has been deleted');
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
        $data = Publisher::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Publisher::class;
    }
}
