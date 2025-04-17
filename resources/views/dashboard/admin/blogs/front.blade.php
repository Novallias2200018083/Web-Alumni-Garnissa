@extends('layouts.website')

@section('content')
    <div class="container mx-auto px-6 mt-12">
    <h2 class="text-4xl text-center font-bold text-gray-800 mb-8 transition-all duration-300 hover:text-[#E82929] hover:underline underline-offset-8">
            Latest Blogs
        </h2>

        <div class="grid md:grid-cols-3 gap-6 mt-6">
            @foreach ($blogs as $blog)
                <div class="bg-white rounded-xl shadow-lg p-4 flex flex-col">
                    @if ($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" class="rounded-lg mb-3 w-full h-48 object-cover"
                            alt="Blog Image">
                    @endif

                    <h3 class="text-xl font-semibold text-gray-800">{{ $blog->title }}</h3>

                    <p class="text-gray-500 text-sm mb-2">
                        <i class="fas fa-calendar-alt text-red-500 mr-1"></i>
                        {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') : 'Not Published' }}
                    </p>

                    <p class="text-gray-600 transition-all ease-in-out duration-300" id="blog-full-description-{{ $blog->id }}">
                        {{ strip_tags($blog->description) }}
                    </p>

                   
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $blogs->links() }}
        </div>
    </div>
@endsection