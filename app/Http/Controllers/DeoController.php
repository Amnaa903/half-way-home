<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeoController extends Controller
{
    /**
     * Display DEO dashboard
     */
    public function dashboard()
    {
        // Check if user is DEO
        if (Auth::user()->user_type !== 'deo') {
            return redirect()->route('home')->with('error', 'Access denied. DEO privileges required.');
        }

        return view('deo_dashboard');
    }

    /**
     * Other DEO methods can be added here as needed
     */
}