@extends('layouts.website')

@section('content')
<!-- Hero Section -->
<section class="relative bg-black py-24 text-center">
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/70 to-black/90"></div>
    
    <div class="relative z-10 container mx-auto px-6">
        <h1 class="text-5xl font-bold text-white hover:text-[#E82929] transition duration-300 relative inline-block hover:underline">
            Contact Us
        </h1>
        <p class="text-lg text-gray-300 mt-4 max-w-lg mx-auto">
            We’d love to hear from you! Reach out to us anytime.
        </p>
    </div>
</section>

<!-- Contact Section -->
<section class="container mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-2 gap-12">
    <!-- Contact Form -->
    <div class="bg-white p-10 shadow-xl rounded-lg">
        <h2 class="text-3xl font-semibold mb-6">Send Us a Message</h2>
        <form class="space-y-5">
            <div>
                <label class="block font-medium text-gray-700">Full Name</label>
                <input type="text" class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#E82929]" placeholder="Enter your name">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Email Address</label>
                <input type="email" class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#E82929]" placeholder="Enter your email">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Subject</label>
                <input type="text" class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#E82929]" placeholder="Subject">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Message</label>
                <textarea rows="5" class="w-full p-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#E82929]" placeholder="Write your message"></textarea>
            </div>
            <button type="submit" class="w-full py-4 bg-[#E82929] text-white font-bold rounded-lg hover:opacity-90 transition text-lg">
                Send Message
            </button>
        </form>
    </div>

  <!-- Contact Info & Map -->
<div class="space-y-8">
    <!-- Contact Information -->
    <div class="bg-white p-8 shadow-xl rounded-lg">
        <h2 class="text-3xl font-semibold mb-6">Get In Touch</h2>
        
        <div class="flex items-center space-x-4 mb-4">
            <i class="fas fa-envelope text-[#E82929] text-2xl"></i>
            <a href="mailto:info@isteducation.com" class="text-lg text-gray-700 hover:text-[#E82929] transition">
                info@isteducation.com
            </a>
        </div>

        <div class="flex items-center space-x-4 mb-4">
            <i class="fas fa-phone text-[#E82929] text-2xl"></i>
            <a href="tel:+254739944882" class="text-lg text-gray-700 hover:text-[#E82929] transition">
                +254 739 944 882
            </a>
        </div>

        <div class="flex items-center space-x-4">
            <i class="fas fa-map-marker-alt text-[#E82929] text-2xl"></i>
            <a href="https://www.google.com/maps?q=-1.2587008747483714,36.805838322747114" target="_blank" 
               class="text-lg text-gray-700 hover:text-[#E82929] transition">
                6th Floor, Westpoint Building, Mpaka Road, Westlands, Nairobi
            </a>
        </div>
    </div>
 <!-- Google Map -->
 <div class="w-full h-64 shadow-lg rounded-lg overflow-hidden">
        <iframe class="w-full h-full"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15955.158063820518!2d36.805838322747114!3d-1.2587008747483714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f173b7a3e9a1f%3A0x5b2b5c2b5e4e5e5e!2sWestpoint%20Building%2C%20Mpaka%20Road%2C%20Westlands%2C%20Nairobi!5e0!3m2!1sen!2ske!4v1616161616161!5m2!1sen!2ske"
            allowfullscreen="" loading="lazy"></iframe>
    </div>
</section>


@endsection