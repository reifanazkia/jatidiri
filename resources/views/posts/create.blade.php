@extends('layouts.app')

@section('page_title', 'Blog')

@section('content')
    {{-- Pindahkan CKEditor ke section scripts --}}
    <div class="container p-[32px] max-h-auto max-w-auto bg-white rounded-[24px] shadow-md">
        <h2 class="text-[24px] font-medium px-[18px] mb-[32px]">Add</h2>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="">
            @csrf

            <div class="space-y-6">
                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input id="title" name="title" type="text" placeholder="Judul Post" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200" />
                </div>

                {{-- Resume --}}
                <div class="space-y-4">
                    <label for="resume" class="block text-sm font-medium text-gray-700">Resume</label>
                    <textarea name="resume" required id="resume" rows="5" class="...">
                            {{ old('resume', $data->description ?? '') }}
                    </textarea>
                </div>

                {{-- Content --}}
                <div class="space-y-4 mt-6">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea name="content" required id="content" rows="10"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 resize-none">
                        {{ old('content', $data->content ?? '') }}
                    </textarea>
                </div>

                {{-- Kategori & Tanggal --}}
                <div class="flex gap-4 items-center">
                    <div class="w-1/2">
                        <label for="category" class="block text-gray-500 text-[14px] mb-1">Category</label>
                        <div class="relative">
                            <select name="category_id" id="category_id" required
                                class="w-full pl-4 pr-12 py-2 h-10 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-200 appearance-none bg-white">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2">
                        <label for="publish_date" class="block text-gray-500 text-[14px] mb-1">Publish
                            Date</label>
                        <input type="date" name="publish_date" id="publish_date" required
                            class="w-full px-4 py-2 text-[14px] border rounded shadow focus:outline-none">
                    </div>
                </div>


                {{-- Upload Image --}}
                <div class="w-full max-w-xl mt-10">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image (Max Size: 750kb)</label>

                    {{-- Area Upload --}}
                    <div id="upload-box"
                        class="relative flex justify-center items-center w-full border border-gray-300 rounded-xl h-60 cursor-pointer bg-white">

                        {{-- Icon & Text --}}
                        <label id="upload-placeholder" for="image" required
                            class="flex flex-col items-center space-y-3 text-gray-500 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-10 h-10">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                            </svg>
                            <span class="text-center text-sm">Drag and drop a file here or click</span>
                        </label>

                        {{-- Input File --}}
                        <input id="image" name="image" type="file" accept="image/*" class="hidden"
                            onchange="previewImage(event)">

                        {{-- Preview Image (inside box) --}}
                        <img id="image-preview" src="#" alt="Preview"
                            class="absolute inset-0 w-full h-full object-contain rounded-xl hidden z-10" />

                        {{-- Tambahkan ini untuk Remove Button --}}
                        <button id="remove-btn" type="button" onclick="removeImage()"
                            class="absolute top-2 right-2 z-20 hidden bg-red-500 text-white p-1 rounded-full hover:bg-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                {{-- Tombol Submit --}}
                <div class="text-left">
                    <button type="submit"
                        class="bg-[#6F4FF2] hover:bg-[#523dc2] text-white font-semibold text-[14px] px-6 py-2 rounded shadow-lg">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById("image-preview");
            const placeholder = document.getElementById("upload-placeholder");
            const removeBtn = document.getElementById("remove-btn");

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove("hidden");
                    removeBtn.classList.remove("hidden");
                    placeholder.classList.add("hidden");
                };
                reader.readAsDataURL(file);
            }
        }

        // Fungsi baru untuk remove image
        function removeImage() {
            const previewImage = document.getElementById("image-preview");
            const placeholder = document.getElementById("upload-placeholder");
            const fileInput = document.getElementById("image");
            const removeBtn = document.getElementById("remove-btn");

            previewImage.src = "#";
            previewImage.classList.add("hidden");
            removeBtn.classList.add("hidden");
            placeholder.classList.remove("hidden");
            fileInput.value = "";
        }

        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById("sidebar");
            if (sidebar) {
                sidebar.classList.add("hidden");
            }
        });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#resume'))
            .catch(error => {
                console.error(error);
            });
    </script>


@endsection

@section('scripts')

    {{-- Trix Editor (kalau kamu masih pakai) --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

    <script>
        function handleImageUpload(event) {
            const input = event.target;
            const file = input.files[0];

            if (!file) return;

            // Validate file type
            if (!file.type.match('image.*')) {
                alert('Please select an image file (JPEG, PNG)');
                return;
            }

            // Validate file size (750KB = 750000 bytes)
            if (file.size > 750000) {
                alert('File size exceeds 750KB limit');
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                // Show preview
                const preview = document.getElementById('image-preview');
                preview.src = e.target.result;

                // Update UI
                document.getElementById('upload-placeholder').classList.add('hidden');
                document.getElementById('image-preview-container').classList.remove('hidden');

                // Show file info
                document.getElementById('file-info').textContent =
                    `${file.name} (${Math.round(file.size/1024)}KB)`;
            };

            reader.readAsDataURL(file);
        }

        function removeImage() {
            // Reset file input
            document.getElementById('image-upload').value = '';

            // Hide preview
            document.getElementById('image-preview-container').classList.add('hidden');
            document.getElementById('upload-placeholder').classList.remove('hidden');

            // Clear preview image
            document.getElementById('image-preview').src = '#';
            document.getElementById('file-info').textContent = '';
        }

        // Drag and drop functionality
        const uploadBox = document.getElementById('upload-box');

        ['dragenter', 'dragover'].forEach(eventName => {
            uploadBox.addEventListener(eventName, (e) => {
                e.preventDefault();
                uploadBox.classList.add('border-indigo-500', 'bg-gray-50');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadBox.addEventListener(eventName, (e) => {
                e.preventDefault();
                uploadBox.classList.remove('border-indigo-500', 'bg-gray-50');
            });
        });

        uploadBox.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length) {
                document.getElementById('image-upload').files = files;
                handleImageUpload({
                    target: document.getElementById('image-upload')
                });
            }
        });
    </script>


@endsection
