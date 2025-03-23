@extends('layouts.admindashboard')

@section('content')
<div class="container mx-auto px-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">About Us</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <div class="bg-white p-6 shadow-md rounded-lg">
        @if($about)
            <div class="mb-4">
                <h3 class="text-2xl font-semibold text-gray-700">{{ $about->title }}</h3>
                <p class="text-gray-600 mt-2">{{ $about->content }}</p>
            </div>

            @if($about->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $about->image) }}" alt="About Us Image" class="w-1/2 rounded-lg shadow-lg">
                </div>
            @endif

            <a href="{{ route('about.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Edit About Us</a>
        @else
            <p class="text-gray-600">No About Us content found.</p>
            <a href="{{ route('about.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create Content</a>
        @endif
    </div>
</div>
@endsection
