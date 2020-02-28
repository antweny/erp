<?php

namespace App\Http\Controllers;


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
    /**
     * Authorization constructor.
     */
    function __construct(ParticipantRepository $participant)
    {
        $this->middleware('auth:admin',['only'=> ['index','store','create','edit','update','destroy']]);
        $this->participant = $participant;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $participants = $this->participant->all();

            return view('participants.index',compact('participants'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Participant $participant)
    {
        $this->can_create($this->model());
        try {
            $participant =new Participant();
            return view('participants.create', compact('participant'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Display the specified resource.
     */
    public function store(ParticipantRequest $request)
    {
        $this->can_create($this->model());    //Check current logged user has this permission
        try {
            Participant::create($request->all());
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
        $this->can_update($this->model());  //Check current logged user has this permission
        try {
            $participant = $this->getID($id);
            return view('participants.edit', compact('participant'));
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
        $this->can_update($this->model());  //Check current logged user has this permission
        try {
            $this->getID($id)->update($request->all());
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
        $this->can_delete($this->model());
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

}
