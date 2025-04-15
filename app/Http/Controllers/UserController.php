<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\InviteAlumni; 



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('dashboard.admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.users.create');  

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // Create the user with no password and set as inactive
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => '',  
            'is_active' => false, 
        ]);

        // Send the invitation email to the user
        Mail::to($user->email)->send(new InviteAlumni($user));

        // Redirect back with success message
        return redirect()->route('users.index')->with('success', 'Alumni added and invitation sent.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
        $user = User::findOrFail($id);
        return view('dashbaord.admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      
        $user = User::findOrFail($id);
        return view('dashboard.admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
   
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,  
        ]);

      
        $user = User::findOrFail($id);
        $user->update($validated);

        
        return redirect()->route('admin.users.index')->with('success', 'User details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        $user = User::findOrFail($id);
        $user->delete();

       
        return redirect()->route('dashboard.admin.users.index')->with('success', 'User deleted successfully.');
    }
}
