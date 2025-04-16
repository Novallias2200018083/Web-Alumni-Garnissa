@extends('layouts.website')

@section('content')
<!-- Events Section -->
<section class="py-12">
    <div class="container mx-auto px-6 text-center">
        <!-- Section Heading -->
        <h2 class="text-4xl font-bold text-gray-800 mb-8 transition-all duration-300 hover:text-[#E82929] hover:underline underline-offset-8">
            Upcoming Events
        </h2>

        <!-- Event Cards -->
        @if($events->isEmpty())
            <p class="text-xl text-gray-600">No upcoming events at the moment.</p>
        @else
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-500 hover:scale-105">
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-52 object-cover">
                        <div class="p-6">
                            <h3 class="text-2xl font-semibold text-gray-800 mb-3">{{ $event->title }}</h3>
                            <p class="text-gray-700">{{ Str::limit($event->description, 100) }}</p>
                            <p class="mt-2 text-gray-600 text-sm">
                                <i class="fas fa-calendar-alt text-[#E82929]"></i> 
                                {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }} 
                                @if($event->event_time) 
                                    at {{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }} 
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
