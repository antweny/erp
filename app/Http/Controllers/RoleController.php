<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * AdminController constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->middleware(['auth:admin','role:superAdmin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*$role = Role::where('name','superAdmin')->first();
        $permissions = Permission::get();
        foreach ($permissions as $permission)
        {
            $role->givePermissionTo($permission);
        }*/
        try {
            return view('security.roles.index');
        }
        catch (\Exception $e) {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $permissions = $request['permissions'];
        DB::beginTransaction();
        try {
            $role = Role::create($request->only('name','guard_name','desc'));
            //Looping through selected permissions
            if (isset($permissions)) {
                foreach ($permissions as $permission) {
                    $per = Permission::where('id', $permission)->firstOrFail();
                    $role->givePermissionTo($per);
                }
            }
            DB::commit();
            return back()->with('success','role has been saved');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error','Something went wrong')->withInput($request->input());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{
           $role = $this->getID($id);
            return view('security.roles.edit',compact('role'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, $id)
    {
        $permissions = $request->permissions;

        DB::beginTransaction();
        try {
            $role = $this->getID($id);
            $role->update($request->only('name','guard_name','desc'));
            //Assign roles to user admin
            if (isset($permissions)) {
                $role->permissions()->sync($permissions);  //If one or more role is selected associate user to roles
            } else {
                $role->permissions()->detach(); //If no role is selected remove exisiting role associated to a user
            }
            DB::commit();
            return redirect()->route('roles.index')->with('success','Role updated successfully!');
        }
        catch (\Exception $e) {
            DB::rollback();
            return $this->errorReturn();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->getID($id)->delete();
            return back()->with('success','role has been deleted');
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
        $data = Role::findOrFail($id);
        return $data;
    }

    /*
    * Exception Error return back
    */
    public function errorReturn()
    {
        return redirect()->route('roles.index')->with('error','something went wrong');
    }

}
