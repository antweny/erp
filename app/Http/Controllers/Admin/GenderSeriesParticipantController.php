<?php

namespace App\Http\Controllers\Admin;

use App\GenderSeries;
use App\Http\Controllers\Controller;

use App\GenderSeriesParticipant;
use App\Http\Requests\GenderSeriesParticipantRequest;
use App\Individual;
use App\Organization;
use App\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $wards = Ward::get_name_and_id();

        $individuals = Individual::get_name_and_id();

        $organizations = Organization::get_name_and_id();

        $genders = GenderSeries::select('topic','id')->get();

        return view('participants.genderSeries.create', compact('genders','wards','individuals','organizations','genderSeriesParticipant'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(GenderSeriesParticipantRequest $request, GenderSeriesParticipant $genderSeriesParticipant)
    {
        $this->authorize('create',$genderSeriesParticipant);

        $request['ward_id'] = $this->check_ward($request['ward']);

        // assume it won't work
        $success = false;

        DB::beginTransaction();

        try {
            if ($this->check_unique_individual_and_gender_series($request) < 0) {
                $genderSeriesParticipant->create($request->only('individual_id','organization_id','ward_id','gender_series_id'));
                $success = true;
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
        if ($success) {
            DB::commit();
            return back()->with('success','Participants has been added');
        } else {
            DB::rollback();
            return back()->with('error','This User already added')->withInput($request->input());
        }

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GenderSeriesParticipant $genderSeriesParticipant)
    {
        $this->authorize('update',$genderSeriesParticipant);

        $wards = Ward::get_name_and_id();

        $individuals = Individual::get_name_and_id();

        $organizations = Organization::get_name_and_id();

        $genders = GenderSeries::select('topic','id')->get();

        return view('participants.genderSeries.edit', compact('genders','wards','individuals','organizations','genderSeriesParticipant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenderSeriesParticipantRequest $request, GenderSeriesParticipant $genderSeriesParticipant)
    {
        $this->authorize('update',$genderSeriesParticipant);

        $request['ward_id'] = $this->check_ward($request['ward']);

        $success = false;

        DB::beginTransaction();

        try {
            if ($this->check_unique_individual_and_gender_series($request) < 0) {
                $genderSeriesParticipant->update($request->only('individual_id','organization_id','ward_id','gender_series_id'));
                $success = true;
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
        if ($success) {
            DB::commit();
            return redirect()->route('genderSeriesParticipants.index')->with('success',' Participants has been updated');
        } else {
            DB::rollback();
            return back()->with('error','This User already added')->withInput($request->input());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GenderSeriesParticipant  $genderSeriesParticipant
     * @return \Illuminate\Http\Response
     */
    public function destroy(GenderSeriesParticipant $genderSeriesParticipant)
    {
        $this->authorize('delete',$genderSeriesParticipant);

        $genderSeriesParticipant->delete();

        return back()->with('success',' Participants deleted successfully');
    }



    /*
     * Check if user already added as participant on the event on the same day
     */
    public function check_unique_individual_and_gender_series ($request)
    {
        //if(!empty($genderSeriesPartcipant)) {

        //}
       // else {
            $query = GenderSeriesParticipant::where('individual_id',$request['individual_id'])
                ->where('gender_series_id',$request['gender_series_id'])
                ->count();;

            return $query;
        //}

    }

    /*
    * Get Ward ID
    */
    public function check_ward($request)
    {
        $name = new Ward();
        return $name->get_id($request);
    }
}
