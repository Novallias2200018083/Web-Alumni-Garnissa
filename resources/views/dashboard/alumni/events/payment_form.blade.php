{{-- resources/views/alumni/events/payment_form.blade.php --}}

@extends('layouts.alumnidashboard') {{-- Sesuaikan dengan layout utama Anda (layout alumni) --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Unggah Bukti Pembayaran Event: {{ $registration->event->title }}</h1>

        @if(session('success'))
            <x-alert type="success" message="{{ session('success') }}" />
        @endif
        @if(session('error'))
            <x-alert type="danger" message="{{ session('error') }}" />
        @endif
        @if(session('info'))
            <x-alert type="info" message="{{ session('info') }}" />
        @endif

        <div class="mb-4 text-gray-700">
            <p><strong>Harga Event:</strong> Rp {{ number_format($registration->event->price, 0, ',', '.') }}</p>
            <p class="mt-2">Silakan transfer sesuai harga event ke rekening berikut:</p>
            <p class="font-bold text-lg">Bank ABC - 1234567890 (a.n. Alumni Connect)</p>
            <p class="text-sm text-gray-600 mt-1">Pastikan nama pengirim transfer sesuai dengan nama Anda yang terdaftar.</p>
        </div>

        <form action="{{ route('events.upload-proof', $registration->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="payment_proof" class="block text-gray-700 text-sm font-bold mb-2">
                    Bukti Pembayaran (Gambar: JPG, PNG, GIF, maks 2MB)
                </label>
                <input type="file" name="payment_proof" id="payment_proof"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('payment_proof') border-red-500 @enderror">
                @error('payment_proof')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            @if($registration->payment_proof)
                <div class="mb-4">
                    <p class="text-gray-700 text-sm font-bold mb-2">Bukti Pembayaran Sebelumnya:</p>
                    <img src="{{ $registration->payment_proof_url }}" alt="Bukti Pembayaran" class="w-64 h-auto rounded-lg shadow-md border border-gray-200">
                    <p class="text-xs text-gray-500 mt-1">Jika Anda mengunggah bukti baru, bukti lama akan diganti.</p>
                </div>
            @endif

            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Unggah Bukti & Selesaikan
                </button>
                <a href="{{ route('events.public.detail', $registration->event->id) }}"
                   class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800">
                    Kembali ke Detail Event
                </a>
            </div>
        </form>
    </div>
</div>
@endsection