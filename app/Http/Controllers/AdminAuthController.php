<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    //

    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard'; // Adjust the redirect path as needed
    protected $guard = 'admin';

    public function showLoginForm()
    {
        return view('auth.login'); // Create a login blade view for admin if not already done
    }

    protected function guard()
    {
        return Auth::guard($this->guard);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/login'); // Adjust the redirect path as needed
    }
}
