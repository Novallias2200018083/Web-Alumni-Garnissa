@extends('layouts.admindashboard')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="bg-white rounded-lg shadow-xl p-8 max-w-3xl mx-auto">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Edit Pengguna: {{ $user->name }}</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                <ul class="mt-3 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Penting untuk update --}}

            {{-- User Information --}}
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Akun</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                        <input type="text" name="name" id="name"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500"
                               value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input type="email" name="email" id="email"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500"
                               value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div>
                        <label for="student_id" class="block text-gray-700 text-sm font-bold mb-2">ID Mahasiswa (Opsional):</label>
                        <input type="text" name="student_id" id="student_id"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500"
                               value="{{ old('student_id', $user->student_id) }}">
                    </div>
                    <div>
                        <label for="major_id" class="block text-gray-700 text-sm font-bold mb-2">Jurusan:</label>
                        <select name="major_id" id="major_id"
                                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500">
                            <option value="">Pilih Jurusan</option>
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}" {{ old('major_id', $user->major_id) == $major->id ? 'selected' : '' }}>
                                    {{ $major->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Peran:</label>
                        <select name="role" id="role"
                                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500" required>
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Pengguna Biasa</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="alumni" {{ old('role', $user->role) == 'alumni' ? 'selected' : '' }}>Alumni</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Password (Optional Update) --}}
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Ubah Kata Sandi (Opsional)</h3>
                <p class="text-sm text-gray-600 mb-4">Biarkan kosong jika tidak ingin mengubah kata sandi.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Kata Sandi Baru:</label>
                        <input type="password" name="password" id="password"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Kata Sandi Baru:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500">
                    </div>
                </div>
            </div>

            {{-- Alumni Profile Information --}}
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Profil Alumni</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="alumni_code" class="block text-gray-700 text-sm font-bold mb-2">Kode Alumni (Opsional):</label>
                        <input type="text" name="alumni_code" id="alumni_code"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500"
                               value="{{ old('alumni_code', $user->alumniProfile->alumni_code ?? '') }}">
                    </div>
                    <div>
                        <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Telepon (Opsional):</label>
                        <input type="text" name="phone" id="phone"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500"
                               value="{{ old('phone', $user->alumniProfile->phone ?? '') }}">
                    </div>
                    <div class="md:col-span-2">
                        <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Alamat (Opsional):</label>
                        <textarea name="address" id="address" rows="3"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500">{{ old('address', $user->alumniProfile->address ?? '') }}</textarea>
                    </div>
                    <div>
                        <label for="graduation_year" class="block text-gray-700 text-sm font-bold mb-2">Tahun Lulus (Opsional):</label>
                        <select name="graduation_year" id="graduation_year"
                                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500">
                            <option value="">Pilih Tahun</option>
                            @foreach ($graduationYears as $year)
                                <option value="{{ $year }}" {{ old('graduation_year', $user->alumniProfile->graduation_year ?? '') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="current_job" class="block text-gray-700 text-sm font-bold mb-2">Pekerjaan Saat Ini (Opsional):</label>
                        <input type="text" name="current_job" id="current_job"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500"
                               value="{{ old('current_job', $user->alumniProfile->current_job ?? '') }}">
                    </div>
                    <div>
                        <label for="company" class="block text-gray-700 text-sm font-bold mb-2">Perusahaan (Opsional):</label>
                        <input type="text" name="company" id="company"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500"
                               value="{{ old('company', $user->alumniProfile->company ?? '') }}">
                    </div>
                    <div>
                        <label for="position" class="block text-gray-700 text-sm font-bold mb-2">Posisi (Opsional):</label>
                        <input type="text" name="position" id="position"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500"
                               value="{{ old('position', $user->alumniProfile->position ?? '') }}">
                    </div>
                    <div>
                        <label for="linkedin_url" class="block text-gray-700 text-sm font-bold mb-2">URL LinkedIn (Opsional):</label>
                        <input type="url" name="linkedin_url" id="linkedin_url"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500"
                               value="{{ old('linkedin_url', $user->alumniProfile->linkedin_url ?? '') }}">
                    </div>
                    <div>
                        <label for="website_url" class="block text-gray-700 text-sm font-bold mb-2">URL Website (Opsional):</label>
                        <input type="url" name="website_url" id="website_url"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500"
                               value="{{ old('website_url', $user->alumniProfile->website_url ?? '') }}">
                    </div>
                    <div class="md:col-span-2">
                        <label for="bio" class="block text-gray-700 text-sm font-bold mb-2">Bio (Opsional):</label>
                        <textarea name="bio" id="bio" rows="4"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500">{{ old('bio', $user->alumniProfile->bio ?? '') }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Foto Profil (Opsional):</label>
                        <input type="file" name="image" id="image" accept="image/*"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-yellow-500">
                        @if ($user->alumniProfile && $user->alumniProfile->image)
                            <p class="text-sm text-gray-600 mt-2">Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $user->alumniProfile->image) }}" alt="Current Profile Image" class="w-24 h-24 object-cover rounded-full mt-2 shadow">
                        @endif
                    </div>
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-between mt-8">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105">
                    <i class="fas fa-sync-alt mr-2"></i> Perbarui Pengguna
                </button>
                <a href="{{ route('users.index') }}"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded-full focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
