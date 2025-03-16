@extends('layouts.website')

@section('content')
 <!-- Blog Section -->
 <section class="bg-gray-100 py-12 ">
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
   


@endsection