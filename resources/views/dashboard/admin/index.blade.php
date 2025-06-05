@extends('layouts.admindashboard')

@section('content')

<div class="container mx-auto px-4 py-10 bg-white rounded-xl shadow-2xl"> {{-- Container utama diberi gaya kartu --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
        <!-- Blogs Count Card -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-700 p-8 rounded-2xl shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out cursor-pointer group border border-transparent hover:border-blue-300">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-2xl font-bold text-white">Blogs</h3>
                <i class="fas fa-blog text-5xl text-blue-200 group-hover:text-white transition-colors duration-300"></i>
            </div>
            <p class="text-5xl font-extrabold text-white mb-2">{{ $blogCount }}</p>
            <p class="text-sm text-blue-100 mb-6">Total postingan blog yang dibuat</p>
            <a href="{{ route('blogs.index') }}"
               class="inline-flex items-center text-white text-lg font-semibold hover:underline group-hover:text-blue-200 transition-colors duration-300">
                Kelola Blog <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
        </div>

        <!-- Events Count Card -->
        <div class="bg-gradient-to-br from-green-500 to-green-700 p-8 rounded-2xl shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out cursor-pointer group border border-transparent hover:border-green-300">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-2xl font-bold text-white">Events</h3>
                <i class="fas fa-calendar-alt text-5xl text-green-200 group-hover:text-white transition-colors duration-300"></i>
            </div>
            <p class="text-5xl font-extrabold text-white mb-2">{{ $eventCount }}</p>
            <p class="text-sm text-green-100 mb-6">Acara mendatang atau yang sudah lewat</p>
            <a href="{{ route('events.index') }}"
               class="inline-flex items-center text-white text-lg font-semibold hover:underline group-hover:text-green-200 transition-colors duration-300">
                Kelola Acara <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
        </div>

        <!-- Announcements Count Card -->
        <div class="bg-gradient-to-br from-red-500 to-red-700 p-8 rounded-2xl shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out cursor-pointer group border border-transparent hover:border-red-300">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-2xl font-bold text-white">Announcements</h3>
                <i class="fas fa-bullhorn text-5xl text-red-200 group-hover:text-white transition-colors duration-300"></i>
            </div>
            <p class="text-5xl font-extrabold text-white mb-2">{{ $announcementCount }}</p>
            <p class="text-sm text-red-100 mb-6">Pemberitahuan penting yang diposting</p>
            <a href="{{ route('announcements.index') }}"
               class="inline-flex items-center text-white text-lg font-semibold hover:underline group-hover:text-red-200 transition-colors duration-300">
                Kelola Pengumuman <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
        </div>

        <!-- Users Count Card -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-700 p-8 rounded-2xl shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out cursor-pointer group border border-transparent hover:border-purple-300">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-2xl font-bold text-white">Users</h3>
                <i class="fas fa-users text-5xl text-purple-200 group-hover:text-white transition-colors duration-300"></i>
            </div>
            <p class="text-5xl font-extrabold text-white mb-2">{{ $userCount }}</p>
            <p class="text-sm text-purple-100 mb-6">Total pengguna terdaftar</p>
            <a href="{{ route('users.index') }}"
               class="inline-flex items-center text-white text-lg font-semibold hover:underline group-hover:text-purple-200 transition-colors duration-300">
                Kelola Pengguna <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="mt-12">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-8 border-b-4 border-yellow-600 pb-4 inline-block">Aktivitas Terbaru</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Latest Blog -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:border-yellow-400 hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <h4 class="text-2xl font-bold text-gray-900 mb-3 flex items-center">
                    <i class="fas fa-pencil-alt text-2xl text-yellow-500 mr-3"></i> Blog Terbaru
                </h4>
                @if($latestBlog)
                    <p class="text-gray-700 text-lg mb-2">{{ $latestBlog->title }}</p>
                    <p class="text-sm text-gray-500">Diposting pada: {{ $latestBlog->created_at->format('d M Y') }}</p>
                @else
                    <p class="text-gray-500 italic">Belum ada blog tersedia.</p>
                @endif
            </div>

            <!-- Latest Event -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:border-yellow-400 hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <h4 class="text-2xl font-bold text-gray-900 mb-3 flex items-center">
                    <i class="fas fa-calendar-check text-2xl text-yellow-500 mr-3"></i> Acara Terbaru
                </h4>
                @if($latestEvent)
                    <p class="text-gray-700 text-lg mb-2">{{ $latestEvent->title }}</p>
                    <p class="text-sm text-gray-500">Tanggal: {{ \Carbon\Carbon::parse($latestEvent->date)->format('d M Y') }}</p>
                @else
                    <p class="text-gray-500 italic">Belum ada acara tersedia.</p>
                @endif
            </div>

            <!-- Latest Announcement -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:border-yellow-400 hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <h4 class="text-2xl font-bold text-gray-900 mb-3 flex items-center">
                    <i class="fas fa-bullhorn text-2xl text-yellow-500 mr-3"></i> Pengumuman Terbaru
                </h4>
                @if($latestAnnouncement)
                    <p class="text-gray-700 text-lg mb-2">{{ $latestAnnouncement->title }}</p>
                    <p class="text-sm text-gray-500">Diposting pada: {{ $latestAnnouncement->created_at->format('d M Y') }}</p>
                @else
                    <p class="text-gray-500 italic">Belum ada pengumuman tersedia.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="mt-16">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-8 border-b-4 border-yellow-600 pb-4 inline-block">Tindakan Cepat</h2>
        <div class="flex flex-wrap gap-6 justify-center sm:justify-start">
            <a href="{{ route('blogs.create') }}"
               class="inline-flex items-center px-8 py-4 bg-yellow-500 text-white font-semibold rounded-full shadow-xl
                      hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105 group">
                <i class="fas fa-plus-circle text-xl mr-3 group-hover:rotate-6 transition-transform duration-300"></i> Buat Blog Baru
            </a>
            <a href="{{ route('events.create') }}"
               class="inline-flex items-center px-8 py-4 bg-yellow-500 text-white font-semibold rounded-full shadow-xl
                      hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105 group">
                <i class="fas fa-plus-circle text-xl mr-3 group-hover:rotate-6 transition-transform duration-300"></i> Buat Acara Baru
            </a>
            <a href="{{ route('announcements.create') }}"
               class="inline-flex items-center px-8 py-4 bg-yellow-500 text-white font-semibold rounded-full shadow-xl
                      hover:bg-yellow-600 transition-all duration-300 transform hover:scale-105 group">
                <i class="fas fa-plus-circle text-xl mr-3 group-hover:rotate-6 transition-transform duration-300"></i> Buat Pengumuman Baru
            </a>
        </div>
    </div>
</div>

@endsection
