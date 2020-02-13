<?php

namespace App\Http\Controllers\Admin;

use App\GenderSeries;
use App\Http\Controllers\Controller;
use App\GenderSeriesParticipant;
use App\Http\Requests\GenderSeriesParticipantRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\GenderSeriesParticipantsImport;
use App\Individual;
use App\Organization;
use App\Ward;
use Maatwebsite\Excel\Facades\Excel;

class GenderSeriesParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GenderSeriesParticipant $genderSeriesParticipant)
    {
        $this->authorize('read',$genderSeriesParticipant);

        $genderParticipants = $genderSeriesParticipant->with('individual','organization','gender_series')->get();

        return view('participants.genderSeries.index', compact('genderParticipants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(GenderSeriesParticipant $genderSeriesParticipant)
    {
        $this->authorize('create',$genderSeriesParticipant);
        return $this->populate(__FUNCTION__, $genderSeriesParticipant);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(GenderSeriesParticipantRequest $request, GenderSeriesParticipant $genderSeriesParticipant)
    {
        $this->authorize('create',$genderSeriesParticipant);

        $request['ward_id'] = $this->check_ward($request['ward']);

        try {
            $genderSeriesParticipant->create($request->only('individual_id','organization_id','ward_id','gender_series_id'));
            return back()->with('success','Participants has been added');
        }
        catch (\Exception $e) {
            return back()->with('error','This user already attended this event')->withInput($request->input());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('update',$this->model());
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
        $this->authorize('update',$this->model());

        $request['ward_id'] = $this->check_ward($request['ward']);  //Get the Ward Name

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
        $this->authorize('delete',$this->model());
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
        $this->authorize('create',$this->model());
        try {
            Excel::import(new GenderSeriesParticipantsImport,request()->file('imported_file'));
            return back()->with('success','Gender Participants have been imported');
        }
        catch (\Exception $e){
            return redirect()->route('genderSeriesParticipants.index')->with('error',$e->getMessage());
        }
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
        $wards = Ward::get_name_and_id();
        $individuals = Individual::get_name_and_id();
        $organizations = Organization::get_name_and_id();
        $genders = GenderSeries::select('topic','id')->get();
        $data = compact('genders','wards','individuals','organizations','genderSeriesParticipant');
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
