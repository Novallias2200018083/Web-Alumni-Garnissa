@extends('layouts.website')

@section('content')
<!-- About section with an image and text content -->
<section id="aboutSection" class="py-16 relative bg-gray-100 rounded-3xl mt-5 shadow-lg transition-all duration-500 hover:scale-[0.98] hover:shadow-xl opacity-0 translate-y-10 ">
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
@vite(['resources/js/app.js'])

@endsection