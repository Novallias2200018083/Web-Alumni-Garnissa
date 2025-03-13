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
            Connect, Grow, <span class="text-[#E82929]">Succeed</span>
        </h1>
        <p class="mt-4 text-lg md:text-2xl font-light text-gray-200">
            Join the IST Alumni Network and expand your opportunities through lifelong connections.
        </p>
        
        <div class="mt-6 flex flex-col md:flex-row justify-center gap-4">
            <a href="{{ route('register') }}" 
                class="bg-[#E82929] text-white font-semibold px-6 py-3 rounded-full hover:bg-[#E82929] transition shadow-md">
                Get Started
            </a>
            <a href="{{ route('login') }}" 
                class="border-2 border-white text-white font-semibold px-6 py-3 rounded-full hover:bg-white hover:text-[#E82929] transition shadow-md">
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


<!-- About section with an image and text content -->
<section id="aboutSection" class="py-16 relative bg-gray-100 rounded-3xl mt-5 shadow-lg transition-all duration-500 hover:scale-[0.98] hover:shadow-xl opacity-0 translate-y-10">
    <div class="container mx-auto px-6 relative z-10">
        <!-- Section Heading -->
        <h2 class="text-4xl font-bold text-gray-800 text-center mb-10 transition-all duration-300 hover:text-[#E82929] hover:underline underline-offset-8">
            About Us
        </h2>

        <div class="flex flex-col md:flex-row items-center gap-6">
            <!-- Image -->
            <div class="w-full md:w-1/2 flex justify-center">
                <img src="https://images.pexels.com/photos/7942464/pexels-photo-7942464.jpeg?auto=compress&cs=tinysrgb&w=600" 
                     alt="About IST Alumni" 
                     class="w-3/4 md:w-[80%] rounded-lg shadow-lg transition-transform duration-500 hover:scale-105 hover:rotate-1">
            </div>

            <!-- Text Content -->
            <div class="w-full md:w-1/2 text-center md:text-left">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 transition-all duration-300 hover:text-[#E82929] hover:underline underline-offset-8">
                    <a href="#">About IST Alumni Network</a>
                </h2>
                <p class="mt-4 text-gray-700 opacity-0 transition-opacity duration-700 delay-200">
                    The <strong class="font-black text-gray-900">IST Alumni Network</strong> is a community that connects past students to foster lifelong relationships,
                    career opportunities, and mentorship. We aim to create a <strong class="font-black text-gray-900">strong, engaged, and supportive</strong> alumni network.
                </p>
                <p class="mt-2 text-gray-700 opacity-0 transition-opacity duration-700 delay-500">
                    Our mission is to keep alumni engaged and provide opportunities to reconnect, learn, and grow. Join us to stay updated on events and ways to give back to <strong class="font-black text-gray-900">IST</strong>!
                </p>
                <a href="#" 
                   class="mt-6 inline-block bg-[#E82929] text-white font-semibold px-6 py-3 rounded-lg transition-all duration-300 hover:scale-110 hover:bg-[#c71f1f]">
                    Learn More
                </a>
            </div>
        </div>
    </div>
</section>


<!-- Events Section -->
<section class="py-12">
    <div class="container mx-auto px-6 text-center">
        <!-- Section Heading -->
        <h2 class="text-4xl font-bold text-gray-800 mb-8 transition-all duration-300 hover:text-[#E82929] hover:underline underline-offset-8">
            Upcoming Events
        </h2>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Event 1 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-500 hover:scale-105">
                <img src="https://images.pexels.com/photos/3183186/pexels-photo-3183186.jpeg" 
                     alt="Networking Event" class="w-full h-52 object-cover">
                <div class="p-6">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-3">Alumni Networking Night</h3>
                    <p class="text-gray-700">Connect with fellow alumni and industry professionals to expand your network.</p>
                    <p class="mt-2 text-gray-600 text-sm"><i class="fas fa-calendar-alt text-[#E82929]"></i> March 25, 2025</p>
                </div>
            </div>

            <!-- Event 2 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-500 hover:scale-105">
                <img src="https://images.pexels.com/photos/1181414/pexels-photo-1181414.jpeg" 
                     alt="Workshop" class="w-full h-52 object-cover">
                <div class="p-6">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-3">Career Development Workshop</h3>
                    <p class="text-gray-700">Learn essential career skills and insights from industry leaders.</p>
                    <p class="mt-2 text-gray-600 text-sm"><i class="fas fa-calendar-alt text-[#E82929]"></i> April 10, 2025</p>
                </div>
            </div>

            <!-- Event 3 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-500 hover:scale-105">
                <img src="https://images.pexels.com/photos/1181406/pexels-photo-1181406.jpeg" 
                     alt="Charity Event" class="w-full h-52 object-cover">
                <div class="p-6">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-3">Charity & Giving Back</h3>
                    <p class="text-gray-700">Join us in making a difference by contributing to social causes.</p>
                    <p class="mt-2 text-gray-600 text-sm"><i class="fas fa-calendar-alt text-[#E82929]"></i> May 5, 2025</p>
                </div>
            </div>
        </div>

        <!-- View All Events Button -->
        <div class="mt-8">
            <a href="#" class="bg-[#E82929] text-white font-semibold px-6 py-3 rounded-lg transition-all duration-300 hover:scale-105 hover:bg-[#c71f1f]">
                View All Events
            </a>
        </div>
    </div>
</section>

<!-- Mission, Vision & Why Join Us Section -->
<section class="py-12 relative mt-5 shadow-lg rounded-3xl">
    <div class="container mx-auto px-6 text-center">
        <!-- Section Heading -->
        <h2 class="text-4xl font-bold text-gray-800 mb-8 transition-all duration-300 hover:text-[#E82929] hover:underline underline-offset-8">
            Our Mission, Vision & Why Join Us
        </h2>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Mission -->
            <div class="p-6 bg-white rounded-xl shadow-lg shadow-gray-400 transition-transform duration-500 hover:scale-105">
                <div class="flex items-center justify-center text-[#E82929] text-4xl mb-3">
                    <i class="fas fa-bullseye"></i> <!-- Mission Icon -->
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Our Mission</h3>
                <p class="text-gray-700 transition-all duration-300 hover:text-gray-900">
                    To build a strong alumni community that fosters lifelong connections, career growth, and mutual support.
                </p>
            </div>

            <!-- Vision -->
            <div class="p-6 bg-white rounded-xl shadow-lg shadow-gray-400 transition-transform duration-500 hover:scale-105">
                <div class="flex items-center justify-center text-[#E82929] text-4xl mb-3">
                    <i class="fas fa-eye"></i> <!-- Vision Icon -->
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Our Vision</h3>
                <p class="text-gray-700 transition-all duration-300 hover:text-gray-900">
                    To create an engaged and supportive alumni network that empowers members and contributes to society.
                </p>
            </div>

            <!-- Why Join Us -->
            <div class="p-6 bg-white rounded-xl shadow-lg shadow-gray-400 transition-transform duration-500 hover:scale-105">
                <div class="flex items-center justify-center text-[#E82929] text-4xl mb-3">
                    <i class="fas fa-users"></i> <!-- Community Icon -->
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Why Join Us?</h3>
                <p class="text-gray-700 transition-all duration-300 hover:text-gray-900">
                    Connect with alumni, gain mentorship, access career opportunities, and be part of a lifelong network.
                </p>
            </div>
        </div>
    </div>
</section>





























@vite(['resources/js/app.js'])

@endsection