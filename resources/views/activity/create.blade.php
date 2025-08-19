@extends('layouts.app')

@section('page_title', 'Why Services')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white rounded-[24px] p-[32px]">
            <h2 class=" mb-4 text-[24px] font-semibold text-gray-800">Add</h2>

            <form action="{{ route('activity.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Services & Title -->
                <div class="flex gap-6 mb-6">
                    <div class="w-full md:w-1/2 mb-4">
                        <label for="services" class="block text-sm font-medium text-gray-700 mb-1">Services</label>
                        <div class="relative">
                            <select name="service_id" id="service_id" required
                                class="appearance-none w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-1 focus:ring-blue-100 focus:border-blue-500 pr-10 transition-all">
                                <option value="" disabled selected class="text-gray-400">-- Select Service --</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" class="py-2">{{ $service->name }}</option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2">
                        <label for="title" class="block text-[14px] text-gray-600 mb-[8px]">Title <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none"
                            placeholder="Enter Title">
                    </div>
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Image *</label>
                    <div id="upload-container" class="flex flex-col">
                        <input type="file" name="image" id="image" accept="image/*" class="hidden"
                            onchange="previewImage(this, 'preview_image', 'upload-container', 'preview-container')">

                        <button type="button" onclick="document.getElementById('image').click()"
                            class="w-full px-4 py-2 mb-8 bg-white border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-4">
                            <span
                                class="inline-flex items-center px-4 py-2 bg-gray-300 text-black border text-xs font-medium rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                Pilih File
                            </span>
                            <span id="file-name" class="text-sm text-gray-500">No file chosen</span>
                        </button>

                        <div id="preview-container" class="hidden flex-col items-center gap-1 mt-2">
                            <img id="preview_image" src="#" alt="Preview"
                                class="w-20 h-20 object-cover rounded-md border border-gray-200">
                            <button type="button"
                                onclick="removeImage('preview_image', 'image', 'upload-container', 'preview-container')"
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
                    <label class="block text-sm font-medium mb-1">Description </label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-200"
                        placeholder="Enter description"></textarea>
                </div>

                <!-- Save Button -->
                <div class="text-left">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition">
                        Save
                    </button>
                </div>
        </div>
        </form>
    </div>


    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
            document.getElementById('file-name').textContent = fileName;
        });
    </script>

    <!-- Image Preview Script -->
    <script>
        function previewImage(input, previewId, uploadContainerId, previewContainerId) {
            const file = input.files[0];
            const fileNameDisplay = document.getElementById('file-name');
            const previewContainer = document.getElementById(previewContainerId);
            const previewImage = document.getElementById(previewId);

            if (file) {
                // Display file name
                fileNameDisplay.textContent = file.name;

                // Show preview container
                previewContainer.classList.remove('hidden');

                // Create image preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                }
                reader.readAsDataURL(file);
            } else {
                fileNameDisplay.textContent = 'No file chosen';
                previewContainer.classList.add('hidden');
            }
        }

        function removeImage(previewId, inputId, uploadContainerId, previewContainerId) {
            document.getElementById(inputId).value = '';
            document.getElementById(previewId).src = '#';
            document.getElementById('file-name').textContent = 'No file chosen';
            document.getElementById(previewContainerId).classList.add('hidden');
        }
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>


@endsection
