<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the welcome page (public homepage)
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Show the application dashboard (after login)
     */
    public function index(Request $request)
    {
        // Manual authentication check
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Check user type and redirect accordingly
        $user = Auth::user();
        
        // Debugging
        \Log::info('HomeController - User accessed home:', [
            'id' => $user->id,
            'name' => $user->name,
            'user_type' => $user->user_type ?? 'unknown'
        ]);

        if (isset($user->user_type)) {
            if ($user->user_type === 'incharge') {
                return redirect()->route('incharge.dashboard');
            } elseif ($user->user_type === 'deo') {
                return redirect()->route('deo.dashboard');
            }
            // Admin users will see the home view directly
        }

        // Default fallback - show home view (admin dashboard)
        return view('home', compact('user'));
    }
}