<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni IST</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.2.2/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">

    
</head>

<body>
<nav class="bg-white py-4">
    <div class="container mx-auto flex justify-between items-center px-4">
        <!-- Logo -->
        <a href="#" class="text-3xl text-[#E82929] font-bold no-underline px-5 hover:text-black transition duration-300">
            Alumni IST
        </a>

        <!-- Navigation Links Centered with a Slight Shift to the Right -->
        <ul class="hidden md:flex space-x-5  ml-auto mr-10">
            <li><a href="/" class="no-underline relative text-black  after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#E82929] after:transition-all after:duration-300 hover:after:w-full">Home</a></li>
            <li><a href="/about" class="no-underline relative text-black  after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#E82929] after:transition-all after:duration-300 hover:after:w-full">About</a></li>
            <li><a href="/events" class="no-underline relative text-black  after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#E82929] after:transition-all after:duration-300 hover:after:w-full">Events</a></li>
            <li><a href="/blog" class="no-underline relative text-black  after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#E82929] after:transition-all after:duration-300 hover:after:w-full">Blog</a></li>
            <li><a href="/contact" class="no-underline relative text-black after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#E82929] after:transition-all after:duration-300 hover:after:w-full">Contact</a></li>
        </ul>

        <!-- Login & Register Buttons with Rounded Style -->
        <div class="hidden md:flex space-x-4 mr-10 ">
            <a href="/login" class="px-6 py-2 bg-[#E82929] text-white rounded-full transition duration-300 hover:opacity-90">
                Login
            </a>
            <a href="/register" class="px-6 py-2 border-2 border-[#E82929] text-[#E82929] rounded-full transition duration-300 ">
                Register
            </a>
        </div>
    </div>
</nav>







    <main>
        @yield('content')
    </main>

    <footer>
        <!-- <p>&copy; {{ date('Y') }} Alumni Network. All rights reserved.</p> -->
    </footer>
</body>
</html>
