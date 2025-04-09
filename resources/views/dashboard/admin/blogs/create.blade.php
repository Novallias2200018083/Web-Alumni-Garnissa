@extends('layouts.admindashboard')

@section('content')
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Create Blog</h2>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                <input type="text" name="title"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="description" rows="5"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Blog Image</label>
                <input type="file" name="image"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Published Date</label>
                <input type="date" name="published_at"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
            </div>

          

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Create Blog
                </button>
            </div>
        </form>
    </div>
@endsection