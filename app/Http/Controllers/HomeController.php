<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\User;
use App\Models\Blog; 
use App\Models\Announcement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch the latest 6 events
        $events = Event::latest()->take(6)->get();
        // Fetch the latest 6 blogs
        $blogs = Blog::latest()->take(6)->get(); 
        // Fetch the latest 6 announcements
        $announcements = Announcement::latest()->take(6)->get(); 

        // Fetch all users (or adjust based on your needs)
        $users = User::with('alumniProfile')->get();

        return view('welcome', compact('events', 'users', 'blogs', 'announcements'));

    }

}
