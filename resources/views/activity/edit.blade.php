@extends('layouts.app')

@section('page_title', 'Activity Services')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white rounded-xl p-[32px]">
            <h2 class="text-[24px] font-semibold mb-[32px] text-gray-800">Edit Activity</h2>

            <form action="{{ route('activity.update', $activity->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Services & Title -->
                <div class="flex gap-6 mb-6">
                    <div class="w-1/2">
                        <label for="service_id" class="block text-[14px] text-gray-600 mb-[8px]">Services <span
                                class="text-red-500">*</span></label>
                        <select name="service_id" id="service_id" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none">
                            <option value="" disabled>-- Select Services --</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}"
                                    {{ $activity->service_id == $service->id ? 'selected' : '' }}>
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
                            placeholder="Enter Title" value="{{ old('title', $activity->title) }}">
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image *</label>
                    <div id="upload-container" class="flex flex-col">
                        <!-- Hidden file input -->
                        <input type="file" name="image" id="image" accept="image/*" class="hidden"
                            onchange="previewImage(this, 'preview_image', 'upload-container', 'preview-container')">

                        <!-- Upload button -->
                        <button type="button" onclick="document.getElementById('image').click()"
                            class="w-full px-4 py-2 mb-2 bg-white border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-4">
                            <span
                                class="inline-flex items-center px-4 py-2 bg-gray-300 text-black border text-xs font-medium rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                Pilih File
                            </span>
                            <span id="file-name" class="text-sm text-gray-500">No file chosen</span>
                        </button>

                        <!-- Current image display (only shown if editing with existing image) -->
                        @if (isset($activity->image) && $activity->image)
                            <div id="current-image-container" class="flex flex-col items-center gap-2 mt-2 mb-4">
                                <p class="text-sm text-gray-500">Current Image:</p>
                                <img src="{{ asset('storage/' . $activity->image) }}" alt="Current Activity Image"
                                    class="w-40 h-40 object-cover rounded-md border border-gray-200">
                                <button type="button" onclick="confirmDeleteImage()"
                                    class="text-red-500 hover:text-red-700 text-xs flex items-center mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Remove current image
                                </button>
                                <input type="hidden" name="remove_image" id="remove_image" value="0">
                            </div>
                        @endif

                        <!-- New image preview (shown when new image is selected) -->
                        <div id="preview-container" class="hidden flex-col items-center gap-2 mt-2">
                            <p class="text-sm text-gray-500">New Image Preview:</p>
                            <img id="preview_image" src="#" alt="Preview of uploaded image"
                                class="w-40 h-40 object-cover rounded-md border border-gray-200">
                            <button type="button"
                                onclick="removeImage('preview_image', 'image', 'upload-container', 'preview-container')"
                                class="text-red-500 hover:text-red-700 text-xs flex items-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel upload
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
                        placeholder="Enter description">{{ old('description', $activity->description) }}</textarea>
                </div>

                <!-- Save Button -->
                <div class="text-left">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition">
                        Update Activity
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

        function confirmDeleteImage() {
            if (confirm('Are you sure you want to remove the current image?')) {
                document.getElementById('remove_image').value = '1';
                document.getElementById('current-image-container').classList.add('hidden');
            }
        }

        function previewImage(input, previewId, containerId, previewContainerId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                    document.getElementById(previewContainerId).classList.remove('hidden');
                    document.getElementById('file-name').textContent = input.files[0].name;

                    // Hide current image container if exists
                    const currentImageContainer = document.getElementById('current-image-container');
                    if (currentImageContainer) {
                        currentImageContainer.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage(previewId, inputId, containerId, previewContainerId) {
            document.getElementById(previewId).src = '#';
            document.getElementById(inputId).value = '';
            document.getElementById(previewContainerId).classList.add('hidden');
            document.getElementById('file-name').textContent = 'No file chosen';

            // Show current image container again if exists
            const currentImageContainer = document.getElementById('current-image-container');
            if (currentImageContainer) {
                currentImageContainer.classList.remove('hidden');
            }
        }
    </script>

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @foreach ($errors->all() as $error)
                    alert('{{ $error }}');
                @endforeach
            });
        </script>
    @endif

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection
