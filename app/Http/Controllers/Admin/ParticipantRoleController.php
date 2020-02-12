<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\ParticipantRoleRequest;
use App\ParticipantRole;
use Illuminate\Http\Request;

class ParticipantRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ParticipantRole $participantRole)
    {
        $this->authorize('read',$participantRole);
        $participantRoles = $participantRole->latest()->get();
        return view('participants.roles.index',compact('participantRoles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParticipantRoleRequest $request, ParticipantRole $participantRole)
    {
        $this->authorize('create',$participantRole);
        try {
            $participantRole->create($request->only('name','desc'));
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
        $this->authorize('update',$this->model());
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
