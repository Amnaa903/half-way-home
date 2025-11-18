<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Get authenticated user
            $user = Auth::user();
            
            // Redirect based on user type
            return $this->redirectBasedOnUserType($user);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Redirect user based on their type
     */
    private function redirectBasedOnUserType($user)
    {
        // Debugging
        \Log::info('User logged in:', [
            'id' => $user->id,
            'name' => $user->name,
            'user_type' => $user->user_type ?? 'unknown'
        ]);

        if (isset($user->user_type)) {
            if ($user->user_type === 'incharge') {
                return redirect()->route('incharge.dashboard');
            } elseif ($user->user_type === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->user_type === 'deo') {
                return redirect()->route('deo.dashboard');
            }
        }

        // Default redirect
        return redirect()->intended('/home');
    }
}