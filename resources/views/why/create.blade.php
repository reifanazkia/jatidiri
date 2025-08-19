@extends('layouts.app')

@section('page_title', 'Why Services')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white rounded-[24px] p-[32px]">
            <h2 class="mb-4 text-[24px] font-semibold text-gray-800">Add</h2>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were {{ $errors->count() }} errors with your
                                submission</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('why.store') }}" method="POST" enctype="multipart/form-data" id="why-service-form">
                @csrf

                <!-- Services & Title -->
                <div class="flex gap-6 mb-6">
                    <!-- Services Dropdown -->
                    <div class="w-full md:w-1/2 mb-4">
                        <label for="services" class="block text-sm font-medium text-gray-700 mb-1">Services</label>
                        <div class="relative">
                            <select name="service_id" id="service_id" required
                                class="appearance-none w-full px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-1 focus:ring-blue-100 focus:border-blue-500 pr-10 transition-all">
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

                        @error('services')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <p></p>

                    <!-- Title Input -->
                    <div class="w-full md:w-1/2">
                        <label for="title" class="block text-[14px] text-gray-600 mb-[8px]">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" required value="{{ old('title') }}"
                            class="w-full border {{ $errors->has('title') ? 'border-red-300' : 'border-gray-300' }} rounded-lg px-4 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none"
                            placeholder="Enter Title">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Image Upload Section -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Image *</label>
                    <div id="upload-container" class="flex flex-col">
                        <!-- Main file input (hidden) -->
                        <input type="file" name="image" id="image" accept="image/*" class="hidden"
                            onchange="handleImageChange(this, 'preview_image', 'file-name', 'preview-container', 'image-error')">

                        <!-- Custom upload button -->
                        <button type="button" onclick="document.getElementById('image').click()"
                            class="w-full px-4 py-2 bg-white border {{ $errors->has('image') ? 'border-red-300' : 'border-gray-300' }} rounded-md text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors flex items-center gap-4">
                            <span
                                class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 border text-xs font-medium rounded-md hover:bg-gray-200">
                                Choose File
                            </span>
                            <span id="file-name" class="text-sm text-gray-500 truncate flex-grow">No file chosen</span>
                        </button>

                        <!-- Image preview container -->
                        <div id="preview-container" class="hidden flex-col items-center gap-1 mt-2">
                            <img id="preview_image" src="#" alt="Preview"
                                class="w-20 h-20 object-cover rounded-md border border-gray-200">
                            <button type="button"
                                onclick="removeImage('preview_image', 'image', 'file-name', 'preview-container', 'image-error')"
                                class="text-gray-500 hover:text-gray-700 text-xs flex items-center mt-1 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Remove image
                            </button>
                        </div>
                        @error('image')
                            <p id="image-error" class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
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
                <div class="text-left mt-6">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Enhanced error handling for image upload
        function handleImageChange(input, previewId, fileNameId, previewContainerId, errorElementId) {
            const file = input.files[0];
            const fileNameElement = document.getElementById(fileNameId);
            const previewContainer = document.getElementById(previewContainerId);
            const errorElement = document.getElementById(errorElementId);

            // Reset previous error
            if (errorElement) {
                errorElement.textContent = '';
                input.classList.remove('border-red-300');
                input.classList.add('border-gray-300');
            }

            if (file) {
                // Validate file type
                const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                if (!validTypes.includes(file.type)) {
                    if (errorElement) {
                        errorElement.textContent = 'Invalid file type. Please upload an image (JPEG, PNG, GIF, WEBP).';
                        input.classList.add('border-red-300');
                    }
                    return;
                }

                // Validate file size (max 5MB)
                const maxSize = 5 * 1024 * 1024; // 5MB
                if (file.size > maxSize) {
                    if (errorElement) {
                        errorElement.textContent = 'File size too large. Maximum size is 5MB.';
                        input.classList.add('border-red-300');
                    }
                    return;
                }

                // Update file name display
                fileNameElement.textContent = file.name;
                fileNameElement.classList.remove('text-gray-500');
                fileNameElement.classList.add('text-gray-800');

                // Show preview
                const preview = document.getElementById(previewId);
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }

                reader.onerror = function() {
                    if (errorElement) {
                        errorElement.textContent = 'Error reading file. Please try another image.';
                        input.classList.add('border-red-300');
                    }
                }

                reader.readAsDataURL(file);
            }
        }

        // Remove image function with error clearing
        function removeImage(previewId, inputId, fileNameId, previewContainerId, errorElementId) {
            document.getElementById(inputId).value = '';
            document.getElementById(previewId).src = '#';
            document.getElementById(fileNameId).textContent = 'No file chosen';
            document.getElementById(fileNameId).classList.remove('text-gray-800');
            document.getElementById(fileNameId).classList.add('text-gray-500');
            document.getElementById(previewContainerId).classList.add('hidden');

            // Clear any error message
            if (errorElementId && document.getElementById(errorElementId)) {
                document.getElementById(errorElementId).textContent = '';
                document.getElementById(inputId).classList.remove('border-red-300');
                document.getElementById(inputId).classList.add('border-gray-300');
            }
        }

        // Form validation before submission
        document.getElementById('why-service-form').addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = ['services', 'title', 'description', 'image'];

            requiredFields.forEach(field => {
                const element = document.querySelector(`[name="${field}"]`);
                const errorElement = document.getElementById(`${field}-error`) ||
                    element.nextElementSibling ||
                    element.parentElement.nextElementSibling;

                if (!element.value) {
                    isValid = false;
                    if (errorElement) {
                        errorElement.textContent = 'This field is required.';
                        element.classList.add('border-red-300');
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();
                // Scroll to first error
                const firstError = document.querySelector('.border-red-300');
                if (firstError) {
                    firstError.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }
        });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
    document.getElementById('whyForm').addEventListener('submit', function (e) {
        Swal.fire({
            title: 'Menyimpan data...',
            html: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            }
        });
    });
</script>

@endsection
