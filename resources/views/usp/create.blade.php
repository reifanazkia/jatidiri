@extends('layouts.app')

@section('page_title', 'USP')

@section('content')
    <div class="max-w-full mx-auto p-8 bg-white rounded-2xl shadow-md">
        <h1 class="text-xl font-semibold mb-6">Add USP</h1>

        <form action="{{ route('usp.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="flex flex-col gap-8">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="Title" id="Title" placeholder="Enter Title"
                        class="w-1/2 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
                        required>
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Image
                    </label>

                    <div>
                        {{-- Upload Button --}}
                        <div id="upload-container" class="flex flex-col">
                            <input type="file" name="Image" id="Image" accept="image/*" class="hidden"
                                onchange="previewImage(this, 'preview_image', 'upload-container', 'preview-container')">

                            <button id="upload-btn" type="button" onclick="document.getElementById('Image').click()"
                                class="w-1/2 px-4 py-2 bg-white border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-4">
                                <label class="cursor-pointer">
                                    <span
                                        class="inline-flex items-center px-4 py-2 bg-gray-300 text-black border text-xs font-medium rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                        Pilih File
                                    </span>
                                </label>
                                <span id="file-name" class="text-sm text-gray-500">No file chosen</span>
                            </button>
                        </div>

                        {{-- Preview --}}
                        <div id="preview-container" class="hidden flex-col items-center gap-1 mt-2">
                            <img id="preview_image" src="#" alt="Preview"
                                class="w-20 h-20 object-cover rounded-md border border-gray-200">
                            <button type="button"
                                onclick="removeImage('preview_image', 'Image', 'upload-container', 'preview-container')"
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
                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea name="Description" id="Description" rows="3"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-200"
                        placeholder="Enter description"></textarea>
                </div>

                <!-- Save Button -->
                <div>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-full shadow-md transition duration-200">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#Description'))
            .catch(error => {
                console.error(error);
            });



        function previewImage(input, previewId, uploadContainerId, previewContainerId) {
            const file = input.files[0];
            const preview = document.getElementById(previewId);
            const previewContainer = document.getElementById(previewContainerId);
            const uploadBtn = document.getElementById('upload-btn');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    uploadBtn.classList.remove('mb-[32px]');
                    document.getElementById('file-name').textContent = file.name;
                }
                reader.readAsDataURL(file);
            }
        }

        function removeImage(previewId, inputId, uploadContainerId, previewContainerId) {
            document.getElementById(previewId).src = '#';
            document.getElementById(previewContainerId).classList.add('hidden');
            document.getElementById(inputId).value = '';
            document.getElementById('file-name').textContent = 'No file chosen';
            document.getElementById('upload-btn').classList.add('mb-[32px]');
        }
    </script>
@endsection
