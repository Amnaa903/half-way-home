<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'));
    }

    public function create()
    {
        // Sirf Deo, Admin, Incharge roles show karein
        $roles = Role::whereIn('name', ['Deo', 'Admin', 'Incharge'])
                    ->pluck('name','name')
                    ->all();
        
        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        // Laravel 12 compatible validation
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'district' => 'required',
            'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'district' => $validated['district']
        ]);
        
        // Validate selected roles
        $allowedRoles = ['Deo', 'Admin', 'Incharge'];
        $selectedRoles = $request->input('roles');
        
        // Filter only allowed roles
        $validRoles = array_intersect($selectedRoles, $allowedRoles);
        
        if (!empty($validRoles)) {
            $user->assignRole($validRoles);
        }

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        
        // Sirf Deo, Admin, Incharge roles show karein
        $roles = Role::whereIn('name', ['Deo', 'Admin', 'Incharge'])
                    ->pluck('name','name')
                    ->all();
        
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        // Laravel 12 compatible validation
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'district' => 'required',
            'roles' => 'required'
        ]);

        $user = User::find($id);
        
        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'district' => $validated['district']
        ];

        // Password update karein agar diya gaya hai
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);
        
        // Remove old roles
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        // Validate and assign new roles
        $allowedRoles = ['Deo', 'Admin', 'Incharge'];
        $selectedRoles = $request->input('roles');
        
        // Filter only allowed roles
        $validRoles = array_intersect($selectedRoles, $allowedRoles);
        
        if (!empty($validRoles)) {
            $user->assignRole($validRoles);
        }

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}