<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\User;
use App\Models\Blog; 
use App\Models\Announcement;
use App\Models\About;
use Illuminate\Http\Request;
use Carbon\Carbon; // <--- TAMBAHKAN BARIS INI

class HomeController extends Controller
{
    public function index()
    {

        // MEMPERBARUI BAGIAN INI:
        // Mengambil 6 event terbaru yang memiliki audience_type 'all'
        // Ambil 3 event mendatang yang terdekat (event_date lebih besar dari atau sama dengan hari ini)
        $events = Event::where('event_date', '>=', Carbon::today())
                        ->orderBy('event_date', 'asc') // Urutkan berdasarkan tanggal terdekat
                        ->orderBy('event_time', 'asc') // Kemudian berdasarkan waktu
                        ->take(3) // Ambil hanya 3 event
                        ->get(); // Eksekusi query


        // Fetch only the latest 3 published blogs for the homepage section
        $blogs = Blog::whereNotNull('published_at')
                     ->where('published_at', '<=', \Carbon\Carbon::now()) // Ensure it's not a future-dated blog
                     ->latest('published_at') // Order by published_at DESC
                     ->limit(3) // Limit to 3 blogs
                     ->get(); // Get the results


        $announcements = Announcement::latest()->paginate(6);    

        // Di dalam metode controller Anda
        $alumniUsers = User::where('role', 'alumni')->limit(6)->get();


        $about = About::first();

        return view('welcome', compact('events', 'alumniUsers', 'blogs', 'announcements', 'about'));

    }

}
