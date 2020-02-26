<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

    use AuthenticatesUsers;

    /**
     * Where to redirect normal users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Show Admin Login Form
     */
    public function showLoginForm()
    {
        return view('auth.admin_login');
    }

    /**
     * Log the admin out of the application.
     */
    public function logout()
    {
        $this->guard()->logout();

        return redirect('admin/login');
    }

    /**
     * Get the guard to be used during authentication.
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
