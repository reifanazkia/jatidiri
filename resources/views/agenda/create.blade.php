@extends('layouts.app')

@section('page_title', 'Agenda')

@section('content')
    <div class="container mx-auto px-6 py-4 font-[Outfit]">
        <div class="bg-white rounded-xl p-8 shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Add</h2>

            <form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input type="text" name="title" id="title"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-blue-500"
                        placeholder="Agenda's Title" required>
                </div>

                {{-- Date & Time --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    {{-- Start --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                            <input type="date" name="start_date" id="start_date"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-blue-500"
                                required>
                        </div>
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">Start Time</label>
                            <input type="time" name="start_time" id="start_time"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-blue-500"
                                required>
                        </div>
                    </div>

                    {{-- End --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                            <input type="date" name="end_date" id="end_date"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-blue-500"
                                required>
                        </div>
                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-2">End Time</label>
                            <input type="time" name="end_time" id="end_time"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-blue-500"
                                required>
                        </div>
                    </div>
                </div>

                {{-- Description (CKEditor) --}}
                <div class="mb-4">
                    <label for="ckeditor" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="ckeditor" rows="5"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm"></textarea>
                </div>

                {{-- Organizer, Location, Youtube --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    {{-- Organizer & Location --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="organizer" class="block text-sm font-medium text-gray-700 mb-2">Organizer</label>
                            <input type="text" name="organizer" id="organizer"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-blue-500">
                        </div>
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                            <input type="text" name="location" id="location"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-blue-500">
                        </div>
                    </div>

                    {{-- YouTube Link --}}
                    <div class="grid grid-cols-1">
                        <div>
                            <label for="youtube_link" class="block text-sm font-medium text-gray-700 mb-2">YouTube
                                Link</label>
                            <input type="url" name="youtube_link" id="youtube_link"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-blue-500">
                        </div>
                    </div>
                </div>






                {{-- Register Link & Contact --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="register_link" class="block text-sm font-medium text-gray-700 mb-2">Link for
                            Registration</label>
                        <input type="url" name="register_link" id="register_link"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm">
                    </div>
                    <div>
                        <label for="contact" class="block text-sm font-medium text-gray-700 mb-2">Event Contact No</label>
                        <input type="text" name="contact" id="contact"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm">
                    </div>
                </div>

                {{-- Upload Image --}}
                <div class="w-full max-w-xl mt-10 ">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image (Max Size: 750kb)</label>

                    {{-- Area Upload --}}
                    <div id="upload-box"
                        class="relative flex justify-center items-center w-full border-2 border-dashed border-gray-300 rounded-xl h-60 cursor-pointer bg-white">

                        {{-- Icon & Text --}}
                        <label id="upload-placeholder" for="image"
                            class="flex flex-col items-center space-y-3 text-gray-500 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                            </svg>
                            <span class="text-center text-sm">Drag and drop a file here or click</span>
                        </label>

                        {{-- Input File --}}
                        <input id="image" name="image" type="file" accept="image/*" class="hidden"
                            onchange="previewImage(event)">

                        {{-- Preview Image (inside box) --}}
                        <img id="image-preview" src="#" alt="Preview"
                            class="absolute inset-0 w-full h-full object-contain rounded-xl hidden z-10" />
                    </div>
                </div>
                {{-- Submit --}}
                <div class="text-left mt-3">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-8 py-2 rounded-full text-sm">
                        Save
                    </button>
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
                    placeholder.classList.add("hidden"); // sembunyikan icon+teks
                };
                reader.readAsDataURL(file);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById("sidebar");
            if (sidebar) {
                sidebar.classList.add("hidden");
            }
        });
    </script>
@endsection



@push('scripts')
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ckeditor', {
            toolbar: [{
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Underline', 'Strike']
                },
                {
                    name: 'paragraph',
                    items: ['NumberedList', 'BulletedList', '-', 'Blockquote']
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink']
                },
                {
                    name: 'tools',
                    items: ['Maximize']
                },
                '/',
                {
                    name: 'styles',
                    items: ['Format', 'FontSize']
                },
                {
                    name: 'colors',
                    items: ['TextColor', 'BGColor']
                }
            ],
            height: 180,
            removePlugins: 'elementspath',
            resize_enabled: false
        });
    </script>
@endpush
