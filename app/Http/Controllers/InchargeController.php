<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InchargeController extends Controller
{
    /**
     * Display incharge dashboard
     */
    public function dashboard()
    {
        // Check if user is incharge
        $user = Auth::user();
        
        if (!isset($user->user_type) || $user->user_type !== 'incharge') {
            return redirect()->route('home')->with('error', 'Access denied. Incharge privileges required.');
        }

        // You can pass data to the dashboard here
        $stats = [
            'total_residents' => 45,
            'pending_registration' => 12,
            'pending_discharge' => 8,
            'today_tasks' => 5
        ];
        
        return view('incharge_dashboard', compact('stats'));
    }

    /**
     * List all residents
     */
    public function listResidents()
    {
        $user = Auth::user();
        
        if (!isset($user->user_type) || $user->user_type !== 'incharge') {
            return redirect()->route('home')->with('error', 'Access denied.');
        }
        
        // Your logic for listing residents
        return view('incharge.residents_list');
    }

    /**
     * Pending registration
     */
    public function pendingRegistration()
    {
        $user = Auth::user();
        
        if (!isset($user->user_type) || $user->user_type !== 'incharge') {
            return redirect()->route('home')->with('error', 'Access denied.');
        }
        
        // Your logic for pending registration
        return view('incharge.pending_registration');
    }

    /**
     * Create discharge
     */
    public function createDischarge()
    {
        $user = Auth::user();
        
        if (!isset($user->user_type) || $user->user_type !== 'incharge') {
            return redirect()->route('home')->with('error', 'Access denied.');
        }
        
        // Your logic for creating discharge
        return view('incharge.create_discharge');
    }

    /**
     * Pending discharge
     */
    public function pendingDischarge()
    {
        $user = Auth::user();
        
        if (!isset($user->user_type) || $user->user_type !== 'incharge') {
            return redirect()->route('home')->with('error', 'Access denied.');
        }
        
        // Your logic for pending discharge
        return view('incharge.pending_discharge');
    }
}