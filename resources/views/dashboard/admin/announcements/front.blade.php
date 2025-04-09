@extends('layouts.website')

@section('content')
<div class="container mx-auto px-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">Latest Announcements</h2>

    <div class="grid md:grid-cols-3 gap-6 mt-6">
        @foreach ($announcements as $announcement)
            <div class="bg-white rounded-xl shadow-lg p-4">
                <h3 class="text-xl font-semibold text-gray-800">{{ $announcement->title }}</h3>
                <p class="text-gray-600">{{ Str::limit(strip_tags($announcement->description), 100) }}</p>
                <p class="text-gray-500 text-sm">
                    <i class="fas fa-calendar-alt text-red-500 mr-1"></i>
                    {{ $announcement->published_at ? \Carbon\Carbon::parse($announcement->published_at)->format('M d, Y') : 'Not Published' }}
                </p>

                <a href="{{ route('announcements.show', $announcement->id) }}" class="text-blue-600 hover:underline">Read More</a>
            </div>
        @endforeach
    </div>

    {{ $announcements->links() }}
</div>
@endsection