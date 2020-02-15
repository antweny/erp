<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Controller;


use App\Http\Requests\RoleRequest;
use App\Permission;
use App\Role;

class RoleController extends Controller
{
    /**
     * AdminController constructor.
     */
    function __construct()
    {
        $this->middleware(['auth:admin','role:superAdmin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Role $role)
    {
        $roles = $role->orderBy('name','desc')->get();

        $permissions = Permission::orderBy('name','asc')->get();

        return view('admin.roles.index')->with(compact('roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request, Role $role)
    {
        //store all permissions assign to roles
        $permissions = $request['permissions'];

        $role = $role->create($request->only('name','guard_name','desc'));

        //Looping through selected permissions
        if (isset($permissions)) {
            foreach ($permissions as $permission) {
                $per = Permission::where('id', $permission)->firstOrFail();
                $role->givePermissionTo($per);
            }
        }
        return back()->with('success','role has been saved');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('name','asc')->get();

        return view('admin.roles.edit',compact('permissions','role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $permissions = $request->permissions;

        $role->update($request->only('name','guard_name','desc'));

        //Assign roles to user admin
        if (isset($permissions)) {
            $role->permissions()->sync($permissions);  //If one or more role is selected associate user to roles
        }
        else {
            $role->permissions()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        return redirect()->route('roles.index')->with('success','Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('success','role has been deleted');
    }

}
