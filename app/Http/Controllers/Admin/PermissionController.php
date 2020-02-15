<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Controller;

use App\Http\Requests\PermissionRequest;
use App\Permission;
use App\Role;

class PermissionController extends Controller
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
    public function index(Permission $permission)
    {

        $permissions = $permission->latest()->get();

        $roles = Role::orderBy('name','asc')->get();

        return view('admin.permissions.index')->with(compact('roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request, Permission $permission)
    {
        $roles = $request['roles'];

        $permission = $permission->create($request->only('name','guard_name','desc'));

        if (!empty($roles)) { //If one or more role is selected
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record
                $permission = Permission::where('name', '=', $permission->name)->first(); //Match input //permission to db record
                $r->givePermissionTo($permission);
            }
        }

        return back()->with('success','Permission has been saved!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        $roles = Role::orderBy('name','asc')->get();
        return view('admin.permissions.edit',compact('permission','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $roles = $request->roles;

        $permission->update($request->only('name','guard_name','desc'));

        //Assign roles to user admin
        if (isset($roles)) {
            $permission->roles()->sync($roles);  //If one or more role is selected associate user to roles
        }
        else {
            $permission->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        return redirect()->route('permissions.index')->with('success','permission has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back()->with('success','Permission has been deleted');
    }




}
