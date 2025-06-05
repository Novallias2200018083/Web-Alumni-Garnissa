@extends('layouts.alumnidashboard')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-extrabold text-gray-800 mb-10 tracking-wide text-center
                 transition-all duration-300 hover:text-rose-800 hover:underline underline-offset-8">
        Detail Profil Alumni
    </h1>

    {{-- Notifikasi Sukses (Jika ada, biasanya dari redirect setelah update) --}}
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "Sukses!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        </script>
    @endif
    {{-- Notifikasi Error (Jika ada) --}}
    @if(session('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK"
            });
        </script>
    @endif

    <div class="bg-white shadow-xl rounded-lg overflow-hidden max-w-5xl mx-auto border border-gray-200
                transform hover:scale-[1.005] transition-transform duration-300 ease-in-out">
        <div class="flex flex-col md:flex-row">
            {{-- Bagian Kiri: Gambar Profil dan Info Dasar --}}
            <div class="w-full md:w-1/3 bg-gradient-to-br from-indigo-500 to-purple-600 p-8 flex flex-col justify-center items-center text-white relative">
                <div class="relative w-48 h-48 mb-6">
                    <img src="{{ optional($user->alumniProfile)->image ? asset('storage/' . $user->alumniProfile->image) : 'https://placehold.co/192x192/E0E7FF/4F46E5?text=No+Image' }}"
                         class="w-full h-full object-cover rounded-full border-4 border-white shadow-lg"
                         alt="Profile Image">
                    <div class="absolute bottom-0 right-0 bg-white p-2 rounded-full shadow-md text-indigo-600">
                        <i class="fas fa-camera text-lg"></i> {{-- Mengubah ikon untuk lebih relevan --}}
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-center mb-2">{{ $user->name }}</h2>
                <p class="text-indigo-200 text-lg">{{ $user->major->name ?? 'Jurusan Tidak Tersedia' }}</p>
                <p class="text-indigo-300 text-sm mt-1">Angkatan {{ optional($user->alumniProfile)->graduation_year ?? 'N/A' }}</p>
            </div>

            {{-- Bagian Kanan: Detail Profil --}}
            <div class="w-full md:w-2/3 p-8">
                <h3 class="text-2xl font-semibold text-rose-800 border-b-2 border-rose-200 pb-3 mb-6">Informasi Dasar</h3>
                <div class="space-y-4 text-gray-700">
                    <p class="flex items-center text-lg">
                        <i class="fas fa-envelope text-blue-500 mr-3 text-xl"></i>
                        <strong>Email:</strong> {{ $user->email }}
                    </p>
                    <p class="flex items-center text-lg">
                        <i class="fas fa-id-card text-purple-500 mr-3 text-xl"></i>
                        <strong>NIS:</strong> {{ $user->student_id ?? 'Belum tersedia' }}
                    </p>
                    <p class="flex items-center text-lg">
                        <i class="fas fa-user-tag text-teal-500 mr-3 text-xl"></i> {{-- Ikon baru untuk Kode Alumni --}}
                        <strong>Kode Alumni:</strong> {{ optional($user->alumniProfile)->alumni_code ?? 'Belum tersedia' }}
                    </p>
                </div>

                <h3 class="text-2xl font-semibold text-rose-800 border-b-2 border-rose-200 pb-3 mt-8 mb-6">Detail Kontak</h3>
                <div class="space-y-4 text-gray-700">
                    <p class="flex items-center text-lg">
                        <i class="fas fa-phone text-green-500 mr-3 text-xl"></i>
                        <strong>Telepon:</strong> {{ optional($user->alumniProfile)->phone ?? 'Belum disediakan' }}
                    </p>
                    <p class="flex items-center text-lg">
                        <i class="fas fa-map-marker-alt text-red-500 mr-3 text-xl"></i>
                        <strong>Alamat:</strong> {{ optional($user->alumniProfile)->address ?? 'Belum disediakan' }}
                    </p>
                    <p class="flex items-center text-lg">
                        <i class="fas fa-calendar-alt text-orange-500 mr-3 text-xl"></i> {{-- Mengubah ikon untuk tahun lulus --}}
                        <strong>Tahun Lulus:</strong> {{ optional($user->alumniProfile)->graduation_year ?? 'Belum disediakan' }}
                    </p>
                    <div class="flex items-start text-lg">
                        <i class="fas fa-info-circle text-gray-500 mr-3 text-xl mt-1"></i>
                        <span class="font-bold">Bio:</span>
                        <span class="ml-2 leading-relaxed">{{ optional($user->alumniProfile)->bio ?? 'Belum ada bio.' }}</span>
                    </div>
                </div>

                <h3 class="text-2xl font-semibold text-rose-800 border-b-2 border-rose-200 pb-3 mt-8 mb-6">Informasi Karier & Profesional</h3>
                <div class="space-y-4 text-gray-700">
                    <p class="flex items-center text-lg">
                        <i class="fas fa-briefcase text-blue-600 mr-3 text-xl"></i>
                        <strong>Pekerjaan Saat Ini:</strong> {{ optional($user->alumniProfile)->current_job ?? 'Belum diisi' }}
                    </p>
                    <p class="flex items-center text-lg">
                        <i class="fas fa-building text-cyan-600 mr-3 text-xl"></i>
                        <strong>Perusahaan:</strong> {{ optional($user->alumniProfile)->company ?? 'Belum diisi' }}
                    </p>
                    <p class="flex items-center text-lg">
                        <i class="fas fa-user-tie text-lime-600 mr-3 text-xl"></i>
                        <strong>Posisi:</strong> {{ optional($user->alumniProfile)->position ?? 'Belum diisi' }}
                    </p>
                    <p class="flex items-center text-lg">
                        <i class="fab fa-linkedin text-blue-700 mr-3 text-xl"></i>
                        <strong>LinkedIn:</strong>
                        @if(optional($user->alumniProfile)->linkedin_url)
                            <a href="{{ $user->alumniProfile->linkedin_url }}" target="_blank" class="text-blue-600 hover:underline ml-2">
                                {{ $user->alumniProfile->linkedin_url }}
                            </a>
                        @else
                            Belum diisi
                        @endif
                    </p>
                    <p class="flex items-center text-lg">
                        <i class="fas fa-globe text-pink-600 mr-3 text-xl"></i>
                        <strong>Website Pribadi:</strong>
                        @if(optional($user->alumniProfile)->website_url)
                            <a href="{{ $user->alumniProfile->website_url }}" target="_blank" class="text-blue-600 hover:underline ml-2">
                                {{ $user->alumniProfile->website_url }}
                            </a>
                        @else
                            Belum diisi
                        @endif
                    </p>
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-10 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 md:space-x-4">
                    <a href="{{ route('alumni.directory.index') }}"
                       class="inline-flex items-center bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg
                              transition duration-300 ease-in-out transform hover:scale-105 shadow-lg hover:shadow-xl w-full md:w-auto justify-center">
                        <i class="fas fa-arrow-left mr-3 text-lg"></i>
                        Kembali ke Direktori
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
