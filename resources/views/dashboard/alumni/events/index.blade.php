@extends('layouts.alumnidashboard')

@section('content')
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold text-gray-800 mb-10 transition-all duration-300 hover:text-[#E82929] hover:underline underline-offset-8">
            Upcoming Events
        </h2>

        @if($events->isEmpty())
            <div class="bg-white rounded-xl shadow-lg p-8 max-w-md mx-auto">
                <p class="text-xl text-gray-600">Tidak ada acara tersedia saat ini.</p>
                <p class="text-md text-gray-500 mt-2">Cek lagi nanti untuk acara-acara menarik lainnya!</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($events as $event)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-500 hover:scale-105 border border-gray-200">
                        @if ($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-52 object-cover">
                        @else
                            <div class="w-full h-52 bg-gray-200 flex items-center justify-center text-gray-400 text-6xl">
                                <i class="fas fa-image"></i> {{-- Font Awesome icon for placeholder --}}
                            </div>
                        @endif
                        <div class="p-6 text-left">
                            <h3 class="text-2xl font-semibold text-gray-800 mb-3">{{ $event->title }}</h3>
                            <p class="text-gray-700 text-base mb-4">{{ Str::limit($event->description, 100) }}</p>
                            
                            <div class="text-gray-600 text-sm space-y-2 mb-4">
                                <p class="flex items-center">
                                    <i class="fas fa-calendar-alt text-[#E82929] mr-2"></i> 
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }} 
                                    @if($event->event_time) 
                                        at {{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }} 
                                    @endif
                                </p>
                                <p class="flex items-center">
                                    <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i> 
                                    {{ $event->location }}
                                </p>
                                <p class="flex items-center">
                                    @if($event->rsvp_required)
                                        <i class="fas fa-check-circle text-green-500 mr-2"></i> Perlu RSVP
                                    @else
                                        <i class="fas fa-times-circle text-red-500 mr-2"></i> Tidak Perlu RSVP
                                    @endif
                                </p>
                            </div>

                            <a href="{{ route('events.public.detail', $event->id) }}" {{-- Asumsi ada route events.show --}}
                               class="inline-block bg-[#E82929] text-white px-6 py-2 rounded-lg text-base font-semibold
                                      hover:bg-red-700 transition duration-300 transform hover:scale-105 shadow-md">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection

