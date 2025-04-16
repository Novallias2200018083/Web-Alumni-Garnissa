@extends('layouts.alumnidashboard')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-10  hover:text-rose-800 transition duration-300">
        Announcements
    </h2>

    <div class="grid md:grid-cols-3 gap-6">
        @foreach ($announcements as $announcement)
        <div class="bg-white rounded-xl shadow-lg p-4">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $announcement->title }}</h3>

            <p class="text-gray-600 mb-3">{!! $announcement->description !!}</p>

            <p class="text-gray-500 text-sm">
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

    <div class="mt-6">
        {{ $announcements->links() }}
    </div>
</div>
@endsection
