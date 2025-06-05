@extends('layouts.website')

@section('content')

<section
            class="relative min-h-screen-full flex items-center text-center text-white overflow-hidden mt-[4.50 rem]"
            x-data="{
                currentSlide: 0,
                slides: [
                    'https://i.ibb.co/gMZXCBnZ/gambar3.jpg',
                    'https://i.ibb.co/fdqr57tJ/gambar2.jpg',
                    'https://i.ibb.co/5XTLHdhV/gambar1.jpg'
                ],
                init() {
                    this.startCarousel();
                },
                startCarousel() {
                    setInterval(() => {
                        this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                    }, 4000);
                }
            }">

            <div class="absolute inset-0 bg-cover bg-center transition-all duration-1000 ease-in-out"
                :style="{ backgroundImage: 'url(' + slides[currentSlide] + ')' }">
            </div>

            <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/40 to-black/60"></div>

            <div class="container mx-auto px-6 relative z-10 max-w-4xl py-20"> <div class="animate-fade-in-up">
                    <h1 class="text-4xl md:text-6xl font-black leading-tight drop-shadow-1xl mb-6">
                        Terhubung, Tumbuh, <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 via-yellow-500 to-amber-500">Sukses</span>
                    </h1>
                    <p class="mt-6 text-xl md:text-1xl font-light text-gray-100 max-w-3xl mx-auto leading-relaxed">
                        Bergabunglah dengan Jaringan Alumni Garnissa dan perluas kesempatan Anda melalui koneksi
                        seumur hidup.
                    </p>

                    <div class="mt-10 flex flex-col md:flex-row justify-center gap-6">
                        <a href="{{ route('register') }}"
                            class="group bg-gradient-to-r from-yellow-400 to-amber-500 text-black font-bold px-8 py-4 rounded-full hover:from-yellow-500 hover:to-amber-600 transition-all duration-300 shadow-2xl transform hover:scale-105 hover:-translate-y-1">
                            <span class="flex items-center justify-center">
                                Mulai
                                <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </a>
                        <a href="{{ route('login') }}"
                            class="border-3 border-yellow-400 text-yellow-400 font-bold px-8 py-4 rounded-full hover:bg-yellow-400 hover:text-black transition-all duration-300 shadow-2xl transform hover:scale-105 backdrop-blur-sm bg-white/10">
                            Masuk Anggota
                        </a>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-8 left-0 right-0 flex justify-center z-20">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="currentSlide = index"
                        :class="{ 'bg-yellow-400 w-8': currentSlide === index, 'bg-white/50 w-3': currentSlide !== index }"
                        class="h-3 mx-2 rounded-full transition-all duration-300 hover:bg-yellow-300">
                    </button>
                </template>
            </div>
        </section>

        <section id="aboutSection"
            class="min-h-screen-full flex flex-col justify-center relative bg-gradient-to-br from-gray-50 to-white shadow-2xl transition-all duration-500 hover:shadow-3xl">
            <div class="container mx-auto px-6 relative z-10 py-10"> <div class="text-center mb-16">
                    <h2 class="text-5xl font-black text-gray-800 mb-0 relative inline-block ">
                        Tentang Kami
                        <div
                            class="absolute -bottom-2 left-0 right-0 h-1 bg-gradient-to-r from-yellow-400 to-amber-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300">
                        </div>
                    </h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-yellow-400 to-amber-500 mx-auto rounded-full"></div>
                </div>

                <div class="flex flex-col lg:flex-row items-center gap-12">
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
                            {{ $about->title ?? ' '}}
                        </h3>
                        <p class="text-lg text-gray-600 leading-relaxed text-justify mt-10">
                            {{ $about->content ?? ' '}}
                        </p>
                        <a href="/about"
                            class="inline-flex items-center bg-gradient-to-r from-yellow-400 to-amber-500 text-black font-bold px-8 py-4 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-xl group">
                            Lebih banyak..
                            <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="min-h-screen-full flex flex-col justify-center relative bg-gradient-to-br from-amber-50 to-yellow-50">
            <div class="container mx-auto px-6 text-center py-10"> <div class="mb-16">
                    <h2 class="text-5xl font-black text-gray-800 mb-4">
                        Visi dan Misi
                    </h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-yellow-400 to-amber-500 mx-auto rounded-full"></div>
                </div>

                <div class="grid md:grid-cols-3 gap-8">

                    <div
                        class="group p-8 bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 hover:scale-105 border-t-4 border-amber-400">
                        <div
                            class="flex items-center justify-center w-16 h-16 mx-auto mb-6 bg-gradient-to-r from-amber-400 to-yellow-500 rounded-full text-white text-2xl shadow-lg">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">VISI</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Untuk menciptakan jaringan alumni yang terlibat dan mendukung yang memberdayakan anggota
                            dan berkontribusi kepada masyarakat.
                        </p>
                    </div>

                    <div
                        class="group p-8 bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 hover:scale-105 border-t-4 border-yellow-400">
                        <div
                            class="flex items-center justify-center w-16 h-16 mx-auto mb-6 bg-gradient-to-r from-yellow-400 to-amber-500 rounded-full text-white text-2xl shadow-lg">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">MISI</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Untuk membangun komunitas alumni yang kuat yang membina hubungan seumur hidup, pertumbuhan
                            karier, dan dukungan bersama.
                        </p>
                    </div>

                    <div
                        class="group p-8 bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 hover:scale-105 border-t-4 border-yellow-500">
                        <div
                            class="flex items-center justify-center w-16 h-16 mx-auto mb-6 bg-gradient-to-r from-yellow-500 to-amber-400 rounded-full text-white text-2xl shadow-lg">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Mari Bergabung</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Terhubung dengan alumni, dapatkan bimbingan, akses peluang karier, dan jadilah bagian dari
                            jaringan seumur hidup.
                        </p>
                    </div>
                </div>
            </div>
        </section>

       <section class="py-20 bg-gradient-to-br from-gray-50 to-gray-100 relative overflow-hidden">
    {{-- Decorative shapes (Pastikan Anda sudah mendefinisikan keyframes di CSS utama Anda atau di bawah ini) --}}
    <div class="absolute top-0 left-1/4 w-32 h-32 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob"></div>
    <div class="absolute top-1/2 right-1/4 w-48 h-48 bg-amber-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000"></div>
    <div class="absolute bottom-0 left-1/3 w-40 h-40 bg-red-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-4000"></div>


    <div class="container mx-auto px-6 relative z-10">
        {{-- Section Title --}}
        <div class="text-center mb-16">
            <h2 class="text-5xl font-extrabold text-gray-900 mb-4 tracking-tight leading-tight">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-600 to-amber-700">Kenali Alumni Kami</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-8">
                Jelajahi profil para alumni berprestasi yang telah menjadi bagian dari perjalanan kami. Temukan inspirasi dari kisah sukses mereka!
            </p>
            <div class="w-28 h-1.5 bg-gradient-to-r from-yellow-500 to-amber-600 mx-auto rounded-full shadow-lg"></div>
        </div>

        {{-- Alumni Profiles Grid --}}
        @if($alumniUsers->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl shadow-lg max-w-xl mx-auto">
                <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-r from-yellow-500 to-amber-600 rounded-full flex items-center justify-center shadow-xl transform transition-transform duration-500 hover:scale-110">
                    <i class="fas fa-users text-white text-4xl"></i>
                </div>
                <p class="text-2xl text-gray-700 font-semibold mb-4">Belum Ada Profil Alumni yang Tersedia.</p>
                <p class="text-lg text-gray-500 max-w-md mx-auto">
                    Kami sedang mengumpulkan data alumni kami. Silakan kunjungi kembali nanti!
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($alumniUsers as $user)
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transition-all duration-500 transform hover:scale-[1.02] hover:shadow-2xl group flex flex-col">
                        <div class="relative p-8 bg-gradient-to-br from-yellow-50 to-amber-50">
                            {{-- Animated Blob for Image Background --}}
                            <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-amber-500 rounded-full blur-xl opacity-30 group-hover:opacity-50 transition duration-500 animate-pulse-slow"></div>
                            <div class="relative z-10">
                                <img src="{{ optional($user->alumniProfile)->image ? asset('storage/' . $user->alumniProfile->image) : 'https://via.placeholder.com/150/FACC15/FFF?text=Alumni' }}"
                                    alt="Profile Image of {{ $user->name }}"
                                    class="w-36 h-36 object-cover rounded-full border-5 border-white shadow-xl mx-auto transform group-hover:scale-105 transition-transform duration-300">
                            </div>
                        </div>

                        <div class="p-7 flex flex-col flex-grow">
                            <h3 class="text-2xl font-bold text-gray-800 text-center mb-4 leading-tight group-hover:text-yellow-700 transition-colors duration-300">
                                {{ $user->name }}
                            </h3>
                            <div class="space-y-3 text-base text-gray-700 flex-grow">
                                <p class="flex items-center">
                                    <i class="fas fa-envelope text-yellow-600 w-6 mr-3"></i>
                                    <span class="truncate" title="{{ $user->email }}">{{ $user->email }}</span>
                                </p>
                                @if($user->alumniProfile)
                                    <p class="flex items-center">
                                        <i class="fas fa-phone text-yellow-600 w-6 mr-3"></i>
                                        {{ $user->alumniProfile->phone ?? 'Belum ada nomor' }}
                                    </p>
                                    <p class="flex items-start">
                                        <i class="fas fa-map-marker-alt text-yellow-600 w-6 mr-3 mt-0.5"></i>
                                        <span>{{ Str::limit($user->alumniProfile->address ?? 'Belum ada alamat', 50) }}</span>
                                    </p>
                                    <p class="flex items-center">
                                        <i class="fas fa-graduation-cap text-yellow-600 w-6 mr-3"></i>
                                        Angkatan {{ $user->alumniProfile->graduation_year ?? 'Tidak Tersedia' }}
                                    </p>
                                    @if($user->alumniProfile->bio)
                                        <div class="mt-4 p-4 bg-gray-50 rounded-lg border border-gray-100">
                                            <p class="text-gray-700 text-sm leading-relaxed italic">
                                                "{{ Str::limit($user->alumniProfile->bio, 80) }}"
                                            </p>
                                        </div>
                                    @endif
                                @else
                                    <p class="text-gray-500 text-center italic text-sm py-4">Profil alumni belum lengkap.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- "Lihat Selengkapnya" Button --}}
            <div class="text-center mt-16">
                <a href="{{ route('login') }}" {{-- Link to your login page --}}
                   class="inline-flex items-center px-10 py-4 bg-yellow-600 text-white font-bold rounded-full shadow-lg
                          hover:bg-yellow-700 transition duration-300 transform hover:scale-105
                          focus:outline-none focus:ring-4 focus:ring-yellow-300 focus:ring-opacity-75 text-lg">
                    Lihat Selengkapnya <i class="fas fa-arrow-right ml-3"></i>
                </a>
                <p class="mt-4 text-gray-500 text-sm">Masuk untuk melihat semua profil alumni.</p>
            </div>
        @endif
    </div>
