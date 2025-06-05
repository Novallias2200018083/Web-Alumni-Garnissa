@extends('layouts.admindashboard')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 max-w-6xl">
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" 
         class="fixed top-6 right-6 z-50">
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-3 animate-fade-in-down">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <!-- Page Header -->
    <div class="mb-12">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-light text-gray-900 mb-2">Tentang Kami</h1>
                <div class="w-16 h-1 bg-gradient-to-r from-gray-300 to-transparent rounded-full"></div>
            </div>
            
            @if($about)
                <a href="{{ route('about.edit') }}" 
                   class="inline-flex items-center px-5 py-2.5 bg-yellow-600 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-700 transition duration-300 text-white text-sm font-medium rounded-lg transition-all duration-300 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Content
                </a>
            @endif
        </div>
    </div>

    @if($about)
        <!-- Main Content Card -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-md">
            <!-- Content Header with subtle gradient -->
            <div class="px-8 py-6 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                <h2 class="text-2xl font-medium text-gray-900">{{ $about->title }}</h2>
            </div>

            <!-- Content Body -->
            <div class="px-8 py-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    <!-- Text Content -->
                    <div class="lg:col-span-2">
                        <div class="prose prose-gray max-w-none">
                            <div class="text-gray-700 leading-relaxed space-y-6 text-justify">
                                {!! nl2br(e($about->content)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Image Section -->
                    @if($about->image)
                        <div class="lg:col-span-1">
                            <div class="aspect-square overflow-hidden bg-gray-50 border border-gray-100 rounded-lg group relative">
                                <img src="{{ asset('storage/' . $about->image) }}" 
                                     alt="{{ $about->title }}" 
                                     class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Meta Information Footer -->
            <div class="px-8 py-4 bg-gray-50 border-t border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm text-gray-500">
                    <div class="flex items-center space-x-6 mb-3 sm:mb-0">
                        @if($about->created_at)
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Created {{ $about->created_at->format('d F Y') }}
                            </span>
                        @endif
                        
                        @if($about->updated_at && $about->updated_at != $about->created_at)
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Updated {{ $about->updated_at->format('d F Y') }}
                            </span>
                        @endif
                    </div>
                    <div class="text-gray-400 text-xs">
                        Last modified {{ $about->updated_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>

    @else
        <!-- Empty State Card -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 text-center">
            <div class="px-8 py-16">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                
                <h3 class="text-xl font-medium text-gray-900 mb-3">No content yet</h3>
                <p class="text-gray-500 mb-8 max-w-md mx-auto">
                    The "About Us" page is currently empty. Create your first content to showcase your organization's story.
                </p>
                
                <a href="{{ route('about.edit') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gray-900 hover:bg-gray-800 text-white font-medium rounded-lg transition-all duration-300 shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create Content
                </a>
            </div>
        </div>
    @endif
</div>

<style>
.prose {
    font-size: 0.95rem;
    line-height: 1.8;
}

.prose p {
    margin-bottom: 1.25rem;
    color: #4b5563;
}

.prose p:last-child {
    margin-bottom: 0;
}

.animate-fade-in-down {
    animation: fadeInDown 0.5s ease-out;
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endsection