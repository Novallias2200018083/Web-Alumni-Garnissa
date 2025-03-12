@extends('layouts.website')

@section('content')

<!-- Hero Section with Background Image Slider -->
<section class="relative h-[70vh] flex items-center text-center text-white overflow-hidden" 
    x-data="{ 
        currentSlide: 0, 
        slides: [
            'https://images.pexels.com/photos/7944238/pexels-photo-7944238.jpeg?auto=compress&cs=tinysrgb&w=1200',
            'https://images.pexels.com/photos/7942534/pexels-photo-7942534.jpeg?auto=compress&cs=tinysrgb&w=1200',
            'https://images.pexels.com/photos/7972735/pexels-photo-7972735.jpeg?auto=compress&cs=tinysrgb&w=1200'
        ],
        init() {
            this.startCarousel();
        },
        startCarousel() {
            setInterval(() => {
                this.currentSlide = (this.currentSlide + 1) % this.slides.length;
            }, 3000);
        }
    }">

    <!-- Background Image with bg-cover -->
    <div class="absolute inset-0 bg-cover bg-center transition-all duration-500"
        :style="{ backgroundImage: 'url(' + slides[currentSlide] + ')' }">
    </div>

    <!-- Lighter Overlay for Better Visibility -->
    <div class="absolute inset-0 bg-black/30"></div>

    <!-- Content -->
    <div class="container mx-auto px-6 relative z-10 max-w-3xl">
        <h1 class="text-5xl md:text-7xl font-extrabold leading-tight drop-shadow-lg">
            Connect, Grow, <span class="text-orange-400">Succeed</span>
        </h1>
        <p class="mt-4 text-lg md:text-2xl font-light text-gray-200">
            Join the IST Alumni Network and expand your opportunities through lifelong connections.
        </p>
        
        <div class="mt-6 flex flex-col md:flex-row justify-center gap-4">
            <a href="{{ route('register') }}" 
                class="bg-orange-500 text-white font-semibold px-6 py-3 rounded-full hover:bg-orange-600 transition shadow-md">
                Get Started
            </a>
            <a href="{{ route('login') }}" 
                class="border-2 border-white text-white font-semibold px-6 py-3 rounded-full hover:bg-white hover:text-orange-600 transition shadow-md">
                Member Login
            </a>
        </div>
    </div>

    <!-- Navigation Dots -->
    <div class="absolute bottom-0 left-0 right-0 flex justify-center mb-4">
        <template x-for="(slide, index) in slides" :key="index">
            <button @click="currentSlide = index" 
                :class="{ 'bg-white': currentSlide === index, 'bg-gray-400': currentSlide !== index }" 
                class="w-3 h-3 mx-1 rounded-full transition">
            </button>
        </template>
    </div>

</section>







@endsection