@extends('layouts.app')

@section('page_title', 'Assesments')

@section('content')
    <div class="max-w-full bg-white mx-auto p-[32px] rounded-[24px] shadow-sm">
        <h2 class="text-xl font-semibold mb-6">Edit</h2>

        <form action="{{ route('assesment.update', $facilities->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Display on Home -->
            <div class="flex items-center mb-4">
                <input type="checkbox" name="home" id="home" value="1"
                    class="h-4 w-4 text-purple-500 focus:ring-purple-400 border-gray-300 rounded"
                    {{ old('home', $facilities->home) ? 'checked' : '' }}>
                <label for="home" class="ml-2 text-sm text-gray-700 font-medium">Display on Home</label>
            </div>

            <!-- Grid: Program + Image -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Title*</label>
                        <input type="text" name="title" id="title" placeholder="Title"
                            value="{{ old('title', $facilities->title) }}"
                            class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500"
                            required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subtitle -->
                    <div>
                        <label for="subtitle" class="block mb-2 text-sm font-medium text-gray-700">Subtitle*</label>
                        <input type="text" name="subtitle" id="subtitle" placeholder="Subtitle"
                            value="{{ old('subtitle', $facilities->subtitle) }}"
                            class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500"
                            required>
                        @error('subtitle')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Description*</label>
                        <textarea name="description" id="description" rows="6"
                            class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500"
                            required>{{ old('description', $facilities->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Image Upload -->
                <div>
                    {{-- Preview Image --}}
                    <div id="preview" class="mb-4">
                        @if ($facilities->image)
                            <img src="{{ asset('storage/' . $facilities->image) }}"
                                class="max-h-40 rounded-lg shadow mx-auto" alt="Current Image">
                        @endif
                    </div>

                    {{-- Upload Image --}}
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-700">
                        Upload Image (Max: 750kb)
                    </label>
                    <div id="dropzone"
                        class="flex flex-col justify-center items-center border-2 border-gray-300 rounded-lg h-56 text-gray-500 text-sm text-center cursor-pointer">
                        <input type="file" name="image" id="image" accept="image/*" class="hidden"
                            onchange="previewImage(event)">
                        <label for="image"
                            class="w-full h-full flex flex-col justify-center items-center cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                            </svg>
                            <span>Drag and drop a file here or click</span>
                        </label>
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit"
                    class="px-8 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-full transition-all">
                    Update
                </button>
            </div>
        </form>
    </div>

    <!-- Image Preview Script -->
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            preview.innerHTML = '';
            const file = event.target.files[0];
            if (file) {
                const img = document.createElement("img");
                img.src = URL.createObjectURL(file);
                img.classList.add("max-h-40", "rounded-lg", "shadow", "mx-auto");
                preview.appendChild(img);
            }
        }
    </script>

    <!-- Inisialisasi CKEditor -->
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection