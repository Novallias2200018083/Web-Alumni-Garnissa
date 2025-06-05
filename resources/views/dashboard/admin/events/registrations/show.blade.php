{{-- resources/views/admin/registrations/show.blade.php --}}

@extends('layouts.admindashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        {{-- Header Section --}}
        <div class="mb-8">
            <nav class="flex items-center text-sm text-slate-500 mb-4">
                <a href="{{ route('admin.events.registrations.index', $registration->event->id) }}" 
                   class="hover:text-slate-700 transition-colors">Event Registrations</a>
                <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-slate-700">Registration Details</span>
            </nav>
            
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Registration Details</h1>
            <p class="text-slate-600">Manage and review event registration information</p>
        </div>

        {{-- Success/Error Messages --}}
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-xl p-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <p class="text-red-800 font-medium">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        {{-- Main Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Left Column - Registration Details --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Participant Information --}}
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/50 p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-slate-800">Participant Information</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-medium text-slate-500 uppercase tracking-wide">Full Name</label>
                                <p class="text-slate-800 font-medium text-lg">{{ $registration->user->name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-slate-500 uppercase tracking-wide">Email Address</label>
                                <p class="text-slate-800">{{ $registration->user->email ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-medium text-slate-500 uppercase tracking-wide">Major</label>
                                <p class="text-slate-800 font-medium">{{ $registration->user->major->name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-slate-500 uppercase tracking-wide">Graduation Year</label>
                                <p class="text-slate-800 font-medium">{{ $registration->user->alumniProfile->graduation_year ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Event Information --}}
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/50 p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-slate-800">Event Information</h2>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-slate-500 uppercase tracking-wide">Event Title</label>
                            <p class="text-slate-800 font-medium text-lg">{{ $registration->event->title ?? 'N/A' }}</p>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="text-sm font-medium text-slate-500 uppercase tracking-wide">Date</label>
                                <p class="text-slate-800 font-medium">{{ \Carbon\Carbon::parse($registration->event->event_date)->translatedFormat('d F Y') }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-slate-500 uppercase tracking-wide">Time</label>
                                <p class="text-slate-800 font-medium">{{ \Carbon\Carbon::parse($registration->event->event_time)->format('H:i') }} WIB</p>
                            </div>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-slate-500 uppercase tracking-wide">Location</label>
                            <p class="text-slate-800 font-medium">{{ $registration->event->location ?? 'N/A' }}</p>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="text-sm font-medium text-slate-500 uppercase tracking-wide">Type</label>
                                <div class="mt-1">
                                    @if($registration->event->is_paid)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                            Paid Event
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            Free Event
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @if($registration->event->is_paid)
                                <div>
                                    <label class="text-sm font-medium text-slate-500 uppercase tracking-wide">Price</label>
                                    <p class="text-slate-800 font-bold text-lg">Rp {{ number_format($registration->event->price, 0, ',', '.') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Payment Proof (if paid event) --}}
                @if($registration->event->is_paid)
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/50 p-6">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-slate-800">Payment Proof</h2>
                        </div>
                        
                        @if($registration->payment_proof)
                            <div class="space-y-4">
                                <div class="relative rounded-xl overflow-hidden border border-slate-200 shadow-sm">
                                    <img src="{{ $registration->payment_proof_url }}" 
                                         alt="Payment Proof" 
                                         class="w-full max-w-md h-auto object-cover">
                                </div>
                                <p class="text-sm text-slate-600 bg-slate-50 p-3 rounded-lg">
                                    <svg class="w-4 h-4 inline mr-2 text-slate-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                    Please verify the payment proof before confirming the registration.
                                </p>
                            </div>
                        @else
                            <div class="text-center py-8 bg-slate-50 rounded-xl">
                                <svg class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-slate-600 font-medium">No payment proof uploaded yet</p>
                                <p class="text-sm text-slate-500 mt-1">Participant hasn't submitted payment proof</p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Right Column - Status & Actions --}}
            <div class="space-y-6">
                
                {{-- Registration Status --}}
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/50 p-6">
                    <h3 class="text-lg font-semibold text-slate-800 mb-4">Registration Status</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-slate-500 uppercase tracking-wide">Current Status</label>
                            <div class="mt-2">
                                @if($registration->status == 'confirmed')
                                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold bg-green-100 text-green-800">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        Confirmed
                                    </span>
                                @elseif($registration->status == 'pending_confirmation')
                                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold bg-blue-100 text-blue-800">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        Pending Confirmation
                                    </span>
                                @elseif($registration->status == 'pending_payment')
                                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold bg-yellow-100 text-yellow-800">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        Pending Payment
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold bg-red-100 text-red-800">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        </svg>
                                        Rejected
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-slate-500 uppercase tracking-wide">Registration Date</label>
                            <p class="text-slate-800 font-medium">{{ $registration->created_at->format('d F Y') }}</p>
                            <p class="text-slate-600 text-sm">{{ $registration->created_at->format('H:i') }} WIB</p>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/50 p-6">
                    <h3 class="text-lg font-semibold text-slate-800 mb-4">Actions</h3>
                    
                    <div class="space-y-3">
                        @if($registration->status === 'pending_confirmation')
                            <form action="{{ route('admin.registrations.confirm', $registration->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center px-4 py-3 bg-green-600 hover:bg-green-700 
                                               text-white font-semibold rounded-xl transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Confirm Registration
                                </button>
                            </form>

                            <form action="{{ route('admin.registrations.reject', $registration->id) }}" method="POST" 
                                  onsubmit="return confirmReject();">
                                @csrf
                                @method('PUT')
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center px-4 py-3 bg-red-600 hover:bg-red-700 
                                               text-white font-semibold rounded-xl transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    Reject Registration
                                </button>
                            </form>
                        @elseif($registration->status === 'confirmed')
                            <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodar" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-green-800 font-medium">Registration Confirmed</span>
                                </div>
                            </div>
                        @else
                            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                                <p class="text-slate-600 text-sm">
                                    Current status: <span class="font-medium">{{ ucfirst(str_replace('_', ' ', $registration->status)) }}</span>
                                </p>
                            </div>
                        @endif

                        <div class="pt-4 border-t border-slate-200">
                            <form action="{{ route('admin.registrations.destroy', $registration->id) }}" method="POST" 
                                  onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center px-4 py-3 bg-slate-600 hover:bg-slate-700 
                                               text-white font-semibold rounded-xl transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"/>
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414L7.586 12l-1.293 1.293a1 1 0 101.414 1.414L9 13.414l1.293 1.293a1 1 0 001.414-1.414L10.414 12l1.293-1.293z" clip-rule="evenodd"/>
                                    </svg>
                                    Delete Registration
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Enhanced Confirmation Scripts --}}
<script>
    function confirmReject() {
        return confirm('Are you sure you want to reject this registration? This action cannot be undone.');
    }
    
    function confirmDelete() {
        return confirm('Are you sure you want to permanently delete this registration? This action cannot be undone.');
    }
</script>

<style>
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #3b82f6, #6366f1);
        border-radius: 3px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #2563eb, #4f46e5);
    }
</style>
@endsection