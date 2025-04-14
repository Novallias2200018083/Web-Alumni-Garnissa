<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni IST</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.2.2/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Include SwiperJS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

</head>

<body>
    <nav class="bg-white/50 backdrop-blur-md text-white py-4 px-6 sticky top-0 w-full z-50 shadow-lg">
        <div class="container mx-auto flex justify-between items-center px-4">
            <!-- Logo -->
            <a href="#"
                class="text-3xl text-[#E82929] font-bold no-underline px-5 hover:text-black transition duration-300">
                Alumni IST
            </a>

            <!-- Hamburger Icon for Mobile -->
            <div class="md:hidden flex items-center">
                <button id="menu-toggle" class="focus:outline-none">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            <!-- Navigation Links Centered with a Slight Shift to the Right -->
            <ul id="menu" class="hidden md:flex space-x-5 ml-auto mr-10">
                <li><a href="/"
                        class="no-underline relative text-black after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#E82929] after:transition-all after:duration-300 hover:after:w-full">Home</a>
                </li>
                <li><a href="{{ route('about.front') }}"
                        class="no-underline relative text-black after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#E82929] after:transition-all after:duration-300 hover:after:w-full">About</a>
                </li>
                <li><a href="{{ route('events.front') }}"
                        class="no-underline relative text-black after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#E82929] after:transition-all after:duration-300 hover:after:w-full">Events</a>
                </li>
                <li><a href="{{ route('blogs.front') }}"
                        class="no-underline relative text-black after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#E82929] after:transition-all after:duration-300 hover:after:w-full">Blogs</a>
                </li>
                <li><a href="{{ route('announcements.front') }}"
                        class="no-underline relative text-black after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#E82929] after:transition-all after:duration-300 hover:after:w-full">Announcements</a>
                </li>
                <li><a href="/contact"
                        class="no-underline relative text-black after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#E82929] after:transition-all after:duration-300 hover:after:w-full">contact</a>
                </li>
            </ul>

            <!-- Login & Register Buttons with Rounded Style -->
            <div class="hidden md:flex space-x-4 mr-10">
                <a href="/login"
                    class="px-6 py-2 bg-[#E82929] text-white rounded-full transition duration-300 hover:opacity-90">Login</a>
                <a href="/register"
                    class="px-6 py-2 border-2 border-[#E82929] text-[#E82929] rounded-full transition duration-300">Register</a>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden">
            <ul class="flex flex-col space-y-2 mt-2">
                <li><a href="/" class="block px-4 py-2 text-black hover:bg-gray-200">Home</a></li>
                <li><a href="/about" class="block px-4 py-2 text-black hover:bg-gray-200">About</a></li>
                <li><a href="/events" class="block px-4 py-2 text-black hover:bg-gray-200">Events</a></li>
                <li><a href="/blog" class="block px-4 py-2 text-black hover:bg-gray-200">Blog</a></li>
                <li><a href="/contact" class="block px-4 py-2 text-black hover:bg-gray-200">Contact</a></li>
                <li>
                    <a href="/login" class="block px-4 py-2 text-white bg-[#E82929] rounded-full hover:opacity-90"
                        style="flex-shrink: 0;">Login</a>
                </li>
                <li>
                    <a href="/register"
                        class="block px-4 py-2 border-2 border-[#E82929] text-[#E82929] rounded-full hover:bg-gray-200"
                        style="flex-shrink: 0;">Register</a>
                </li>
            </ul>
        </div>
    </nav>




    <main>
        @yield('content')
    </main>

    <!-- footer -->
    <footer class="bg-black text-white py-8 md:py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Footer Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-y-8 gap-x-6">
                <!-- About Us -->
                <div>
                    <h3 class="text-lg md:text-2xl font-semibold text-red-600 mb-4 md:text-left text-center">About Us
                    </h3>
                    <p class="text-sm md:text-base text-gray-400 leading-relaxed md:text-left text-center">
                        We connect alumni and foster a strong professional network.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg md:text-2xl font-semibold text-red-600 mb-4 md:text-left text-center">Quick Links
                    </h3>
                    <ul class="space-y-2 md:text-left text-center">
                        <li><a href="/"
                                class="flex md:justify-start justify-center items-center text-white hover:text-red-600"><i
                                    class="fas fa-home mr-2"></i>Home</a></li>
                        <li><a href="/about"
                                class="flex md:justify-start justify-center items-center text-white hover:text-red-600"><i
                                    class="fas fa-info-circle mr-2"></i>About</a></li>
                        <li>
                            <a href="{{ route('events.front') }}"
                                class="flex md:justify-start justify-center items-center text-white hover:text-red-600">
                                <i class="fas fa-calendar-alt mr-2"></i> Events
                            </a>
                        </li>

                        <li><a href="/blogs"
                                class="flex md:justify-start justify-center items-center text-white hover:text-red-600"><i
                                    class="fas fa-blog mr-2"></i>Blogs</a></li>
                        <li><a href="/contact"
                                class="flex md:justify-start justify-center items-center text-white hover:text-red-600"><i
                                    class="fas fa-envelope mr-2"></i>Contact</a></li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div>
                    <h3 class="text-lg md:text-2xl font-semibold text-red-600 mb-4 md:text-left text-center">Follow Us
                    </h3>
                    <div class="space-y-2 md:text-left text-center">
                        <a href="https://www.facebook.com"
                            class="flex md:justify-start justify-center items-center text-white hover:text-blue-600"><i
                                class="fab fa-facebook mr-3"></i>Facebook</a>
                        <a href="https://x.com/"
                            class="flex md:justify-start justify-center items-center text-white hover:text-blue-400"><i
                                class="fab fa-twitter mr-3"></i>Twitter</a>
                        <a href="https://www.instagram.com"
                            class="flex md:justify-start justify-center items-center text-white hover:text-pink-500"><i
                                class="fab fa-instagram mr-3"></i>Instagram</a>
                        <a href="https://ke.linkedin.com/"
                            class="flex md:justify-start justify-center items-center text-white hover:text-blue-800"><i
                                class="fab fa-linkedin mr-3"></i>LinkedIn</a>
                    </div>
                </div>

                <!-- Contact Us -->
                <div>
                    <h3 class="text-lg md:text-2xl font-semibold text-red-600 mb-4 md:text-left text-center">Contact Us
                    </h3>
                    <div class="space-y-2 md:text-left text-center">
                        <p class="flex md:justify-start justify-center items-center text-gray-400">
                            <i class="fas fa-map-marker-alt text-white mr-2"></i>
                            <a href="#" class="text-white hover:text-red-600">123 Alumni Street, City</a>
                        </p>
                        <p class="flex md:justify-start justify-center items-center text-gray-400">
                            <i class="fas fa-phone-alt text-white mr-2"></i>
                            <a href="tel:+1234567890" class="text-white hover:text-red-600">+123 456 7890</a>
                        </p>
                        <p class="flex md:justify-start justify-center items-center text-gray-400">
                            <i class="fas fa-envelope text-white mr-2"></i>
                            <a href="mailto:contact@alumni.com"
                                class="text-white hover:text-red-600">contact@alumni.com</a>
                        </p>
                        <p class="flex md:justify-start justify-center items-center text-gray-400">
                            <i class="fa-solid fa-location-crosshairs text-white mr-2"></i>
                            <a href="#" class="text-white hover:text-red-600">
                                Westpoint Building, 6th Floor Mpaka Road, Westlands, Nairobi
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <hr class="border-t border-gray-700 my-6 shadow-lg shadow-red-600/10">

            <!-- Copyright -->
            <div class="mt-4 text-gray-300 text-sm text-center">
                &copy; 2025 Alumni Network. All rights reserved.
            </div>
        </div>
    </footer>

</body>

</html>