@extends('layouts.admindashboard')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Create New Event</h2>
    
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">Ada beberapa masalah dengan input Anda:</span>
            <ul class="mt-3 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-xl rounded-xl px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Event Details --}}
            <div>
                <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Event Information</h3>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
                    <textarea name="description" id="description" rows="5" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>{{ old('description') }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="event_date">Event Date</label>
                    <input type="date" name="event_date" id="event_date" value="{{ old('event_date') }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="event_time">Event Time</label>
                    <input type="time" name="event_time" id="event_time" value="{{ old('event_time') }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="location">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Event Image</label>
                    <input type="file" name="image" id="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-500 mt-1">Max 2MB. (JPG, PNG, GIF, SVG)</p>
                </div>
            </div>

            {{-- Audience, RSVP, Payment Settings --}}
            <div>
                <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Audience & Registration Settings</h3>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="rsvp_required">RSVP Required</label>
                    <select name="rsvp_required" id="rsvp_required" class="shadow-sm border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="1" {{ old('rsvp_required') == '1' ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('rsvp_required') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="mb-4" id="max_attendees_container">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="max_attendees">Max Attendees (RSVP Limit)</label>
                    <input type="number" name="max_attendees" id="max_attendees" value="{{ old('max_attendees') }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" min="1">
                    <p class="text-xs text-gray-500 mt-1">Leave blank for no limit.</p>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Audience Type</label>
                    <div class="mt-2 space-y-2">
                        <label class="inline-flex items-center p-3 bg-gray-50 rounded-lg shadow-sm hover:bg-gray-100 transition duration-200 w-full">
                            <input type="radio" name="audience_type" value="all" class="form-radio text-blue-600 h-5 w-5" {{ old('audience_type', 'all') == 'all' ? 'checked' : '' }}>
                            <span class="ml-3 text-gray-800 font-medium">All Alumni (Public)</span>
                        </label>
                        <label class="inline-flex items-center p-3 bg-gray-50 rounded-lg shadow-sm hover:bg-gray-100 transition duration-200 w-full">
                            <input type="radio" name="audience_type" value="major_only" class="form-radio text-blue-600 h-5 w-5" {{ old('audience_type') == 'major_only' ? 'checked' : '' }}>
                            <span class="ml-3 text-gray-800 font-medium">Specific Major(s) Only</span>
                        </label>
                        <label class="inline-flex items-center p-3 bg-gray-50 rounded-lg shadow-sm hover:bg-gray-100 transition duration-200 w-full">
                            <input type="radio" name="audience_type" value="year_only" class="form-radio text-blue-600 h-5 w-5" {{ old('audience_type') == 'year_only' ? 'checked' : '' }}>
                            <span class="ml-3 text-gray-800 font-medium">Specific Graduation Year(s) Only</span>
                        </label>
                        <label class="inline-flex items-center p-3 bg-gray-50 rounded-lg shadow-sm hover:bg-gray-100 transition duration-200 w-full">
                            <input type="radio" name="audience_type" value="major_and_year" class="form-radio text-blue-600 h-5 w-5" {{ old('audience_type') == 'major_and_year' ? 'checked' : '' }}>
                            <span class="ml-3 text-gray-800 font-medium">Specific Major(s) AND Graduation Year(s)</span>
                        </label>
                    </div>
                </div>

                <div class="mb-4" id="target_majors_container">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="target_majors">Target Major(s)</label>
                    <select name="target_majors[]" id="target_majors" class="shadow-sm border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent h-48" multiple>
                        @foreach ($majors as $major)
                            <option value="{{ $major->id }}" {{ in_array($major->id, old('target_majors', [])) ? 'selected' : '' }}>{{ $major->name }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple.</p>
                </div>

                <div class="mb-4" id="target_years_container">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="target_years">Target Graduation Year(s)</label>
                    <select name="target_years[]" id="target_years" class="shadow-sm border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent h-48" multiple>
                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ in_array($year, old('target_years', [])) ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple.</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Payment Type</label>
                    <div class="mt-2 space-y-2">
                        <label class="inline-flex items-center p-3 bg-gray-50 rounded-lg shadow-sm hover:bg-gray-100 transition duration-200 w-full">
                            <input type="radio" name="is_paid" value="0" class="form-radio text-blue-600 h-5 w-5" {{ old('is_paid', '0') == '0' ? 'checked' : '' }}>
                            <span class="ml-3 text-gray-800 font-medium">Free Event</span>
                        </label>
                        <label class="inline-flex items-center p-3 bg-gray-50 rounded-lg shadow-sm hover:bg-gray-100 transition duration-200 w-full">
                            <input type="radio" name="is_paid" value="1" class="form-radio text-blue-600 h-5 w-5" {{ old('is_paid') == '1' ? 'checked' : '' }}>
                            <span class="ml-3 text-gray-800 font-medium">Paid Event</span>
                        </label>
                    </div>
                </div>

                <div class="mb-4" id="price_container">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Price (IDR)</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" step="0.01" min="0">
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end mt-8 border-t pt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-200 transform hover:scale-105 shadow-md">
                <i class="fas fa-plus-circle mr-2"></i> Create Event
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rsvpRequiredSelect = document.getElementById('rsvp_required');
        const maxAttendeesContainer = document.getElementById('max_attendees_container');
        const audienceTypeRadios = document.querySelectorAll('input[name="audience_type"]');
        const targetMajorsContainer = document.getElementById('target_majors_container');
        const targetYearsContainer = document.getElementById('target_years_container');
        const isPaidRadios = document.querySelectorAll('input[name="is_paid"]');
        const priceContainer = document.getElementById('price_container');

        function toggleMaxAttendees() {
            if (rsvpRequiredSelect.value === '1') {
                maxAttendeesContainer.style.display = 'block';
            } else {
                maxAttendeesContainer.style.display = 'none';
                document.getElementById('max_attendees').value = ''; 
            }
        }

        function toggleAudienceType() {
            const selectedAudienceType = document.querySelector('input[name="audience_type"]:checked').value;
            
            // Hide all and clear selections first
            targetMajorsContainer.style.display = 'none';
            targetYearsContainer.style.display = 'none';
            Array.from(document.getElementById('target_majors').options).forEach(option => option.selected = false);
            Array.from(document.getElementById('target_years').options).forEach(option => option.selected = false);

            if (selectedAudienceType === 'major_only') {
                targetMajorsContainer.style.display = 'block';
            } else if (selectedAudienceType === 'year_only') {
                targetYearsContainer.style.display = 'block';
            } else if (selectedAudienceType === 'major_and_year') {
                targetMajorsContainer.style.display = 'block';
                targetYearsContainer.style.display = 'block';
            }
            // 'all' type means both are hidden
        }

        function togglePrice() {
            const selectedIsPaid = document.querySelector('input[name="is_paid"]:checked').value;
            if (selectedIsPaid === '1') {
                priceContainer.style.display = 'block';
                document.getElementById('price').setAttribute('required', 'required');
            } else {
                priceContainer.style.display = 'none';
                document.getElementById('price').removeAttribute('required');
                document.getElementById('price').value = ''; 
            }
        }

        // Panggil fungsi saat halaman dimuat untuk setel status awal
        toggleMaxAttendees();
        toggleAudienceType();
        togglePrice();

        // Tambahkan event listener
        rsvpRequiredSelect.addEventListener('change', toggleMaxAttendees);
        audienceTypeRadios.forEach(radio => radio.addEventListener('change', toggleAudienceType));
        isPaidRadios.forEach(radio => radio.addEventListener('change', togglePrice));
    });
</script>
@endsection
