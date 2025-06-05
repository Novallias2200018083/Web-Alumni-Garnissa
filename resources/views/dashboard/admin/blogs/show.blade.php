@extends('layouts.admindashboard')

@section('content')
{{-- SweetAlert2 CDN diasumsikan dimuat di layouts/admindashboard.blade.php --}}

<div class="container mx-auto px-6 py-10">
    <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12 max-w-5xl mx-auto border border-gray-100 transform transition-all duration-500 hover:scale-[1.005] hover:shadow-3xl">
        <h2 class="text-5xl font-extrabold text-gray-900 mb-10 text-center tracking-tight leading-tight border-b-4 border-yellow-500 pb-5">Detail Blog</h2>

        <div class="flex flex-col md:flex-row items-start md:space-x-10">
            {{-- Blog Image --}}
            @if ($blog->image)
                <div class="md:w-1/2 mb-8 md:mb-0 flex-shrink-0 relative group">
                    <img src="{{ asset('storage/' . $blog->image) }}"
                         class="w-full h-auto object-cover rounded-2xl shadow-xl border-4 border-yellow-400 transition-transform duration-500 hover:scale-[1.03]"
                         alt="Blog Image">
                    <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity duration-300 rounded-2xl"></div>
                </div>
            @else
                <div class="md:w-1/2 mb-8 md:mb-0 flex-shrink-0">
                    <div class="w-full h-72 bg-gray-200 flex items-center justify-center text-gray-400 text-8xl rounded-2xl shadow-lg border-4 border-gray-300">
                        <i class="fas fa-image"></i>
                    </div>
                </div>
            @endif

            {{-- Blog Content Details --}}
            <div class="md:w-1/2 flex-grow">
                <h3 class="text-4xl font-bold text-gray-900 mb-5 leading-tight text-justify">{{ $blog->title }}</h3>

                <div class="flex flex-wrap items-center text-gray-700 text-base mb-6 space-x-6">
                    <span class="flex items-center">
                        <i class="fas fa-calendar-alt text-blue-600 mr-2 text-xl"></i>
                        Diposting pada: <span class="font-semibold ml-1">{{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('d F Y') : 'Belum Dipublikasikan' }}</span>
                    </span>
                    @if($blog->slug)
                    <span class="flex items-center">
                        <i class="fas fa-link text-green-600 mr-2 text-xl"></i>
                        Slug: <span class="font-mono text-sm bg-gray-100 px-3 py-1 rounded-md text-gray-800 border border-gray-200">{{ $blog->slug }}</span>
                    </span>
                    @endif
                    <span class="flex items-center">
                        <i class="fas fa-comments mr-2 {{ $blog->comments_enabled ? 'text-green-600' : 'text-red-600' }} text-xl"></i>
                        Komentar: <span class="font-semibold ml-1">{{ $blog->comments_enabled ? 'Aktif' : 'Nonaktif' }}</span>
                    </span>
                </div>

                <div class="prose prose-xl text-gray-800 text-justify leading-relaxed mb-10 border-l-4 border-yellow-400 pl-4 py-2">
                    {!! nl2br(e($blog->description)) !!}
                </div>

                {{-- Meta Information (Created/Updated) --}}
                <div class="text-sm text-gray-500 mt-6 pt-4 border-t border-gray-200 flex flex-wrap justify-between items-center space-y-2 sm:space-y-0">
                    @if($blog->created_at)
                        <span class="flex items-center">
                            <i class="fas fa-plus-circle text-gray-400 mr-2"></i> Dibuat: {{ $blog->created_at->format('d F Y H:i') }}
                        </span>
                    @endif
                    @if($blog->updated_at && $blog->updated_at != $blog->created_at)
                        <span class="flex items-center">
                            <i class="fas fa-history text-gray-400 mr-2"></i> Diperbarui: {{ $blog->updated_at->format('d F Y H:i') }}
                        </span>
                    @endif
                </div>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mt-10 pt-6 border-t border-gray-200">
                    {{-- PERBAIKAN 1: Menggunakan 'blogs.edit' (tanpa 'admin.') sesuai route:list --}}
                    <a href="{{ route('blogs.edit', $blog->id) }}"
                       class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-full shadow-lg
                              hover:bg-blue-700 transition duration-300 transform hover:scale-105 group">
                        <i class="fas fa-edit mr-3 text-xl group-hover:rotate-6 transition-transform duration-300"></i> Edit Blog
                    </a>
                    {{-- PERBAIKAN 2: Menggunakan 'blogs.index' (tanpa 'admin.') sesuai route:list --}}
                    <a href="{{ route('blogs.index') }}"
                       class="inline-flex items-center px-8 py-4 bg-gray-300 text-gray-800 font-semibold rounded-full shadow-lg
                              hover:bg-gray-400 transition duration-300 transform hover:scale-105">
                        <i class="fas fa-arrow-left mr-3 text-xl"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>

        {{-- Bagian Komentar untuk Admin --}}
        @if($blog->comments_enabled)
        <div class="mt-12 pt-8 border-t-2 border-gray-200">
            <h3 class="text-3xl font-bold text-gray-900 mb-6 border-b pb-4">Komentar Blog (Total: {{ $blog->comments->count() }})</h3>

            {{-- SweetAlert2 Notifikasi Komentar --}}
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

            @forelse($blog->comments as $comment)
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm mb-4 border border-gray-200 relative">
                    <div class="flex items-center mb-2">
                        <div class="flex-shrink-0">
                            {{-- Avatar User --}}
                            @if($comment->user->profile_picture)
                                <img src="{{ asset('storage/' . $comment->user->profile_picture) }}" alt="{{ $comment->user->name }}" class="w-10 h-10 rounded-full object-cover border-2 border-yellow-300">
                            @else
                                <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 text-xl font-bold">
                                    {{ $comment->user->name[0] }}
                                </div>
                            @endif
                        </div>
                        <div class="ml-3">
                            <p class="text-lg font-semibold text-gray-800">{{ $comment->user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $comment->created_at->diffForHumans() }} ({{ $comment->created_at->format('d M Y, H:i') }})</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed">{{ $comment->content }}</p>

                    <div class="flex items-center mt-4 text-sm text-gray-500 space-x-4">
                        {{-- Tombol Balas Komentar --}}
                        <button class="flex items-center hover:text-blue-600 transition-colors duration-200"
                                onclick="toggleReplyForm('replyForm{{ $comment->id }}')">
                            <i class="fas fa-reply mr-1"></i> Balas
                        </button>
                        {{-- Tombol Hapus Komentar untuk Admin (dan alumni pemilik komentar) --}}
                        {{-- PERBAIKAN 3: Menggunakan 'comments.destroy' (tanpa 'admin.') sesuai route:list --}}
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirmDeleteComment(event);" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center hover:text-red-600 transition-colors duration-200" title="Hapus Komentar">
                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                            </button>
                        </form>
                    </div>

                    {{-- Form Balas Komentar (tersembunyi secara default) --}}
                    <div id="replyForm{{ $comment->id }}" class="hidden mt-4 pl-4 border-l-2 border-gray-100">
                        <h5 class="text-md font-semibold text-gray-700 mb-3">Balas komentar ini:</h5>
                        {{-- PERBAIKAN 4: Menggunakan 'admin.comments.reply' sesuai route:list --}}
                        <form action="{{ route('admin.comments.reply', $comment) }}" method="POST">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <textarea name="content" rows="2"
                                      class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 @error('content') border-red-500 @enderror"
                                      placeholder="Tulis balasan Anda..." required></textarea>
                            @error('content')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                            <button type="submit"
                                    class="mt-2 inline-flex items-center px-4 py-2 bg-blue-500 text-white font-semibold rounded-full text-sm shadow-md
                                           hover:bg-blue-600 transition duration-300 transform hover:scale-105">
                                <i class="fas fa-paper-plane mr-1"></i> Kirim Balasan
                            </button>
                        </form>
                    </div>

                    {{-- Tampilkan Balasan (termasuk balasan admin) --}}
                    {{-- PERBAIKAN 5: Pastikan nama komponen view benar --}}
                    @include('components.comments_replies_admin', ['replies' => $comment->replies])
                </div>
            @empty
                <p class="text-gray-600 text-center py-4">Belum ada komentar untuk blog ini.</p>
            @endforelse
        </div>
        @else
            <div class="mt-12 pt-8 border-t-2 border-gray-200 text-center py-6 bg-gray-50 rounded-lg shadow-sm">
                <p class="text-gray-600 text-lg">Bagian komentar untuk blog ini dinonaktifkan.</p>
            </div>
        @endif
    </div>
</div>

{{-- Script untuk SweetAlert2 konfirmasi hapus dan toggle form balasan --}}
<script>
    function toggleReplyForm(formId) {
        const form = document.getElementById(formId);
        if (form) {
            form.classList.toggle('hidden');
        }
    }

    function confirmDeleteComment(event) {
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