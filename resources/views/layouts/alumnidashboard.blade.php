<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-rose-500 text-white p-5 min-h-screen">
            <h2 class="text-xl font-bold mb-6">Alumni Dashboard</h2>
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('alumni.dashboard') }}"
                        class="block p-3 rounded-lg hover:bg-rose-400 transition-colors duration-200">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="/alumni/profile"
                        class="block p-3 rounded-lg hover:bg-rose-400 transition-colors duration-200">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>
                </li>
              
                <li>
                    <a href="/alumni/events"
                        class="block p-3 rounded-lg hover:bg-rose-400 transition-colors duration-200">
                        <i class="fas fa-calendar-alt mr-2"></i> Events
                    </a>
                </li>
                <li>
                    <a href="/alumni/blogs"
                        class="block p-3 rounded-lg hover:bg-rose-400 transition-colors duration-200">
                        <i class="fas fa-blog mr-2"></i> Blogs
                    </a>
                </li>
                <li>
                    <a href="/alumni/announcements"
                        class="block p-3 rounded-lg hover:bg-rose-400 transition-colors duration-200">
                        <i class="fas fa-bullhorn mr-2"></i> Announcements
                    </a>
                </li>


            </ul>
        </aside>


        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <nav class="bg-white shadow-md p-4 text-black">
                <div class="container mx-auto flex justify-between items-center">
                    <h1 class="text-lg font-semibold">Welcome, Alumni</h1>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>