

@extends('layouts.website')  

@section('content')  
<div class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">All Alumni Profiles</h1>

    @if($users->isEmpty())
        <p class="text-center text-lg text-gray-500">No alumni profiles available.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($users as $user)
                <div class="bg-white shadow-xl rounded-lg overflow-hidden max-w-xs mx-auto border border-gray-200">
                    <div class="flex">
                        <!-- Profile Picture -->
                        <div class="w-1/3 bg-gray-100 p-6 flex justify-center items-center">
                            <img src="{{ optional($user->alumniProfile)->image ? asset('storage/' . $user->alumniProfile->image) : 'https://images.pexels.com/photos/7944131/pexels-photo-7944131.jpeg?auto=compress&cs=tinysrgb&w=600' }}"
                                class="w-40 h-40 object-cover rounded-full border-4 border-indigo-500 shadow-md"
                                alt="Profile Image">
                        </div>

                        <!-- Profile Details -->
                        <div class="w-2/3 p-8">
                            <h3 class="text-2xl font-semibold text-rose-800 mb-4">{{ $user->name }}</h3>
                            <p class="text-gray-700 mb-3 text-lg"><strong>Email:</strong> {{ $user->email }}</p>
                            @if($user->alumniProfile)
                                <p class="text-gray-700 mb-3 text-lg"><strong>Phone:</strong> {{ $user->alumniProfile->phone ?? 'Not provided' }}</p>
                                <p class="text-gray-700 mb-3 text-lg"><strong>Address:</strong> {{ $user->alumniProfile->address ?? 'Not provided' }}</p>
                                <p class="text-gray-700 mb-3 text-lg"><strong>Graduation Year:</strong> {{ $user->alumniProfile->graduation_year ?? 'Not provided' }}</p>
                                <p class="text-gray-700 mb-6 text-lg"><strong>Bio:</strong> {{ $user->alumniProfile->bio ?? 'Not provided' }}</p>
                            @else
                                <p class="text-gray-700 mb-3 text-lg">No alumni profile available</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
