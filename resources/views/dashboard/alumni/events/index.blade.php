@extends('layouts.alumnidashboard')

@section('content')
<div class="container mx-auto px-6 py-10">
<h2 class="text-4xl font-bold text-center text-gray-800 mb-10 hover:text-rose-800  transition duration-300 ease-in-out">
    Upcoming Events
</h2>

    @if($events->isEmpty())
        <p class="text-center text-gray-500 text-lg">No upcoming events at the moment.</p>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($events as $event)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
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
@endsection
