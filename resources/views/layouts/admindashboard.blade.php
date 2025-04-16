<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-red-600 text-white p-5 min-h-screen">
            <h2 class="text-xl font-bold mb-6">Admin Dashboard</h2>
            <ul class="space-y-4">
                <li><a href="{{ route('admin.dashboard') }}" class="block p-3 rounded-lg hover:bg-red-500">
                        <i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="{{ route('users.index') }}" class="block p-3 rounded-lg hover:bg-red-500">
                        <i class="fas fa-users"></i> Users</a></li>
                <li><a href="{{ route('about.index') }}" class="block p-3 rounded-lg hover:bg-red-500">
                        <i class="fas fa-info-circle"></i> Manage About Us
                    </a></li>

                <li><a href="/admin/blogs" class="block p-3 rounded-lg hover:bg-red-500"> <i
                            class="fas fa-blog mr-2"></i> Blogs</a></li>
                <li><a href="{{ route('events.index') }}" class="block p-3 rounded-lg hover:bg-red-500">
                        <i class="fas fa-calendar"></i> Events</a></li>
                <li><a href="/admin/announcements" class="block p-3 rounded-lg hover:bg-red-500"> <i
                            class="fas fa-bullhorn"></i> Announcements</a></li>
            </ul>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <nav class="bg-white shadow-md p-4 text-black">
                <div class="container mx-auto flex justify-between items-center">
                    <h1 class="text-lg font-semibold">Welcome, Admin</h1>
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

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('hidden');
        });
        document.getElementById('profile-dropdown').addEventListener('click', function () {
            document.getElementById('dropdown-menu').classList.toggle('hidden');
        });
    </script>
</body>

</html>