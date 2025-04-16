@extends('layouts.alumnidashboard')

@section('content')

<!-- Alumni Dashboard -->
<div class="container mx-auto px-6 py-8">
<h1 class="text-4xl font-extrabold text-gray-800 mb-10 tracking-wide transition-all duration-300 hover:text-rose-800 hover:underline underline-offset-8">
    Welcome to the Alumni Dashboard
</h1>

    <!-- Upcoming Events Section -->
    <div class="mb-12">
        <h2 class="text-4xl font-bold text-center text-gray-800 mb-8 hover:text-rose-800 transition duration-300 ease-in-out">
            Upcoming Events
        </h2>

        @if($events->isEmpty())
            <p class="text-center text-gray-500 text-lg">No upcoming events at the moment.</p>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($events as $event)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                        @if ($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-rose-700 mb-2">{{ $event->title }}</h3>
                            <p class="text-gray-600 mb-2">
                                <i class="fas fa-calendar-alt text-red-500 mr-2"></i>{{ $event->event_date }}
                            </p>
                            <p class="text-gray-600 mb-2">
                                <i class="fas fa-clock text-blue-500 mr-2"></i>{{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }}
                            </p>
                            <p class="text-gray-600 mb-2">
                                <i class="fas fa-map-marker-alt text-green-500 mr-2"></i>{{ $event->location }}
                            </p>
                            <p class="text-gray-700 text-sm mb-3">
                                {{ Str::limit($event->description, 120) }}
                            </p>

                            @if($event->rsvp_required)
                                <p class="text-sm text-green-600 font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i> RSVP Required
                                </p>
                            @else
                                <p class="text-sm text-red-600 font-semibold">
                                    <i class="fas fa-times-circle mr-1"></i> RSVP Not Required
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            
        @endif
    </div>

    <!-- Alumni Blog Posts Section -->
    <div class="mb-12">
        <h2 class="text-4xl font-bold text-center text-gray-800 mb-8 hover:text-rose-800 transition duration-300 ease-in-out">
            Alumni Blog Posts
        </h2>

        <div class="grid md:grid-cols-3 gap-6 mt-6">
            @foreach ($blogs as $blog)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col hover:shadow-xl transition duration-300">
                    @if ($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" class="w-full h-48 object-cover" alt="Blog Image">
                    @endif

                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $blog->title }}</h3>

                        <p class="text-sm text-gray-500 mb-4">
                            <i class="fas fa-calendar-alt text-red-500 mr-1"></i>
                            {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') : 'Not set' }}
                        </p>

                        <p class="text-gray-600 text-sm">{!! Str::limit($blog->description, 120) !!}</p>
                    </div>
                </div>
            @endforeach
        </div>

       
    </div>

    <!-- Announcements Section -->
    <div class="mb-12">
        <h2 class="text-4xl font-bold text-center text-gray-800 mb-8 hover:text-rose-800 transition duration-300 ease-in-out">
            Announcements
        </h2>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($announcements as $announcement)
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $announcement->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{!! Str::limit($announcement->description, 120) !!}</p>

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

       
    </div>
</div>

@endsection
