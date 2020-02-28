<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * AdminController constructor.
     */
    function __construct()
    {
        $this->middleware(['auth:admin','role:superAdmin'],['only'=> ['index','store','create','edit','update','destroy']]);

    }

    /**
     * User index page
     */
    public function index()
    {
        try {
            $users = User::get();
            return view('security.users.index',compact('users'));
        }
        catch (\Exception $e) {
            return abort(404);
        }
    }

    /**
     * Show the form for creating the specified resource.
     */
    public function store(UserRequest $request, User $user)
    {
        $roles = $request['roles'];
        DB::beginTransaction();
        try {
            $this->password_encryption($request);
            $user = $user->create($request->only('name','email','password'));
            if(isset($roles)) {
                $user->assignRole($roles);
            }
            DB::commit();
            return back()->with('success','user has been added');
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
            $user = $this->getID($id);
            return view('security.users.edit')->with(compact('user'));
        }
        catch (\Exception $e) {
            return $this->errorReturn();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $roles = $request->roles; //Get all assign roles
        DB::beginTransaction();
        try {
            $user = $this->getID($id);
            $user->update($request->only('name'));
            //Assign roles to user user
            if (isset($roles)) {
                $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
            }
            else {
                $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
            }
            DB::commit();
            return redirect()->route('users.index')->with('success','User updated successfully!');
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
            return back()->with('success','User has been deleted');
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
        $data = User::findOrFail($id);
        return $data;
    }

    /*
    * Exception Error return back
    */
    public function errorReturn()
    {
        return redirect()->route('users.index')->with('error','something went wrong');
    }

    /*
     * Get Password Reset Form
     */
    public function resetPasswordForm($id)
    {
        try {
            $user= $this->getID($id);
            return view('security.users.reset_password')->with(compact('user'));
        }
        catch (\Exception $e) {
            return redirect()->route('users.index')->with('error','Something went wrong');
        }
    }

    /*
     * Password Reset Form
     */
    public function reset_password(PasswordResetRequest $request,$id)
    {
        try {
            $user = $this->getID($id);
            $this->password_encryption($request);
            $admin->update($request->only('password'));
            return redirect()->route('users.index')->with('success','Password for user '.$user->name. ' updated successfuly');
        }
        catch (\Exception $e) {
            return redirect()->route('users.index')->with('error','Something went wrong');
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
