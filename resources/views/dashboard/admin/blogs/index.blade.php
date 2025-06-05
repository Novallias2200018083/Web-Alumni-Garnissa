@extends('layouts.admindashboard')

@section('content')
{{-- SweetAlert2 CDN diasumsikan dimuat di layouts/admindashboard.blade.php --}}

<div class="container mx-auto px-6 py-8">
    {{-- Header Bagian --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-4 sm:mb-0">Manajemen Blog</h2>
        {{-- Menggunakan route('blogs.create') sesuai dengan definisi resource route Anda --}}
        <a href="{{ route('blogs.create') }}"
           class="inline-flex items-center px-6 py-3 bg-yellow-500 text-white font-semibold rounded-full shadow-lg
                   hover:bg-yellow-600 transition duration-300 transform hover:scale-105 group">
            <i class="fas fa-plus-circle mr-2 group-hover:rotate-6 transition-transform duration-300"></i> Tambah Blog Baru
        </a>
    </div>

    {{-- SweetAlert2 untuk Notifikasi --}}
    @if(session('success'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK",
                confirmButtonColor: "#3085d6"
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK",
                confirmButtonColor: "#d33"
            });
        </script>
    @endif

    {{-- Form Pencarian --}}
    {{-- Menggunakan route('blogs.index') sesuai dengan definisi resource route Anda --}}
    <form action="{{ route('blogs.index') }}" method="GET" class="mb-8 bg-white p-6 rounded-lg shadow-md">
        <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4">
            <input type="text" name="search" placeholder="Cari blog berdasarkan judul atau deskripsi..."
                   class="flex-1 shadow-sm appearance-none border border-gray-300 rounded-full w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-200"
                   value="{{ $search ?? '' }}">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105">
                <i class="fas fa-search mr-2"></i> Cari
            </button>
            @if(isset($search) && $search)
                {{-- Menggunakan route('blogs.index') sesuai dengan definisi resource route Anda --}}
                <a href="{{ route('blogs.index') }}"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-full focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105">
                    Reset
                </a>
            @endif
        </div>
    </form>

    @if($blogs->isEmpty())
        <div class="bg-white shadow-lg rounded-xl p-8 text-center mt-10 border border-gray-200">
            <p class="text-gray-500 text-xl font-medium">Belum ada postingan blog yang terdaftar.</p>
            <p class="text-gray-400 mt-2">Mulai dengan menambahkan blog baru untuk berbagi informasi.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-6">
            @foreach ($blogs as $blog)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col border border-gray-200 hover:border-yellow-400 transform hover:-translate-y-1 transition-all duration-300 ease-in-out">
                    @if ($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" class="w-full h-56 object-cover rounded-t-xl transition-transform duration-300 hover:scale-105" alt="Blog Image">
                    @else
                        <div class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-400 text-6xl rounded-t-xl">
                            <i class="fas fa-image"></i>
                        </div>
                    @endif

                    <div class="p-6 flex flex-col flex-grow">
                        {{-- Judul blog dibatasi panjangnya --}}
                        <h3 class="text-2xl font-bold text-gray-900 mb-2 leading-tight text-justify">
                            {{ Str::limit($blog->title, 50, '...') }}
                        </h3>

                        <p class="flex items-center text-sm text-gray-600 mb-2">
                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                            Diposting pada: {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('d F Y') : 'Belum Dipublikasikan' }}
                        </p>

                        {{-- Status Komentar --}}
                        <p class="flex items-center text-sm {{ $blog->comments_enabled ? 'text-green-600' : 'text-red-600' }} mb-4">
                            <i class="fas fa-comments mr-2"></i>
                            Komentar: {{ $blog->comments_enabled ? 'Aktif' : 'Nonaktif' }}
                        </p>

                        <p class="text-base text-gray-700 text-justify leading-relaxed flex-grow mb-4">
                            {{ Str::limit(strip_tags($blog->description), 150, '...') }}
                        </p>

                        <div class="flex justify-between items-center mt-auto pt-4 border-t border-gray-100">
                            {{-- Menggunakan route('blogs.show', $blog->id) sesuai dengan definisi resource route Anda --}}
                            <a href="{{ route('blogs.show', $blog->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-200 inline-flex items-center">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                            <div class="flex space-x-3">
                                {{-- Menggunakan route('blogs.edit', $blog->id) sesuai dengan definisi resource route Anda --}}
                                <a href="{{ route('blogs.edit', $blog->id) }}"
                                   class="text-yellow-600 hover:text-yellow-800 transition-colors duration-200"
                                   title="Edit Blog">
                                    <i class="fas fa-edit text-xl"></i>
                                </a>
                                {{-- Menggunakan route('blogs.destroy', $blog->id) sesuai dengan definisi resource route Anda --}}
                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete(event);">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 transition-colors duration-200"
                                            title="Hapus Blog">
                                        <i class="fas fa-trash-alt text-xl"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $blogs->links() }}
        </div>
    @endif
</div>

{{-- Script untuk SweetAlert2 konfirmasi hapus --}}
<script>
    function confirmDelete(event) {
        event.preventDefault(); // Mencegah form submit secara default
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit(); // Jika dikonfirmasi, submit form
            }
        });
        return false; // Mengembalikan false untuk mencegah submit ganda
    }
</script>
@endsection