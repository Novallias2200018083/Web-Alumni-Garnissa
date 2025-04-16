<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AlumniProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); // Get the logged-in user
        return view('alumni.profile.index', compact('user')); 
    }

    public function front()
    {
        $users = User::with('alumniProfile')->get();

        return view('welcome', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();
        return view('dashboard.alumni.profile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();  
        return view('dashboard.alumni.profile.edit', compact('user'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'graduation_year' => 'nullable|string|max:10',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|max:2048', 
        ]);
    
        $user = auth()->user();
    
        // Update basic user info
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    
        // Handle image upload for alumni profile
        $imagePath = $request->file('image')
            ? $request->file('image')->store('profile_images', 'public')
            : ($user->alumniProfile ? $user->alumniProfile->image : null);
    
        // Update or create alumni profile
        $user->alumniProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $request->phone,
                'address' => $request->address,
                'graduation_year' => $request->graduation_year,
                'bio' => $request->bio,
                'image' => $imagePath,
            ]
        );
    
        return redirect()->route('alumni.profile.show')->with('success', 'Profile updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
