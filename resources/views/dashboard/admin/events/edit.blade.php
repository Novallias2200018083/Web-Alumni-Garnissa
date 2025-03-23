@extends('layouts.alumnidashboard')

@section('content')
<div class="container mx-auto px-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">Edit Event</h2>
    
    <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700">Title</label>
            <input type="text" name="title" value="{{ old('title', $event->title) }}" class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700">Description</label>
            <textarea name="description" class="w-full p-2 border border-gray-300 rounded mt-1">{{ old('description', $event->description) }}</textarea>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700">Event Date</label>
            <input type="date" name="event_date" value="{{ old('event_date', $event->event_date) }}" class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700">Event Image</label>
            <input type="file" name="image" class="w-full p-2 border border-gray-300 rounded mt-1">
            @if($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" class="mt-2 w-32 rounded">
            @endif
        </div>
        
        <div class="mt-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Event</button>
        </div>
    </form>
</div>
@endsection
