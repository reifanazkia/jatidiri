@extends('layouts.app')

@section('page_title', 'Benefits')

@section('content')
    <div class="max-w-full bg-white mx-auto p-[32px] rounded-[24px] shadow-sm">
        <h2 class="text-xl font-semibold mb-6">Edit</h2>

        <form action="{{ route('benefits.updateTitle', $benefit->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" placeholder="Title"
                    value="{{ old('title', $benefit->title) }}"
                    class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
            </div>

            <!-- Sub Title -->
            <div>
                <label for="subtitle" class="block mb-2 text-sm font-medium text-gray-700">Sub Title</label>
                <input type="text" name="subtitle" id="subtitle" placeholder="Sub Title"
                    value="{{ old('subtitle', $benefit->subtitle) }}"
                    class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
            </div>

            <!-- Image Preview & Upload -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">

                <!-- Upload Image -->
                <div>
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-700">Upload Image (Max Size:
                        750kb)</label>
                    <div id="dropzone"
                        class="flex flex-col justify-center items-center border-2 border-gray-300 rounded-lg h-56 text-gray-500 text-sm text-center cursor-pointer">
                        <input type="file" name="image" id="image" accept="image/*" class="hidden"
                            onchange="previewImage(event)">
                        <label for="image"
                            class="w-full h-full flex flex-col justify-center items-center cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-10 h-10">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                            </svg>
                            <span>Drag and drop a file here or click</span>
                        </label>
                    </div>

                    @if ($benefit->image)
                        <div class="mt-2 flex items-center">
                            <input type="checkbox" name="remove_image" id="remove_image" class="h-4 w-4 text-purple-500">
                            <label for="remove_image" class="ml-2 text-sm text-gray-700">Remove current image</label>
                        </div>
                    @endif
                </div>

                <!-- Image Preview -->
                <div id="preview" class="w-full flex justify-center items-center">
                    @if ($benefit->image)
                        <img src="{{ asset('storage/' . $benefit->image) }}" id="existing-image"
                            class="max-h-72 rounded-lg  object-cover w-full">
                    @endif
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

    <!-- Preview Script -->
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const existingImage = document.getElementById('existing-image');
            if (existingImage) existingImage.style.display = 'none';
            preview.innerHTML = '';

            const file = event.target.files[0];
            if (file) {
                const img = document.createElement("img");
                img.src = URL.createObjectURL(file);
                img.classList.add("max-h-72", "rounded-lg", "shadow", "object-cover", "w-full");
                preview.appendChild(img);
            }
        }
    </script>
@endsection
