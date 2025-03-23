@extends('layouts.admindashboard')

@section('content')
<div class="container mx-auto px-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">Edit About Us</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mt-2">{{ session('success') }}</div>
    @endif

    <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label class="block text-gray-700 font-bold">Title:</label>
        <input type="text" name="title" value="{{ old('title', $about->title ?? '') }}" 
               class="w-full border-gray-300 rounded-lg p-2 mb-3">

        <label class="block text-gray-700 font-bold">Content:</label>
        <textarea name="content" rows="5" class="w-full border-gray-300 rounded-lg p-2 mb-3">{{ old('content', $about->content ?? '') }}</textarea>

        <label class="block text-gray-700 font-bold">Image:</label>
        <input type="file" name="image" class="w-full border-gray-300 rounded-lg p-2 mb-3">

        @if ($about && $about->image)
            <img src="{{ asset('storage/' . $about->image) }}" class="w-32 h-32 mt-3 rounded-lg shadow-lg">
        @endif

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Update</button>
    </form>
</div>
@endsection
