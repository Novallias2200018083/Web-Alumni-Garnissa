@extends('layouts.admindashboard') {{-- Sesuaikan dengan layout admin Anda --}}

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="bg-white rounded-lg shadow-xl p-8 max-w-2xl mx-auto">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center border-b pb-4">Detail Jurusan</h2>

        <div class="grid grid-cols-1 gap-4 text-gray-700">
            <div class="mb-4">
                <p class="text-lg mb-1"><strong>ID:</strong> {{ $major->id }}</p>
            </div>
            <div class="mb-4">
                <p class="text-lg mb-1"><strong>Kode Jurusan:</strong> {{ $major->code }}</p>
            </div>
            <div class="mb-4">
                <p class="text-lg mb-1"><strong>Nama Jurusan:</strong> {{ $major->name }}</p>
            </div>
            <div class="mb-4">
                <p class="text-lg mb-1"><strong>Deskripsi:</strong></p>
                <p class="bg-gray-100 p-4 rounded-md text-gray-800">{{ $major->description ?? 'Tidak ada deskripsi.' }}</p>
            </div>
            <div class="mb-4">
                <p class="text-lg mb-1"><strong>Dibuat Pada:</strong> {{ $major->created_at->format('d F Y H:i') }}</p>
            </div>
            <div class="mb-4">
                <p class="text-lg mb-1"><strong>Terakhir Diperbarui:</strong> {{ $major->updated_at->format('d F Y H:i') }}</p>
            </div>
        </div>

        <div class="flex items-center justify-between mt-8 pt-6 border-t">
            <a href="{{ route('majors.edit', $major->id) }}"
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-full shadow-lg
                      hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                <i class="fas fa-edit mr-2"></i> Edit Jurusan
            </a>
            <a href="{{ route('majors.index') }}"
               class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-800 font-semibold rounded-full shadow-lg
                      hover:bg-gray-400 transition duration-300 transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection
