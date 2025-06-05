@extends('layouts.admindashboard')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="bg-white rounded-lg shadow-xl p-8 max-w-3xl mx-auto border border-gray-200">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-8 text-center border-b pb-4">Edit Blog: {{ $blog->title }}</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa masalah dengan input Anda:</span>
                <ul class="mt-3 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Menggunakan route('blogs.update', $blog->id) sesuai dengan definisi resource route Anda --}}
        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Judul Blog:</label>
                <input type="text" name="title" id="title"
                       class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-200 @error('title') border-red-500 @enderror"
                       value="{{ old('title', $blog->title) }}" required placeholder="Masukkan judul blog">
                @error('title')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi/Konten:</label>
                <textarea name="description" id="description" rows="8"
                          class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-200 @error('description') border-red-500 @enderror"
                          required placeholder="Tulis konten blog di sini...">{{ old('description', $blog->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Gambar Blog (Opsional):</label>
                @if($blog->image)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="Current Blog Image" class="w-48 h-auto object-cover rounded-lg shadow-md border border-gray-300">
                        <label class="inline-flex items-center mt-3">
                            <input type="checkbox" name="remove_image" value="1" class="form-checkbox h-5 w-5 text-red-600">
                            <span class="ml-2 text-gray-700 text-sm">Hapus gambar ini</span>
                        </label>
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*"
                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('image') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Pilih gambar baru untuk mengganti yang sudah ada. Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                @error('image')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8">
                <label for="published_at" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Publikasi (Opsional):</label>
                <input type="date" name="published_at" id="published_at"
                       class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-200 @error('published_at') border-red-500 @enderror"
                       value="{{ old('published_at', $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('Y-m-d') : '') }}">
                <p class="text-xs text-gray-500 mt-1">Biarkan kosong untuk draft atau atur tanggal publikasi di masa mendatang.</p>
                @error('published_at')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Comments Enabled Toggle --}}
            <div class="mb-8 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <label for="comments_enabled" class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="comments_enabled" name="comments_enabled" value="1" class="sr-only peer" {{ $blog->comments_enabled ? 'checked' : '' }}>
                    <div class="relative w-14 h-8 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-white after:border after:border-gray-300 after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ms-3 text-lg font-medium text-gray-900">Aktifkan Komentar</span>
                </label>
                <p class="text-xs text-gray-500 mt-1">Centang untuk mengizinkan komentar pada blog ini.</p>
            </div>

            <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                <button type="submit"
                        class="inline-flex items-center px-8 py-3 bg-blue-600 text-white font-semibold rounded-full shadow-lg
                               hover:bg-blue-700 transition duration-300 transform hover:scale-105 group">
                    <i class="fas fa-sync-alt mr-2 group-hover:rotate-6 transition-transform duration-300"></i> Perbarui Blog
                </button>
                {{-- Menggunakan route('blogs.index') sesuai dengan definisi resource route Anda --}}
                <a href="{{ route('blogs.index') }}"
                   class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-800 font-semibold rounded-full shadow-lg
                           hover:bg-gray-400 transition duration-300 transform hover:scale-105">
                    <i class="fas fa-arrow-left mr-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection