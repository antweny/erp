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

        $participantRole->create($request->only('name','desc'));

        return back()->with('success',' Participant Role has been saved');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParticipantRole $participantRole)
    {
        $this->authorize('update',$participantRole);

        return view('participants.roles.edit',compact('participantRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParticipantRoleRequest $request, ParticipantRole $participantRole)
    {
        $this->authorize('update',$participantRole);

        $participantRole->update($request->only('name','desc'));

        return redirect()->route('participantRoles.index')->with('success',' Participant Role has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParticipantRole $participantRole)
    {
        $this->authorize('delete',$participantRole);

        $participantRole->delete();

        return back()->with('success','Participant Role has been deleted ');
    }
}
