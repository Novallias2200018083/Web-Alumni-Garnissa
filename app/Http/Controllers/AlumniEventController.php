<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumniEventController extends Controller
{
    public function __construct()
    {
        // Pastikan user sudah login
        $this->middleware('auth');
        // Hanya user dengan role 'alumni' yang bisa mengakses controller ini
        $this->middleware('role:alumni'); // Asumsi middleware 'role' sudah dibuat dan terdaftar
    }

    /**
     * Display a listing of the resource.
     * Filter events based on audience type for the logged-in alumni.
     */
    public function index()
    {
        $user = Auth::user();

        // Mengambil event terbaru dan memfilter menggunakan scope forAlumni.
        $events = Event::latest()
            ->forAlumni($user) // <-- Panggil scope filter di sini!
            ->paginate(10);     // Paginasi 6 event per halaman

        // Mengirim data event ke view alumni event.
        return view('dashboard.alumni.events.index', compact('events'));
    }

    // Method 'create', 'store', 'show', 'edit', 'update', 'destroy' tetap kosong
    // seperti yang Anda berikan, karena mungkin ini bukan fungsionalitas untuk alumni.
    // Jika Anda ingin menambahkan fungsi show, Anda perlu mengimplementasikannya.
    public function create() {}
    public function store(Request $request) {}
    public function show(string $id)
    {
        // Contoh implementasi method show untuk alumni
        $user = Auth::user();
        $event = Event::findOrFail($id);

        // Validasi apakah event ini relevan untuk alumni yang login
        // Ini memastikan alumni tidak bisa melihat detail event yang tidak ditujukan padanya
        $relevantEvents = Event::forAlumni($user)->where('id', $id)->first();

        if (!$relevantEvents) {
            abort(403, 'Anda tidak memiliki akses untuk melihat event ini.');
        }

        return view('dashboard.alumni.events.show', compact('event'));
    }
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}