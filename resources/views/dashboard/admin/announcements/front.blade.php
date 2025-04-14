@extends('layouts.website')

@section('content')
<div class="container mx-auto px-6 text-center">
    <h2 class="text-4xl font-bold text-gray-800 mb-8 transition-all duration-300 hover:text-[#E82929] hover:underline underline-offset-8">
        All Announcements
    </h2>

    <div class="grid md:grid-cols-3 gap-6 mt-6">
        @foreach ($announcements as $announcement)
        <div class="bg-white rounded-xl shadow-lg p-4">
            <!-- Optional Image -->
            @if ($announcement->image)
                <img src="{{ asset('storage/' . $announcement->image) }}" class="rounded-lg mb-3 w-full h-48 object-cover" alt="Announcement Image">
            @endif

            <h3 class="text-xl font-semibold text-gray-800">{{ $announcement->title }}</h3>

            <p class="text-gray-600 transition-all ease-in-out duration-300">
                {{ strip_tags($announcement->description) }}
            </p>

            <!-- Published date -->
            <p class="text-gray-500 text-sm">
                <i class="fas fa-calendar-alt text-red-500 mr-1"></i>
                {{ $announcement->published_at ? \Carbon\Carbon::parse($announcement->published_at)->format('M d, Y') : 'Not Published' }}
            </p>

            <!-- Status -->
            <p class="text-sm text-gray-500">
                Status: 
                <span class="{{ $announcement->is_active ? 'text-green-500' : 'text-red-500' }}">
                    {{ $announcement->is_active ? 'Active' : 'Inactive' }}
                </span>
            </p>

            <!-- View Details Link -->
            <div class="mt-4">
                <a href="{{ route('announcements.show', $announcement->id) }}" class="text-blue-500 hover:underline">View Details</a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $announcements->links() }}
    </div>
</div>
@endsection
