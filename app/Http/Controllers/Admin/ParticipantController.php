<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Controller;

use App\Event;
use App\Group;
use App\Http\Requests\ParticipantRequest;
use App\Individual;
use App\Organization;
use App\Participant;
use App\ParticipantRole;
use App\Repositories\ParticipantRepository;
use App\Ward;
use Illuminate\Support\Facades\DB;

class ParticipantController extends Controller
{
    protected $participant = null;

    public function __construct(ParticipantRepository $participant)
    {
        parent::__construct();
        $this->participant = $participant;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('read',$this->model());  //Check current logged user has this permission

        $participants = $this->participant->all();

        return view('participants.index',compact('participants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Participant $participant)
    {
        $this->authorize('read',$participant);  //Check current logged user has this permission

        return $this->populate(__FUNCTION__,$participant);
    }

    /**
     * Display the specified resource.
     */
    public function store(ParticipantRequest $request, Participant $participant)
    {
        $this->authorize('read',$participant);    //Check current logged user has this permission

        $request['ward_id'] = $this->check_ward($request['ward']); //Get ward ID

        try {
            $participant->create($request->only('individual_id','organization_id','ward_id','event_id','date','slug','level','participant_role_id','individual_group_id'));
            return back()->with('success',' Participants has been saved');
        }
        catch (\Exception $e) {
            return back()->with('error','The user hass already been added')->withInput($request->all());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('update',$this->model());  //Check current logged user has this permission
        try {
            $participant = $this->getID($id);
            return $this->populate(__FUNCTION__,$participant);
        }
        catch (\Exception $e) {
            return redirect()->route('participants.index')->with('error','something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParticipantRequest $request,$id)
    {
        $this->authorize('update',$this->model());  //Check current logged user has this permission

        $request['ward_id'] = $this->check_ward($request['ward']);   //Get ward ID

        try {
            $this->getID($id)->update($request->only('individual_id','organization_id','ward_id','event_id','date','slug','level','participant_role_id','individual_group_id'));
            return redirect()->route('participants.index')->with('success',' Participants hass been updated');
        }
        catch (\Exception $e) {
            return redirect()->route('participants.index')->with('error','something went wrong');
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
            return redirect()->route('participants.index')->with('error','something went wrong');
        }
    }

    /*
     * Get requested record ID
     */
    public function getID($id)
    {
        $participant = Participant::findOrFail($id);
        return $participant;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return Participant::class;
    }

    /*
     * Check if ward name already exists and get ID if not create and get ID
     */
    public function check_ward($request)
    {
        $name = new Ward();
        return $name->get_id($request);
    }

    /*
     * Populate dropdowns values from different tables and return to forms
     */
    public function populate($function_name, $participant) {
        $events = Event::get_name_and_id();
        $wards =Ward::get_name_and_id();
        $individuals = Individual::get_name_and_id();
        $organizations = Organization::get_name_and_id();
        $roles = ParticipantRole::get_name_and_id();
        $groups = Group::get_name_and_id();
        $data = compact('events','wards','individuals','organizations','roles' ,'groups', 'participant');
        return view('participants.' .$function_name , $data);
    }
}
