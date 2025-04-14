@extends('layouts.admindashboard')

@section('content')
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Create New Announcement</h2>

        <form action="{{ route('announcements.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title</label>
                <input type="text" id="title" name="title" class="w-full p-2 border rounded" value="{{ old('title') }}"
                    required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea id="description" name="description" class="w-full p-2 border rounded" rows="5"
                    required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="published_at" class="block text-gray-700">Published Date (Optional)</label>
                <input type="date" id="published_at" name="published_at" class="w-full p-2 border rounded"
                    value="{{ old('published_at') }}">
            </div>

            <div class="mb-4">
                <label for="is_active" class="block text-gray-700 text-sm font-bold mb-2">Active</label>

                <!-- Hidden input to ensure a value is always sent -->
                <input type="hidden" name="is_active" value="0">

                <!-- Checkbox that overrides the hidden input if checked -->
                <input type="checkbox" name="is_active" id="is_active" class="rounded" value="1" {{ old('is_active', true) ? 'checked' : '' }}>

                <span class="text-gray-600 text-sm">Check to make the announcement active</span>
            </div>


            <div class="mb-4">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow">
                    Save Announcement
                </button>
            </div>
        </form>
    </div>
@endsection