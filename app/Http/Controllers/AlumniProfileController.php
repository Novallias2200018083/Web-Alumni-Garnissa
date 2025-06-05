<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Major;
use App\Models\AlumniProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; // Import Carbon untuk penanganan tanggal/tahun
use Illuminate\View\View; // Import kelas View
use Illuminate\Http\RedirectResponse; // Import kelas RedirectResponse

class AlumniProfileController extends Controller
{
    /**
     * Display the logged-in user's own alumni profile.
     * Ini berfungsi sebagai halaman "Lihat Profil Saya".
     *
     * @return \Illuminate\View\View
     */
    public function show(): View
    {
        $user = Auth::user(); // Dapatkan user yang sedang login
        // Pastikan relasi alumniProfile dan major dimuat untuk ditampilkan di view
        $user->load('alumniProfile', 'major');

        // Menggunakan view 'dashboard.alumni.profile.show'
        return view('dashboard.alumni.profile.show', compact('user'));
    }

    /**
     * Show the form for editing the logged-in user's alumni profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit(): View
    {
        $user = Auth::user();
        // Pastikan relasi alumniProfile dan major dimuat untuk mengisi form
        $user->load('alumniProfile', 'major');

        // Ambil data jurusan dan tahun untuk dropdown di form
        $majors = Major::orderBy('name')->get(); // Ambil dengan urutan nama
        $currentYear = Carbon::now()->year; // Menggunakan Carbon
        $years = range($currentYear, $currentYear - 50); // Rentang tahun angkatan

        return view('dashboard.alumni.profile.edit', compact('user', 'majors', 'years'));
    }

    /**
     * Update the logged-in user's alumni profile in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user(); // Dapatkan user yang sedang login

        // Validasi input dari form edit profil
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'major_id' => ['required', 'exists:majors,id'], // Validasi Jurusan
            'graduation_year' => 'required|integer|min:1900|max:' . Carbon::now()->year,
            'bio' => 'nullable|string',
            'current_job' => 'nullable|string|max:255', // Validasi kolom baru
            'company' => 'nullable|string|max:255',     // Validasi kolom baru
            'position' => 'nullable|string|max:255',    // Validasi kolom baru
            'linkedin_url' => 'nullable|url|max:255',   // Validasi kolom baru
            'website_url' => 'nullable|url|max:255',    // Validasi kolom baru
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remove_image' => 'boolean', // Untuk checkbox hapus gambar
        ]);

        // Update informasi dasar user (nama, email, major_id)
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'major_id' => $request->major_id, // Simpan major_id di model User
        ]);

        // Tangani upload gambar profil
        // Gunakan optional() untuk memastikan alumniProfile tidak null sebelum mencoba mengakses 'image'
        $imagePath = optional($user->alumniProfile)->image;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('profile_images', 'public');
        } else if ($request->boolean('remove_image')) {
            // Hapus gambar jika ada permintaan hapus
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = null; // Set path gambar ke null
        }
        // Jika tidak ada gambar baru dan tidak ada permintaan hapus, imagePath akan tetap yang lama

        // Update atau buat profil alumni
        // Gunakan updateOrCreate untuk memastikan record AlumniProfile ada
        $user->alumniProfile()->updateOrCreate(
            ['user_id' => $user->id], // Kondisi untuk mencari record berdasarkan user_id
            [
                'phone' => $request->phone,
                'address' => $request->address,
                'graduation_year' => $request->graduation_year,
                'bio' => $request->bio,
                'image' => $imagePath, // Simpan path gambar
                'current_job' => $request->current_job,      // Simpan kolom baru
                'company' => $request->company,             // Simpan kolom baru
                'position' => $request->position,           // Simpan kolom baru
                'linkedin_url' => $request->linkedin_url,   // Simpan kolom baru
                'website_url' => $request->website_url,     // Simpan kolom baru
            ]
        );

        // Redirect ke halaman profil pribadi dengan pesan sukses
        return redirect()->route('alumni.profile.show')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Display the alumni card for printing.
     *
     * @return \Illuminate\View\View
     */
    public function printCard(): View
    {
        $user = Auth::user();
        $user->load('alumniProfile', 'major'); // Muat relasi yang dibutuhkan

        return view('dashboard.alumni.profile.card', compact('user'));
    }

    public function showPublicProfile(AlumniProfile $alumniProfile): View
    {
        // $alumniProfile sudah otomatis dimuat berdasarkan alumni_code
        // Kita perlu memuat user terkait dan jurusannya
        $user = $alumniProfile->user()->with('major')->first();

        // Pastikan user dan profil alumni tersedia
        if (!$user || !$alumniProfile) {
            abort(404, 'Profil alumni tidak ditemukan.');
        }

        // Menggunakan view yang sama dengan show() untuk konsistensi tampilan
        // atau Anda bisa membuat view terpisah seperti 'public.alumni.profile.show'
        return view('dashboard.alumni.profile.show', compact('user'));
    }
}
