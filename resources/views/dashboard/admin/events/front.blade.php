@extends('layouts.website')

@section('content')
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Upcoming Events</h2>

        <div class="grid md:grid-cols-3 gap-6 mt-6">
            @foreach ($events as $event)
                <div class="bg-white rounded-xl shadow-lg p-4">
                    @if ($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" class="rounded-lg mb-3 w-full">
                    @endif
                    <h3 class="text-xl font-semibold text-gray-800">{{ $event->title }}</h3>
                    <p class="text-gray-600 transition-all ease-in-out duration-300"
                        id="blog-full-description-{{ $event->id }}">
                        {{ strip_tags($event->description) }}
                    </p>
                    <p class="text-gray-500"><i class="fas fa-calendar-alt text-red-500"></i> {{ $event->event_date }}</p>
                    <a href="{{ route('events.show', $event) }}" class="text-blue-500">View Details</a>
                </div>
            @endforeach
        </div>

        {{ $events->links() }}
    </div>
@endsection