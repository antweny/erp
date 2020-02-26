<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * AdminController constructor.
     */
    function __construct()
    {
        $this->middleware('auth:admin',['only'=> ['index','store','edit','update','destroy']]);
        //$this->middleware('auth:employee',['only'=> ['employee']]);
    }

    /**
     * User index page
     */
    public function index(User $user)
    {
        try {
            $roles = Role::select('id','name')->where('guard_name','web')->get();   //Get all roles
            $users = $user->get();
            return view('admin.users.index',compact('users','roles'));
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
        //Hash the human password
        $request['password'] = Hash::make($request->password);

        $user = $user->create($request->only('name','email','password'));

        $roles = $request['roles'];

        if(isset($roles))
        {
            $user->assignRole($roles);
        }

        return back()->with('success','user has been added');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::select('id','name')->where('guard_name','web')->get();;

        return view('admin.users.edit')->with(compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $roles = $request->roles; //Get all assign roles

        $user->update($request->only('name'));

        //Assign roles to user user
        if (isset($roles)) {
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
        }
        else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        return redirect()->route('users.index')->with('success','User updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success','user has been deleted');
    }

}