</section>


        <section class="min-h-screen-full flex flex-col justify-center py-20 bg-gradient-to-br from-gray-50 to-white">
    <div class="container mx-auto px-6 text-center py-10">
        <div class="mb-16">
            <h2 class="text-5xl font-black text-gray-800 mb-4">Acara Mendatang</h2>
            <div class="w-24 h-1 bg-gradient-to-r from-yellow-400 to-amber-500 mx-auto rounded-full"></div>
        </div>

        @if($events->isEmpty())
            <div class="text-center py-16">
                <div
                    class="w-24 h-24 mx-auto mb-6 bg-gradient-to-r from-yellow-400 to-amber-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-white text-3xl"></i>
                </div>
                <p class="text-xl text-gray-600">Tidak ada acara mendatang untuk saat ini.</p>
            </div>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($events as $event)
                    <div
                        class="group bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-500 hover:scale-105 hover:shadow-2xl flex flex-col">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                                class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </div>
                        <div class="p-6 space-y-4 flex-grow flex flex-col">
                            {{-- Judul Event (Max 2 Baris) --}}
                            <h3 class="text-2xl font-bold text-gray-800 group-hover:text-yellow-600 transition-colors leading-tight line-clamp-2 min-h-[3.5rem]">
                                {{ $event->title }}
                            </h3>
                            {{-- Deskripsi Event --}}
                            <p class="text-gray-600 leading-relaxed flex-grow min-h-[5rem]">
                                {{ Str::limit($event->description, 120, '') }}
                                @if (strlen($event->description) > 120)
                                    <span class="text-gray-500">...</span>
                                @endif
                            </p>
                            <div class="flex items-center text-yellow-600">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span class="text-sm font-medium">
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}
                                    @if($event->event_time)
                                        at {{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- TOMBOL "LIHAT SEMUA ACARA" BARU --}}
            <div class="mt-12 text-center">
                <a href="{{ route('events.front') }}" {{-- Menggunakan rute events.front --}}
                   class="inline-flex items-center px-8 py-3 bg-yellow-600 text-white font-semibold rounded-full shadow-lg
                          hover:bg-yellow-700 transition duration-300 transform hover:scale-105">
                    Lihat Semua Acara
                    <i class="fas fa-arrow-right ml-3"></i>
                </a>
            </div>
            {{-- Akhir TOMBOL BARU --}}

        @endif
    </div>
