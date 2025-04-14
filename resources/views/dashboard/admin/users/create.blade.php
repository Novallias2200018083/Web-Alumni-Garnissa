@extends('layouts.admindashboard')

@section('content')
<h2 class="text-xl font-bold mb-4">Add New User</h2>

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

    <button type="submit" class="bg-blue-500 text-white px-4 py-2">Send Invite</button>
</form>
@endsection
