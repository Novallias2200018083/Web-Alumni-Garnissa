@extends('layouts.admindashboard') {{-- Menggunakan layout admin --}}

@section('content')
{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mx-auto px-6 py-8">
    {{-- Header Bagian --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-4 sm:mb-0">Manajemen Jurusan</h2>
        <a href="{{ route('majors.create') }}"
           class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-full shadow-lg
                  hover:bg-green-700 transition duration-300 transform hover:scale-105">
            <i class="fas fa-plus-circle mr-2"></i> Tambah Jurusan Baru
        </a>
    </div>

    {{-- SweetAlert2 untuk Notifikasi --}}
    @if (session('success'))
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
    @if (session('error'))
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

    @if($majors->isEmpty())
        <div class="bg-white shadow-lg rounded-xl p-8 text-center mt-10">
            <p class="text-gray-500 text-xl font-medium">Belum ada jurusan yang terdaftar.</p>
            <p class="text-gray-400 mt-2">Mulai dengan menambahkan jurusan baru untuk mengelola data alumni.</p>
        </div>
    @else
        <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">
            <div class="overflow-x-auto"> {{-- Membuat tabel responsif dengan scroll horizontal --}}
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider rounded-tl-lg">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Nama Jurusan
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Deskripsi
                            </th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider rounded-tr-lg">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($majors as $major)
                            <tr class="hover:bg-gray-50 transition-colors duration-200 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $major->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                    {{ $major->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 max-w-xs truncate" title="{{ $major->description }}">
                                    {{ Str::limit($major->description, 70) ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center space-x-3">
                                        <a href="{{ route('majors.edit', $major->id) }}"
                                           class="text-blue-600 hover:text-blue-800 transition-colors duration-200"
                                           title="Edit Jurusan">
                                            <i class="fas fa-edit text-lg"></i>
                                        </a>
                                        <form action="{{ route('majors.destroy', $major->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete(event);">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-800 transition-colors duration-200"
                                                    title="Hapus Jurusan">
                                                <i class="fas fa-trash-alt text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination Links --}}
        <div class="mt-8 flex justify-center">
            {{ $majors->links() }}
        </div>
    @endif
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
