@extends('layouts.admindashboard')

@section('content')
<div class="container mx-auto px-6 py-10">
    <!-- Page Heading -->
    <h2 class="text-4xl font-bold text-gray-800 mb-6">About Us</h2>

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

    <!-- About Section -->
    <div class="bg-white p-8 shadow-lg rounded-xl max-w-4xl">
        @if($about)
            <div class="mb-6">
                <h3 class="text-3xl font-semibold text-gray-700">{{ $about->title }}</h3>
                <p class="text-gray-600 mt-4 leading-relaxed">{{ $about->content }}</p>
            </div>

            @if($about->image)
                <div class="mb-6">
                    <img src="{{ asset('storage/' . $about->image) }}" 
                         alt="About Us Image" 
                         class="w-full max-w-lg rounded-xl shadow-md transition-transform duration-500 hover:scale-105">
                </div>
            @endif

            <!-- Edit Button -->
            <a href="{{ route('about.edit') }}" 
               class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md font-semibold transition-all duration-300 hover:bg-blue-700 hover:scale-105 inline-block">
                Edit About Us
            </a>
        @else
            <p class="text-gray-600">No About Us content found.</p>
            <div class="mt-4">
                <a href="{{ route('about.edit') }}" 
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md font-semibold transition-all duration-300 hover:bg-blue-700 hover:scale-105 inline-block">
                    Create Content
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
