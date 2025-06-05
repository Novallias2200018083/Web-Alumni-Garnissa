<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        /* Styling untuk sidebar link aktif */
        .sidebar-link.active {
            background-color: rgba(255, 255, 255, 0.15);
            font-weight: 600;
            color: #fff;
        }
        .sidebar-link.active i {
            color: #fff;
        }
        /* Styling untuk hover pada sidebar link (kecuali yang aktif) */
        .sidebar-link:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.08);
        }
        /* Mengatasi masalah scrollbar di Firefox */
        html {
            scrollbar-width: thin;
            scrollbar-color: #a0aec0 #edf2f7;
        }
        /* Mengatasi masalah scrollbar di Webkit (Chrome, Safari) */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #edf2f7;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #a0aec0;
            border-radius: 4px;
            border: 2px solid #edf2f7;
        }

        /* Kelas untuk menyembunyikan teks sidebar */
        .sidebar-hidden .sidebar-text {
            display: none;
        }

        /* Kelas untuk menyesuaikan lebar ikon saat teks disembunyikan */
        .sidebar-hidden .sidebar-link i {
            margin-right: 0 !important;
            width: auto !important;
        }

        /* Menyesuaikan lebar sidebar saat disembunyikan */
        .sidebar-hidden {
            width: 80px !important; /* Lebar ikon + padding */
            padding-left: 0.5rem !important; /* px-2 */
            padding-right: 0.5rem !important; /* px-2 */
        }

        /* Menyesuaikan margin konten utama saat sidebar disembunyikan */
        .sidebar-hidden ~ #main-content-area {
            margin-left: 80px !important; /* Lebar ikon + padding */
        }

        /* Styling untuk burger menu di dalam navbar */
        .burger-menu-icon {
            display: none; /* Default hidden */
        }

        @media (min-width: 768px) { /* md breakpoint */
            .burger-menu-icon {
                display: block; /* Show on desktop */
            }
        }
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-gray-900 text-white p-5 min-h-screen flex flex-col fixed h-full z-20 shadow-xl
                                   transform -translate-x-full md:translate-x-0 transition-all duration-300 ease-in-out">
            <h2 class="text-3xl font-extrabold mb-8 text-center py-4 border-b border-gray-700 text-yellow-400">
                Alumni Panel
            </h2>

            <ul class="space-y-3 flex-grow">
                <li>
                    <a href="{{ route('alumni.dashboard') }}"
                        class="sidebar-link flex items-center p-3 rounded-lg transition-colors duration-200
                                {{ request()->routeIs('alumni.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home mr-3 text-lg w-6 text-center"></i>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/alumni/profile"
                        class="sidebar-link flex items-center p-3 rounded-lg transition-colors duration-200
                                {{ request()->is('alumni/profile') || request()->is('alumni/profile/edit') ? 'active' : '' }}">
                        <i class="fas fa-user-circle mr-3 text-lg w-6 text-center"></i>
                        <span class="sidebar-text">Profil Saya</span>
                    </a>
                </li>
                <li>
                    <a href="/alumni/directory"
                        class="sidebar-link flex items-center p-3 rounded-lg transition-colors duration-200
                                {{ request()->is('alumni/directory') || request()->is('alumni/directory/*') ? 'active' : '' }}">
                        <i class="fas fa-users mr-3 text-lg w-6 text-center"></i>
                        <span class="sidebar-text">Direktori Alumni</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('alumni.events.index') }}"
                        class="sidebar-link flex items-center p-3 rounded-lg transition-colors duration-200
                                {{ request()->routeIs('alumni.events.index') || request()->routeIs('alumni.events.show') ? 'active' : '' }}">
                        <i class="fas fa-calendar-alt mr-3 text-lg w-6 text-center"></i>
                        <span class="sidebar-text">Acara</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('alumni.blogs.index') }}"
                        class="sidebar-link flex items-center p-3 rounded-lg transition-colors duration-200
                                {{ request()->routeIs('alumni.blogs.index') || request()->routeIs('alumni.blogs.show') ? 'active' : '' }}">
                        <i class="fas fa-blog mr-3 text-lg w-6 text-center"></i>
                        <span class="sidebar-text">Blog</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('alumni.announcements.index') }}"
                        class="sidebar-link flex items-center p-3 rounded-lg transition-colors duration-200
                                {{ request()->routeIs('alumni.announcements.index') || request()->routeIs('alumni.announcements.show') ? 'active' : '' }}">
                        <i class="fas fa-bullhorn mr-3 text-lg w-6 text-center"></i>
                        <span class="sidebar-text">Pengumuman</span>
                    </a>
                </li>
            </ul>

            <div class="mt-auto pt-4 border-t border-gray-700">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();"
                   class="bg-red-600 text-white px-5 py-2 rounded-full shadow-md font-semibold text-base w-full text-center
                          transition-all duration-300 transform hover:bg-red-700 hover:scale-105
                          flex items-center justify-center group">
                    <i class="fas fa-sign-out-alt mr-2 transition-transform duration-300 group-hover:rotate-6"></i>
                    <span class="sidebar-text">Logout</span>
                </a>
            </div>
        </aside>

        <!-- Overlay for mobile sidebar -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-10 hidden md:hidden"></div>

        <!-- Main Content Area -->
        <div id="main-content-area" class="flex-1 flex flex-col md:ml-64 transition-all duration-300 ease-in-out">
            <!-- Top Navigation -->
            <nav class="bg-gray-900 shadow-xl p-4 md:px-8 flex justify-between items-center w-full">
                <!-- Logo atau Nama Aplikasi -->
                <div class="flex items-center">
                    <!-- Burger menu for desktop -->
                    <button id="sidebar-toggle-desktop" class="burger-menu-icon p-2 text-white rounded-full hover:bg-gray-700 mr-4 transition-colors duration-200">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <a href="#" class="text-white text-2xl font-bold tracking-tight transform transition-transform duration-300 hover:scale-105">
                        <i class="fas fa-graduation-cap text-yellow-400 mr-3"></i> AlumniConnect
                    </a>
                </div>

                <!-- Informasi Pengguna dan Tombol Logout -->
                <div class="flex items-center space-x-6">
                    <span class="text-gray-200 text-lg font-medium hidden sm:block">
                        Selamat Datang, <span class="text-yellow-400 font-semibold">{{ Auth::user()->name ?? 'Alumni' }}</span>
                    </span>

                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-navbar').submit();"
                       class="bg-red-600 text-white px-5 py-2 rounded-full shadow-md font-semibold text-base
                                  transition-all duration-300 transform hover:bg-red-700 hover:scale-105
                                  flex items-center group">
                        <i class="fas fa-sign-out-alt mr-2 transition-transform duration-300 group-hover:rotate-6"></i>
                        Logout
                    </a>
                    <form id="logout-form-navbar" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="flex-1 p-6 bg-gray-100">
                @yield('content')
            </main>
        </div>

        <!-- Hidden Logout Forms (untuk sidebar dan navbar) -->
        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
        <form id="logout-form-navbar" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>

    <!-- Mobile Menu Toggle Button (Burger menu di pojok kanan bawah untuk mobile) -->
    <div class="md:hidden fixed bottom-4 right-4 z-30">
        <button id="mobile-menu-toggle" class="p-3 bg-gray-900 text-white rounded-full shadow-lg transition-all duration-300 transform hover:scale-110">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContentArea = document.getElementById('main-content-area');
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const sidebarToggleDesktop = document.getElementById('sidebar-toggle-desktop');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        // Fungsi untuk menyembunyikan/menampilkan teks sidebar dan menyesuaikan lebar
        function toggleSidebarText(hide) {
            document.querySelectorAll('.sidebar-text').forEach(span => {
                if (hide) {
                    span.classList.add('hidden');
                } else {
                    span.classList.remove('hidden');
                }
            });
            if (hide) {
                sidebar.classList.remove('w-64', 'p-5');
                sidebar.classList.add('w-20', 'px-2');
                mainContentArea.classList.remove('md:ml-64');
                mainContentArea.classList.add('md:ml-20');
                sidebar.classList.add('sidebar-hidden');
                sidebar.querySelector('h2').classList.add('hidden');
            } else {
                sidebar.classList.remove('w-20', 'px-2');
                sidebar.classList.add('w-64', 'p-5');
                mainContentArea.classList.remove('md:ml-20');
                mainContentArea.classList.add('md:ml-64');
                sidebar.classList.remove('sidebar-hidden');
                sidebar.querySelector('h2').classList.remove('hidden');
            }
        }

        // Fungsi untuk menutup sidebar mobile dan overlay
        function closeMobileSidebar() {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Mobile menu toggle functionality
        mobileMenuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
            toggleSidebarText(false); // Pastikan sidebar dalam mode teks penuh saat dibuka di mobile
        });

        // Desktop sidebar toggle functionality (burger menu)
        sidebarToggleDesktop.addEventListener('click', function() {
            const isSidebarHidden = sidebar.classList.contains('sidebar-hidden');
            toggleSidebarText(!isSidebarHidden);
        });

        // Close sidebar when clicking on a link (mobile)
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 768) {
                    closeMobileSidebar();
                }
            });
        });

        // Close sidebar when clicking on overlay (mobile)
        sidebarOverlay.addEventListener('click', function() {
            closeMobileSidebar();
        });

        // Pastikan sidebar tersembunyi di mobile saat halaman dimuat
        window.addEventListener('load', () => {
            if (window.innerWidth < 768) {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            }
        });

        // Handle resize: sembunyikan sidebar di mobile jika di-resize ke desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                if (!sidebar.classList.contains('sidebar-hidden')) {
                     toggleSidebarText(false);
                }
            } else {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                toggleSidebarText(false);
            }
        });
    </script>
</body>

</html>
