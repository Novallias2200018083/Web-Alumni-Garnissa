<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Major; // Import Major model
use App\Models\AlumniProfile; // Import model AlumniProfile
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon; // Import Carbon untuk mendapatkan tahun saat ini

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Ambil semua data jurusan dari tabel 'majors' untuk dropdown di form
        $majors = Major::all();

        // Buat rentang tahun untuk dropdown 'Tahun Angkatan Lulus'
        $currentYear = Carbon::now()->year; // Menggunakan Carbon
        // Misalnya, dari tahun sekarang hingga 50 tahun ke belakang.
        // Anda bisa menyesuaikan rentang ini sesuai kebutuhan.
        $years = range($currentYear, $currentYear - 50);

        // Kirimkan data $majors dan $years ke tampilan registrasi
        return view('auth.register', compact('majors', 'years'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi semua input yang diterima dari form registrasi.
        // Pastikan 'student_id' dan 'email' unik di tabel 'users'.
        // 'major_id' harus ada di tabel 'majors'.
        // 'graduation_year' harus berupa angka dalam rentang yang valid.
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'student_id' => ['required', 'string', 'max:20', 'unique:'.User::class], // Validasi Nomor Induk Siswa
            'major_id' => ['required', 'exists:majors,id'], // Validasi Jurusan (harus ID yang valid)
            'graduation_year' => ['required', 'integer', 'min:1900', 'max:' . Carbon::now()->year], // Validasi Tahun Angkatan Lulus
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // Validasi Password
        ]);

        // Buat entri user baru di tabel 'users' dengan data yang divalidasi.
        // Role default diatur sebagai 'alumni'.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'student_id' => $request->student_id, // Simpan Nomor Induk Siswa
            'major_id' => $request->major_id,     // Simpan ID Jurusan
            'password' => Hash::make($request->password), // Hash password sebelum disimpan
            'role' => 'alumni', // Set role user sebagai 'alumni'
        ]);

        // Penting: Load relasi 'major' pada objek $user yang baru dibuat.
        // Ini diperlukan untuk mengakses 'code' jurusan yang akan digunakan dalam pembuatan alumni_code.
        $user->load('major');

        // Ambil kode jurusan dari relasi 'major'.
        // Gunakan operator null coalescing (??) sebagai fallback 'UNKNOWN'
        // meskipun validasi 'exists:majors,id' seharusnya mencegah ini.
        $majorCode = $user->major->code ?? 'UNKNOWN';

        // Ambil dua digit terakhir dari Nomor Induk Siswa.
        // Diasumsikan student_id selalu memiliki setidaknya 2 digit.
        $lastTwoDigitsOfStudentId = substr($user->student_id, -2);

        // Buat ID alumni dengan format yang diinginkan.
        // Format: KodeJurusan-2DigitTahunAngkatanLulus-2DigitTerakhirNIS
        // Contoh: TI-23-45 (untuk Teknik Informatika, angkatan 2023, NIS berakhir 45)
        $alumniCode = $majorCode . '-' . substr($request->graduation_year, -2) . '-' . $lastTwoDigitsOfStudentId;

        // Buat profil alumni baru di tabel 'alumni_profiles' dan kaitkan dengan user yang baru dibuat.
        $user->alumniProfile()->create([
            'graduation_year' => $request->graduation_year, // Simpan tahun angkatan lulus di profil alumni
            'alumni_code' => $alumniCode,                 // Simpan ID alumni yang dihasilkan
            // Atribut profil alumni lainnya (phone, address, bio, image) dapat ditambahkan di sini
            // jika Anda ingin mengumpulkannya langsung saat registrasi standar.
            // Jika tidak, biarkan nullable di migrasi dan biarkan user mengeditnya nanti.
        ]);

        // Trigger event 'Registered' Laravel.
        // Ini penting untuk fitur seperti verifikasi email otomatis.
        event(new Registered($user));

        // Otomatis login user setelah pendaftaran berhasil.
        Auth::login($user);

        // Logika pengalihan berdasarkan peran pengguna
        if ($user->role === 'alumni') {
            return redirect()->route('alumni.dashboard'); // Arahkan ke dashboard alumni
        }

        // Pengalihan default untuk peran lain (misal: jika ada peran 'customer' yang juga bisa daftar di sini)
        return redirect(RouteServiceProvider::HOME);
    }
}
