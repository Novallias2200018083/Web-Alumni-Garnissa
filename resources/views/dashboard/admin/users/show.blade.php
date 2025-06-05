@extends('layouts.admindashboard')

@section('content')
<div class="container mx-auto px-6 py-12 max-w-6xl">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-light text-gray-900 mb-2">Detail Pengguna</h1>
        <div class="w-12 h-0.5 bg-gray-300"></div>
    </div>

    <!-- Main Content -->
    <div class="bg-white border border-gray-100 overflow-hidden">
        <!-- Profile Header -->
        <div class="px-8 py-6 border-b border-gray-100">
            <div class="flex items-center space-x-6">
                <!-- Profile Image -->
                <div class="flex-shrink-0">
                    @if ($user->alumniProfile && $user->alumniProfile->image)
                        <img src="{{ asset('storage/' . $user->alumniProfile->image) }}" 
                             alt="Foto Profil" 
                             class="w-20 h-20 rounded-full object-cover border-2 border-gray-100">
                    @else
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Basic Info -->
                <div class="flex-1">
                    <h2 class="text-xl font-medium text-gray-900 mb-1">{{ $user->name }}</h2>
                    <p class="text-gray-600 text-sm mb-2">{{ $user->email }}</p>
                    
                    <!-- Role Badge -->
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        {{ $user->role === 'admin' ? 'bg-red-50 text-red-700 border border-red-200' : 
                           ($user->role === 'alumni' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-blue-50 text-blue-700 border border-blue-200') }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 divide-y lg:divide-y-0 lg:divide-x divide-gray-100">
            <!-- Account Information -->
            <div class="px-8 py-6">
                <h3 class="text-lg font-medium text-gray-900 mb-6">Informasi Akun</h3>
                
                <dl class="space-y-4">
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">ID Mahasiswa</dt>
                        <dd class="text-sm text-gray-900">{{ $user->student_id ?? '—' }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Jurusan</dt>
                        <dd class="text-sm text-gray-900">{{ $user->major->name ?? '—' }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Terdaftar Sejak</dt>
                        <dd class="text-sm text-gray-900">{{ $user->created_at->format('d F Y') }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Alumni Profile -->
            <div class="px-8 py-6">
                <h3 class="text-lg font-medium text-gray-900 mb-6">Profil Alumni</h3>
                
                @if ($user->alumniProfile)
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Kode Alumni</dt>
                            <dd class="text-sm text-gray-900">{{ $user->alumniProfile->alumni_code ?? '—' }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Telepon</dt>
                            <dd class="text-sm text-gray-900">{{ $user->alumniProfile->phone ?? '—' }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Tahun Lulus</dt>
                            <dd class="text-sm text-gray-900">{{ $user->alumniProfile->graduation_year ?? '—' }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Pekerjaan</dt>
                            <dd class="text-sm text-gray-900">{{ $user->alumniProfile->current_job ?? '—' }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Perusahaan</dt>
                            <dd class="text-sm text-gray-900">{{ $user->alumniProfile->company ?? '—' }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Posisi</dt>
                            <dd class="text-sm text-gray-900">{{ $user->alumniProfile->position ?? '—' }}</dd>
                        </div>
                    </dl>
                @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-sm text-gray-500">Profil alumni belum dilengkapi</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Additional Info (if alumni profile exists) -->
        @if ($user->alumniProfile)
            <div class="px-8 py-6 border-t border-gray-100 bg-gray-50">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Address & Bio -->
                    <div class="space-y-4">
                        @if($user->alumniProfile->address)
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Alamat</dt>
                                <dd class="text-sm text-gray-900">{{ $user->alumniProfile->address }}</dd>
                            </div>
                        @endif
                        
                        @if($user->alumniProfile->bio)
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Bio</dt>
                                <dd class="text-sm text-gray-900 leading-relaxed">{{ $user->alumniProfile->bio }}</dd>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Links -->
                    <div class="space-y-4">
                        @if($user->alumniProfile->linkedin_url)
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">LinkedIn</dt>
                                <dd>
                                    <a href="{{ $user->alumniProfile->linkedin_url }}" 
                                       target="_blank" 
                                       class="text-sm text-blue-600 hover:text-blue-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                        Lihat Profil
                                    </a>
                                </dd>
                            </div>
                        @endif
                        
                        @if($user->alumniProfile->website_url)
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Website</dt>
                                <dd>
                                    <a href="{{ $user->alumniProfile->website_url }}" 
                                       target="_blank" 
                                       class="text-sm text-blue-600 hover:text-blue-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                        Kunjungi Website
                                    </a>
                                </dd>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- Actions -->
        <div class="px-8 py-6 border-t border-gray-100 bg-white">
            <div class="flex items-center justify-between">
                <a href="{{ route('users.index') }}"
                   class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Daftar
                </a>
                
                <a href="{{ route('users.edit', $user->id) }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-900 text-white text-sm font-medium hover:bg-gray-800 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Pengguna
                </a>
            </div>
        </div>
    </div>
</div>
@endsection