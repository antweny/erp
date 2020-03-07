<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Publication;
use App\Author;
use App\Publisher;
use App\Shelf;
use App\PublicationCategory;
use App\Http\Requests\PublicationRequest;
use App\Http\Requests\ImportRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PublicationImport;


class PublicationController extends Controller
{
    /**
     * AdminController constructor.
     */
    function __construct()
    {
        $this->middleware('auth:admin',['only'=> ['index','create','store','edit','update','destroy','import']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $publications = Publication::with(['author','publisher','shelf','genre','publication_category'])->get();
            return view('library.publications.index',compact('publications'));
        }
        catch (\Exception $e) {
            dd($e->getMessage());
            abort(404);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->can_create($this->model());
        try {
            $publication = new Publication();
            return $this->populate(__FUNCTION__,$publication);
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PublicationRequest $request)
    {
        $this->can_create($this->model());
        try {
            Publication::create($request->all());
            return back()->with('success','Publication has been saved!');
        }
        catch (\Exception $e) {
            return back()->with('error',$e->getMessage())->withInput($request->input());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->can_update($this->model());
        try {
            $publication = $this->getID($id);
            return $this->populate(__FUNCTION__,$publication);
        }
        catch (\Exception $e) {
            return back()->with('error','something went Wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublicationRequest $request,$id)
    {
        $this->can_update($this->model());
        try {
            $this->getID($id)->update($request->all());
            return redirect()->route('publications.index')->with('success','Publication has been saved!');
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
            return redirect()->route('publications.index')->with('success','Publication has been deleted!');
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
        //$this->can_create($this->model());
        Excel::import(new PublicationImport,request()->file('imported_file'));
        return back()->with('success','Publications imported successfully!');


    }

    /*
    * Populate dropdowns values from different tables and return to forms
    */
    public function populate ($function_name,$publication)
    {
        $genres = Genre::getNameID();
        $categories = PublicationCategory::getNameID();
        $authors = Author::getNameID();
        $publishers = Publisher::getNameID();
        $shelves = Shelf::getNameID();
        $data = compact('publication','authors','publishers','categories','genres','shelves');
        return view('library.publications.'.$function_name, $data);
    }

    /*
     * Get requested record ID
     */
    public function getID($id)
    {
        $data = Publication::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Publication::class;
    }
}
