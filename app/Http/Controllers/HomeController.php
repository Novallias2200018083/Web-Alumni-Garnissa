<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\User;
use App\Models\Blog; 
use App\Models\Announcement;
use App\Models\About;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch the latest 6 events
        $events = Event::latest()->paginate(6);
        $blogs = Blog::latest()->paginate(6); 
        $announcements = Announcement::latest()->paginate(6);    

        $users = User::with('alumniProfile')->get();
        $about = About::first();

        return view('welcome', compact('events', 'users', 'blogs', 'announcements', 'about'));

    }

}
