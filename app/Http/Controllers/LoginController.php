<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\Login\RememberMeExpiration;

class LoginController extends Controller
{
    use RememberMeExpiration;

    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('content.authentications.auth-login-basic');
    }

    /**
     * Handle account login request
     *
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
{
    $credentials = $request->getCredentials();

    // Attempt to authenticate the user
    if (Auth::attempt($credentials, $request->filled('remember'))) {
        // Authentication successful
        $user = Auth::user();

        // Perform any additional actions upon successful login

        return redirect()->route('home'); // Adjust the route as needed
    } else {
        // Authentication failed
        return redirect()->to('/login')
            ->withInput($request->except('password'))
            ->withErrors(['username' => trans('auth.failed')]);
    }
}

    /**
     * Handle response after user authenticated
     *
     * @param Request $request
     * @param Auth $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        // return redirect()->intended();
        if (Auth::user()->role_id == null) {
            return redirect()->to('/login')->with('error', 'Sorry! Your account has not been activated. Please contact an admin');

        } else {

            return redirect('/dashboard')->with('success', "Account successfully registered.");
        }

        }
}
