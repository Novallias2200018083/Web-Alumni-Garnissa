@extends('layouts.admindashboard')

@section('content')
<div class="container mx-auto px-5 mt-4">
    <h2 class="text-4xl font-bold text-gray-800 mb-6">Edit About Us</h2>

    @if(session('success'))
    <script>
        Swal.fire({
            title: "Success!",
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonText: "OK"
        });
    </script>
    @endif


    <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl space-y-2">
        @csrf

        <!-- Title Input -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Title:</label>
            <input type="text" name="title" value="{{ old('title', $about->title ?? '') }}" 
                   class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
        </div>

        <!-- Content Input -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Content:</label>
            <textarea name="content" rows="5" 
                      class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">{{ old('content', $about->content ?? '') }}</textarea>
        </div>

        <!-- Image Upload -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Upload Image:</label>
            <input type="file" name="image" 
                   class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
            
            @if ($about && $about->image)
                <div class="mt-4">
                    <p class="text-sm text-gray-500">Current Image:</p>
                    <img src="{{ asset('storage/' . $about->image) }}" alt="About Us Image" 
                     class="w-40 h-40 mt-2 rounded-lg shadow-md border border-gray-300">

                </div>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" 
                    class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md font-semibold transition-all duration-300 hover:bg-blue-700 hover:scale-105">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
