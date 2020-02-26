<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Role;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * AdminController constructor.
     */
    function __construct()
    {
        $this->middleware(['auth:admin','role:superAdmin']);
    }

    /**
     * Admin index page
     */
    public function index(Admin $admin)
    {
        $roles = Role::select('id','name')->where('guard_name','admin')->get();   //Get all roles

        $admins = $admin->get();  //Get all administrators

        return view('admin.admins.index',compact('admins','roles'));
    }

    /**
     * Show the form for creating the specified resource.
     */
    public function store(AdminRequest $request, Admin $admin)
    {
        //Hash the human password
        $this->password_encryption($request);

        $admin = $admin->create($request->only('name','email','password'));

        $roles = $request['roles'];

        if(isset($roles))
        {
            $admin->assignRole($roles);
        }

        return back()->with('success','admin has been added');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $roles = Role::select('id','name')->get();

        return view('admin.admins.edit')->with(compact('admin','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        $roles = $request->roles; //Get all assign roles

        $admin->update($request->only('name'));

        //Assign roles to user admin
        if (isset($roles)) {
            $admin->roles()->sync($roles);  //If one or more role is selected associate user to roles
        }
        else {
            $admin->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        return redirect()->route('admin.index')->with('success','Admin updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();

        return back()->with('success','admin has been deleted');
    }

    /*
     * Get Password Reset Form
     */
    public function resetPasswordForm($id)
    {
        try {
            $admin = $this->getID($id);
            return view('admin.admins.reset_password')->with(compact('admin'));
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


    /*
   * Get requested record ID
   */
    public function getID($id)
    {
        $participant = Admin::findOrFail($id);
        return $participant;
    }
}
