@extends('layouts.admindashboard')

@section('content')
<h2 class="text-xl font-bold mb-4">Edit User</h2>

<form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block font-semibold">Name</label>
        <input type="text" name="name" value="{{ $user->name }}" class="w-full border p-2" required>
    </div>

    <div>
        <label class="block font-semibold">Email</label>
        <input type="email" name="email" value="{{ $user->email }}" class="w-full border p-2" required>
    </div>

    <button type="submit" class="bg-green-500 text-white px-4 py-2">Update User</button>
</form>
@endsection
