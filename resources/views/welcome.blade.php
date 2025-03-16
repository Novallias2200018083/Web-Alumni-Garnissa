@extends('layouts.website')

@section('content')


 <!-- Hero Section with Background Image Slider -->
 <section class="relative h-[70vh] flex items-center text-center text-white overflow-hidden mt-19" 
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

    <!-- Mission, Vision & Why Join Us Section -->
    <section class="py-12 relative mt-5 ">
        <div class="container mx-auto px-6 text-center">
            <!-- Section Heading -->
            <h2
                class="text-4xl font-bold text-gray-800 mb-8 transition-all duration-300 hover:text-[#E82929] hover:underline underline-offset-8">
                Our Mission, Vision & Why Join Us
            </h2>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- Mission -->
                <div
                    class="p-6 bg-white rounded-xl shadow-lg shadow-gray-400 transition-transform duration-500 hover:scale-105">
                    <div class="flex items-center justify-center text-[#E82929] text-4xl mb-3">
                        <i class="fas fa-bullseye"></i> <!-- Mission Icon -->
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Our Mission</h3>
                    <p class="text-gray-700 transition-all duration-300 hover:text-gray-900">
                        To build a strong alumni community that fosters lifelong connections, career growth, and mutual
                        support.
                    </p>
                </div>

                <!-- Vision -->
                <div
                    class="p-6 bg-white rounded-xl shadow-lg shadow-gray-400 transition-transform duration-500 hover:scale-105">
                    <div class="flex items-center justify-center text-[#E82929] text-4xl mb-3">
                        <i class="fas fa-eye"></i> <!-- Vision Icon -->
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Our Vision</h3>
                    <p class="text-gray-700 transition-all duration-300 hover:text-gray-900">
                        To create an engaged and supportive alumni network that empowers members and contributes to society.
                    </p>
                </div>

                <!-- Why Join Us -->
                <div
                    class="p-6 bg-white rounded-xl shadow-lg shadow-gray-400 transition-transform duration-500 hover:scale-105">
                    <div class="flex items-center justify-center text-[#E82929] text-4xl mb-3">
                        <i class="fas fa-users"></i> <!-- Community Icon -->
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Why Join Us?</h3>
                    <p class="text-gray-700 transition-all duration-300 hover:text-gray-900">
                        Connect with alumni, gain mentorship, access career opportunities, and be part of a lifelong
                        network.
                    </p>
                </div>
            </div>
        </div>
    </section>



