@extends('layouts.alumnidashboard')

@section('content')

<div class="min-h-screen bg-slate-50 dark:bg-slate-900 transition-colors duration-300 -m-6 md:-m-8">
    <div class="relative overflow-hidden bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 shadow-2xl">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#grid)" />
            </svg>
        </div>
        
        <div class="absolute inset-0">
            <div class="absolute top-1/4 left-1/4 w-3 h-3 bg-blue-400/30 rounded-full animate-pulse"></div>
            <div class="absolute top-3/4 right-1/3 w-2 h-2 bg-indigo-400/40 rounded-full animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-1/3 left-2/3 w-4 h-4 bg-slate-400/20 rounded-full animate-pulse" style="animation-delay: 4s;"></div>
        </div>
        
        <div class="relative container mx-auto px-6 py-20 text-center">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                    Selamat Datang Kembali, 
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-indigo-200 font-light">
                        Alumni Terhormat
                    </span>
                </h1>
                <p class="text-lg md:text-xl text-slate-200 max-w-2xl mx-auto leading-relaxed mb-10 font-light">
                    Terhubung dengan jaringan profesional Anda, temukan berbagai kesempatan, dan berkontribusi pada keunggulan berkelanjutan almamater Anda.
                </p>
                <div class="flex justify-center">
                    <a href="{{ route('events.index') }}" class="inline-flex items-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-lg transition-all duration-300 hover:shadow-xl hover:scale-105">
                        <i class="fas fa-calendar-alt mr-3"></i>
                        Jelajahi Acara
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 py-16">
        <section class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 dark:text-white mb-4">
                    Acara Mendatang
                </h2>
                <div class="w-20 h-1 bg-blue-600 mx-auto rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-300 mt-4 max-w-2xl mx-auto">
                    Tetaplah terhubung dengan komunitas alumni Anda melalui acara bermakna dan kesempatan jaringan.
                </p>
            </div>

            @if($events->isEmpty())
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-12 text-center max-w-2xl mx-auto">
                    <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-calendar-alt text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 dark:text-white mb-3">Belum Ada Acara Mendatang</h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-6">
                        Kami sedang merencanakan acara alumni yang menarik. Silakan periksa kembali nanti untuk pembaruan.
                    </p>
                    <a href="{{ route('events.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-search mr-2"></i>
                        Lihat Semua Acara
                    </a>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($events->take(3) as $event)
                        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                            @if ($event->image)
                                <div class="relative overflow-hidden h-48">
                                    <img src="{{ asset('storage/' . $event->image) }}" 
                                        alt="{{ $event->title }}"
                                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                </div>
                            @else
                                <div class="h-48 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-800 flex items-center justify-center">
                                    <i class="fas fa-calendar-alt text-4xl text-slate-400"></i>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-4 line-clamp-2">
                                    {{ Str::limit($event->title, 70) }}
                                </h3>
                                
                                <div class="space-y-3 mb-6">
                                    <div class="flex items-center text-slate-600 dark:text-slate-300 text-sm">
                                        <div class="w-8 h-8 bg-red-50 dark:bg-red-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-calendar text-red-600 text-xs"></i>
                                        </div>
                                        <span>{{ \Carbon\Carbon::parse($event->event_date)->isoFormat('dddd, D MMMM YYYY', 'ID') }}</span>
                                    </div>
                                    
                                    <div class="flex items-center text-slate-600 dark:text-slate-300 text-sm">
                                        <div class="w-8 h-8 bg-blue-50 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-clock text-blue-600 text-xs"></i>
                                        </div>
                                        <span>{{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }} WIB</span>
                                    </div>
                                    
                                    <div class="flex items-start text-slate-600 dark:text-slate-300 text-sm">
                                        <div class="w-8 h-8 bg-green-50 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3 mt-0.5">
                                            <i class="fas fa-map-marker-alt text-green-600 text-xs"></i>
                                        </div>
                                        <span class="line-clamp-2">{{ Str::limit($event->location, 50) }}</span>
                                    </div>
                                </div>
                                
                                <p class="text-slate-600 dark:text-slate-400 text-sm mb-6 line-clamp-3">
                                    {{ Str::limit($event->description, 120) }}
                                </p>

                                <a href="{{ route('events.show', $event->id) }}" class="block w-full text-center px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-12">
                    <a href="{{ route('events.index') }}" class="inline-flex items-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-lg transition-all duration-200 hover:shadow-xl">
                        Jelajahi Semua Acara
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            @endif
        </section>

        <section class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 dark:text-white mb-4">
                    Kisah Alumni
                </h2>
                <div class="w-20 h-1 bg-purple-600 mx-auto rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-300 mt-4 max-w-2xl mx-auto">
                    Temukan perjalanan dan pencapaian inspiratif dari komunitas alumni terhormat kami.
                </p>
            </div>

            @if($blogs->isEmpty())
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-12 text-center max-w-2xl mx-auto">
                    <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-book-open text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 dark:text-white mb-3">Belum Ada Kisah Alumni</h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-6">
                        Bagikan perjalanan profesional Anda dan inspirasi sesama alumni.
                    </p>
                    <a href="{{ route('blogs.create') }}" class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-pen mr-2"></i>
                        Bagikan Kisah Anda
                    </a>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($blogs->take(3) as $blog)
                        <article class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                            @if ($blog->image)
                                <div class="relative overflow-hidden h-48">
                                    <img src="{{ asset('storage/' . $blog->image) }}" 
                                        alt="{{ $blog->title }}"
                                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                                </div>
                            @else
                                <div class="h-48 bg-gradient-to-br from-purple-50 to-purple-100 dark:from-slate-700 dark:to-slate-800 flex items-center justify-center">
                                    <i class="fas fa-book-open text-4xl text-purple-400"></i>
                                </div>
                            @endif

                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-3 line-clamp-2">
                                    {{ Str::limit($blog->title, 70) }}
                                </h3>

                                <div class="flex items-center text-slate-600 dark:text-slate-300 text-sm mb-4">
                                    <div class="w-8 h-8 bg-slate-100 dark:bg-slate-700 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-calendar text-slate-600 text-xs"></i>
                                    </div>
                                    <span>
                                        {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->isoFormat('DD MMMM YYYY', 'ID') : 'Draf' }}
                                    </span>
                                </div>

                                <p class="text-slate-600 dark:text-slate-400 text-sm mb-6 line-clamp-3 leading-relaxed">
                                    {!! Str::limit(strip_tags($blog->description), 120) !!}
                                </p>
                                
                                <a href="{{ route('blogs.show', $blog->id) }}" class="block w-full text-center px-4 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-colors duration-200">
                                    Baca Kisah
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
                
                <div class="text-center mt-12">
                    <a href="{{ route('blogs.front') }}" class="inline-flex items-center px-8 py-4 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg shadow-lg transition-all duration-200 hover:shadow-xl">
                        Jelajahi Semua Kisah
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            @endif
        </section>

        <section class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 dark:text-white mb-4">
                    Pengumuman Terbaru
                </h2>
                <div class="w-20 h-1 bg-amber-600 mx-auto rounded-full"></div>
                <p class="text-slate-600 dark:text-slate-300 mt-4 max-w-2xl mx-auto">
                    Tetaplah terinformasi dengan pembaruan dan kesempatan penting dari almamater Anda.
                </p>
            </div>

            @if($announcements->isEmpty())
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-12 text-center max-w-2xl mx-auto">
                    <div class="w-16 h-16 bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-megaphone text-2xl text-amber-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-800 dark:text-white mb-3">Belum Ada Pengumuman Baru</h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-6">
                        Pembaruan penting akan muncul di sini saat tersedia.
                    </p>
                    <a href="{{ route('announcements.index') }}" class="inline-flex items-center px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-list mr-2"></i>
                        Lihat Semua Pengumuman
                    </a>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($announcements->take(3) as $announcement)
                        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                            <div class="flex items-start justify-between mb-4">
                                <h3 class="text-lg font-semibold text-slate-800 dark:text-white line-clamp-2 flex-1 pr-4">
                                    {{ Str::limit($announcement->title, 70) }}
                                </h3>
                                <div class="flex items-center ml-2">
                                    <div class="w-2 h-2 rounded-full {{ $announcement->is_active ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                </div>
                            </div>
                            
                            <p class="text-slate-600 dark:text-slate-400 text-sm mb-6 line-clamp-4 leading-relaxed">
                                {!! Str::limit(strip_tags($announcement->description), 120) !!}
                            </p>

                            <div class="flex items-center justify-between pt-4 border-t border-slate-200 dark:border-slate-700">
                                <div class="flex items-center text-slate-600 dark:text-slate-300 text-sm">
                                    <i class="fas fa-calendar-alt mr-2 text-xs"></i>
                                    <span>
                                        {{ $announcement->published_at ? \Carbon\Carbon::parse($announcement->published_at)->isoFormat('DD MMMM YYYY', 'ID') : 'Draf' }}
                                    </span>
                                </div>
                                <span class="text-xs font-medium px-2 py-1 rounded-full {{ $announcement->is_active ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                                    {{ $announcement->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-12">
                    <a href="{{ route('announcements.index') }}" class="inline-flex items-center px-8 py-4 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg shadow-lg transition-all duration-200 hover:shadow-xl">
                        Lihat Semua Pengumuman
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            @endif
        </section>
    </div>
</div>

<style>
    /* Professional animations and utilities */
    @keyframes subtle-float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .animate-float {
        animation: subtle-float 6s ease-in-out infinite;
    }

    /* Line clamp utilities */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-4 {
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Custom scrollbar for better UX */
    ::-webkit-scrollbar {
        width: 8px;
    }
    ::-webkit-scrollbar-track {
        background: #f1f5f9;
    }
    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    /* Dark mode scrollbar */
    .dark ::-webkit-scrollbar-track {
        background: #1e293b;
    }
    .dark ::-webkit-scrollbar-thumb {
        background: #475569;
    }
    .dark ::-webkit-scrollbar-thumb:hover {
        background: #64748b;
    }

    /* Remove default padding/margin from layout container */
    .main-content {
        padding: 0 !important;
        margin: 0 !important;
    }
</style>

@endsection