<?php

namespace App\Http\Controllers;


use App\Http\Requests\SectorRequest;
use App\Sector;


class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $sectors = Sector::latest()->get();
            return view('organizations.sectors.index',compact('sectors'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectorRequest $request)
    {
        $this->can_create($this->model());
        try {
           Sector::create($request->only('name','desc'));
            return back()->with('success',' Sector has been saved');
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
            $sector = $this->getID($id);
            return view('organizations.sectors.edit',compact('sector'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectorRequest $request, $id)
    {
        $this->can_update($this->model());
        try {
            $this->getID($id)->update($request->only('name','desc'));
            return redirect()->route('sectors.index')->with('success',' Sector has been updated');
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
            return back()->with('success','Sector has been deleted');
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
        $data = Sector::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Sector::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('sectors.index')->with('error','something went wrong');
    }

}
