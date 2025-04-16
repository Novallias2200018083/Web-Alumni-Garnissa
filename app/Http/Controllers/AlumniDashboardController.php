<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Blog;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AlumniDashboardController extends Controller
{
    public function index()
    {
         // Fetch events, blogs, and announcements
         $events = Event::all();
         $blogs = Blog::all();
         $announcements = Announcement::all();
 
         // Return the view with the data
         return view('dashboard.alumni.index', compact('events', 'blogs', 'announcements'));
    }
}
