<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Major;
use App\Models\AlumniProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteAlumni;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; // Tambahkan ini untuk mendapatkan tahun saat ini

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Eager load relasi yang diperlukan untuk tampilan index
        $query->with(['major', 'alumniProfile']);

        // Apply Search Filter
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('student_id', 'like', '%' . $search . '%');
            });
        }

        // Apply Role Filter
        if ($role = $request->input('role')) {
            $query->where('role', $role);
        }

        // Apply Major Filter
        if ($majorId = $request->input('major_id')) {
            $query->where('major_id', $majorId);
        }

        // Apply Graduation Year Filter
        if ($graduationYear = $request->input('graduation_year')) {
            $query->whereHas('alumniProfile', function($q) use ($graduationYear) {
                $q->where('graduation_year', $graduationYear);
            });
        }

        // Ambil hasil dengan pagination dan sertakan query string untuk filter
        $users = $query->paginate(10)->withQueryString();

        $majors = Major::all();

        // Generate list of graduation years for filter dropdown
        $currentYear = Carbon::now()->year;
        $startYear = 1950;
        $graduationYears = range($currentYear, $startYear);

        return view('dashboard.admin.users.index', compact('users', 'majors', 'graduationYears'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $majors = Major::all();
        $currentYear = Carbon::now()->year;
        $startYear = 1950;
        $graduationYears = range($currentYear, $startYear);

        return view('dashboard.admin.users.create', compact('majors', 'graduationYears'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'student_id' => 'required|string|max:255|unique:users,student_id',
            'major_id' => 'nullable|exists:majors,id',
            'role' => ['required', 'string', Rule::in(['user', 'admin', 'alumni'])], // Tambahkan 'alumni'
            'alumni_code' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'graduation_year' => 'nullable|integer|digits:4',
            'bio' => 'nullable|string',
            'current_job' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'website_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'student_id' => $request->student_id,
            'major_id' => $request->major_id,
            'role' => $request->role, // Akan mengambil 'alumni' jika dipilih
            'is_active' => true,
        ]);

        // Siapkan data untuk AlumniProfile
        $alumniProfileData = [
            'user_id' => $user->id,
            'alumni_code' => $request->alumni_code,
            'phone' => $request->phone,
            'address' => $request->address,
            'graduation_year' => $request->graduation_year,
            'bio' => $request->bio,
            'current_job' => $request->current_job,
            'company' => $request->company,
            'position' => $request->position,
            'linkedin_url' => $request->linkedin_url,
            'website_url' => $request->website_url,
        ];

        // Handle image upload for AlumniProfile
        if ($request->hasFile('image')) {
            $alumniProfileData['image'] = $request->file('image')->store('alumni_images', 'public');
        }

        AlumniProfile::create($alumniProfileData);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load(['alumniProfile', 'major']);
        return view('dashboard.admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $majors = Major::all();
        $currentYear = Carbon::now()->year;
        $startYear = 1950;
        $graduationYears = range($currentYear, $startYear);

        $user->load('alumniProfile');
        return view('dashboard.admin.users.edit', compact('user', 'majors', 'graduationYears'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'student_id' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id, 'student_id')],
            'major_id' => 'nullable|exists:majors,id',
            'role' => ['required', 'string', Rule::in(['user', 'admin', 'alumni'])], // Tambahkan 'alumni'
            'password' => 'nullable|string|min:8|confirmed',
            'alumni_code' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'graduation_year' => 'nullable|integer|digits:4',
            'bio' => 'nullable|string',
            'current_job' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'website_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $request->validate($rules);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->student_id = $request->student_id;
        $user->major_id = $request->major_id;
        $user->role = $request->role; // Akan mengambil 'alumni' jika dipilih

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $alumniProfileData = [
            'alumni_code' => $request->alumni_code,
            'phone' => $request->phone,
            'address' => $request->address,
            'graduation_year' => $request->graduation_year,
            'bio' => $request->bio,
            'current_job' => $request->current_job,
            'company' => $request->company,
            'position' => $request->position,
            'linkedin_url' => $request->linkedin_url,
            'website_url' => $request->website_url,
        ];

        if ($request->hasFile('image')) {
            if ($user->alumniProfile && $user->alumniProfile->image) {
                Storage::disk('public')->delete($user->alumniProfile->image);
            }
            $alumniProfileData['image'] = $request->file('image')->store('alumni_images', 'public');
        }

        $user->alumniProfile()->updateOrCreate(
            ['user_id' => $user->id],
            $alumniProfileData
        );

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->alumniProfile) {
            if ($user->alumniProfile->image) {
                Storage::disk('public')->delete($user->alumniProfile->image);
            }
            $user->alumniProfile->delete();
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
