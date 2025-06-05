<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Major; // Import Major model
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    /**
     * Tampilkan daftar alumni.
     * Termasuk fungsionalitas pencarian dan filter.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Muat semua jurusan untuk dropdown filter
        $majors = Major::orderBy('name')->get();

        // Dapatkan tahun kelulusan unik dari profil alumni
        // Menggunakan distinct pada tabel alumni_profiles setelah join bisa lebih efisien
        $years = User::join('alumni_profiles', 'users.id', '=', 'alumni_profiles.user_id')
            ->where('users.role', 'alumni') // Pastikan hanya alumni
            ->whereNotNull('alumni_profiles.graduation_year')
            ->distinct('alumni_profiles.graduation_year')
            ->pluck('alumni_profiles.graduation_year')
            ->sortDesc()
            ->values()
            ->toArray();
        
        // Mulai query untuk user dengan role 'alumni' dan memiliki alumniProfile
        $query = User::where('role', 'alumni')
                     ->whereHas('alumniProfile')
                     ->with('alumniProfile', 'major'); // Eager load relasi

        // Terapkan filter berdasarkan major_id
        if ($request->filled('major_id') && $request->major_id != '') {
            $query->where('major_id', $request->major_id);
        }

        // Terapkan filter berdasarkan graduation_year
        if ($request->filled('graduation_year') && $request->graduation_year != '') {
            $query->whereHas('alumniProfile', function ($q) use ($request) {
                $q->where('graduation_year', $request->graduation_year);
            });
        }

        // Terapkan pencarian umum
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%') // Cari di nama user
                  ->orWhere('email', 'like', '%' . $search . '%') // Cari di email user
                  ->orWhereHas('alumniProfile', function($qr) use ($search) {
                      $qr->where('bio', 'like', '%' . $search . '%') // Cari di bio alumni
                         ->orWhere('address', 'like', '%' . $search . '%') // Cari di alamat alumni
                         ->orWhere('phone', 'like', '%' . $search . '%'); // Cari di telepon alumni
                  })
                  ->orWhereHas('major', function($qr) use ($search) { // Cari di nama jurusan
                    $qr->where('name', 'like', '%' . $search . '%');
                });
            });
        }

        // Ambil hasil dan paginasi
        $alumni = $query->paginate(12); // Menampilkan 12 alumni per halaman

       // UBAH BARIS INI: Tambahkan 'dashboard.' di awal path view
        return view('dashboard.alumni.directory.index', compact('alumni', 'majors', 'years'));
    }

    /**
     * Tampilkan detail alumni tertentu.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
{
    // Pastikan user ini memiliki profil alumni dan role-nya adalah 'alumni'
    if (!$user->alumniProfile || $user->role !== 'alumni') {
        abort(404, 'Profil alumni tidak ditemukan atau tidak valid.');
    }

    // Muat relasi alumniProfile dan major (best practice jika belum di-load)
    $user->loadMissing('alumniProfile', 'major');

    // Kirim variabel '$user' ke view 'dashboard.alumni.directory.show'
    return view('dashboard.alumni.directory.show', compact('user'));
}
}
