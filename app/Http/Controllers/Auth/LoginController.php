<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Get the path the user should be redirected to when they are authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function authenticated(Request $request, $user)
    {
        $successMessage = 'Welcome back, ' . $user->employeeName . '!';

        if ($user->role == 'manager') {
            return redirect('/manager/dashboard')->with('login_success', $successMessage);
        }

        if ($user->role == 'supervisor') {
            return redirect('/supervisor/dashboard')->with('login_success', $successMessage);
        }

        if ($user->role == 'clerk') {
            return redirect('/clerk/dashboard')->with('login_success', $successMessage);
        }

        return redirect('/employee/dashboard')->with('login_success', $successMessage);
    }

    public function username()
    {
        return 'employeeEmail';
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only('employeeEmail'))
            ->with('login_error', 'Invalid email or password.');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // Logout function
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out');
    }

    // Inactive employee login attempt
    protected function credentials(Request $request)
    {
        return [
            'employeeEmail' => $request->employeeEmail,
            'password' => $request->password,
            'employeeStatus' => 'Active'
        ];
    }

    // public function getAuthPassword()
    // {
    //     return $this->employeePassword;
    // }
}
