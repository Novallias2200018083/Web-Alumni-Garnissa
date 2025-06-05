@extends('layouts.website')

@section('content')
    <section id="aboutSection"
        class="min-h-screen-full flex flex-col justify-center relative bg-gradient-to-br from-gray-50 to-white shadow-2xl transition-all duration-500 hover:shadow-3xl mt-10">
        <div class="container mx-auto px-6 relative z-10 py-10">
            <div class="text-center mb-16">
                <h2 class="text-5xl font-black text-gray-800 mb-0 relative inline-block ">
                    Tentang Kami
                    <div
                        class="absolute -bottom-2 left-0 right-0 h-1 bg-gradient-to-r from-yellow-400 to-amber-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300">
                    </div>
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-yellow-400 to-amber-500 mx-auto rounded-full"></div>
            </div>

            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20 mb-0">
                <div class="w-full lg:w-1/2 flex justify-center">
                    <div class="relative group">
                        <div
                            class="absolute -inset-4 bg-gradient-to-r from-yellow-400 to-amber-500 rounded-2xl blur opacity-30 group-hover:opacity-50 transition duration-300">
                        </div>
                        <img src="{{ $about && $about->image && file_exists(public_path('storage/' . $about->image)) ? asset('storage/' . $about->image) : 'https://images.pexels.com/photos/7942464/pexels-photo-7942464.jpeg?auto=compress&cs=tinysrgb&w=600' }}"
                            alt="About Alumni"
                            class="relative w-full max-w-md rounded-2xl shadow-2xl transition-all duration-500 hover:scale-105 hover:rotate-1">
                    </div>
                </div>

                <div class="w-full lg:w-1/2 text-center lg:text-left space-y-7 mr-20 mb-10">
                    <h3 class="text-4xl font-bold text-gray-800 leading- text-center">
                        {{ $about->title ?? ' ' }}
                    </h3>
                    <p class="text-lg text-gray-600 leading-relaxed text-justify mt-10">
                        {{ $about->content ?? ' ' }}
                    </p>
                    <a href="/about"
                        class="inline-flex items-center bg-gradient-to-r from-yellow-400 to-amber-500 text-black font-bold px-8 py-4 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-xl group">
                        Lebih banyak..
                        <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @vite(['resources/js/app.js'])
@endsection