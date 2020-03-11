<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['auth:admin','role:superAdmin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $admins = Admin::get();  //Get all administrators
            return view('security.admins.index',compact('admins'));
        }
        catch (\Exception $e) {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $roles = $request['roles'];
        DB::beginTransaction();
        try {
            $this->password_encryption($request);
            $admin = Admin::create($request->only('name','email','password'));
            if(isset($roles)) {
                $admin->assignRole($roles);
            }
            DB::commit();
            return back()->with('success','admin has been added');
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
            $admin = $this->getID($id);
            return view('security.admins.edit')->with(compact('admin'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, $id)
    {
        $roles = $request->roles; //Get all assign roles
        DB::beginTransaction();
        try {
            $admin = $this->getID($id);
            $admin->update($request->only('name'));
            //Assign roles to user admin
            if (isset($roles)) {
                $admin->roles()->sync($roles);  //If one or more role is selected associate user to roles
            }
            else {
                $admin->roles()->detach(); //If no role is selected remove exisiting role associated to a user
            }
            DB::commit();
            return redirect()->route('admin.index')->with('success','Admin updated successfully!');
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
            return back()->with('success','Administrator has been deleted');
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
        $data = Admin::findOrFail($id);
        return $data;
    }

    /*
    * Exception Error return back
    */
    public function errorReturn()
    {
        return redirect()->route('admin.index')->with('error','something went wrong');
    }

    /*
     * Get Password Reset Form
     */
    public function resetPasswordForm($id)
    {
        try {
            $admin = $this->getID($id);
            return view('security.admins.reset_password')->with(compact('admin'));
        }
        catch (\Exception $e) {
            return redirect()->route('admin.index')->with('error','Something went wrong');
        }
    }

    /*
     * Password Reset Form
     */
    public function reset_password(PasswordResetRequest $request,$id)
    {
        try {
            $admin = $this->getID($id);
            $this->password_encryption($request);
            $admin->update($request->only('password'));
            return redirect()->route('admin.index')->with('success','Password for user '.$admin->name. ' updated successfuly');
        }
        catch (\Exception $e) {
            return redirect()->route('admin.index')->with('error','Something went wrong');
        }
    }

    /*
     * Encrypt the Password
     */
    protected function password_encryption($request)
    {
        $request['password'] = Hash::make($request['password']);
        return $request;
    }

}
