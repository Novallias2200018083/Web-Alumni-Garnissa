<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    {{-- Logo/Nama Aplikasi: Sesuaikan dengan rute dashboard berdasarkan peran user --}}
                    <a href="{{
                        Auth::check() && Auth::user()->role === 'admin' ? route('admin.dashboard') :
                        (Auth::check() && Auth::user()->role === 'alumni' ? route('alumni.dashboard') : '/')
                    }}">
                        <span class="text-xl font-bold text-yellow-500">ALUMNI SMA 1 PMG</span> 
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- Navigasi untuk Pengguna Terautentikasi (Admin/Alumni) --}}
                    @auth
                        @if(Auth::user()->role === 'admin')
                            {{-- Nav Link untuk Admin --}}
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                {{ __('Beranda Admin') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                                {{ __('Manajemen User') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.index')">
                                {{ __('Manajemen Event') }}
                            </x-nav-link>
                             <x-nav-link :href="route('admin.registrations.index')" :active="request()->routeIs('admin.registrations.index')">
                                {{ __('Semua Pendaftar') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.blogs.index')" :active="request()->routeIs('admin.blogs.index')">
                                {{ __('Manajemen Blog') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.announcements.index')" :active="request()->routeIs('admin.announcements.index')">
                                {{ __('Manajemen Pengumuman') }}
                            </x-nav-link>
                             <x-nav-link :href="route('about.index')" :active="request()->routeIs('about.index')">
                                {{ __('About Us') }}
                            </x-nav-link>

                        @elseif(Auth::user()->role === 'alumni')
                            {{-- Nav Link untuk Alumni --}}
                            <x-nav-link :href="route('alumni.dashboard')" :active="request()->routeIs('alumni.dashboard')">
                                {{ __('Beranda') }}
                            </x-nav-link>
                            <x-nav-link :href="route('alumni.profile.show')" :active="request()->routeIs('alumni.profile.show')">
                                {{ __('Profil Saya') }}
                            </x-nav-link>
                            <x-nav-link :href="route('alumni.directory.index')" :active="request()->routeIs('alumni.directory.index')">
                                {{ __('Direktori Alumni') }}
                            </x-nav-link>
                            <x-nav-link :href="route('alumni.events.index')" :active="request()->routeIs('alumni.events.index')">
                                {{ __('Event Alumni') }}
                            </x-nav-link>
                            <x-nav-link :href="route('alumni.blogs.index')" :active="request()->routeIs('alumni.blogs.index')">
                                {{ __('Blog Alumni') }}
                            </x-nav-link>
                            <x-nav-link :href="route('alumni.announcements.index')" :active="request()->routeIs('alumni.announcements.index')">
                                {{ __('Pengumuman Alumni') }}
                            </x-nav-link>
                        @endif
                    @else
                        {{-- Navigasi untuk Tamu (belum login) --}}
                        <x-nav-link :href="route('blogs.front')" :active="request()->routeIs('blogs.front')">
                            {{ __('Berita') }}
                        </x-nav-link>
                        <x-nav-link :href="route('events.front')" :active="request()->routeIs('events.front')">
                            {{ __('Acara') }}
                        </x-nav-link>
                        <x-nav-link :href="route('announcements.front')" :active="request()->routeIs('announcements.front')">
                            {{ __('Pengumuman') }}
                        </x-nav-link>
                        <x-nav-link :href="route('about.front')" :active="request()->routeIs('about.front')">
                            {{ __('Tentang Kami') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            {{-- Dropdown Profile --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:text-gray-900 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @if(Auth::user()->role === 'alumni')
                                <x-dropdown-link :href="route('alumni.profile.show')">
                                    {{ __('Profil Saya') }}
                                </x-dropdown-link>
                            @else
                                {{-- Default profile link for admin, or if no specific profile route --}}
                                <x-dropdown-link :href="route('profile.edit')"> {{-- Ini biasanya rute default Breeze --}}
                                    {{ __('Profil') }}
                                </x-dropdown-link>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Keluar') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    {{-- Tombol Login/Register untuk Tamu --}}
                    <div class="flex items-center">
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Register</a>
                        @endif
                    </div>
                @endauth
            </div>

            {{-- Hamburger --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Responsive Navigation --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if(Auth::user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Beranda Admin') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                        {{ __('Manajemen User') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.index')">
                        {{ __('Manajemen Event') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.registrations.index')" :active="request()->routeIs('admin.registrations.index')">
                        {{ __('Semua Pendaftar') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.blogs.index')" :active="request()->routeIs('admin.blogs.index')">
                        {{ __('Manajemen Blog') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.announcements.index')" :active="request()->routeIs('admin.announcements.index')">
                        {{ __('Manajemen Pengumuman') }}
                    </x-responsive-nav-link>
                     <x-responsive-nav-link :href="route('about.index')" :active="request()->routeIs('about.index')">
                        {{ __('About Us') }}
                    </x-responsive-nav-link>

                @elseif(Auth::user()->role === 'alumni')
                    <x-responsive-nav-link :href="route('alumni.dashboard')" :active="request()->routeIs('alumni.dashboard')">
                        {{ __('Beranda') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('alumni.profile.show')" :active="request()->routeIs('alumni.profile.show')">
                        {{ __('Profil Saya') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('alumni.directory.index')" :active="request()->routeIs('alumni.directory.index')">
                        {{ __('Direktori Alumni') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('alumni.events.index')" :active="request()->routeIs('alumni.events.index')">
                        {{ __('Event Alumni') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('alumni.blogs.index')" :active="request()->routeIs('alumni.blogs.index')">
                        {{ __('Blog Alumni') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('alumni.announcements.index')" :active="request()->routeIs('alumni.announcements.index')">
                        {{ __('Pengumuman Alumni') }}
                    </x-responsive-nav-link>
                @endif
            @else
                {{-- Navigasi Responsive untuk Tamu (belum login) --}}
                <x-responsive-nav-link :href="route('blogs.front')" :active="request()->routeIs('blogs.front')">
                    {{ __('Berita') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('events.front')" :active="request()->routeIs('events.front')">
                    {{ __('Acara') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('announcements.front')" :active="request()->routeIs('announcements.front')">
                    {{ __('Pengumuman') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('about.front')" :active="request()->routeIs('about.front')">
                    {{ __('Tentang Kami') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    @if(Auth::user()->role === 'alumni')
                        <x-responsive-nav-link :href="route('alumni.profile.show')">
                            {{ __('Profil Saya') }}
                        </x-responsive-nav-link>
                    @else
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profil') }}
                        </x-responsive-nav-link>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Keluar') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                {{-- Responsive Login/Register Links for Guests --}}
                <div class="space-y-1 px-4">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    @if (Route::has('register'))
                        <x-responsive-nav-link :href="route('register')">
                            {{ __('Register') }}
                        </x-responsive-nav-link>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>