<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('security.permissions.index');
        }
        catch (\Exception $e) {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        $roles = $request['roles'];
        DB::beginTransaction();
        try {
            $permission = Permission::create($request->only('name','guard_name','desc'));
            if (!empty($roles)) { //If one or more role is selected
                foreach ($roles as $role) {
                    $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record
                    $permission = Permission::where('name', '=', $permission->name)->first(); //Match input //permission to db record
                    $r->givePermissionTo($permission);
                }
            }
            DB::commit();
            return back()->with('success','Permission has been saved!');
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
            $permission = $this->getID($id);
            return view('security.permissions.edit',compact('permission'));
        }
        catch (\Exception $e) {
            dd($e->getMessage());
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, $id)
    {
        $roles = $request->roles;

        DB::beginTransaction();
        try {
            $permission = $this->getID($id);
            $permission->update($request->only('name','guard_name','desc'));
            //Assign roles to user admin
            if (isset($roles)) {
                $permission->roles()->sync($roles);  //If one or more role is selected associate user to roles
            }
            else {
                $permission->roles()->detach(); //If no role is selected remove exisiting role associated to a user
            }
            DB::commit();
            return redirect()->route('permissions.index')->with('success','permission has been updated!');
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
            return back()->with('success','permission has been deleted');
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
        $data = Permission::findOrFail($id);
        return $data;
    }

    /*
    * Exception Error return back
    */
    public function errorReturn()
    {
        return redirect()->route('permissions.index')->with('error','something went wrong');
    }

}
