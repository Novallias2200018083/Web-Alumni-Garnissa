<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AlumniProfile; // Pastikan ini di-import
use App\Models\Major;         // Pastikan ini di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Gunakan Hash facade untuk bcrypt
use Illuminate\Validation\Rules;     // Untuk validasi password

class InviteRegisterController extends Controller
{
    /**
     * Menampilkan formulir penyelesaian pendaftaran.
     */
    public function completeRegistration($email)
    {
        // Cari user berdasarkan email
        $user = User::where('email', $email)->first();

        // Jika user tidak ditemukan atau sudah diverifikasi/aktif, redirect ke login
        // Asumsi email_verified_at adalah indikator akun aktif/terverifikasi
        if (!$user || $user->email_verified_at !== null) {
            return redirect()->route('login')->with('error', 'Akun sudah terdaftar atau tidak valid.');
        }

        // Ambil data jurusan dan tahun untuk dropdown di view
        $majors = Major::all();
        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 50); // Misalnya, 50 tahun ke belakang

        // Load relasi major jika user sudah memiliki major_id
        $user->load('major');

        return view('auth.complete-registration', compact('user', 'majors', 'years'));
    }

    /**
     * Memproses data dari formulir penyelesaian pendaftaran.
     */
    public function postCompleteRegistration(Request $request, $email)
    {
        // Cari user berdasarkan email
        $user = User::where('email', $email)->first();

        // Jika user tidak ditemukan atau sudah diverifikasi, redirect ke login
        if (!$user || $user->email_verified_at !== null) {
            return redirect()->route('login')->with('error', 'Akun sudah terdaftar atau tidak valid.');
        }

        // Validasi input dari form
        $request->validate([
            'password' => ['required', 'string', Rules\Password::defaults(), 'confirmed'],
            'graduation_year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            // student_id dan major_id diasumsikan sudah ada di tabel users
            // dan tidak perlu divalidasi ulang di sini jika user tidak mengeditnya.
            // Jika user bisa mengeditnya, tambahkan validasi di sini.
        ]);

        // Update password user dan tandai sebagai terverifikasi
        $user->password = Hash::make($request->password); // Gunakan Hash::make()
        $user->email_verified_at = now(); // Set timestamp verifikasi email
        $user->save();

        // Pastikan relasi 'major' dimuat untuk pembuatan alumni_code
        // Ini penting jika user baru saja dibuat dan relasi belum di-load
        $user->load('major');

        // Ambil kode jurusan (pastikan user memiliki major_id yang valid)
        $majorCode = $user->major->code ?? 'UNKNOWN'; // Fallback jika major tidak ditemukan

        // Ambil 2 digit terakhir dari student_id
        $lastTwoDigitsOfStudentId = substr($user->student_id, -2);

        // Buat ID alumni
        // Format: KodeJurusan-2DigitTahunAngkatanLulus-2DigitTerakhirNIS
        $alumniCode = $majorCode . '-' . substr($request->graduation_year, -2) . '-' . $lastTwoDigitsOfStudentId;

        // Buat atau perbarui profil alumni
        // updateOrCreate akan mencari berdasarkan 'user_id' dan jika tidak ada, akan membuat baru.
        // Jika ada, itu akan memperbarui atribut yang diberikan.
        $user->alumniProfile()->updateOrCreate(
            ['user_id' => $user->id], // Kondisi untuk mencari record
            [
                'graduation_year' => $request->graduation_year,
                'alumni_code' => $alumniCode,
                'phone' => $request->phone,
                'address' => $request->address,
                'bio' => $request->bio,
                // 'image' biasanya dihandle terpisah (upload file)
            ]
        );

        return redirect()->route('login')->with('success', 'Pendaftaran selesai. Anda sekarang bisa login.');
    }
}