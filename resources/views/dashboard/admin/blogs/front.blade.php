@extends('layouts.website') {{-- Pastikan layout ini menyertakan Tailwind CSS dan Font Awesome --}}

@section('content')
<section class="py-12 bg-gray-50 pt-24 min-h-screen flex flex-col"> {{-- Menambahkan min-h-screen dan flex untuk layout --}}
    <div class="container mx-auto px-4 md:px-6 flex-grow"> {{-- flex-grow agar konten mengisi ruang --}}
        {{-- Header Bagian Blog --}}
        <h2 class="text-4xl font-extrabold text-gray-800 mb-10 text-center relative group">
            <span class="text-4xl font-extrabold text-gray-800 mb-10 transition-all duration-300 hover:text-yellow-600">Blog Kami</span>
            <span class="absolute bottom-[-8px] left-1/2 w-24 h-1 bg-[#f59e0b] origin-center transform -translate-x-1/2 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 rounded-full"></span>
        </h2>

        {{-- Form Pencarian & Filter yang Diperbarui --}}
        <form action="{{ route('blogs.front') }}" method="GET" class="mb-14 p-6 bg-white rounded-2xl shadow-xl flex flex-col md:flex-row items-center justify-center space-y-5 md:space-y-0 md:space-x-8">
            <div class="flex-grow w-full md:w-auto">
                <label for="search" class="sr-only">Cari Blog</label>
                <div class="relative">
                    <input type="text" name="search" id="search" placeholder="Cari judul atau isi blog..."
                           class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-yellow-500 focus:border-yellow-500 transition duration-200 text-gray-700 placeholder-gray-400 text-lg"
                           value="{{ request('search') }}">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="flex space-x-4 w-full md:w-auto justify-center">
                <button type="submit"
                        class="px-8 py-3 bg-yellow-600 text-white font-bold rounded-xl shadow-lg hover:bg-yellow-700 transition duration-300 transform hover:scale-105 flex items-center justify-center text-lg">
                    <i class="fas fa-filter mr-2"></i> Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('blogs.front') }}"
                       class="px-8 py-3 bg-gray-300 text-gray-800 font-semibold rounded-xl shadow-lg hover:bg-gray-400 transition duration-300 transform hover:scale-105 flex items-center justify-center text-lg">
                        <i class="fas fa-times-circle mr-2"></i> Reset
                    </a>
                @endif
            </div>
        </form>
        {{-- End Search and Filter Section --}}

        @if($blogs->isEmpty())
            {{-- Pesan Jika Tidak Ada Blog Ditemukan --}}
            <div class="bg-white rounded-2xl shadow-lg p-10 max-w-xl mx-auto flex flex-col items-center justify-center text-center">
                <i class="far fa-sad-tear text-8xl text-gray-300 mb-6 animate-pulse"></i>
                <p class="text-3xl text-gray-700 font-bold mb-4">Ups! Tidak Ada Blog Ditemukan.</p>
                <p class="text-xl text-gray-500 leading-relaxed">
                    Kami mohon maaf, sepertinya tidak ada artikel yang cocok dengan pencarian Anda. <br class="hidden sm:inline">Coba kata kunci lain atau <a href="{{ route('blogs.front') }}" class="text-yellow-600 hover:underline font-semibold">reset filter Anda</a>.
                </p>
            </div>
        @else
            {{-- Grid Daftar Blog --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($blogs as $blog)
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl border border-gray-100 flex flex-col group">
                        @if ($blog->image)
                            <div class="w-full h-56 overflow-hidden">
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 rounded-t-2xl">
                            </div>
                        @else
                            <div class="w-full h-56 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center text-gray-400 text-8xl rounded-t-2xl">
                                <i class="fas fa-book-open"></i> {{-- Ikon lebih relevan untuk blog --}}
                            </div>
                        @endif
                        <div class="p-7 text-left flex-grow flex flex-col">
                            {{-- Judul Blog --}}
                            <h3 class="text-2xl font-extrabold text-gray-800 mb-3 leading-tight line-clamp-2 min-h-[3.5rem] group-hover:text-yellow-600 transition-colors duration-300">
                                {{ $blog->title }}
                            </h3>

                            {{-- Tanggal Publish --}}
                            <p class="text-gray-600 text-sm flex items-center mb-4">
                                <i class="fas fa-calendar-alt text-[#E82929] mr-3 text-lg"></i>
                                <span class="font-medium">
                                    {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->isoFormat('DD MMMM YYYY') : 'Belum Dipublikasi' }} {{-- Format tanggal lebih ramah pengguna --}}
                                </span>
                            </p>

                            {{-- Deskripsi Singkat --}}
                            <p class="text-gray-700 text-base mb-6 flex-grow min-h-[5rem] text-justify">
                                {{ Str::limit(strip_tags($blog->description), 160, '') }} {{-- Batas karakter lebih panjang --}}
                                @if (strlen(strip_tags($blog->description)) > 160)
                                    <span class="text-gray-500 font-semibold">...</span>
                                @endif
                            </p>

                            {{-- Tombol Baca Selengkapnya --}}
                            <div class="mt-auto">
                                <a href="{{ route('blogs.show', $blog->id) }}"
                                   class="inline-flex items-center justify-center px-7 py-3 bg-yellow-600 text-white font-bold rounded-lg text-base
                                          hover:bg-yellow-700 transition duration-300 transform hover:scale-105 shadow-md self-start group">
                                    Baca Selengkapnya
                                    <svg class="ml-2 -mr-1 w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination Links --}}
            <div class="mt-16 mb-8 flex justify-center">
                {{ $blogs->links('pagination::tailwind') }} {{-- Memastikan menggunakan style Tailwind --}}
            </div>
        @endif
    </div>
</section>
@endsection