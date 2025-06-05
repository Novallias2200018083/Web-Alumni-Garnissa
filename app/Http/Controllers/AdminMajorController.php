<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Import Rule untuk validasi unique saat update

class AdminMajorController extends Controller
{
    /**
     * Tampilkan daftar semua jurusan.
     */
    public function index()
    {
        // Menggunakan paginate untuk daftar jurusan dan orderBy untuk pengurutan
        $majors = Major::orderBy('name')->paginate(10);
        return view('dashboard.admin.majors.index', compact('majors'));
    }

    /**
     * Tampilkan form untuk membuat jurusan baru.
     */
    public function create()
    {
        return view('dashboard.admin.majors.create');
    }

    /**
     * Simpan jurusan baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'code' => 'required|string|max:50|unique:majors,code',
            'name' => 'required|string|max:255|unique:majors,name',
            'description' => 'nullable|string', // Pastikan validasi ini ada
        ]);

        // Buat jurusan baru menggunakan data yang sudah divalidasi
        Major::create($validatedData);

        return redirect()->route('majors.index')->with('success', 'Jurusan berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail jurusan tertentu.
     */
    public function show(Major $major)
    {
        // Menggunakan Route Model Binding, $major sudah otomatis terisi
        return view('dashboard.admin.majors.show', compact('major'));
    }

    /**
     * Tampilkan form untuk mengedit jurusan.
     */
    public function edit(Major $major)
    {
        // Menggunakan Route Model Binding, $major sudah otomatis terisi
        return view('dashboard.admin.majors.edit', compact('major'));
    }

    /**
     * Perbarui jurusan di database.
     */
    public function update(Request $request, Major $major)
    {
        // Validasi data yang masuk, dengan pengecualian unique untuk jurusan yang sedang diedit
        $validatedData = $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('majors', 'code')->ignore($major->id)],
            'name' => ['required', 'string', 'max:255', Rule::unique('majors', 'name')->ignore($major->id)],
            'description' => 'nullable|string', // Pastikan validasi ini ada
        ]);

        // Perbarui jurusan menggunakan data yang sudah divalidasi
        $major->update($validatedData);

        return redirect()->route('majors.index')->with('success', 'Jurusan berhasil diperbarui!');
    }

    /**
     * Hapus jurusan dari database.
     */
    public function destroy(Major $major)
    {
        $major->delete();
        return redirect()->route('majors.index')->with('success', 'Jurusan berhasil dihapus!');
    }
}
