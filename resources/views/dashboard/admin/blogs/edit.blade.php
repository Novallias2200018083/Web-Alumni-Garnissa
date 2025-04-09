@extends('layouts.admindashboard')

@section('content')
<div class="container mx-auto px-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">Edit Blog</h2>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-3 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $blog->title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('description', $blog->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="published_at" class="block text-gray-700 text-sm font-bold mb-2">Published Date</label>
            <input type="date" name="published_at" id="published_at" value="{{ old('published_at', $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('Y-m-d') : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Blog Image</label>
            @if($blog->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="w-32 h-32 object-cover mb-2">
                </div>
            @endif
            <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Blog
            </button>
        </div>
    </form>
</div>
@endsection