<!-- Events Section -->
<section class="py-12">
        <div class="container mx-auto px-6 text-center">
            <!-- Section Heading -->
            <h2
                class="text-4xl font-bold text-gray-800 mb-8 transition-all duration-300 hover:text-[#E82929] hover:underline underline-offset-8">
                Upcoming Events
            </h2>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- Event 1 -->
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-500 hover:scale-105">
                    <img src="https://images.pexels.com/photos/3183186/pexels-photo-3183186.jpeg" alt="Networking Event"
                        class="w-full h-52 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-3">Alumni Networking Night</h3>
                        <p class="text-gray-700">Connect with fellow alumni and industry professionals to expand your
                            network.</p>
                        <p class="mt-2 text-gray-600 text-sm"><i class="fas fa-calendar-alt text-[#E82929]"></i> March 25,
                            2025</p>
                    </div>
                </div>

                <!-- Event 2 -->
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-500 hover:scale-105">
                    <img src="https://images.pexels.com/photos/1181414/pexels-photo-1181414.jpeg" alt="Workshop"
                        class="w-full h-52 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-3">Career Development Workshop</h3>
                        <p class="text-gray-700">Learn essential career skills and insights from industry leaders.</p>
                        <p class="mt-2 text-gray-600 text-sm"><i class="fas fa-calendar-alt text-[#E82929]"></i> April 10,
                            2025</p>
                    </div>
                </div>

                <!-- Event 3 -->
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-500 hover:scale-105">
                    <img src="https://images.pexels.com/photos/1181406/pexels-photo-1181406.jpeg" alt="Charity Event"
                        class="w-full h-52 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-3">Charity & Giving Back</h3>
                        <p class="text-gray-700">Join us in making a difference by contributing to social causes.</p>
                        <p class="mt-2 text-gray-600 text-sm"><i class="fas fa-calendar-alt text-[#E82929]"></i> May 5, 2025
                        </p>
                    </div>
                </div>
            </div>

            <!-- View All Events Button -->
            <div class="mt-8">
                <a href="#"
                    class="bg-[#E82929] text-white font-semibold px-6 py-3 rounded-lg transition-all duration-300 hover:scale-105 hover:bg-[#c71f1f]">
                    View All Events
                </a>
            </div>
        </div>
    </section>


    <!-- Gallery Slider Section -->
    <section class="w-full py-12 bg-gray-100">
        <div class="container mx-auto px-6 lg:px-12">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Gallery</h2>

            <!-- Swiper Slider -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/325185/pexels-photo-325185.jpeg" alt="Scenic View"
                            class="w-full h-[500px] object-cover" />
                    </div>
                    <!-- Slide 2 -->
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/210243/pexels-photo-210243.jpeg" alt="Sunset View"
                            class="w-full h-[500px] object-cover" />
                    </div>
                    <!-- Slide 3 -->
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg" alt="Conference Event"
                            class="w-full h-[500px] object-cover" />
                    </div>
                    <!-- Slide 4 -->
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/3184336/pexels-photo-3184336.jpeg" alt="City Night"
                            class="w-full h-[500px] object-cover" />
                    </div>
                </div>

                <!-- Pagination and Navigation -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="bg-gray-100 py-12">
        <div class="container mx-auto px-6 lg:px-12">
            <h2
                class="text-3xl font-bold text-center text-gray-800 mb-8 transition-all duration-300 hover:text-[#E82929] hover:underline underline-offset-8">
                Latest Blog Posts
            </h2>

            <!-- Blog Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Blog Post 1 -->
                <div
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-transform duration-500 hover:scale-105">
                    <img src="https://images.pexels.com/photos/3184339/pexels-photo-3184339.jpeg" alt="Alumni Networking"
                        class="w-full h-56 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-semibold text-gray-800">The Power of Alumni Networks</h3>
                        <p class="text-gray-500 text-sm">March 12, 2025</p>
                        <p class="text-gray-600 mt-3">Discover how alumni connections can open doors to new opportunities
                            and strengthen professional growth.</p>
                        <a href="#" class="text-red-600 hover:underline mt-3 inline-block">Read More →</a>
                    </div>
                </div>

                <!-- Blog Post 2 -->
                <div
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-transform duration-500 hover:scale-105">
                    <img src="https://images.pexels.com/photos/3183179/pexels-photo-3183179.jpeg" alt="Networking Events"
                        class="w-full h-56 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-semibold text-gray-800">How to Stay Connected After Graduation</h3>
                        <p class="text-gray-500 text-sm">March 8, 2025</p>
                        <p class="text-gray-600 mt-3">Tips and strategies for maintaining meaningful connections with former
                            classmates and alumni.</p>
                        <a href="#" class="text-red-600 hover:underline mt-3 inline-block">Read More →</a>
                    </div>
                </div>

                <!-- Blog Post 3 -->
                <div
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-transform duration-500 hover:scale-105">
                    <img src="https://images.pexels.com/photos/3184416/pexels-photo-3184416.jpeg" alt="Alumni Event"
                        class="w-full h-56 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-semibold text-gray-800">Networking Events That Matter</h3>
                        <p class="text-gray-500 text-sm">March 5, 2025</p>
                        <p class="text-gray-600 mt-3">Explore key alumni events that can help you grow both personally and
                            professionally.</p>
                        <a href="#" class="text-red-600 hover:underline mt-3 inline-block">Read More →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>









    <!-- Testimonials Section -->
    <section class="bg-gray-100 py-12">
        <div class="container mx-auto px-6 lg:px-12">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8"> Testimonials </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <p class="text-gray-700 italic">“This network has helped me connect with amazing mentors and
                        opportunities!”</p>
                    <p class="mt-4 font-semibold text-gray-800">— Alex Johnson</p>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <p class="text-gray-700 italic">“Being a part of this alumni group has been an incredible experience.”
                    </p>
                    <p class="mt-4 font-semibold text-gray-800">— Emily Davis</p>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <p class="text-gray-700 italic">“The events and support from this network are invaluable. Highly
                        recommend!”</p>
                    <p class="mt-4 font-semibold text-gray-800">— Michael Lee</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="relative bg-cover bg-center py-16 text-white"
        style="background-image: url('https://images.pexels.com/photos/3184439/pexels-photo-3184439.jpeg');">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>

        <div class="container mx-auto px-6 lg:px-12 relative text-center">
            <h2 class="text-4xl font-bold mb-4">Stay Connected with Your Alumni</h2>
            <p class="text-lg text-gray-300 mb-6">Join our network to engage with fellow graduates, attend exclusive events,
                and unlock new opportunities.</p>

            <a href="#"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-300">Join
                Now</a>
        </div>
    </section>



























    @vite(['resources/js/app.js'])

@endsection