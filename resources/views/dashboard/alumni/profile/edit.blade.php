@extends('layouts.alumnidashboard')

@section('content')
<div class="container mx-auto px-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">Edit Your Profile</h2>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-3 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('alumni.profile.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <!-- Phone -->
        <div class="mb-4">
            <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', optional($user->alumniProfile)->phone ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Address -->
        <div class="mb-4">
            <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
            <input type="text" name="address" id="address" value="{{ old('address', optional($user->alumniProfile)->address ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Graduation Year -->
        <div class="mb-4">
            <label for="graduation_year" class="block text-gray-700 text-sm font-bold mb-2">Graduation Year</label>
            <input type="text" name="graduation_year" id="graduation_year" value="{{ old('graduation_year', optional($user->alumniProfile)->graduation_year ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Bio -->
        <div class="mb-4">
            <label for="bio" class="block text-gray-700 text-sm font-bold mb-2">Bio</label>
            <textarea name="bio" id="bio" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('bio', optional($user->alumniProfile)->bio ?? '') }}</textarea>
        </div>

        <!-- Profile Image -->
        <div class="mb-4">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Profile Image</label>
            <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @if (optional($user->alumniProfile)->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . optional($user->alumniProfile)->image) }}" class="w-32 h-32 object-cover rounded-full" alt="Current Profile Image">
                </div>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Profile
            </button>
        </div>
    </form>
</div>
@endsection
