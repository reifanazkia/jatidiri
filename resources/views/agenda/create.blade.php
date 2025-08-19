@extends('layouts.app')

@section('page_title', 'Add New Agenda')

@section('content')
    <div class="container mx-auto font-[Outfit]">
        <div class="bg-white rounded-[24px] p-8 shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Add New Agenda</h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-blue-500"
                        placeholder="Agenda Title" required>
                </div>

                {{-- Date & Time --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    {{-- Start --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date *</label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-blue-500"
                                required>
                        </div>
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">Start Time *</label>
                            <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-blue-500"
                                required>
                        </div>
                    </div>

                    {{-- End --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-blue-500">
                        </div>
                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-2">End Time</label>
                            <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-blue-500">
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                    <textarea name="content" id="content" rows="5"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm">{{ old('content') }}</textarea>
                </div>

                {{-- Organizer, Location, Youtube --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label for="organizer" class="block text-sm font-medium text-gray-700 mb-2">Organizer</label>
                        <input type="text" name="organizer" id="organizer" value="{{ old('organizer') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-blue-500">
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-blue-500">
                    </div>
                    <div>
                        <label for="yt_link" class="block text-sm font-medium text-gray-700 mb-2">YouTube Link</label>
                        <input type="url" name="yt_link" id="yt_link" value="{{ old('yt_link') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-blue-500">
                    </div>
                </div>

                {{-- Register Link & Contact --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="register_link" class="block text-sm font-medium text-gray-700 mb-2">Registration Link</label>
                        <input type="url" name="register_link" id="register_link" value="{{ old('register_link') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm">
                    </div>
                    <div>
                        <label for="contact" class="block text-sm font-medium text-gray-700 mb-2">Contact Number</label>
                        <input type="text" name="contact" id="contact" value="{{ old('contact') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm">
                    </div>
                </div>

                {{-- Image Upload --}}
                <div class="w-full max-w-full mt-10">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Agenda Image (Max: 2MB) *</label>
                    <div id="upload-box" class="relative flex justify-center items-center w-[50%] border-2 border-gray-300 rounded-xl h-60 cursor-pointer bg-white">
                        <label id="upload-placeholder" for="image" class="flex flex-col items-center space-y-3 text-gray-500 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                            </svg>
                            <span class="text-center text-sm">Click to upload image</span>
                        </label>
                        <input id="image" name="image" type="file" accept="image/*" class="hidden" onchange="previewImage(event)" required>
                        <img id="image-preview" src="#" alt="Preview" class="absolute inset-0 w-full h-full object-contain rounded-xl hidden z-10" />
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div class="text-left mt-8">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-8 py-2 rounded-full text-sm">
                        Save Agenda
                    </button>
                    <a href="{{ route('agenda.index') }}" class="ml-4 text-gray-600 hover:text-gray-800 text-sm font-medium">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById("image-preview");
            const placeholder = document.getElementById("upload-placeholder");

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove("hidden");
                    placeholder.classList.add("hidden");
                };
                reader.readAsDataURL(file);
            }
        }

        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
