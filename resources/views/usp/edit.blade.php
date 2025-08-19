@extends('layouts.app')

@section('page_title', 'USP')

@section('content')
    <div class="max-w-full mx-auto p-[32px] bg-white rounded-[24px] shadow-md">
        <h1 class="text-xl font-semibold mb-6">Edit USP</h1>

        <form action="{{ route('usp.update', $usp->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-8">
                <!-- Title -->
                <div>
                    <label for="Title" class="block text-sm font-medium text-gray-700 mb-1">Title <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="Title" id="Title" placeholder="Enter Title"
                        value="{{ old('Title', $usp->Title) }}"
                        class="w-1/2 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
                        required>
                </div>

                <!-- Image -->
                <div>
                    <label for="Image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>

                    <!-- Image Preview Container -->
                    <div class="flex items-center gap-4 mb-4">
                        <!-- Current Image (will be hidden when new image is selected) -->
                        @if ($usp->Image)
                            <div class="relative group" id="currentImageContainer">
                                <img src="{{ asset('storage/' . $usp->Image) }}" alt="Current Image"
                                    class="w-48 h-48 object-cover rounded-md border">
                                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-md">
                                    <span class="text-white text-sm font-medium">Current Image</span>
                                </div>
                            </div>
                        @endif

                        <!-- New Image Preview (hidden by default) -->
                        <div id="newImagePreviewContainer" class="hidden">
                            <div class="relative group">
                                <img id="newImagePreview" class="w-48 h-48 object-cover rounded-md border">
                                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-md">
                                    <span class="text-white text-sm font-medium">New Image</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="file" name="Image" id="Image"
                        class="w-1/2 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500
                        file:cursor-pointer" accept="image/jpeg,image/png,image/jpg,image/gif"
                        onchange="previewImage(this)">
                    <p class="mt-1 text-sm text-gray-500">Max file size: 2MB (JPEG, PNG, JPG, GIF)</p>

                    <!-- Clear Image Selection Button (hidden by default) -->
                    <button type="button" id="clearImageSelection" class="hidden mt-2 text-sm text-red-600 hover:text-red-800"
                        onclick="clearImageSelection()">
                        Cancel image change
                    </button>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="Description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="Description" id="Description" rows="5"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
                    maxlength="255">{{ old('Description', $usp->Description) }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Max 255 characters</p>
            </div>

            <!-- Save Button -->
            <div class="flex gap-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-full shadow-md transition duration-200">
                    Update
                </button>
                <a href="{{ route('usp.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-6 py-2 rounded-full shadow-md transition duration-200">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        // Image Preview Functionality
        function previewImage(input) {
            const previewContainer = document.getElementById('newImagePreviewContainer');
            const currentImageContainer = document.getElementById('currentImageContainer');
            const preview = document.getElementById('newImagePreview');
            const clearButton = document.getElementById('clearImageSelection');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');

                    // Hide the current image when new image is selected
                    if (currentImageContainer) {
                        currentImageContainer.classList.add('hidden');
                    }

                    // Show the clear selection button
                    clearButton.classList.remove('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Clear Image Selection
        function clearImageSelection() {
            const fileInput = document.getElementById('Image');
            const previewContainer = document.getElementById('newImagePreviewContainer');
            const currentImageContainer = document.getElementById('currentImageContainer');
            const clearButton = document.getElementById('clearImageSelection');

            // Reset file input
            fileInput.value = '';

            // Hide new image preview
            previewContainer.classList.add('hidden');

            // Show current image again
            if (currentImageContainer) {
                currentImageContainer.classList.remove('hidden');
            }

            // Hide clear button
            clearButton.classList.add('hidden');
        }

        // Initialize CKEditor if needed
        if (document.querySelector('#Description')) {
            ClassicEditor
                .create(document.querySelector('#Description'))
                .catch(error => {
                    console.error(error);
                });
        }
    </script>
@endsection
