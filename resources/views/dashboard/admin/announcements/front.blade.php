@extends('layouts.website')

@section('content')
<div class="container mx-auto px-6 mt-12">
    <h2 class="text-4xl text-center font-bold text-gray-800 mb-8 transition-all duration-300 hover:text-red-600 hover:underline underline-offset-8">
        All Announcements
    </h2>

    <div class="grid md:grid-cols-3 gap-6">
        @foreach ($announcements as $announcement)
        <div class="bg-white rounded-xl shadow-md p-4 hover:shadow-xl transition-shadow duration-300">
            @if ($announcement->image)
                <img src="{{ asset('storage/' . $announcement->image) }}" class="rounded-lg mb-3 w-full h-48 object-cover" alt="Announcement Image">
            @endif

            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $announcement->title }}</h3>

            <p class="text-gray-600 mb-2">
                {{ strip_tags($announcement->description) }}
            </p>

            <p class="text-gray-500 text-sm mb-1">
                <i class="fas fa-calendar-alt text-red-500 mr-1"></i>
                {{ $announcement->published_at ? \Carbon\Carbon::parse($announcement->published_at)->format('M d, Y') : 'Not Published' }}
            </p>

            <p class="text-sm text-gray-500">
                Status:
                <span class="{{ $announcement->is_active ? 'text-green-500' : 'text-red-500' }}">
                    {{ $announcement->is_active ? 'Active' : 'Inactive' }}
                </span>
            </p>
        </div>
        @endforeach
    </div>

    <div class="mt-10">
        {{ $announcements->links() }}
    </div>
</div>
@endsection
