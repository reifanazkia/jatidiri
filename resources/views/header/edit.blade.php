@extends('layouts.app')

@section('content')
    <div class="bg-white max-w-full rounded-[24px] mx-auto px-6 py-10">
        <h2 class="text-xl font-semibold mb-6">Edit</h2>

        <form action="{{ route('header.update', $header->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label class="block text-sm font-medium mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title', $header->title) }}"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300">
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-medium mb-1">Description</label>
                <textarea id="editor" name="meta_desc" rows="6" class="w-full border border-gray-300 rounded-md px-4 py-2">{{ old('meta_desc', $header->meta_desc) }}</textarea>
            </div>

            {{-- Upload --}}
            <label class="block text-sm font-medium mb-2">Upload Image (Max Size: 750kb)</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                {{-- Dropzone --}}
                <div>
                    <label for="image"
                        class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 rounded-md cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-10 h-10 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="w-7 h-7 mx-auto text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                            </svg>
                            <p class="mb-1 text-sm text-gray-500">Drag and drop file here or click</p>
                        </div>
                        <input id="image" name="image" type="file" class="hidden" accept="image/*">
                    </label>
                </div>

                {{-- Preview --}}
                <div class="w-full h-48 bg-gray-100 rounded-md overflow-hidden flex items-center justify-center">
                    @if ($header->image)
                        <img src="{{ asset($header->image) }}" alt="Current Image"
                            class="object-cover w-full h-full rounded-md" id="current-image">
                    @else
                        <span class="text-sm text-gray-500">No image available</span>
                    @endif
                </div>
            </div>

            {{-- Submit --}}
            <div class="pt-6">
                <button type="submit"
                    class="bg-[#7A6FF0] hover:bg-[#665ae3] text-white px-8 py-2 rounded-full transition-all">
                    Update
                </button>
            </div>
        </form>
    </div>

    <script>
        // CKEditor initialization
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

        // Image preview functionality
        document.getElementById('image').addEventListener('change', function(e) {
            const previewContainer = document.querySelector('.bg-gray-100');
            const file = e.target.files[0];

            if (file) {
                // Check file size (750kb = 750000 bytes)
                if (file.size > 750000) {
                    alert('File size exceeds 750kb limit');
                    this.value = ''; // Clear the file input
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    // Remove the current image if it exists
                    const currentImage = document.getElementById('current-image');
                    if (currentImage) currentImage.remove();

                    // Create and display the new preview
                    const imgPreview = document.createElement('img');
                    imgPreview.src = e.target.result;
                    imgPreview.alt = 'Preview';
                    imgPreview.className = 'object-cover w-full h-full rounded-md';
                    imgPreview.id = 'image-preview';

                    previewContainer.innerHTML = '';
                    previewContainer.appendChild(imgPreview);
                }

                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
