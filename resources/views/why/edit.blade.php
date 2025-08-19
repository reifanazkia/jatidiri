@extends('layouts.app')

@section('page_title', 'Why Services')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white rounded-[24px] p-[32px]">
            <h2 class="text-[24px] font-semibold text-gray-800">Edit</h2>

            <form action="{{ route('why.update', $why->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Services & Title -->
                <div class="flex gap-6 mb-6">
                    <div class="w-1/2">
                        <label for="category" class="block text-[14px] text-gray-600 mb-[8px]">Services <span
                                class="text-red-500">*</span></label>
                        <select name="service_id" id="service_id" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none">
                            <option value="" disabled>-- Select Services --</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" {{ $why->service_id == $service->id ? 'selected' : '' }}
                                    class="px-4 text-black">
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="title" class="block text-[14px] text-gray-600 mb-[8px]">Title <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none"
                            placeholder="Enter Title" value="{{ old('title', $why->title) }}">
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>

                    <!-- Upload Container -->
                    <div id="upload-container" class="flex flex-col">
                        <!-- File Input (hidden) -->
                        <input type="file" name="image" id="image" accept="image/*" class="hidden"
                            onchange="previewImage(this, 'preview_image', 'upload-container', 'preview-container', 'current-image-container')">

                        <!-- Custom Upload Button -->
                        <button type="button" onclick="document.getElementById('image').click()"
                            class="w-full px-4 py-2 mb-2 bg-white border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-4">
                            <span
                                class="inline-flex items-center px-4 py-2 bg-gray-300 text-black border text-xs font-medium rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                Pilih File
                            </span>
                            <span id="file-name" class="text-sm text-gray-500">No file chosen</span>
                        </button>

                        <!-- Current Image Preview (hidden when new image is selected) -->
                        @if ($why->image)
                            <div id="current-image-container" class="flex flex-col items-center gap-1 mt-2">
                                <p class="text-sm text-gray-500 mb-1">Current Image:</p>
                                <img src="{{ asset('storage/' . $why->image) }}" alt="Current Image"
                                    class="w-20 h-20 object-cover rounded-md border border-gray-200">
                            </div>
                        @endif

                        <!-- New Image Preview (hidden by default) -->
                        <div id="preview-container" class="hidden flex-col items-center gap-1 mt-2">
                            <p class="text-sm text-gray-500 mb-1">New Image:</p>
                            <img id="preview_image" src="#" alt="Preview"
                                class="w-20 h-20 object-cover rounded-md border border-gray-200">
                            <button type="button"
                                onclick="removeImage('preview_image', 'image', 'upload-container', 'preview-container', 'current-image-container')"
                                class="text-gray-500 hover:text-gray-700 text-xs flex items-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Remove image
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Description -->
                <div class="mb-10">
                    <label for="description" class="block text-sm text-gray-600 mb-1">Description <span
                            class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="4" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none"
                        placeholder="Enter description">{{ old('description', $why->description) }}</textarea>
                </div>

                <!-- Save Button -->
                <div class="text-left">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
            document.getElementById('file-name').textContent = fileName;
        });

        function previewImage(input, previewId, containerId, previewContainerId, currentImageContainerId) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Show preview container
                    document.getElementById(previewContainerId).classList.remove('hidden');
                    document.getElementById(previewId).src = e.target.result;

                    // Hide current image container if exists
                    if (document.getElementById(currentImageContainerId)) {
                        document.getElementById(currentImageContainerId).classList.add('hidden');
                    }

                    // Update file name
                    document.getElementById('file-name').textContent = file.name;
                }

                reader.readAsDataURL(file);
            }
        }

        function removeImage(previewId, inputId, containerId, previewContainerId, currentImageContainerId) {
            // Reset file input
            document.getElementById(inputId).value = '';

            // Hide preview container
            document.getElementById(previewContainerId).classList.add('hidden');

            // Show current image container if exists
            if (document.getElementById(currentImageContainerId)) {
                document.getElementById(currentImageContainerId).classList.remove('hidden');
            }

            // Reset file name
            document.getElementById('file-name').textContent = 'No file chosen';
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            ClassicEditor.create(document.querySelector('#description')).catch(e => console.error(e));
        });
    </script>
@endsection
