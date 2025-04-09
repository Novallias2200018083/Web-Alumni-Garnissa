<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Show active announcements
        $announcements = Announcement::where('is_active', true)->latest()->paginate(5);
        return view('dashboard.admin.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'published_at' => 'nullable|date',
        ]);

        Announcement::create($request->only('title', 'description', 'published_at'));

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get the announcement by ID
        $announcement = Announcement::findOrFail($id);
        return view('announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Get the announcement by ID
        $announcement = Announcement::findOrFail($id);
        return view('dashboard.admin.announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'published_at' => 'nullable|date',
        ]);

        $announcement = Announcement::findOrFail($id);
        $announcement->update($request->only('title', 'description', 'published_at'));

        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}