</section>
        <section class="min-h-screen-full flex flex-col justify-center w-full py-20 bg-gradient-to-br from-yellow-50 to-amber-50">
            <div class="container mx-auto px-6 lg:px-12 py-10"> <div class="text-center mb-16">
                    <h2 class="text-5xl font-black text-gray-800 mb-4">Gallery</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-yellow-400 to-amber-500 mx-auto rounded-full"></div>
                </div>

                <div class="swiper mySwiper rounded-2xl overflow-hidden shadow-2xl">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="https://images.pexels.com/photos/267885/pexels-photo-267885.jpeg?auto=compress&cs=tinysrgb&w=1200"
                                alt="Alumni Together" class="w-full h-[600px] object-cover" />
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images.pexels.com/photos/1595391/pexels-photo-1595391.jpeg?auto=compress&cs=tinysrgb&w=1200"
                                alt="Graduation Day" class="w-full h-[600px] object-cover" />
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg"
                                alt="Conference Event" class="w-full h-[600px] object-cover" />
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images.pexels.com/photos/3184405/pexels-photo-3184405.jpeg?auto=compress&cs=tinysrgb&w=1200"
                                alt="Networking Event" class="w-full h-[600px] object-cover" />
                        </div>
                    </div>

                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </section>

       <section class="py-20 bg-gray-50"> {{-- Removed min-h-screen-full and flex justify-center if this is just a section on a larger page --}}
    <div class="container mx-auto px-6">
        {{-- Section Header --}}
        <div class="text-center mb-16">
            <h2 class="text-5xl font-extrabold text-gray-900 mb-4 tracking-tight leading-tight">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-600 to-amber-700">Blog Terbaru</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-8">
                Dapatkan informasi terkini dan wawasan mendalam dari artikel-artikel terbaru kami.
            </p>
            <div class="w-28 h-1.5 bg-gradient-to-r from-yellow-500 to-amber-600 mx-auto rounded-full shadow-lg"></div>
        </div>

        {{-- Blog Grid --}}
        @if($blogs->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl shadow-lg max-w-xl mx-auto">
                <i class="far fa-newspaper text-8xl text-gray-300 mb-6 animate-pulse"></i>
                <p class="text-2xl text-gray-700 font-semibold mb-4">Belum Ada Artikel Blog Tersedia.</p>
                <p class="text-lg text-gray-500 max-w-md mx-auto">
                    Nantikan pembaruan kami untuk artikel-artikel menarik lainnya!
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10"> {{-- Increased gap for better spacing --}}
                @foreach ($blogs as $blog)
                    <article class="group bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl flex flex-col"> {{-- Added flex-col for consistent card height --}}
                        @if ($blog->image)
                            <div class="relative overflow-hidden w-full h-64"> {{-- Added w-full h-64 to image wrapper --}}
                                <img src="{{ asset('storage/' . $blog->image) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                    alt="{{ $blog->title }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                                    {{-- You could add a small overlay title or category here if desired --}}
                                </div>
                            </div>
                        @else
                            {{-- Placeholder if no image --}}
                            <div class="w-full h-64 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center text-gray-400 text-8xl rounded-t-2xl">
                                <i class="fas fa-book-open"></i>
                            </div>
                        @endif

                        <div class="p-7 space-y-4 flex-grow flex flex-col justify-between"> {{-- Added flex-grow and justify-between --}}
                            <div>
                                <h3 class="text-2xl font-extrabold text-gray-800 group-hover:text-yellow-600 transition-colors leading-tight mb-3 line-clamp-2"> {{-- line-clamp-2 added for title --}}
                                    {{ $blog->title }}
                                </h3>

                                <div class="flex items-center text-gray-600 text-sm mb-4"> {{-- Changed icon color to gray-600 for contrast --}}
                                    <i class="fas fa-calendar-alt text-yellow-600 mr-2 text-base"></i> {{-- Explicitly set yellow color for icon --}}
                                    <span class="font-medium">
                                        {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->isoFormat('DD MMMM YYYY', 'ID') : 'Belum Dipublikasi' }}
                                    </span>
                                </div>

                                <p class="text-gray-700 leading-relaxed text-justify line-clamp-3"> {{-- line-clamp-3 added for description --}}
                                    {{ Str::limit(strip_tags($blog->description), 150) }}
                                </p>
                            </div>

                            <div class="mt-6 text-center"> {{-- Button moved inside a div to manage spacing and centering --}}
                                <a href="{{ route('blogs.show', $blog->id) }}"
                                   class="inline-flex items-center justify-center px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg text-base
                                          hover:bg-yellow-700 transition duration-300 transform hover:scale-105 shadow-md">
                                    Baca Artikel
                                    <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- "Lihat Semua Blog" Button --}}
            <div class="text-center mt-16">
                <a href="{{ route('blogs.front') }}"
                   class="inline-flex items-center px-10 py-4 bg-yellow-600 text-white font-bold rounded-full shadow-lg
                          hover:bg-yellow-700 transition duration-300 transform hover:scale-105
                          focus:outline-none focus:ring-4 focus:ring-yellow-300 focus:ring-opacity-75 text-lg">
                    Lihat Semua Blog <i class="fas fa-arrow-right ml-3"></i>
                </a>
            </div>
        @endif
    </div>
