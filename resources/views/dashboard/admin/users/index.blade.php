@extends('layouts.admindashboard')

@section('content')
<div class="container mx-auto px-6 py-8">
    {{-- Header Bagian --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-4 sm:mb-0">Daftar Pengguna</h2>
        <a href="{{ route('users.create') }}"
           class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-full shadow-lg
                  hover:bg-green-700 transition duration-300 transform hover:scale-105">
            <i class="fas fa-plus-circle mr-2"></i> Tambah Pengguna Baru
        </a>
    </div>

    {{-- SweetAlert2 untuk Notifikasi --}}
    @if(session('success'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK",
                confirmButtonColor: "#3085d6"
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK",
                confirmButtonColor: "#d33"
            });
        </script>
    @endif

    {{-- Search and Filter Section --}}
    <form action="{{ route('users.index') }}" method="GET" class="mb-8 p-6 bg-white rounded-lg shadow-md flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 md:space-x-4">
        <div class="flex-grow w-full md:w-auto">
            <label for="search" class="sr-only">Cari Pengguna</label>
            <div class="relative">
                <input type="text" name="search" id="search" placeholder="Cari nama, email, atau ID Siswa..."
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500"
                       value="{{ request('search') }}">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
        </div>

        <div class="w-full md:w-auto">
            <label for="role" class="sr-only">Filter Peran</label>
            <select name="role" id="role"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500">
                <option value="">Semua Peran</option>
                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Pengguna Biasa</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="alumni" {{ request('role') == 'alumni' ? 'selected' : '' }}>Alumni</option>
            </select>
        </div>

        <div class="w-full md:w-auto">
            <label for="major_id" class="sr-only">Filter Jurusan</label>
            <select name="major_id" id="major_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500">
                <option value="">Semua Jurusan</option>
                @foreach($majors as $major)
                    <option value="{{ $major->id }}" {{ request('major_id') == $major->id ? 'selected' : '' }}>
                        {{ $major->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- New Graduation Year Filter --}}
        <div class="w-full md:w-auto">
            <label for="graduation_year" class="sr-only">Filter Tahun Angkatan</label>
            <select name="graduation_year" id="graduation_year"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-yellow-500 focus:border-yellow-500">
                <option value="">Semua Tahun Angkatan</option>
                @foreach($graduationYears as $year)
                    <option value="{{ $year }}" {{ request('graduation_year') == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex space-x-4 w-full md:w-auto justify-center md:justify-end">
            <button type="submit"
                    class="px-6 py-2 bg-yellow-600 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-700 transition duration-300">
                Filter
            </button>
            @if(request('search') || request('role') || request('major_id') || request('graduation_year'))
                <a href="{{ route('users.index') }}"
                   class="px-6 py-2 bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md hover:bg-gray-400 transition duration-300">
                    Reset
                </a>
            @endif
        </div>
    </form>
    {{-- End Search and Filter Section --}}

    {{-- Tabel Pengguna dalam Card --}}
    <div class="bg-white rounded-lg shadow-xl overflow-hidden">
        <div class="overflow-x-auto"> {{-- Membuat tabel responsif dengan scroll horizontal --}}
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider rounded-tl-lg">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            ID Mahasiswa
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Jurusan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Tahun Angkatan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Peran
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider rounded-tr-lg">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors duration-200 ease-in-out">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                            {{ $user->student_id ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                            {{ $user->major->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                            {{ $user->alumniProfile->graduation_year ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : ($user->role === 'alumni' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex items-center justify-center space-x-3">
                                <a href="{{ route('users.show', $user->id) }}"
                                   class="text-gray-600 hover:text-gray-800 transition-colors duration-200"
                                   title="Lihat Detail">
                                    <i class="fas fa-eye text-lg"></i>
                                </a>
                                <a href="{{ route('users.edit', $user->id) }}"
                                   class="text-blue-600 hover:text-blue-800 transition-colors duration-200"
                                   title="Edit Pengguna">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete(event);">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 transition-colors duration-200"
                                            title="Hapus Pengguna">
                                        <i class="fas fa-trash-alt text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            Tidak ada pengguna ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination Links --}}
    <div class="mt-8 flex justify-center">
        {{ $users->links() }}
    </div>
</div>

{{-- Script untuk SweetAlert2 konfirmasi hapus --}}
<script>
    function confirmDelete(event) {
        event.preventDefault(); // Mencegah form submit secara default
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit(); // Jika dikonfirmasi, submit form
            }
        });
        return false; // Mengembalikan false untuk mencegah submit ganda
    }
</script>
@endsection
