@extends('layouts.app')

@section('page_title', 'Services')

@section('content')
<div class="max-w-full mx-auto">
    <div class="bg-white rounded-[24px] shadow-lg p-[32px]">
        <h2 class="text-3xl font-bold mb-10 text-gray-800">Add Service</h2>

        <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div class="mb-8">
                <label for="name" class="block text-gray-800 font-semibold mb-2">Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-300"
                    required>
            </div>

            @for ($i = 1; $i <= 4; $i++)
            <div class=" mt-[32px] border-b border-gray-100 pb-8">
                <h3 class="text-xl font-semibold mb-5 text-gray-800">Section {{ $i }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Title {{ $i }}</label>
                        <input type="text" name="title{{ $i }}" value="{{ old('title'.$i) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-200"
                            placeholder="Enter title {{ $i }}">
                    </div>
                    <!-- Image -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Image</label>
                        <div class="upload-container flex flex-col">
                            <input type="file" name="image{{ $i }}" id="image{{ $i }}" accept="image/*" class="hidden"
                                onchange="handleImageUpload(this, 'preview-container-{{ $i }}', 'preview_image-{{ $i }}', 'file-name-{{ $i }}')">
                            <button type="button" onclick="document.getElementById('image{{ $i }}').click()"
                                class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md text-sm flex items-center gap-4">
                                <span class="inline-flex px-4 py-2 bg-gray-300 text-black text-xs font-medium rounded-md cursor-pointer">Pilih File</span>
                                <span id="file-name-{{ $i }}" class="text-sm text-gray-500">No file chosen</span>
                            </button>
                            <div id="preview-container-{{ $i }}" class="hidden flex-col items-center gap-1 mt-2">
                                <img id="preview_image-{{ $i }}" src="#" alt="Preview"
                                    class="w-20 h-20 object-cover rounded-md border border-gray-200">
                                <button type="button"
                                    onclick="removeImage('image{{ $i }}', 'preview-container-{{ $i }}', 'file-name-{{ $i }}', 'preview_image-{{ $i }}')"
                                    class="text-gray-500 hover:text-gray-700 text-xs flex items-center mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Remove image
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Description -->
                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1">Description {{ $i }}</label>
                    <textarea name="description{{ $i }}" id="description{{ $i }}" rows="3"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-200"
                        placeholder="Enter description {{ $i }}">{{ old('description'.$i) }}</textarea>
                </div>
            </div>
            @endfor

            <!-- Submit -->
            <div class=>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function handleImageUpload(input, previewContainerId, previewImageId, fileNameId) {
    const file = input.files[0];
    if (file) {
        document.getElementById(fileNameId).textContent = file.name;
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById(previewImageId).src = e.target.result;
            document.getElementById(previewContainerId).classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}
function removeImage(inputId, previewContainerId, fileNameId, previewImageId) {
    document.getElementById(inputId).value = '';
    document.getElementById(previewImageId).src = '#';
    document.getElementById(previewContainerId).classList.add('hidden');
    document.getElementById(fileNameId).textContent = 'No file chosen';
}
document.addEventListener("DOMContentLoaded", function() {
    for (let i = 1; i <= 4; i++) {
        ClassicEditor.create(document.querySelector('#description'+i)).catch(e => console.error(e));
    }
});
</script>
@endsection
