@extends('layouts.website')

@section('content')
<section class="py-12 bg-gray-50 pt-24"> {{-- Added pt-24 for spacing below a fixed navbar --}}
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-10 transition-all duration-300 hover:text-[#E82929] hover:underline underline-offset-8">
            Acara Mendatang
        </h2>

        @if($events->isEmpty())
            <div class="bg-white rounded-xl shadow-lg p-8 max-w-md mx-auto flex flex-col items-center justify-center">
                <p class="text-2xl text-gray-700 font-semibold mb-3">Tidak ada acara tersedia saat ini.</p>
                <p class="text-lg text-gray-500">Cek lagi nanti untuk acara-acara menarik lainnya!</p>
                <i class="far fa-calendar-times text-6xl text-gray-300 mt-6"></i> {{-- Added a more descriptive icon --}}
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($events as $event)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-500 hover:scale-105 hover:shadow-xl border border-gray-200 flex flex-col">
                        @if ($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-52 object-cover">
                        @else
                            <div class="w-full h-52 bg-gray-100 flex items-center justify-center text-gray-400 text-6xl">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                        <div class="p-6 text-left flex-grow flex flex-col"> {{-- Use flex-grow to make sure cards are same height --}}
                            <h3 class="text-2xl font-bold text-gray-800 mb-3 leading-tight">{{ $event->title }}</h3> {{-- Added leading-tight --}}
                            <p class="text-gray-700 text-base mb-4 flex-grow">{{ Str::limit($event->description, 100) }}</p> {{-- flex-grow for description --}}

                            <div class="text-gray-600 text-sm space-y-2 mb-6"> {{-- Increased bottom margin for spacing --}}
                                <p class="flex items-center">
                                    <i class="fas fa-calendar-alt text-[#E82929] mr-3 text-lg"></i> {{-- Larger icon, more margin --}}
                                    <span class="font-medium">
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}
                                        @if($event->event_time)
                                            <span class="ml-1">pukul {{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }} WIB</span> {{-- Changed "at" to "pukul" and added WIB --}}
                                        @endif
                                    </span>
                                </p>
                                <p class="flex items-center">
                                    <i class="fas fa-map-marker-alt text-blue-500 mr-3 text-lg"></i>
                                    <span class="font-medium">{{ $event->location }}</span>
                                </p>
                                <p class="flex items-center">
                                    @if($event->rsvp_required)
                                        <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i> <span class="font-medium">Perlu RSVP</span>
                                    @else
                                        <i class="fas fa-times-circle text-red-500 mr-3 text-lg"></i> <span class="font-medium">Tidak Perlu RSVP</span>
                                    @endif
                                </p>
                            </div>

                            <a href="{{ route('events.public.detail', $event->id) }}"
                               class="inline-block bg-[#E82929] text-white px-8 py-3 rounded-lg text-base font-semibold text-center
                                      hover:bg-red-700 transition duration-300 transform hover:scale-105 shadow-md self-start"> {{-- self-start to align button to left --}}
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection