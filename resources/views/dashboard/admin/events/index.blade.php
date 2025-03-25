@extends('layouts.admindashboard')

@section('content')
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">My Events</h2>

        <a href="{{ route('events.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create Event</a>

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
            @foreach ($events as $event)
                <div class="bg-white rounded-xl shadow-lg p-4 flex flex-col h-full">
                    @if ($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" class="rounded-lg mb-3 w-full h-48 object-cover">
                    @endif
                    <h3 class="text-xl font-semibold text-gray-800">{{ $event->title }}</h3>
                    <p class="text-gray-600 flex-grow">{{ Str::limit($event->description, 100) }}</p>
                    <p class="text-gray-500"><i class="fas fa-calendar-alt text-red-500"></i> {{ $event->event_date }}</p>

                    <div class="flex justify-between mt-auto">
                        <a href="{{ route('events.edit', $event) }}" class="text-yellow-500">Edit</a>
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>


        {{ $events->links() }}
    </div>
@endsection