<?php


namespace App\Http\Controllers;

use App\Http\Requests\ParticipantRoleRequest;
use App\Participant;
use App\ParticipantRole;
use Illuminate\Http\Request;

class ParticipantRoleController extends Controller
{
    /**
     * Controller constructor.
     */
    function __construct()
    {
        $this->middleware('auth:admin',['only'=> ['index','store','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->can_read($this->model());
        try {
            $participantRoles = ParticipantRole::latest()->get();
            return view('participants.roles.index',compact('participantRoles'));
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParticipantRoleRequest $request)
    {
        $this->can_create($this->model());
        try {
            ParticipantRole::create($request->only('name','desc'));
            return back()->with('success',' Participant Role has been saved');
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->can_update($this->model());
        try{
            $participantRole = $this->getID($id);
            return view('participants.roles.edit',compact('participantRole'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParticipantRoleRequest $request,$id)
    {
        $this->authorize('update',$this->model());

        try {
            $this->getID($id)->update($request->only('name','desc'));
            return redirect()->route('participantRoles.index')->with('success',' Participant Role has been updated');
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
        $this->authorize('delete',$this->model());
        try {
            $this->getID($id)->delete();
            return back()->with('success','Participant Role has been deleted ');
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
        $data = ParticipantRole::findOrFail($id);
        return $data;
    }

    /*
     * Initialize the controler model class
     */
    public function model ()
    {
        return ParticipantRole::class;
    }

    /*
     * Exception Error return back
     */
    public function errorReturn()
    {
        return redirect()->route('participantRoles.index')->with('error','something went wrong');
    }


}
