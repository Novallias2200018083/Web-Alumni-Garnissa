@extends('layouts.admindashboard') {{-- Sesuaikan dengan layout admin Anda --}}

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="bg-white rounded-lg shadow-xl p-8 max-w-2xl mx-auto">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center border-b pb-4">Edit Jurusan: {{ $major->name }}</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                <ul class="mt-3 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('majors.update', $major->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Penting untuk update --}}

            <div class="mb-6">
                <label for="code" class="block text-gray-700 text-sm font-bold mb-2">Kode Jurusan:<span class="text-red-500">*</span></label>
                <input type="text" name="code" id="code"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500 @error('code') border-red-500 @enderror"
                       value="{{ old('code', $major->code) }}" required>
                @error('code')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Jurusan:<span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500 @error('name') border-red-500 @enderror"
                       value="{{ old('name', $major->name) }}" required>
                @error('name')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi (Opsional):</label>
                <textarea name="description" id="description" rows="4"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500 @error('description') border-red-500 @enderror">{{ old('description', $major->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-8">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105">
                    <i class="fas fa-sync-alt mr-2"></i> Perbarui Jurusan
                </button>
                <a href="{{ route('majors.index') }}"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-full focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105">
                    <i class="fas fa-arrow-left mr-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
