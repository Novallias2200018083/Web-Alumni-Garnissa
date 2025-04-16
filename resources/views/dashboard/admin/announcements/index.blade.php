@extends('layouts.admindashboard')

@section('content')
<div class="container mx-auto px-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">All Announcements</h2>
        <a href="{{ route('announcements.create') }}" 
           class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow">
            + Add Announcement
        </a>
    </div>

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

    <div class="grid md:grid-cols-3 gap-6 mt-6">
        @foreach ($announcements as $announcement)
        <div class="bg-white rounded-xl shadow-lg p-4">
            <h3 class="text-xl font-semibold text-gray-800">{{ $announcement->title }}</h3>
            <p class="text-gray-600">{!! strip_tags($announcement->description) !!}</p>
            <p class="text-gray-500 text-sm">
                <i class="fas fa-calendar-alt text-red-500 mr-1"></i>
                {{ $announcement->published_at ? \Carbon\Carbon::parse($announcement->published_at)->format('M d, Y') : 'Not Published' }}
            </p>
            <p class="text-sm text-gray-500">
                Status: 
                <span class="{{ $announcement->is_active ? 'text-green-500' : 'text-red-500' }}">
                    {{ $announcement->is_active ? 'Active' : 'Inactive' }}
                </span>
            </p>

            <div class="flex justify-between mt-4">
                <a href="{{ route('announcements.edit', $announcement->id) }}" class="text-blue-600 hover:underline">Edit</a>
                <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    {{ $announcements->links() }}
</div>
@endsection
