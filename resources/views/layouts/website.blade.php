<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni GARNISSA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.2.2/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

</head>

<body>
    <nav class="bg-white/50 backdrop-blur-md text-white py-4 px-6 fixed top-0 w-full z-50 shadow-lg">
        <div class="container mx-auto flex justify-between items-center px-4">
            <a href="#"
                class="text-3xl text-[#f59e0b] font-bold no-underline px-5 hover:text-black transition duration-300">
                Alumni GARNISSA
            </a>

            <div class="md:hidden flex items-center">
                <button id="menu-toggle" class="focus:outline-none">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            <ul id="menu" class="hidden md:flex space-x-5 flex-grow justify-center">
                <li><a href="/"
                        class="no-underline relative text-black after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#f59e0b] after:transition-all after:duration-300 hover:after:w-full">Beranda</a>
                </li>
                <li><a href="{{ route('about.front') }}"
                        class="no-underline relative text-black after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#f59e0b] after:transition-all after:duration-300 hover:after:w-full">Tentang
                        Kami</a>
                </li>
                <li><a href="{{ route('events.front') }}"
                        class="no-underline relative text-black after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#f59e0b] after:transition-all after:duration-300 hover:after:w-full">Acara</a>
                </li>
                <li><a href="{{ route('blogs.front') }}"
                        class="no-underline relative text-black after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#f59e0b] after:transition-all after:duration-300 hover:after:w-full">Blogs</a>
                </li>
                <li><a href="{{ route('announcements.front') }}"
                        class="no-underline relative text-black after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#f59e0b] after:transition-all after:duration-300 hover:after:w-full">Pengumuman</a>
                </li>
                <li><a href="/contact"
                        class="no-underline relative text-black after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#f59e0b] after:transition-all after:duration-300 hover:after:w-full">Kontak</a>
                </li>
            </ul>

            <div class="hidden md:flex space-x-4">
                <a href="/login"
                    class="px-6 py-2 bg-[#f59e0b] text-white rounded-full transition duration-300 hover:opacity-90">Masuk</a>
                <a href="/register"
                    class="px-6 py-2 border-2 border-[#f59e0b] text-[#f59e0b] rounded-full transition duration-300">Daftar</a>
            </div>
        </div>

        <div id="mobile-menu" class="md:hidden hidden">
            <ul class="flex flex-col space-y-2 mt-2">
                <li><a href="/" class="block px-4 py-2 text-black hover:bg-gray-200">Beranda</a></li>
                <li><a href="/about" class="block px-4 py-2 text-black hover:bg-gray-200">Tentang Kami</a></li>
                <li><a href="/events" class="block px-4 py-2 text-black hover:bg-gray-200">Acara</a></li>
                <li><a href="/blog" class="block px-4 py-2 text-black hover:bg-gray-200">Blog</a></li>
                <li><a href="/contact" class="block px-4 py-2 text-black hover:bg-gray-200">Kontak</a></li>
                <li>
                    <a href="/login" class="block px-4 py-2 text-white bg-[#f59e0b] rounded-full hover:opacity-90"
                        style="flex-shrink: 0;">Masuk</a>
                </li>
                <li>
                    <a href="/register"
                        class="block px-4 py-2 border-2 border-[#f59e0b] text-[#f59e0b] rounded-full hover:bg-gray-200"
                        style="flex-shrink: 0;">Daftar</a>
                </li>
            </ul>
        </div>
    </nav>


    <main>
        @yield('content')
    </main>

    <footer class="bg-black text-white py-8 md:py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-y-8 gap-x-6">
                <div>
                    <h3 class="text-lg md:text-2xl font-semibold text-[#f59e0b] mb-4 md:text-left text-center">Tentang
                        Kami
                    </h3>
                    <p class="text-sm md:text-base text-gray-400 leading-relaxed md:text-left text-center">
                        Kami menghubungkan alumni dan membina jaringan profesional yang kuat.
                    </p>
                </div>

                <div>
                    <h3 class="text-lg md:text-2xl font-semibold text-[#f59e0b] mb-4 md:text-left text-center">Tautan
                        Cepat
                    </h3>
                    <ul class="space-y-2 md:text-left text-center">
                        <li><a href="/"
                                class="flex md:justify-start justify-center items-center text-white hover:text-[#f59e0b]"><i
                                    class="fas fa-home mr-2"></i>Beranda</a></li>
                        <li><a href="/about"
                                class="flex md:justify-start justify-center items-center text-white hover:text-[#f59e0b]"><i
                                    class="fas fa-info-circle mr-2"></i>Tentang Kami</a></li>
                        <li>
                            <a href="{{ route('events.front') }}"
                                class="flex md:justify-start justify-center items-center text-white hover:text-[#f59e0b]">
                                <i class="fas fa-calendar-alt mr-2"></i> Acara
                            </a>
                        </li>

                        <li><a href="/blogs"
                                class="flex md:justify-start justify-center items-center text-white hover:text-[#f59e0b]"><i
                                    class="fas fa-blog mr-2"></i>Blogs</a></li>
                        <li><a href="/contact"
                                class="flex md:justify-start justify-center items-center text-white hover:text-[#f59e0b]"><i
                                    class="fas fa-envelope mr-2"></i>Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg md:text-2xl font-semibold text-[#f59e0b] mb-4 md:text-left text-center">Ikuti
                        Kami
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

                <div>
                    <h3 class="text-lg md:text-2xl font-semibold text-[#f59e0b] mb-4 md:text-left text-center">Kontak
                        Kami
                    </h3>
                    <div class="space-y-2 md:text-left text-center">
                        <p class="flex md:justify-start justify-center items-center text-gray-400">
                            <i class="fas fa-map-marker-alt text-white mr-2"></i>
                            <a href="#" class="text-white hover:text-[#f59e0b]">123 Alumni Street, City</a>
                        </p>
                        <p class="flex md:justify-start justify-center items-center text-gray-400">
                            <i class="fas fa-phone-alt text-white mr-2"></i>
                            <a href="tel:+1234567890" class="text-white hover:text-[#f59e0b]">+123 456 7890</a>
                        </p>
                        <p class="flex md:justify-start justify-center items-center text-gray-400">
                            <i class="fas fa-envelope text-white mr-2"></i>
                            <a href="mailto:contact@alumni.com"
                                class="text-white hover:text-[#f59e0b]">contact@alumni.com</a>
                        </p>
                        <p class="flex md:justify-start justify-center items-center text-gray-400">
                            <i class="fa-solid fa-location-crosshairs text-white mr-2"></i>
                            <a href="#" class="text-white hover:text-[#f59e0b]">
                                Westpoint Building, 6th Floor Mpaka Road, Westlands, Nairobi
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <hr class="border-t border-gray-700 my-6 shadow-lg shadow-red-600/10">

            <div class="mt-4 text-gray-300 text-sm text-center">
                &copy; 2025 Alumni Network. All rights reserved.
            </div>
        </div>
    </footer>

</body>

</html>