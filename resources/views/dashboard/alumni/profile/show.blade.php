@extends('layouts.alumnidashboard')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Your Profile</h1>

        @if(session('success'))
            <script>
                Swal.fire({
                    title: "Success!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            </script>
        @endif

        <!-- Profile Card -->
        <div class="bg-white shadow-xl rounded-lg overflow-hidden max-w-4xl mx-auto border border-gray-200">
            <div class="flex">
                <!-- Profile Picture -->
                <div class="w-1/3 bg-gray-100 p-6 flex justify-center items-center">
                    <img src="{{ optional($user->alumniProfile)->image ? asset('storage/' . $user->alumniProfile->image) : 'https://images.pexels.com/photos/7944131/pexels-photo-7944131.jpeg?auto=compress&cs=tinysrgb&w=600' }}"
                        class="w-40 h-40 object-cover rounded-full border-4 border-indigo-500 shadow-md"
                        alt="Profile Image">

                </div>

                <!-- Profile Details -->
                <div class="w-2/3 p-8">
                    <h3 class="text-2xl font-semibold text-rose-800 mb-4">Basic Information</h3>
                    <p class="text-gray-700 mb-3 text-lg"><strong>Name:</strong> {{ $user->name }}</p>
                    <p class="text-gray-700 mb-3 text-lg"><strong>Email:</strong> {{ $user->email }}</p>

                    <h3 class="text-2xl font-semibold text-rose-800 mt-6 mb-4">Alumni Profile</h3>
                    <p class="text-gray-700 mb-3 text-lg"><strong>Phone:</strong>
                        {{ $user->alumniProfile->phone ?? 'Not provided' }}</p>
                    <p class="text-gray-700 mb-3 text-lg"><strong>Address:</strong>
                        {{ $user->alumniProfile->address ?? 'Not provided' }}</p>
                    <p class="text-gray-700 mb-3 text-lg"><strong>Graduation Year:</strong>
                        {{ $user->alumniProfile->graduation_year ?? 'Not provided' }}</p>
                    <p class="text-gray-700 mb-6 text-lg"><strong>Bio:</strong>
                        {{ $user->alumniProfile->bio ?? 'Not provided' }}</p>

                    <!-- Edit Button -->
                    <a href="{{ route('alumni.profile.edit') }}"
                        class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection