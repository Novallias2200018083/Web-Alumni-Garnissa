@extends('layouts.admindashboard')

@section('content')
<div class="container mx-auto px-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">All Blogs</h2>
        <a href="{{ route('blogs.create') }}"
           class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow">
            + Add Blog
        </a>
    </div>

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

    <div class="grid md:grid-cols-3 gap-6 mt-6">
        @foreach ($blogs as $blog)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col">
                @if ($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" class="w-full h-48 object-cover" alt="Blog Image">
                @endif

                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="text-xl font-semibold text-gray-800 mb-1">{{ $blog->title }}</h3>

                    <p class="text-sm text-gray-500 mb-3">
                        <i class="fas fa-calendar-alt text-red-500 mr-1"></i>
                        {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') : 'Not set' }}
                    </p>

                    <p class="text-gray-600 flex-grow">{{(strip_tags($blog->description)) }}</p>

                    <div class="flex justify-between items-center mt-4">
                        <a href="{{ route('blogs.edit', $blog->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
