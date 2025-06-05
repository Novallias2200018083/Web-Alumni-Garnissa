@extends('layouts.alumnidashboard')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-extrabold text-gray-800 mb-10 tracking-wide text-center
                transition-all duration-300 hover:text-rose-800 hover:underline underline-offset-8">
        Direktori Alumni
    </h1>

    <div class="bg-white shadow-lg rounded-xl p-6 mb-8 border border-gray-200">
        <form action="{{ route('alumni.directory.index') }}" method="GET"
              class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-end">
            
            {{-- Search Input --}}
            <div class="md:col-span-2 lg:col-span-2">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Alumni</label>
                <div class="relative">
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           placeholder="Nama, email, bio, atau jurusan..."
                           class="mt-1 block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md shadow-sm
                                  focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </div>

            {{-- Filter Jurusan --}}
            <div>
                <label for="major_id" class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                <select id="major_id" name="major_id"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm
                                focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900">
                    <option value="">Semua Jurusan</option>
                    @foreach($majors as $major)
                        <option value="{{ $major->id }}" {{ request('major_id') == $major->id ? 'selected' : '' }}>
                            {{ $major->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filter Tahun Angkatan --}}
            <div>
                <label for="graduation_year" class="block text-sm font-medium text-gray-700 mb-1">Tahun Lulus</label>
                <select id="graduation_year" name="graduation_year"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm
                                focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900">
                    <option value="">Semua Tahun</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('graduation_year') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tombol Aksi Filter --}}
            <div class="flex space-x-4 col-span-1 md:col-span-2 lg:col-span-4 justify-end">
                <button type="submit"
                        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-md shadow-md
                                transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-filter mr-2"></i> Terapkan Filter
                </button>
                <a href="{{ route('alumni.directory.index') }}"
                   class="inline-flex items-center bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-5 rounded-md shadow-md
                           transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-redo mr-2"></i> Reset
                </a>
            </div>
        </form>
    </div>

    @if($alumni->isEmpty())
        <p class="text-center text-gray-500 text-xl mt-10 p-6 bg-white rounded-xl shadow-md border border-gray-200">
            <i class="fas fa-exclamation-circle text-orange-500 mr-2"></i> Tidak ada alumni yang ditemukan sesuai kriteria Anda.
        </p>
    @else
        <p class="text-gray-600 text-lg mb-6 text-center">Menampilkan {{ $alumni->count() }} dari {{ $alumni->total() }} alumni</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($alumni as $user)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden
                            transform hover:scale-105 transition-transform duration-300 ease-in-out
                            border border-gray-200 group"> {{-- Added 'group' class for hover effects --}}
                    <div class="relative h-48 w-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center overflow-hidden">
                        @if (optional($user->alumniProfile)->image)
                            <img src="{{ asset('storage/' . $user->alumniProfile->image) }}" alt="{{ $user->name }}"
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-300">
                        @else
                            <img src="https://placehold.co/192x192/E0E7FF/4F46E5?text=No+Image" alt="No Image"
                                 class="w-full h-full object-cover opacity-80">
                        @endif
                        <div class="absolute bottom-2 right-2 bg-white p-1.5 rounded-full shadow-md text-indigo-600">
                            <i class="fas fa-user-circle text-lg"></i>
                        </div>
                    </div>
                    <div class="p-6 text-center">
                        <h2 class="text-xl font-bold text-gray-900 mb-1 truncate">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-600 mb-2 truncate">{{ $user->major->name ?? 'Jurusan Tidak Tersedia' }}</p>
                        <p class="text-sm text-gray-500 mb-3">Lulus: {{ optional($user->alumniProfile)->graduation_year ?? 'N/A' }}</p>
                        <a href="{{ route('alumni.directory.show', $user->id) }}"
                           class="inline-flex items-center bg-rose-600 hover:bg-rose-700 text-white font-semibold py-2 px-4 rounded-full
                                   transition duration-300 transform hover:scale-105">
                            <i class="fas fa-eye mr-2"></i> Lihat Profil
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-10 flex justify-center">
            {{ $alumni->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection
