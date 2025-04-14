@extends('layouts.admindashboard')

@section('content')
<h2 class="text-xl font-bold mb-4">All Users</h2>

<a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add New User</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table-auto w-full border-collapse">
    <thead>
        <tr class="bg-gray-100">
            <th class="p-2 border">#</th>
            <th class="p-2 border">Name</th>
            <th class="p-2 border">Email</th>
            <th class="p-2 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td class="p-2 border">{{ $loop->iteration }}</td>
            <td class="p-2 border">{{ $user->name }}</td>
            <td class="p-2 border">{{ $user->email }}</td>
            <td class="p-2 border">
                <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500">Edit</a> |
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-500">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
