@extends('layouts.alumnidashboard')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Edit Profil Alumni</h1>

    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "Sukses!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        </script>
    @endif
    @if(session('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK"
            });
        </script>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6 max-w-4xl mx-auto" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">Ada beberapa masalah dengan input Anda:</span>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('alumni.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-xl rounded-lg p-8 max-w-4xl mx-auto border border-gray-200">
        @csrf
        @method('PUT') {{-- Menggunakan PUT untuk update --}}

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                       class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror" required>
                @error('name')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                       class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror" required>
                @error('email')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', optional($user->alumniProfile)->phone ?? '') }}"
                       class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('phone') border-red-500 @enderror">
                @error('phone')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
                <input type="text" name="address" id="address" value="{{ old('address', optional($user->alumniProfile)->address ?? '') }}"
                       class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('address') border-red-500 @enderror">
                @error('address')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="major_id" class="block text-gray-700 text-sm font-bold mb-2">Jurusan</label>
                <select name="major_id" id="major_id"
                        class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('major_id') border-red-500 @enderror" required>
                    <option value="">Pilih Jurusan</option>
                    @foreach($majors as $major)
                        <option value="{{ $major->id }}" {{ old('major_id', $user->major_id) == $major->id ? 'selected' : '' }}>
                            {{ $major->name }}
                        </option>
                    @endforeach
                </select>
                @error('major_id')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="graduation_year" class="block text-gray-700 text-sm font-bold mb-2">Tahun Angkatan Lulus</label>
                <select name="graduation_year" id="graduation_year"
                        class="form-select w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('graduation_year') border-red-500 @enderror" required>
                    <option value="">Pilih Tahun</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ old('graduation_year', optional($user->alumniProfile)->graduation_year) == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
                @error('graduation_year')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="current_job" class="block text-gray-700 text-sm font-bold mb-2">Pekerjaan Saat Ini</label>
                <input type="text" name="current_job" id="current_job" value="{{ old('current_job', optional($user->alumniProfile)->current_job ?? '') }}"
                       class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('current_job') border-red-500 @enderror">
                @error('current_job')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="company" class="block text-gray-700 text-sm font-bold mb-2">Perusahaan</label>
                <input type="text" name="company" id="company" value="{{ old('company', optional($user->alumniProfile)->company ?? '') }}"
                       class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('company') border-red-500 @enderror">
                @error('company')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="position" class="block text-gray-700 text-sm font-bold mb-2">Posisi</label>
                <input type="text" name="position" id="position" value="{{ old('position', optional($user->alumniProfile)->position ?? '') }}"
                       class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('position') border-red-500 @enderror">
                @error('position')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="linkedin_url" class="block text-gray-700 text-sm font-bold mb-2">URL LinkedIn</label>
                <input type="url" name="linkedin_url" id="linkedin_url" value="{{ old('linkedin_url', optional($user->alumniProfile)->linkedin_url ?? '') }}"
                       class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('linkedin_url') border-red-500 @enderror" placeholder="https://linkedin.com/in/username">
                @error('linkedin_url')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="website_url" class="block text-gray-700 text-sm font-bold mb-2">URL Website Pribadi</label>
                <input type="url" name="website_url" id="website_url" value="{{ old('website_url', optional($user->alumniProfile)->website_url ?? '') }}"
                       class="form-input w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('website_url') border-red-500 @enderror" placeholder="https://yourwebsite.com">
                @error('website_url')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="bio" class="block text-gray-700 text-sm font-bold mb-2">Bio</label>
            <textarea name="bio" id="bio" rows="4"
                      class="form-textarea w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('bio') border-red-500 @enderror">{{ old('bio', optional($user->alumniProfile)->bio ?? '') }}</textarea>
            @error('bio')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Gambar Profil</label>
            <input type="file" name="image" id="image"
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            @error('image')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror

            @if (optional($user->alumniProfile)->image)
                <div class="mt-4 flex items-center space-x-4">
                    <img src="{{ asset('storage/' . $user->alumniProfile->image) }}" class="w-24 h-24 object-cover rounded-full border-2 border-indigo-300 shadow-md" alt="Current Profile Image">
                    <label class="flex items-center text-gray-700">
                        <input type="checkbox" name="remove_image" value="1" class="form-checkbox text-red-600 rounded">
                        <span class="ml-2 text-sm">Hapus Gambar Profil</span>
                    </label>
                </div>
            @else
                <p class="text-gray-500 text-sm mt-2">Belum ada gambar profil. Unggah satu!</p>
            @endif
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-full text-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                <i class="fas fa-save mr-2"></i> Simpan Perubahan
            </button>
            <a href="{{ route('alumni.profile.show') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-full text-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
