@extends('layouts.admindashboard')

@section('content')
<div class="container mx-auto px-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $announcement->title }}</h2>
    <p class="text-gray-500">
        <i class="fas fa-calendar-alt text-red-500 mr-1"></i>
        {{ $announcement->published_at ? \Carbon\Carbon::parse($announcement->published_at)->format('M d, Y') : 'Not Published' }}
    </p>

    <div class="mt-4">
        <p class="text-gray-600">{{ $announcement->description }}</p>
    </div>

    <a href="{{ route('announcements.index') }}" class="mt-6 inline-block text-blue-500">Back to Announcements</a>
</div>
@endsection
