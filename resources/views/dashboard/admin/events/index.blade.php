{{-- resources/views/dashboard/admin/events/index.blade.php --}}

@extends('layouts.admindashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- Modern Header Section --}}
        <div class="mb-12">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="space-y-2">
                    <h1 class="text-5xl font-bold bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 bg-clip-text text-transparent">
                        Acara Saya
                    </h1>
                    <p class="text-slate-600 text-lg">Kelola dan atur acara Anda dengan mudah</p>
                </div>

                <a href="{{ route('events.create') }}"
                   class="group relative inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600
                          text-white font-semibold rounded-2xl shadow-lg shadow-blue-500/25 hover:shadow-xl hover:shadow-blue-500/40
                          transform hover:-translate-y-1 transition-all duration-300 ease-out">
                    <div class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center group-hover:rotate-90 transition-transform duration-300">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    Buat Acara Baru
                </a>
            </div>
        </div>

        {{-- SweetAlert Success Message --}}
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: "Berhasil!",
                        text: "{{ session('success') }}",
                        icon: "success",
                        confirmButtonText: "OK",
                        confirmButtonColor: '#3B82F6',
                        background: '#ffffff',
                        borderRadius: '16px'
                    });
                });
            </script>
        @endif

        {{-- Search and Filter Section --}}
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-lg shadow-slate-200/50 p-6 mb-12 border border-white/50">
            <form action="{{ route('events.index') }}" method="GET" class="space-y-6">
                {{-- Filter Row 1: Search and Status --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- Search Input --}}
                    <div>
                        <label for="search" class="block text-sm font-medium text-slate-700 mb-2">Cari Acara</label>
                        <div class="relative">
                            <input type="text" name="search" id="search" placeholder="Cari berdasarkan judul, deskripsi, atau lokasi..."
                                   class="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-xl focus:ring-blue-500 focus:border-blue-500
                                          transition duration-200 ease-in-out"
                                   value="{{ request('search') }}">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Status Filter --}}
                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-700 mb-2">Status Acara</label>
                        <select name="status" id="status"
                                class="w-full py-3 px-4 border border-slate-300 rounded-xl focus:ring-blue-500 focus:border-blue-500
                                       transition duration-200 ease-in-out">
                            <option value="">Semua Status</option>
                            <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                            <option value="past" {{ request('status') == 'past' ? 'selected' : '' }}>Telah Selesai</option>
                        </select>
                    </div>
                </div>

                {{-- Filter Row 2: Type and Audience --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- Event Type Filter --}}
                    <div>
                        <label for="type_filter" class="block text-sm font-medium text-slate-700 mb-2">Jenis Acara</label>
                        <select name="type_filter" id="type_filter"
                                class="w-full py-3 px-4 border border-slate-300 rounded-xl focus:ring-blue-500 focus:border-blue-500
                                       transition duration-200 ease-in-out">
                            <option value="">Semua Jenis</option>
                            <option value="paid" {{ request('type_filter') == 'paid' ? 'selected' : '' }}>Berbayar</option>
                            <option value="free" {{ request('type_filter') == 'free' ? 'selected' : '' }}>Gratis</option>
                        </select>
                    </div>

                    {{-- Audience Type Filter --}}
                    <div>
                        <label for="audience_filter" class="block text-sm font-medium text-slate-700 mb-2">Target Peserta</label>
                        <select name="audience_filter" id="audience_filter"
                                class="w-full py-3 px-4 border border-slate-300 rounded-xl focus:ring-blue-500 focus:border-blue-500
                                       transition duration-200 ease-in-out">
                            <option value="">Semua Target</option>
                            <option value="all" {{ request('audience_filter') == 'all' ? 'selected' : '' }}>Semua Alumni</option>
                            <option value="major_only" {{ request('audience_filter') == 'major_only' ? 'selected' : '' }}>Jurusan Tertentu</option>
                            <option value="year_only" {{ request('audience_filter') == 'year_only' ? 'selected' : '' }}>Angkatan Tertentu</option>
                            <option value="major_and_year" {{ request('audience_filter') == 'major_and_year' ? 'selected' : '' }}>Jurusan & Angkatan</option>
                        </select>
                    </div>
                </div>

                {{-- Filter Row 3: Major and Year (if available) --}}
                @if(isset($majors) && isset($years))
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- Major Filter --}}
                    <div>
                        <label for="major_filter" class="block text-sm font-medium text-slate-700 mb-2">Filter Jurusan</label>
                        <select name="major_filter" id="major_filter"
                                class="w-full py-3 px-4 border border-slate-300 rounded-xl focus:ring-blue-500 focus:border-blue-500
                                       transition duration-200 ease-in-out">
                            <option value="">Semua Jurusan</option>
                            @foreach($majors as $major)
                                <option value="{{ $major->id }}" {{ request('major_filter') == $major->id ? 'selected' : '' }}>
                                    {{ $major->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Year Filter --}}
                    <div>
                        <label for="year_filter" class="block text-sm font-medium text-slate-700 mb-2">Filter Angkatan</label>
                        <select name="year_filter" id="year_filter"
                                class="w-full py-3 px-4 border border-slate-300 rounded-xl focus:ring-blue-500 focus:border-blue-500
                                       transition duration-200 ease-in-out">
                            <option value="">Semua Angkatan</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ request('year_filter') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <button type="submit"
                                class="flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl
                                       shadow-md shadow-blue-500/20 hover:bg-blue-700 transform hover:-translate-y-0.5 transition-all duration-200 ease-out">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"/>
                        </svg>
                        Terapkan Filter
                    </button>

                    {{-- Reset Button --}}
                    @if(request()->hasAny(['search', 'status', 'type_filter', 'audience_filter', 'major_filter', 'year_filter']))
                        <a href="{{ route('events.index') }}"
                           class="flex items-center justify-center gap-2 px-6 py-3 bg-slate-300 text-slate-800 font-semibold rounded-xl
                                   shadow-md shadow-slate-200/20 hover:bg-slate-400 transform hover:-translate-y-0.5 transition-all duration-200 ease-out">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            Reset Filter
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Events Content --}}
        @if($events->isEmpty())
            {{-- Empty State - Modern Design --}}
            <div class="flex flex-col items-center justify-center py-24">
                <div class="relative mb-8">
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-3xl flex items-center justify-center shadow-lg">
                        <svg class="w-16 h-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>

                <div class="text-center space-y-4 max-w-md">
                    <h3 class="text-2xl font-bold text-slate-800">Tidak ada acara ditemukan</h3>
                    <p class="text-slate-500 leading-relaxed">
                        @if(request()->hasAny(['search', 'status', 'type_filter', 'audience_filter', 'major_filter', 'year_filter']))
                            Tidak ada acara yang sesuai dengan kriteria pencarian dan filter Anda. Coba sesuaikan filter Anda.
                        @else
                            Mulai membangun portofolio acara Anda dengan membuat acara pertama. Cepat dan mudah!
                        @endif
                    </p>
                </div>

                <a href="{{ route('events.create') }}"
                   class="mt-8 inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600
                          text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1
                          transition-all duration-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    Buat Acara Pertama Anda
                </a>
            </div>
        @else
            {{-- Events Grid - Modern Cards with Consistent Layout --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @foreach ($events as $event)
                    <div class="group bg-white/80 backdrop-blur-sm rounded-3xl shadow-lg shadow-slate-200/50
                                 hover:shadow-xl hover:shadow-slate-300/50 overflow-hidden border border-white/50
                                 transform hover:-translate-y-2 transition-all duration-500 ease-out flex flex-col">

                        {{-- Event Image --}}
                        <div class="relative overflow-hidden h-48 flex-shrink-0">
                            @if ($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}"
                                         alt="{{ $event->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-slate-100 to-blue-100
                                             flex items-center justify-center">
                                    <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif

                            {{-- Event Type Badge --}}
                            <div class="absolute top-4 left-4">
                                @if($event->is_paid)
                                    <span class="px-3 py-1 bg-orange-500/90 backdrop-blur-sm text-white text-sm font-medium rounded-full">
                                        Rp{{ number_format($event->price, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-green-500/90 backdrop-blur-sm text-white text-sm font-medium rounded-full">
                                        Gratis
                                    </span>
                                @endif
                            </div>

                            {{-- RSVP Badge --}}
                            <div class="absolute top-4 right-4">
                                @if($event->rsvp_required)
                                    <span class="px-3 py-1 bg-blue-500/90 backdrop-blur-sm text-white text-sm font-medium rounded-full">
                                        RSVP
                                    </span>
                                @endif
                            </div>

                            {{-- Status Badge --}}
                            <div class="absolute bottom-4 left-4">
                                @if(\Carbon\Carbon::parse($event->event_date)->isPast())
                                    <span class="px-3 py-1 bg-gray-500/90 backdrop-blur-sm text-white text-sm font-medium rounded-full">
                                        Selesai
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-emerald-500/90 backdrop-blur-sm text-white text-sm font-medium rounded-full">
                                        Akan Datang
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Card Content with Flex Layout --}}
                        <div class="p-6 flex flex-col flex-grow">
                            {{-- Title - Fixed Height --}}
                            <div class="h-14 mb-4">
                                <h3 class="text-xl font-bold text-slate-800 group-hover:text-blue-600 transition-colors duration-300
                                           line-clamp-2 leading-7">
                                    {{ $event->title }}
                                </h3>
                            </div>

                            {{-- Description - Fixed Height --}}
                            <div class="h-16 mb-6">
                                <p class="text-slate-600 text-sm leading-relaxed line-clamp-3">
                                    {{ $event->description }}
                                </p>
                            </div>

                            {{-- Event Details - Grows to fill space --}}
                            <div class="space-y-3 py-4 border-t border-slate-100 flex-grow">
                                {{-- Date & Time --}}
                                <div class="flex items-center gap-3 text-sm">
                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="font-medium text-slate-800 truncate">{{ \Carbon\Carbon::parse($event->event_date)->locale('id')->translatedFormat('d M, Y') }}</p>
                                        <p class="text-slate-500 truncate">{{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }} WIB</p>
                                    </div>
                                </div>

                                {{-- Location --}}
                                <div class="flex items-center gap-3 text-sm">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <p class="font-medium text-slate-800 truncate flex-1">{{ $event->location }}</p>
                                </div>

                                {{-- Audience Type --}}
                                <div class="flex items-center gap-3 text-sm">
                                    <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM9 8a2 2 0 11-4 0 2 2 0 014 0zM7 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            <path d="M1 15.5a6 6 0 0112 0v3.5H1v-3.5zM13 15.5a6 6 0 0112 0v3.5h-12v-3.5z"/>
                                        </svg>
                                    </div>
                                    <p class="font-medium text-slate-800 truncate flex-1">
                                        @if($event->audience_type === 'all')
                                            Semua Alumni
                                        @elseif($event->audience_type === 'major_only')
                                            Jurusan Tertentu ({{ $event->targetMajor->name ?? 'N/A' }})
                                        @elseif($event->audience_type === 'year_only')
                                            Angkatan Tertentu ({{ $event->target_year ?? 'N/A' }})
                                        @elseif($event->audience_type === 'major_and_year')
                                            Jurusan {{ $event->targetMajor->name ?? 'N/A' }} & Angkatan {{ $event->target_year ?? 'N/A' }}
                                        @endif
                                    </p>
                                </div>

                                {{-- Max Attendees & Current Registrations --}}
                                @if($event->max_attendees)
                                <div class="flex items-center gap-3 text-sm">
                                    <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <p class="font-medium text-slate-800 truncate flex-1">
                                        {{ $event->eventRegistrations->count() }} / {{ number_format($event->max_attendees) }} peserta
                                    </p>
                                </div>
                                @endif
                            </div>

                            {{-- Action Buttons - Fixed at Bottom --}}
                            <div class="flex flex-wrap gap-2 pt-4 border-t border-slate-100 mt-auto">
                                {{-- Edit Button --}}
                                <a href="{{ route('events.edit', $event) }}"
                                   class="flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600
                                          text-white text-sm font-medium rounded-xl transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                    </svg>
                                    Edit
                                </a>

                                {{-- Registrations Button --}}
                                <a href="{{ route('admin.events.registrations.index', $event->id) }}"
                                   class="flex items-center gap-2 px-4 py-2 bg-emerald-500 hover:bg-emerald-600
                                          text-white text-sm font-medium rounded-xl transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                                    </svg>
                                    {{ $event->eventRegistrations_count ?? $event->eventRegistrations()->count() }} Peserta
                                </a>

                                {{-- Delete Button --}}
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline" onsubmit="return confirmDelete(event);">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600
                                                   text-white text-sm font-medium rounded-xl transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"/>
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414L7.586 12l-1.293 1.293a1 1 0 101.414 1.414L9 13.414l1.293 1.293a1 1 0 001.414-1.414L10.414 12l1.293-1.293z" clip-rule="evenodd"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            ---
            {{-- Modern Pagination --}}
            @if($events->hasPages())
                <div class="mt-16 flex justify-center">
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-4 border border-white/50">
                        {{ $events->appends(request()->query())->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>

{{-- Enhanced SweetAlert Delete Confirmation --}}
<script>
    function confirmDelete(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data acara akan dihapus secara permanen dan tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            background: '#ffffff',
            borderRadius: '16px',
            customClass: {
                popup: 'swal-popup-custom',
                title: 'swal-title-custom',
                content: 'swal-content-custom'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form
                event.target.submit();
            }
        });

        return false;
    }
</script>

{{-- Custom SweetAlert Styles --}}
<style>
    .swal-popup-custom {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    .swal-title-custom {
        font-weight: 700;
        color: #1F2937;
    }

    .swal-content-custom {
        color: #6B7280;
        font-size: 14px;
        line-height: 1.5;
    }
</style>

@endsection