</section>

{{-- Make sure you have the @tailwindcss/line-clamp plugin installed and configured --}}
        <section class="min-h-screen-full flex flex-col justify-center py-20 bg-gradient-to-br from-gray-50 to-white">
            <div class="container mx-auto px-6 py-10"> <div class="text-center mb-16">
                    <h2 class="text-5xl font-black text-gray-800 mb-4">Pengumuman Terbaru</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-yellow-400 to-amber-500 mx-auto rounded-full"></div>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($announcements as $announcement)
                        <div
                            class="group bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                            @if ($announcement->image)
                                <div class="relative overflow-hidden">
                                    <img src="{{ asset('storage/' . $announcement->image) }}"
                                        class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                                        alt="Announcement Image">
                                    <div class="absolute top-4 right-4">
                                        <span
                                            class="px-3 py-1 text-xs font-bold rounded-full {{ $announcement->is_active ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                            {{ $announcement->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <div class="p-6 space-y-4">
                                <h3
                                    class="text-2xl font-bold text-gray-800 group-hover:text-yellow-600 transition-colors">
                                    {{ $announcement->title }}
                                </h3>

                                <p class="text-gray-600 leading-relaxed">
                                    {{ Str::limit(strip_tags($announcement->description), 120) }}
                                </p>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div class="flex items-center text-yellow-600">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        <span class="text-sm font-medium">
                                            {{ $announcement->published_at ? \Carbon\Carbon::parse($announcement->published_at)->format('M d, Y') : 'Not Published' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="min-h-screen-full flex flex-col justify-center py-20 bg-gradient-to-br from-yellow-50 to-amber-50">
            <div class="container mx-auto px-6 lg:px-12 py-10"> <div class="text-center mb-16">
                    <h2 class="text-5xl font-black text-gray-800 mb-4">Testimoni</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-yellow-400 to-amber-500 mx-auto rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        class="group bg-white rounded-2xl shadow-xl p-8 transition-all duration-500 hover:scale-105 hover:shadow-2xl border-t-4 border-yellow-400">
                        <div
                            class="flex items-center justify-center w-12 h-12 mx-auto mb-6 bg-gradient-to-r from-yellow-400 to-amber-500 rounded-full">
                            <i class="fas fa-quote-left text-white"></i>
                        </div>
                        <p class="text-gray-700 italic text-lg leading-relaxed mb-6">
                            "This network has helped me connect with amazing mentors and opportunities!"
                        </p>
                        <div class="text-center">
                            <p class="font-bold text-gray-800 text-lg">Alex Johnson</p>
                            <p class="text-yellow-600 text-sm">Class of 2018</p>
                        </div>
                    </div>

                    <div
                        class="group bg-white rounded-2xl shadow-xl p-8 transition-all duration-500 hover:scale-105 hover:shadow-2xl border-t-4 border-amber-400">
                        <div
                            class="flex items-center justify-center w-12 h-12 mx-auto mb-6 bg-gradient-to-r from-amber-400 to-yellow-500 rounded-full">
                            <i class="fas fa-quote-left text-white"></i>
                        </div>
                        <p class="text-gray-700 italic text-lg leading-relaxed mb-6">
                            "Being a part of this alumni group has been an incredible experience."
                        </p>
                        <div class="text-center">
                            <p class="font-bold text-gray-800 text-lg">Mary Doe</p>
                            <p class="text-yellow-600 text-sm">Class of 2019</p>
                        </div>
                    </div>

                    <div
                        class="group bg-white rounded-2xl shadow-xl p-8 transition-all duration-500 hover:scale-105 hover:shadow-2xl border-t-4 border-yellow-500">
                        <div
                            class="flex items-center justify-center w-12 h-12 mx-auto mb-6 bg-gradient-to-r from-yellow-500 to-amber-400 rounded-full">
                            <i class="fas fa-quote-left text-white"></i>
                        </div>
                        <p class="text-gray-700 italic text-lg leading-relaxed mb-6">
                            "The events and support from this network are invaluable. Highly recommend!"
                        </p>
                        <div class="text-center">
                            <p class="font-bold text-gray-800 text-lg">John Doe</p>
                            <p class="text-yellow-600 text-sm">Class of 2020</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="relative min-h-screen-full flex items-center justify-center bg-cover bg-center text-white overflow-hidden"
            style="background-image: url('https://images.pexels.com/photos/3184439/pexels-photo-3184439.jpeg');">
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/70"></div>

            <div class="container mx-auto px-6 lg:px-12 relative text-center py-20"> <div class="max-w-4xl mx-auto">
                    <h2 class="text-6xl font-black mb-6 leading-tight">
                        Tetap Terhubung dengan
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-amber-500">Alumni
                            Anda</span>
                    </h2>
                    <p class="text-xl text-gray-200 mb-10 leading-relaxed max-w-2xl mx-auto">
                        Bergabunglah dengan jaringan kami untuk berinteraksi dengan sesama lulusan, menghadiri acara
                        eksklusif, dan membuka peluang baru yang akan membentuk masa depan Anda.
                    </p>

                    <a href="/register"
                        class="inline-flex items-center bg-gradient-to-r from-yellow-400 to-amber-500 text-black font-bold px-10 py-5 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-2xl group">
                        Bergabunglah
                        <svg class="ml-3 w-6 h-6 group-hover:translate-x-1 transition-transform" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </section>


<style>
    /* Custom animations */
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fade-in-up 1s ease-out;
    }

    /* Swiper custom styles with yellow theme */
    .swiper-button-next,
    .swiper-button-prev {
        color: #f59e0b !important; /* yellow-500 */
        background: rgba(255, 255, 255, 0.9);
        width: 50px !important;
        height: 50px !important;
        border-radius: 50%;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: rgba(255, 255, 255, 1);
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 18px !important;
        font-weight: bold;
    }

    .swiper-pagination-bullet {
        background: rgba(255, 255, 255, 0.5) !important;
        width: 12px !important;
        height: 12px !important;
        opacity: 1 !important;
        transition: all 0.3s ease;
    }

    .swiper-pagination-bullet-active {
        background: #f59e0b !important; /* yellow-500 */
        transform: scale(1.2);
        box-shadow: 0 2px 10px rgba(245, 158, 11, 0.5);
    }

    /* Enhanced hover effects */
    .hover\:shadow-3xl:hover {
        box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
    }

    /* Gradient text animation */
    .bg-clip-text {
        background-clip: text;
        -webkit-background-clip: text;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #fbbf24, #f59e0b);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #f59e0b, #d97706);
    }

    /* Enhanced card hover effects */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }

    .group:hover .group-hover\:translate-x-1 {
        transform: translateX(0.25rem);
    }

    /* Smooth page transitions */
    * {
        scroll-behavior: smooth;
    }

    /* Enhanced focus states for accessibility */
    .focus\:ring-yellow-500:focus {
        --tw-ring-color: #f59e0b;
    }

    /* Custom button pulse animation */
    @keyframes pulse-yellow {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7);
        }
        50% {
            box-shadow: 0 0 0 10px rgba(245, 158, 11, 0);
        }
    }

    .animate-pulse-yellow {
        animation: pulse-yellow 2s infinite;
    }

    /* Enhanced text selection */
    ::selection {
        background-color: #fef3c7; /* yellow-100 */
        color: #92400e; /* yellow-800 */
    }

    /* Loading animation for images */
    img {
        transition: opacity 0.3s ease;
    }

    img[loading] {
        opacity: 0.7;
    }
    /* CSS Tambahan untuk Fullscreen sections */
        .min-h-screen-full {
            min-height: 100vh;
            /* Pastikan tingginya minimal 100% viewport */
        }

        /* Untuk memastikan elemen-elemen di dalam section bisa menyesuaikan */
        .flex-center {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        /* Override margin-top untuk section yang diberi min-h-screen-full agar tidak ada gap besar */
        section {
            margin-top: 0 !important;
            /* Hapus margin-top bawaan Tailwind atau lainnya */
        }
</style>

<!-- Additional JavaScript for enhanced interactions -->
<script>
    // Smooth scroll for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Enhanced intersection observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe all sections for scroll animations
    document.querySelectorAll('section').forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(20px)';
        section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(section);
    });

    // Add loading states for images
    document.querySelectorAll('img').forEach(img => {
        img.addEventListener('load', function() {
            this.style.opacity = '1';
        });
    });

    // Enhanced button interactions
    document.querySelectorAll('a, button').forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        element.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
</script>

@vite(['resources/js/app.js'])

@endsection