@extends('layouts.website')

@section('content')
<section class="py-12 bg-gray-50 pt-24">
    <div class="container mx-auto px-6 text-center">
        {{-- Judul bagian Acara Mendatang --}}
        <h2 class="text-4xl font-extrabold text-gray-800 mb-10 transition-all duration-300 hover:text-yellow-600 hover:underline underline-offset-8">
            Acara Mendatang
        </h2>

        {{-- Search and Filter Section --}}
        <form action="{{ route('events.front') }}" method="GET" class="mb-10 p-6 bg-white rounded-xl shadow-lg flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-6">
            <div class="flex-grow w-full md:w-auto">
                <label for="search" class="sr-only">Cari Acara</label>
                <div class="relative">
                    <input type="text" name="search" id="search" placeholder="Cari berdasarkan judul atau deskripsi..."
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500"
                           value="{{ request('search') }}">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-auto">
                <label for="status" class="sr-only">Status</label>
                <select name="status" id="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500">
                    <option value="">Semua Status</option>
                    <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Mendatang</option>
                    <option value="past" {{ request('status') == 'past' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="flex space-x-4 w-full md:w-auto justify-center">
                <button type="submit"
                        class="px-6 py-2 bg-yellow-600 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-700 transition duration-300">
                    Cari
                </button>
                @if(request('search') || request('status'))
                    <a href="{{ route('events.front') }}"
                       class="px-6 py-2 bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md hover:bg-gray-400 transition duration-300">
                        Reset
                    </a>
                @endif
            </div>
        </form>
        {{-- End Search and Filter Section --}}

        @if($events->isEmpty())
            {{-- Pesan jika tidak ada acara --}}
            <div class="bg-white rounded-xl shadow-lg p-8 max-w-md mx-auto flex flex-col items-center justify-center">
                <p class="text-2xl text-gray-700 font-semibold mb-3">Tidak ada acara tersedia saat ini.</p>
                <p class="text-lg text-gray-500">Cek lagi nanti untuk acara-acara menarik lainnya!</p>
                <i class="far fa-calendar-times text-6xl text-gray-300 mt-6"></i>
            </div>
        @else
            {{-- Grid daftar acara --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($events as $event)
                    {{-- Card untuk setiap acara --}}
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-500 hover:scale-105 hover:shadow-xl border border-gray-200 flex flex-col">
                        @if ($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-52 object-cover">
                        @else
                            <div class="w-full h-52 bg-gray-100 flex items-center justify-center text-gray-400 text-6xl">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                        <div class="p-6 text-left flex-grow flex flex-col">
                            {{-- Judul Event: Maksimal 2 baris dengan ellipsis --}}
                            <h3 class="text-2xl font-bold text-gray-800 mb-3 leading-tight line-clamp-2 min-h-[3.5rem]">
                                {{ $event->title }}
                            </h3>

                            {{-- Deskripsi Event: Dibatasi karakter, dengan ellipsis manual jika dipotong, dan teks rata kanan-kiri --}}
                            <p class="text-gray-700 text-base mb-4 flex-grow min-h-[5rem] text-justify">
                                {{ Str::limit($event->description, 150, '') }}
                                @if (strlen($event->description) > 150)
                                    <span class="text-gray-500">...</span>
                                @endif
                            </p>

                            {{-- Informasi detail acara (tanggal, lokasi, RSVP) --}}
                            <div class="text-gray-600 text-sm space-y-2 mb-6">
                                <p class="flex items-center">
                                    <i class="fas fa-calendar-alt text-yellow-600 mr-3 text-lg"></i>
                                    <span class="font-medium">
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}
                                        @if($event->event_time)
                                            <span class="ml-1">pukul {{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }} WIB</span>
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

                            {{-- Tombol Lihat Detail --}}
                            <div class="mt-auto">
                                <a href="{{ route('events.public.detail', $event->id) }}"
                                   class="inline-block bg-yellow-600 text-white px-8 py-3 rounded-lg text-base font-semibold text-center
                                          hover:bg-yellow-700 transition duration-300 transform hover:scale-105 shadow-md self-start">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8 flex justify-center"> {{-- Menggunakan flex justify-center agar pagination di tengah --}}
                {{ $events->links() }}
            </div>
        @endif
    </div>
</section>
@endsection