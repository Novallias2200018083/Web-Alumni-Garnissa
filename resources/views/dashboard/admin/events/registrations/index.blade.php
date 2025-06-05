{{-- resources/views/admin/events/registrations/index.blade.php --}}

@extends('layouts.admindashboard') {{-- Sesuaikan dengan layout admin Anda --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-2">Pendaftar untuk Event: <span class="text-indigo-600">{{ $event->title }}</span></h1>
    <p class="text-gray-600 mb-6">Kelola daftar peserta yang mendaftar untuk event ini.</p>

    @if(session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif
    @if(session('error'))
        <x-alert type="danger" message="{{ session('error') }}" />
    @endif

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <form action="{{ route('admin.events.registrations.index', $event->id) }}" method="GET" class="space-y-4 md:space-y-0 md:flex md:gap-4 items-end">
            <div class="flex-grow">
                <label for="search" class="block text-sm font-medium text-gray-700">Cari (Nama Peserta)</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Filter Status</label>
                <select name="status" id="status"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Semua Status</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Filter
                </button>
                @if(request()->has('search') || request()->has('status'))
                    <a href="{{ route('admin.events.registrations.index', $event->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ml-2">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID Regis
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Peserta
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal Daftar
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($registrations as $registration)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $registration->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $registration->user->name ?? 'N/A' }}
                            <br>
                            <span class="text-xs text-gray-500">{{ $registration->user->alumniProfile->major->name ?? '' }} - {{ $registration->user->alumniProfile->graduation_year ?? '' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($registration->status == 'confirmed') bg-green-100 text-green-800
                                @elseif($registration->status == 'pending_confirmation') bg-blue-100 text-blue-800
                                @elseif($registration->status == 'pending_payment') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $registration->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $registration->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.registrations.show', $registration->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Detail</a>
                            {{-- Tombol aksi cepat --}}
                            @if($registration->status === 'pending_confirmation')
                                <form action="{{ route('admin.registrations.confirm', $registration->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-green-600 hover:text-green-900 mr-3">Konfirmasi</button>
                                </form>
                                <form action="{{ route('admin.registrations.reject', $registration->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menolak pendaftaran ini?');">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Tolak</button>
                                </form>
                            @elseif($registration->status !== 'confirmed')
                                <form action="{{ route('admin.registrations.destroy', $registration->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pendaftaran ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada pendaftaran untuk event ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $registrations->links() }}
        </div>
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('events.index') }}" class="inline-block text-indigo-600 hover:text-indigo-900 font-semibold">
            &larr; Kembali ke Daftar Event
        </a>
    </div>
</div>
@endsection