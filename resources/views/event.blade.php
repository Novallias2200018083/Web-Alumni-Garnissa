@extends('layouts.website')

@section('content')
    <!-- Events Section -->
    <section class="py-12 ">
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


        </div>
    </section>
@endsection