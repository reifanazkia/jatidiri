@extends('layouts.app')

@section('page_title', 'Slider')

@section('content')
    <div class="bg-white container mx-auto p-[32px] gap-8 rounded-[24px]">
        <h2 class="text-xl font-semibold mb-6">Edit</h2>

        <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @csrf
            @method('PUT')

            <!-- Left Side -->
            <div class="space-y-4 col-span-2">

                <!-- Display on Home -->
                <div class="flex items-center space-x-2">
                    <input type="checkbox" name="home" id="home" value="1" class="w-4 h-4 text-indigo-600"
                        {{ old('home', $slider->home) ? 'checked' : '' }}>
                    <label for="home" class="text-sm text-gray-700">Display on Home</label>
                </div>

                <!-- Program Name -->
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Program Name</label>
                    <div class="relative">
                        <select name="program_id"
                            class="px-[8px] py-[18px] pr-10 w-full border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 text-sm appearance-none">
                            <option value="">-- Select Program --</option>
                            @foreach ($programs as $program)
                                <option value="{{ $program->id }}"
                                    {{ old('program_id', $slider->program_id) == $program->id ? 'selected' : '' }}>
                                    {{ $program->name }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Custom Arrow -->
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    @error('program_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Title -->
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title', $slider->title) }}"
                        class="w-full px-[8px] py-[18px] border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 text-sm"
                        placeholder="Slider's Title">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alignment -->
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Text Alignment</label>
                    <div class="relative">
                        <select name="align"
                            class="px-[8px] py-[18px] pr-10 w-full border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 text-sm appearance-none">
                            <option value="left" {{ old('align', $slider->align) == 'left' ? 'selected' : '' }}>Left
                            </option>
                            <option value="center" {{ old('align', $slider->align) == 'center' ? 'selected' : '' }}>Center
                            </option>
                            <option value="right" {{ old('align', $slider->align) == 'right' ? 'selected' : '' }}>Right
                            </option>
                        </select>
                        <!-- Custom Arrow -->
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>


                <!-- Subtitle (Description) -->
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Subtitle</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-[8px] py-[18px] border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 text-sm"
                        placeholder="Write something...">{{ old('description', $slider->description) }}</textarea>
                </div>

                <!-- Button Text -->
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Button Text</label>
                    <input type="text" name="button" value="{{ old('button', $slider->button) }}"
                        class="w-full px-[8px] py-[18px] border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 text-sm"
                        placeholder="Button Text">
                </div>

                <!-- URL Link -->
                <div>
                    <label class="block text-sm text-gray-700 mb-1">URL Link</label>
                    <input type="text" name="link" value="{{ old('link', $slider->link) }}"
                        class="w-full px-[8px] py-[18px] border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 text-sm"
                        placeholder="Url">
                </div>

                <!-- Save Button -->
                <div class="pt-4">
                    <button type="submit"
                        class="px-6 py-2 bg-[#8989FC] hover:bg-indigo-600 text-white rounded-full text-sm">
                        Update
                    </button>
                </div>
            </div>

            <!-- Right Side -->
            <div class="space-y-4">

                <!-- Upload Image -->
                <div>
                    <div class="mt-3" id="image-preview-container">
                        @if ($slider->image)
                            <p class="text-xs text-gray-500 mb-1">Current Image:</p>
                            <img src="{{ asset('storage/' . $slider->image) }}" id="current-image"
                                class="h-[200px] object-contain rounded-lg border border-gray-300 mb-[24px]" />
                        @endif
                    </div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image (Max: 2MB)</label>
                    <label for="image"
                        class="block mt-1 cursor-pointer h-[252px] flex flex-col items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 rounded-lg hover:border-gray-400 transition">
                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775
                                                5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1
                                                18 19.5H6.75Z" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">Drag and drop a file here or click</p>
                        <input id="image" name="image" type="file" class="hidden"
                            accept="image/jpeg,image/png,image/jpg">
                    </label>
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- YouTube ID -->
                <div>
                    @if ($slider->yt_id)
                        <div class="mt-4">
                            <p class="text-xs text-gray-500 mb-1">Preview:</p>
                            <div class="aspect-w-16 aspect-h-9 mb-4">
                                <iframe class="w-full rounded-lg border"
                                    src="https://www.youtube.com/embed/{{ $slider->yt_id }}" frameborder="0"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    @endif

                    <label class="block text-sm text-gray-700 mb-1">ID Youtube</label>
                    <input type="text" name="yt_id" value="{{ old('yt_id', $slider->yt_id) }}"
                        class="w-full px-[8px] py-[18px] border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 text-sm"
                        placeholder="e.g. dQw4w9WgXcQ">
                </div>
            </div>
        </form>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

        // Image preview functionality
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('image-preview-container');

            if (file) {
                // Remove the current image if it exists
                const currentImage = document.getElementById('current-image');
                if (currentImage) {
                    currentImage.remove();
                }

                // Create a new image element for the preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.id = 'image-preview';
                    img.src = e.target.result;
                    img.className = 'h-[200px] object-contain rounded-lg border border-gray-300 mb-[24px]';

                    // Create the label
                    const label = document.createElement('p');
                    label.className = 'text-xs text-gray-500 mb-1';
                    label.textContent = 'New Image Preview:';

                    // Clear the container and add new elements
                    previewContainer.innerHTML = '';
                    previewContainer.appendChild(label);
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
