@extends('layouts.website') {{-- Sesuaikan dengan layout utama Anda --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Notifikasi --}}
    @if(session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif
    @if(session('error'))
        <x-alert type="danger" message="{{ session('error') }}" />
    @endif
    @if(session('info'))
        <x-alert type="info" message="{{ session('info') }}" />
    @endif

    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        @if($event->image)
            <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="w-full h-64 object-cover">
        @endif

        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $event->title }}</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-gray-700">
                <div>
                    <p><strong class="font-semibold">Tanggal:</strong> {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('l, d F Y') }}</p>
                    <p><strong class="font-semibold">Waktu:</strong> {{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }} WIB</p>
                    <p><strong class="font-semibold">Lokasi:</strong> {{ $event->location }}</p>
                </div>
                <div>
                    <p><strong class="font-semibold">RSVP Diperlukan:</strong> {{ $event->rsvp_required ? 'Ya' : 'Tidak' }}</p>
                    <p><strong class="font-semibold">Max Peserta:</strong> {{ $event->max_attendees ?? 'Tidak Terbatas' }}</p>
                    <p><strong class="font-semibold">Tipe Audiens:</strong> {{ ucfirst(str_replace('_', ' ', $event->audience_type)) }}</p>
                    @if($event->target_majors && count($event->target_majors) > 0)
                        <p><strong class="font-semibold">Target Jurusan:</strong>
                            @foreach($event->target_majors as $majorId)
                                {{ \App\Models\Major::find($majorId)->name ?? 'N/A' }}{{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        </p>
                    @endif
                    @if($event->target_years && count($event->target_years) > 0)
                        <p><strong class="font-semibold">Target Angkatan:</strong> {{ implode(', ', $event->target_years) }}</p>
                    @endif
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Deskripsi</h2>
                <p class="text-gray-700 leading-relaxed">{!! nl2br(e($event->description)) !!}</p>
            </div>

            {{-- Bagian Pendaftaran (RSVP/Pembayaran) --}}
            <div class="border-t pt-6 mt-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Pendaftaran</h2>

                @if($event->is_paid)
                    <p class="text-lg text-green-600 font-bold mb-4">Harga: Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                @else
                    <p class="text-lg text-green-600 font-bold mb-4">GRATIS</p>
                @endif

                @auth
                    @if(Auth::user()->role === 'alumni')
                        @php
                            $isEligible = $event->isEligibleForAlumni(Auth::user());
                            $registration = Auth::user()->eventRegistrations()->where('event_id', $event->id)->first();
                        @endphp

                        @if($isEligible)
                            @if(!$event->hasAvailableSlots() && (!$registration || $registration->status !== 'confirmed'))
                                {{-- Jika slot penuh DAN belum terdaftar atau statusnya bukan confirmed --}}
                                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                                    <p class="font-bold">Maaf, kuota peserta sudah penuh.</p>
                                    <p>Anda tidak bisa mendaftar untuk event ini.</p>
                                </div>
                            @elseif($registration)
                                {{-- Jika sudah terdaftar --}}
                                @if($registration->status === 'pending_payment')
                                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                                        <p class="font-bold">Menunggu Pembayaran</p>
                                        <p>Pendaftaran Anda untuk event ini sedang menunggu pembayaran. Silakan lanjutkan ke halaman pembayaran.</p>
                                        <a href="{{ route('events.payment', $registration->id) }}" class="inline-block mt-2 px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">Lanjutkan Pembayaran</a>
                                    </div>
                                @elseif($registration->status === 'pending_confirmation')
                                    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4" role="alert">
                                        <p class="font-bold">Menunggu Konfirmasi Admin</p>
                                        <p>Bukti pembayaran Anda telah diunggah dan sedang menunggu konfirmasi dari admin.</p>
                                    </div>
                                @elseif($registration->status === 'confirmed')
                                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                                        <p class="font-bold">Pendaftaran Dikonfirmasi</p>
                                        <p>Anda telah berhasil terdaftar untuk event ini!</p>
                                    </div>
                                @elseif($registration->status === 'rejected' || $registration->status === 'cancelled')
                                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                                        <p class="font-bold">Status Pendaftaran:</p>
                                        <p>Pendaftaran Anda untuk event ini: {{ ucfirst(str_replace('_', ' ', $registration->status)) }}.</p>
                                        @if($event->hasAvailableSlots())
                                            <form action="{{ route('events.rsvp', $event->id) }}" method="POST" class="mt-2">
                                                @csrf
                                                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Daftar Ulang</button>
                                            </form>
                                        @else
                                            <p class="text-red-600 mt-2">Kuota penuh, tidak bisa daftar ulang.</p>
                                        @endif
                                    </div>
                                @endif
                            @else {{-- Belum terdaftar dan eligible & slot tersedia --}}
                                <form action="{{ route('events.rsvp', $event->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Daftar Sekarang!</button>
                                </form>
                            @endif
                        @else
                            {{-- Tidak memenuhi syarat audiens --}}
                            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                                <p class="font-bold">Tidak Memenuhi Syarat</p>
                                <p>Anda tidak memenuhi kriteria audiens untuk event ini ({{ ucfirst(str_replace('_', ' ', $event->audience_type)) }}).</p>
                                @if($event->audience_type === 'major_only' || $event->audience_type === 'major_and_year')
                                    <p>Target Jurusan: {{ implode(', ', array_map(function($id){ return \App\Models\Major::find($id)->name ?? 'N/A'; }, $event->target_majors ?? [])) }}</p>
                                @endif
                                @if($event->audience_type === 'year_only' || $event->audience_type === 'major_and_year')
                                    <p>Target Angkatan: {{ implode(', ', $event->target_years ?? []) }}</p>
                                @endif
                            </div>
                        @endif
                    @else {{-- Jika user login tapi bukan alumni (misal admin) --}}
                        <div class="bg-gray-100 border-l-4 border-gray-500 text-gray-700 p-4 mb-4" role="alert">
                            <p>Anda login sebagai {{ Auth::user()->role }}. Fitur pendaftaran hanya untuk alumni.</p>
                        </div>
                    @endif
                @else {{-- Jika belum login --}}
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                        <p>Silakan <a href="{{ route('login') }}" class="underline font-semibold">Login</a> sebagai alumni untuk mendaftar event ini.</p>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection