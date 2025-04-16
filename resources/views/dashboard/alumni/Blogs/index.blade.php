@extends('layouts.alumnidashboard')

@section('content')
<div class="container mx-auto px-6">
    <h2 class="text-4xl font-bold text-center text-gray-800 mb-10 hover:text-rose-800  transition duration-300">
        Alumni Blog Posts
    </h2>

    <div class="grid md:grid-cols-3 gap-6 mt-6">
        @foreach ($blogs as $blog)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col">
                @if ($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" class="w-full h-48 object-cover" alt="Blog Image">
                @endif

                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $blog->title }}</h3>

                    <p class="text-sm text-gray-500 mb-4">
                        <i class="fas fa-calendar-alt text-red-500 mr-1"></i>
                        {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') : 'Not set' }}
                    </p>

                    <p class="text-gray-600">{!! $blog->description !!}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
