<?php

namespace App\Http\Controllers;

use App\GenderSeries;
use App\GenderSeriesParticipant;
use App\Http\Requests\GenderSeriesParticipantRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\GenderSeriesParticipantsImport;
use App\Ward;
use Maatwebsite\Excel\Facades\Excel;

class GenderSeriesParticipantController extends Controller
{
    /**
     * Authorization constructor.
     */
    function __construct()
    {
        $this->middleware('auth:admin',['only'=> ['index','store','create','show','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $genderParticipants = GenderSeriesParticipant::with('individual','organization','gender_series')->get();
            return view('participants.genderSeries.index', compact('genderParticipants'));
        }
        catch (\Exception $e) {
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
            $genderSeriesParticipant = new GenderSeriesParticipant();
            return $this->populate(__FUNCTION__,$genderSeriesParticipant );
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenderSeriesParticipantRequest $request)
    {
        $this->can_create($this->model());
        try {
            GenderSeriesParticipant::create($request->only('individual_id','organization_id','ward_id','gender_series_id'));
            return back()->with('success','Participants has been added');
        }
        catch (\Exception $e) {
            return back()->with('error','This user already attended this event')->withInput($request->input());
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function show($id)
    {
        $this->can_read($this->model());
        try {
            $genderParticipants = GenderSeriesParticipant::with('individual','organization','gender_series')->where('gender_series_id',$id)->get();
            return view('participants.genderSeries.index', compact('genderParticipants'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->can_update($this->model());
        try{
            $genderSeriesParticipant = $this->getID($id);
            return $this->populate(__FUNCTION__,$genderSeriesParticipant);
        }
        catch (\Exception $e) {
            return  $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenderSeriesParticipantRequest $request, $id)
    {
        $this->can_update($this->model());
        try {
            $this->getID($id)->update($request->only('individual_id','organization_id','ward_id','gender_series_id'));
            return redirect()->route('genderSeriesParticipants.index')->with('success',' Participants hass been updated');
        }
        catch (\Exception $e) {
            return back()->with('error','This user already attended this event')->withInput($request->input());
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
            return back()->with('success',' Participants has been deleted');
        }
        catch (\Exception $e) {
            return  $this->errorReturn();
        }
    }

    /*
     * Import Data from Excel
     */
    public function import (ImportRequest $request)
    {
        $this->can_create($this->model());
        Excel::import(new GenderSeriesParticipantsImport,request()->file('imported_file'));
        return back()->with('success','Gender Participants have been imported');
    }

    /*
    * Get Ward ID
    */
    public function check_ward($request)
    {
        $name = new Ward();
        return $name->get_id($request);
    }

    /*
     * Populate dropdowns values from different tables and return to forms
     */
    public function populate($function_name, $genderSeriesParticipant) {
        $genders = GenderSeries::select('topic','id')->get();
        $data = compact('genders','genderSeriesParticipant');
        return view('participants.genderSeries.' .$function_name , $data);
    }

    /*
     * Get requested record ID
     */
    public function getID($id)
    {
        $data = GenderSeriesParticipant::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return GenderSeriesParticipant::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('genderSeriesParticipants.index')->with('error','something went wrong');
    }




}
