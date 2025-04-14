@extends('layouts.admindashboard')

@section('content')
<h1 class="text-4xl font-extrabold text-gray-800 mb-10 tracking-wide transition-all duration-300 hover:text-[#E82929] hover:underline underline-offset-8">
    Welcome to the Admin Dashboard
</h1>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <!-- Blogs Count Card -->
    <div class="bg-gradient-to-r from-blue-100 to-blue-50 p-6 rounded-2xl shadow hover:shadow-md transition">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold text-blue-800">Blogs</h3>
            <i class="fas fa-blog text-3xl text-blue-500"></i>
        </div>
        <p class="text-4xl font-bold text-blue-700">{{ $blogCount }}</p>
        <p class="text-sm text-gray-600 mb-4">Total blog posts created</p>
        <a href="{{ route('blogs.index') }}"
           class="inline-block text-sm font-semibold text-blue-700 hover:underline">
            Manage Blogs →
        </a>
    </div>

    <!-- Events Count Card -->
    <div class="bg-gradient-to-r from-green-100 to-green-50 p-6 rounded-2xl shadow hover:shadow-md transition">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold text-green-800">Events</h3>
            <i class="fas fa-calendar-alt text-3xl text-green-500"></i>
        </div>
        <p class="text-4xl font-bold text-green-700">{{ $eventCount }}</p>
        <p class="text-sm text-gray-600 mb-4">Upcoming or past events</p>
        <a href="{{ route('events.index') }}"
           class="inline-block text-sm font-semibold text-green-700 hover:underline">
            Manage Events →
        </a>
    </div>

    <!-- Announcements Count Card -->
    <div class="bg-gradient-to-r from-red-100 to-red-50 p-6 rounded-2xl shadow hover:shadow-md transition">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold text-red-800">Announcements</h3>
            <i class="fas fa-bullhorn text-3xl text-red-500"></i>
        </div>
        <p class="text-4xl font-bold text-red-700">{{ $announcementCount }}</p>
        <p class="text-sm text-gray-600 mb-4">Important notifications posted</p>
        <a href="{{ route('announcements.index') }}"
           class="inline-block text-sm font-semibold text-red-700 hover:underline">
            Manage Announcements →
        </a>
    </div>

    <!-- Users Count Card -->
    <div class="bg-gradient-to-r from-purple-100 to-purple-50 p-6 rounded-2xl shadow hover:shadow-md transition">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold text-purple-800">Users</h3>
            <i class="fas fa-users text-3xl text-purple-500"></i>
        </div>
        <p class="text-4xl font-bold text-purple-700">{{ $userCount }}</p>
        <p class="text-sm text-gray-600 mb-4">Total registered users</p>
        <a href="{{ route('users.index') }}"
           class="inline-block text-sm font-semibold text-purple-700 hover:underline">
            Manage Users →
        </a>
    </div>
</div>


    <div class="mt-12">
    <!-- Recent Activity -->
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-[#E82929] pb-2">Recent Activity</h2>
    <div class="grid md:grid-cols-3 gap-6">
        <!-- Latest Blog -->
        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-xl transition duration-300">
            <h4 class="text-lg font-semibold text-[#E82929] mb-2">Latest Blog</h4>
            <p class="text-gray-700">{{ $latestBlog->title ?? 'No blogs available yet.' }}</p>
        </div>

        <!-- Latest Event -->
        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-xl transition duration-300">
            <h4 class="text-lg font-semibold text-[#E82929] mb-2">Latest Event</h4>
            <p class="text-gray-700">{{ $latestEvent->title ?? 'No events available yet.' }}</p>
        </div>

        <!-- Latest Announcement -->
        <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-xl transition duration-300">
            <h4 class="text-lg font-semibold text-[#E82929] mb-2">Latest Announcement</h4>
            <p class="text-gray-700">{{ $latestAnnouncement->title ?? 'No announcements available yet.' }}</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-[#E82929] pb-2">Quick Actions</h2>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('blogs.create') }}"
               class="bg-[#E82929] text-white px-5 py-2 rounded-lg shadow hover:bg-red-700 transition-all duration-300">
                + Create Blog
            </a>
            <a href="{{ route('events.create') }}"
               class="bg-[#E82929] text-white px-5 py-2 rounded-lg shadow hover:bg-red-700 transition-all duration-300">
                + Create Event
            </a>
            <a href="{{ route('announcements.create') }}"
               class="bg-[#E82929] text-white px-5 py-2 rounded-lg shadow hover:bg-red-700 transition-all duration-300">
                + Create Announcement
            </a>
        </div>
    </div>
</div>


@endsection
