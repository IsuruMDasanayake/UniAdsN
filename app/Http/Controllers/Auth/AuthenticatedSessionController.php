<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        // Authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
    
            // Check the user's role and redirect accordingly
            if (Auth::user()->role === 'Admin') {
                return redirect()->route('admin.dashboard');
            }
    
            // Redirect other roles to the default home
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
    // Get the current user's role
    $userRole = Auth::user()?->role;

    // Log out the current user
    Auth::logout();

    // Invalidate the current session and regenerate the session ID
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect based on the user's role
    if ($userRole === 'Admin') {
        // Redirect to the admin login page
        return redirect('/')->with('message', 'Logged out successfully as Admin.');
    }

    // Redirect other users to the default login page
    return redirect('/')->with('message', 'Logged out successfully.');
}
    
}
