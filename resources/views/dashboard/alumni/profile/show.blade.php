@extends('layouts.alumnidashboard')

@section('content')
<div class="min-h-screen bg-gray-50 px-6 py-8">
    <!-- Simple Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Detail Profil Alumni</h1>
        <p class="text-gray-600">Informasi lengkap profil alumni</p>
    </div>

    {{-- Notifications --}}
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "Sukses!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK",
                background: '#ffffff',
                color: '#1f2937',
                confirmButtonColor: '#3b82f6'
            });
        </script>
    @endif
    
    @if(session('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK",
                background: '#ffffff',
                color: '#1f2937',
                confirmButtonColor: '#ef4444'
            });
        </script>
    @endif

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            
            <!-- Profile Header -->
            <div class="bg-gradient-to-r from-slate-900 to-slate-700 px-8 py-12">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                    <!-- Profile Image -->
                    <div class="relative">
                        <img src="{{ optional($user->alumniProfile)->image ? asset('storage/' . $user->alumniProfile->image) : 'https://placehold.co/120x120/E5E7EB/6B7280?text=No+Image' }}"
                             class="w-32 h-32 object-cover rounded-full border-4 border-white shadow-lg"
                             alt="Profile Image">
                    </div>
                    
                    <!-- Basic Info -->
                    <div class="text-center md:text-left text-white">
                        <h2 class="text-3xl font-bold mb-2">{{ $user->name }}</h2>
                        <p class="text-slate-300 text-lg mb-1">{{ $user->major->name ?? 'Jurusan Tidak Tersedia' }}</p>
                        <p class="text-slate-400">Angkatan {{ optional($user->alumniProfile)->graduation_year ?? 'N/A' }}</p>
                        @if(optional($user->alumniProfile)->alumni_code)
                            <p class="text-slate-400 text-sm mt-2">{{ $user->alumniProfile->alumni_code }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Content Sections -->
            <div class="p-8 space-y-8">
                
                <!-- Contact Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informasi Kontak
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="text-gray-900">{{ $user->email }}</p>
                        </div>
                        
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500">NIS</label>
                            <p class="text-gray-900">{{ $user->student_id ?? 'Belum tersedia' }}</p>
                        </div>
                        
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500">Telepon</label>
                            <p class="text-gray-900">{{ optional($user->alumniProfile)->phone ?? 'Belum tersedia' }}</p>
                        </div>
                        
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500">Tahun Lulus</label>
                            <p class="text-gray-900">{{ optional($user->alumniProfile)->graduation_year ?? 'Belum tersedia' }}</p>
                        </div>
                        
                        <div class="space-y-1 md:col-span-2">
                            <label class="text-sm font-medium text-gray-500">Alamat</label>
                            <p class="text-gray-900">{{ optional($user->alumniProfile)->address ?? 'Belum tersedia' }}</p>
                        </div>
                        
                        @if(optional($user->alumniProfile)->bio)
                        <div class="space-y-1 md:col-span-2">
                            <label class="text-sm font-medium text-gray-500">Bio</label>
                            <p class="text-gray-900 leading-relaxed">{{ $user->alumniProfile->bio }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200"></div>

                <!-- Professional Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                        </svg>
                        Informasi Karier
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500">Pekerjaan Saat Ini</label>
                            <p class="text-gray-900">{{ optional($user->alumniProfile)->current_job ?? 'Belum diisi' }}</p>
                        </div>
                        
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500">Perusahaan</label>
                            <p class="text-gray-900">{{ optional($user->alumniProfile)->company ?? 'Belum diisi' }}</p>
                        </div>
                        
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500">Posisi</label>
                            <p class="text-gray-900">{{ optional($user->alumniProfile)->position ?? 'Belum diisi' }}</p>
                        </div>
                        
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500">LinkedIn</label>
                            @if(optional($user->alumniProfile)->linkedin_url)
                                <a href="{{ $user->alumniProfile->linkedin_url }}" target="_blank" 
                                   class="text-blue-600 hover:text-blue-800 hover:underline transition-colors">
                                    {{ $user->alumniProfile->linkedin_url }}
                                </a>
                            @else
                                <p class="text-gray-900">Belum diisi</p>
                            @endif
                        </div>
                        
                        @if(optional($user->alumniProfile)->website_url)
                        <div class="space-y-1 md:col-span-2">
                            <label class="text-sm font-medium text-gray-500">Website Pribadi</label>
                            <a href="{{ $user->alumniProfile->website_url }}" target="_blank" 
                               class="text-blue-600 hover:text-blue-800 hover:underline transition-colors">
                                {{ $user->alumniProfile->website_url }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200"></div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('alumni.profile.edit') }}"
                       class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 flex-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Profil
                    </a>
                    
                    <a href="{{ route('alumni.profile.card') }}" target="_blank"
                       class="inline-flex items-center justify-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200 flex-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Cetak Kartu Alumni
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection