<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Blog;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan ini di-import

class AlumniDashboardController extends Controller
{
    public function __construct()
    {
        // Pastikan user sudah login
        $this->middleware('auth');
        // Hanya user dengan role 'alumni' yang bisa mengakses controller ini
        $this->middleware('role:alumni'); // Asumsi middleware 'role' sudah dibuat dan terdaftar
    }

    public function index()
    {
        $user = Auth::user();

        // 1. Ambil 3 event terdekat yang akan datang, yang relevan untuk alumni yang login
        $events = Event::where('event_date', '>=', now()) // Hanya event yang akan datang
            ->orderBy('event_date', 'asc')   // Urutkan dari yang paling dekat
            ->forAlumni($user)               // <-- Panggil scope filter di sini!
            ->take(3)                        // Ambil 3 saja setelah difilter
            ->get();

        // 2. Ambil data blog dan pengumuman (sudah benar)
        $blogs = Blog::latest()->take(3)->get();
        $announcements = Announcement::latest()->take(3)->get();

        // 3. Kirim semua data ke view dasbor alumni
        return view('dashboard.alumni.index', [
            'events' => $events,
            'blogs' => $blogs,
            'announcements' => $announcements,
        ]);
    }
}