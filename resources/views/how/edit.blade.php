@extends('layouts.app')

@section('page_title', 'Edit How Service')

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Edit How Service</h2>

            <form action="{{ route('how.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Services & Title -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="service_id" class="block text-sm font-medium text-gray-700 mb-1">Service <span class="text-red-500">*</span></label>
                        <select name="service_id" id="service_id" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-200 focus:border-blue-500 focus:outline-none transition">
                            <option value="" disabled>-- Select Service --</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" {{ $data->service_id == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-200 focus:border-blue-500 focus:outline-none transition"
                            placeholder="Enter Title" value="{{ old('title', $data->title) }}">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>

                    <div class="flex flex-col space-y-4">
                        <!-- Current Image -->
                        @if($data->image)
                        <div class="flex items-center space-x-4">
                            <div class="shrink-0">
                                <img src="{{ asset('storage/' . $data->image) }}" alt="Current Image"
                                     class="h-20 w-20 object-cover rounded-md border border-gray-200">
                            </div>
                            <div>
                                <button type="button" onclick="confirmDeleteImage()"
                                    class="text-red-600 hover:text-red-800 text-sm font-medium">
                                    Remove Image
                                </button>
                                <input type="checkbox" name="remove_image" id="remove_image" class="hidden">
                            </div>
                        </div>
                        @endif

                        <!-- New Image Upload -->
                        <div class="flex items-center space-x-4">
                            <label for="image" class="cursor-pointer">
                                <span class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    Choose New Image
                                </span>
                                <input type="file" name="image" id="image" class="hidden" onchange="previewImage(this)">
                            </label>
                            <span id="file-name" class="text-sm text-gray-500">No file chosen</span>
                        </div>

                        <!-- Image Preview -->
                        <div id="image-preview" class="hidden mt-2">
                            <p class="text-sm text-gray-500 mb-1">Preview:</p>
                            <img id="preview" src="#" alt="Preview" class="h-20 w-20 object-cover rounded-md border border-gray-200">
                        </div>
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="6" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-200 focus:border-blue-500 focus:outline-none transition"
                        placeholder="Enter description">{{ old('description', $data->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('how.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Image Preview Function
        function previewImage(input) {
            const file = input.files[0];
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('image-preview');
            const fileNameDisplay = document.getElementById('file-name');

            if (file) {
                fileNameDisplay.textContent = file.name;

                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                fileNameDisplay.textContent = 'No file chosen';
                previewContainer.classList.add('hidden');
            }
        }

        // Confirm Image Deletion
        function confirmDeleteImage() {
            if (confirm('Are you sure you want to remove this image?')) {
                document.getElementById('remove_image').checked = true;
                document.querySelector('div.flex.items-center.space-x-4').classList.add('hidden');
            }
        }

        // Initialize CKEditor if needed
        document.addEventListener("DOMContentLoaded", function() {
            if (document.querySelector('#description')) {
                ClassicEditor.create(document.querySelector('#description'))
                    .catch(e => console.error(e));
            }
        });
    </script>
@endsection
