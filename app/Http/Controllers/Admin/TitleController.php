<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\TitleRequest;
use App\Imports\TitleImport;
use App\Title;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Title $title)
    {
        $this->authorize('read',$title);

        $titles = $title->latest()->get();

        return view('titles.index',compact('titles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TitleRequest $request, Title $title)
    {
        $this->authorize('create',$title);

        $title->create($request->only('name','desc'));

        return back()->with('success',' Title has been saved');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Title $title)
    {
        $this->authorize('update',$title);

        return view('titles.edit',compact('title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TitleRequest $request, Title $title)
    {
        $this->authorize('update',$title);

        $title->update($request->only('name','desc'));

        return redirect()->route('titles.index')->with('success',' Title has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Title $title)
    {
        $this->authorize('delete',$title);

        $title->delete();

        return back()->with('success','Title has been deleted');
    }

    /*
   * Import Data from Excel
   */
    public function import (ImportRequest $request, Title $title)
    {
        $this->authorize('import',$title);

        if ($request->file('imported_file')) {
            Excel::import(new TitleImport(), request()->file('imported_file'));
            return back()->with('success','titles imported successfully!');
        }
    }



}
