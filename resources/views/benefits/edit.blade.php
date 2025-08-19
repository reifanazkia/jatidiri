@extends('layouts.app')

@section('page_title', 'Benefits')

@section('content')
    <div class="max-w-full bg-white mx-auto p-[32px] rounded-[24px] shadow-sm">
        <h2 class="text-xl font-semibold mb-6">Edit Benefit</h2>

        <form action="{{ route('benefits.update', $benefit->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Display on Home -->
            <div class="flex items-center mb-2">
                <input type="checkbox" name="home" id="home" value="1"
                    class="h-4 w-4 text-purple-500 focus:ring-purple-400 border-gray-300 rounded"
                    {{ $benefit->home ? 'checked' : '' }}>
                <label for="home" class="ml-2 text-sm text-gray-700 font-medium">Display on Home</label>
            </div>

            <!-- Grid: Facility + Image -->
            <div class="grid grid-cols-1 gap-8">
                <div class="space-y-6">
                    <!-- Facility Selection -->
                    <div class="relative">
                        <label for="facility_id" class="block mb-2 text-sm font-medium text-gray-700">Facility</label>
                        <select name="facility_id" id="facility_id"
                            class="w-full py-2.5 pl-4 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 appearance-none bg-white">
                            @foreach ($facilities as $facility)
                                <option value="{{ $facility->id }}"
                                    {{ $benefit->facility_id == $facility->id ? 'selected' : '' }}>
                                    {{ $facility->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none mt-5">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" placeholder="Title"
                            value="{{ old('title', $benefit->title) }}"
                            class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="6"
                            class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500">{{ old('description', $benefit->description) }}</textarea>
                    </div>
                </div>

                <!-- Image Upload & Preview -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                    <!-- Dropzone -->
                    <div>
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-700">Upload Image (Max:
                            2MB)</label>
                        <div id="dropzone"
                            class="flex flex-col justify-center items-center border-2 border-gray-300 rounded-lg h-56 text-gray-500 text-sm text-center cursor-pointer">
                            <input type="file" name="image" id="image" accept="image/*" class="hidden"
                                onchange="previewImage(event)">
                            <label for="image"
                                class="w-full h-full flex flex-col justify-center items-center cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                </svg>
                                <span>Drag and drop a file here or click</span>
                            </label>
                        </div>

                        @if ($benefit->image)
                            <div class="mt-4 flex items-center">
                                <input type="checkbox" name="remove_image" id="remove_image"
                                    class="h-4 w-4 text-purple-500">
                                <label for="remove_image" class="ml-2 text-sm text-gray-700">Remove current image</label>
                            </div>
                        @endif
                    </div>

                    <!-- Existing or Preview Image -->
                    <div id="preview" class="w-full flex justify-center items-center">
                        @if ($benefit->image)
                            <img src="{{ asset('storage/' . $benefit->image) }}" id="existing-image"
                                class="max-h-56 rounded-lg shadow object-cover">
                        @endif
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="px-8 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-full transition-all">
                Update
            </button>
        </form>
    </div>

    <!-- Image Preview Script -->
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const existingImage = document.getElementById('existing-image');

            if (existingImage) {
                existingImage.style.display = 'none';
            }

            preview.innerHTML = '';
            const file = event.target.files[0];
            if (file) {
                const img = document.createElement("img");
                img.src = URL.createObjectURL(file);
                img.classList.add("max-h-56", "rounded-lg", "shadow", "object-cover");
                preview.appendChild(img);
            }
        }
    </script>

    <!-- CKEditor -->
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection