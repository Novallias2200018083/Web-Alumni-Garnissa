<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\About; 

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first(); // Get About Us content
        return view('dashboard.admin.about.index', compact('about'));
    }

    public function front()
    {
         $about = About::first(); // Fetch About Us content
         return view('dashboard.admin.about.front', compact('about')); // Return the frontend view
    }


    public function edit()
    {
        $about = About::first();
        return view('dashboard.admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $about = About::first() ?? new About();
        $about->title = $request->title;
        $about->content = $request->content;

        if ($request->hasFile('image')) {
            $about->image = $request->file('image')->store('about', 'public');
        }

        $about->save();

        return redirect()->route('about.index')->with('success', 'About Us updated successfully.');
    }
}
