<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\SectorRequest;
use App\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Sector $sector)
    {
        $this->authorize('read',$sector);

        $sectors = $sector->latest()->get();

        return view('organizations.sectors.index',compact('sectors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectorRequest $request, Sector $sector)
    {
        $this->authorize('create',$sector);

        $sector->create($request->only('name','desc'));

        return back()->with('success',' Sector has been saved');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sector $sector)
    {
        $this->authorize('update',$sector);

        return view('organizations.sectors.edit',compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectorRequest $request, Sector $sector)
    {
        $this->authorize('update',$sector);

        $sector->update($request->only('name','desc'));

        return redirect()->route('sectors.index')->with('success',' Sector has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sector $sector)
    {
        $this->authorize('delete',$sector);

        $sector->delete();

        return back()->with('success','Sector has been deleted');
    }

}
