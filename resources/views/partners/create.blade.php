@extends('layouts.app')

@section('page_title', 'Partners')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-10 bg-white rounded-[24px] shadow-md">
        <h2 class="text-xl font-semibold mb-6">Add Partner</h2>

        @if (session('success'))
            <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 text-red-700 bg-red-100 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Partner's Name *</label>
                    <input type="text" name="name" id="name" required value="{{ old('name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-indigo-500" />
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Web -->
                <div class="col-span-2">
                    <label for="web" class="block text-sm font-medium text-gray-700 mb-1">Partner's Web Address</label>
                    <input type="url" name="web" id="web" placeholder="https://example.com" value="{{ old('web') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-indigo-500" />
                    @error('web')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Partner Description</label>
                    <textarea name="description" id="description" class="ckeditor w-full border border-gray-300 rounded-md">
                        {{ old('description') }}
                    </textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Program Desc -->
                <div class="col-span-2">
                    <label for="program_desc" class="block text-sm font-medium text-gray-700 mb-1">Partnership Details</label>
                    <textarea name="program_desc" id="program_desc" class="ckeditor w-full border border-gray-300 rounded-md">
                        {{ old('program_desc') }}
                    </textarea>
                    @error('program_desc')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Image (Max: 750kb) *</label>
                    <div class="relative">
                        <div id="dropZone" class="w-full h-48 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center text-gray-400 hover:border-indigo-500 transition cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-12 h-12 mb-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                            </svg>
                            <span class="text-center px-4">Drag and drop a file here or click to select</span>
                            <span class="text-xs mt-2">Recommended: 400x250px (JPG, PNG)</span>
                        </div>
                        <input type="file" name="image" id="imageInput" accept="image/jpeg,image/png" required
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Preview Box -->
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Image Preview</label>
                    <div class="w-full h-48 border-2 border-gray-200 rounded-lg overflow-hidden">
                        <img id="imagePreview" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 250' fill='%23f3f4f6'%3E%3Crect width='400' height='250'/%3E%3Ctext x='50%' y='50%' font-family='Arial' font-size='14' fill='%239ca3af' text-anchor='middle' dominant-baseline='middle'%3ENo image selected%3C/text%3E%3C/svg%3E"
                            class="w-full h-full object-contain" />
                    </div>
                    <div id="fileNameDisplay" class="mt-2 text-sm text-gray-500 truncate"></div>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit"
                    class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium px-6 py-2 rounded-full transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Save Partner
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script>
        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error('Description editor error:', error);
            });

        ClassicEditor
            .create(document.querySelector('#program_desc'))
            .catch(error => {
                console.error('Program description editor error:', error);
            });

        // Image upload and preview functionality
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('imageInput');
            const imagePreview = document.getElementById('imagePreview');
            const dropZone = document.getElementById('dropZone');
            const fileNameDisplay = document.getElementById('fileNameDisplay');

            // Handle file selection
            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Validate file size (750KB)
                    if (file.size > 750 * 1024) {
                        alert('File size exceeds 750KB limit. Please choose a smaller file.');
                        return;
                    }

                    // Validate file type
                    if (!file.type.match('image/jpeg') && !file.type.match('image/png')) {
                        alert('Only JPG and PNG images are allowed.');
                        return;
                    }

                    // Display file name
                    fileNameDisplay.textContent = `Selected: ${file.name}`;

                    // Create preview
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        imagePreview.src = event.target.result;
                        imagePreview.classList.remove('object-contain');
                        imagePreview.classList.add('object-cover');
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropZone.classList.add('border-indigo-500', 'bg-indigo-50');
            }

            function unhighlight() {
                dropZone.classList.remove('border-indigo-500', 'bg-indigo-50');
            }

            dropZone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length) {
                    imageInput.files = files;
                    const event = new Event('change');
                    imageInput.dispatchEvent(event);
                }
            }
        });
    </script>
@endsection
