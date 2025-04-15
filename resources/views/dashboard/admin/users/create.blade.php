@extends('layouts.admindashboard')

@section('content')
<h2 class="text-xl font-bold mb-4">Add New User</h2>

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('users.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label class="block font-semibold">Name</label>
        <input type="text" name="name" class="w-full border p-2" required>
    </div>

    <div>
        <label class="block font-semibold">Email</label>
        <input type="email" name="email" class="w-full border p-2" required>
    </div>

    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Send Invite</button>
</form>
@endsection
