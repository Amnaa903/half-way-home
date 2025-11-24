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
     * Show admin dashboard
     */
    public function adminDashboard()
    {
        return view('admin.dashboard');
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

        // Redirect based on user type
        if ($user->user_type === 'incharge') {
            return redirect()->route('incharge.dashboard');
        } 
        elseif ($user->user_type === 'deo') {
            return redirect()->route('deo.dashboard');
        }
        elseif ($user->user_type === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Default fallback - show home view
        return view('home', compact('user'));
    }
}