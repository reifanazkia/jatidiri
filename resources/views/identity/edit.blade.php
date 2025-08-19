@extends('layouts.app')

@section('page_title', 'Edit Identity')

@section('content')
    <div class="max-w-full mx-auto p-8 bg-white rounded-[24px] shadow-md">
        <h2 class="text-xl font-semibold mb-6">Edit Identity</h2>

        <form id="identity-form" action="{{ route('identity.update', $identity->id) }}" method="POST"
            enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name & Year -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Organization Name</label>
                    <input type="text" name="name" value="{{ old('name', $identity->name) }}" required
                        class="px-[8px] py-[16px] mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Year</label>
                    <input type="text" name="year" value="{{ old('year', $identity->year) }}"
                        class="px-[8px] py-[16px] mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('year')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-[8px]">Meta/Description</label>
                <textarea name="description" id="description"
                    class="mt-1 w-full rounded-md border border-gray-300 h-32 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $identity->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-[8px]">Address</label>
                <textarea name="address" id="address"
                    class="mt-1 w-full rounded-md border border-gray-300 h-20 focus:ring-indigo-500 focus:border-indigo-500">{{ old('address', $identity->address) }}</textarea>
                @error('address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Google Maps -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-[8px]">Link Google Maps</label>
                <input type="url" name="maps_url" value="{{ old('maps_url', $identity->maps_url) }}"
                    class="px-[8px] py-[16px] mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                @error('maps_url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kontak & Sosial Media -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-[8px]">Mobile Contact</label>
                    <input type="tel" name="phone" value="{{ old('phone', $identity->phone) }}"
                        class="px-[8px] py-[16px] mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-[8px]">Email</label>
                    <input type="email" name="email" value="{{ old('email', $identity->email) }}"
                        class="px-[8px] py-[16px] mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-[8px]">Instagram</label>
                    <input type="url" name="ig" value="{{ old('ig', $identity->ig) }}"
                        placeholder="https://instagram.com/username"
                        class="px-[8px] py-[16px] mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('ig')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-[8px]">YouTube</label>
                    <input type="url" name="yt" value="{{ old('yt', $identity->yt) }}"
                        placeholder="https://youtube.com/channel"
                        class="px-[8px] py-[16px] mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('yt')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-[8px]">TikTok</label>
                    <input type="url" name="tt" value="{{ old('tt', $identity->tt) }}"
                        placeholder="https://tiktok.com/@username"
                        class="px-[8px] py-[16px] mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('tt')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-[8px]">Facebook</label>
                    <input type="url" name="fb" value="{{ old('fb', $identity->fb) }}"
                        placeholder="https://facebook.com/username"
                        class="px-[8px] py-[16px] mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('fb')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Jadwal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-[8px]">Time Service</label>
                    <input type="text" name="time_service" value="{{ old('time_service', $identity->time_service) }}"
                        placeholder="08:00 - 17:00"
                        class="px-[8px] py-[16px] mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('time_service')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-[8px]">Day Service</label>
                    <input type="text" name="day_service" value="{{ old('day_service', $identity->day_service) }}"
                        placeholder="Monday - Friday"
                        class="px-[8px] py-[16px] mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('day_service')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Upload Logo & Favicon -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-[8px]">Upload Logo (Max: 750kb, Format:
                            PNG/JPG)</label>
                        <div class="relative border-2 border-gray-300 rounded-md h-48 flex items-center justify-center cursor-pointer hover:border-indigo-400 transition duration-150 ease-in-out"
                            id="logo-dropzone">
                            <input type="file" name="logo" id="logo-input" accept="image/png,image/jpeg"
                                class="absolute inset-0 opacity-0 cursor-pointer z-10">
                            <div class="text-center p-4" id="logo-upload-text">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-7 h-7 mx-auto text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                                </svg>
                                <p class="text-sm text-gray-500 mt-2">Click to upload or drag and drop</p>
                                <p class="text-xs text-gray-400 mt-1">PNG or JPG (max. 750kb)</p>
                            </div>
                        </div>
                        @error('logo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Di bagian preview gambar, ubah menjadi: -->
                    <div class="logo-preview-container">
                        @if ($identity->logo)
                            <div class="relative inline-block">
                                <img src="{{ Storage::url('identity/' . $identity->logo) }}?v={{ time() }}"
                                    id="logo-preview" class="h-32 w-auto mt-4 rounded border border-gray-200">
                                <button type="button"
                                    class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center -mt-2 -mr-2 hover:bg-red-600"
                                    onclick="removeImage('logo')">
                                    &times;
                                </button>
                            </div>
                            <input type="hidden" name="existing_logo" value="{{ $identity->logo }}"
                                id="existing-logo">
                        @else
                            <img src="" id="logo-preview"
                                class="h-32 w-auto mt-4 rounded border border-gray-200 hidden">
                        @endif
                    </div>

                    <!-- Tambahkan script ini di bagian bawah: -->
                    @if (session('reload'))
                        <script>
                            // Force reload page after update to refresh images
                            window.location.reload(true);
                        </script>
                    @endif
                </div>
                <div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-[8px]">Upload Favicon (Max: 750kb, Format:
                            ICO/PNG)</label>
                        <div class="relative border-2 border-gray-300 rounded-md h-48 flex items-center justify-center cursor-pointer hover:border-indigo-400 transition duration-150 ease-in-out"
                            id="favicon-dropzone">
                            <input type="file" name="favicon" id="favicon-input" accept="image/x-icon,image/png"
                                class="absolute inset-0 opacity-0 cursor-pointer z-10">
                            <div class="text-center p-4" id="favicon-upload-text">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-7 h-7 mx-auto text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                                </svg>
                                <p class="text-sm text-gray-500 mt-2">Click to upload or drag and drop</p>
                                <p class="text-xs text-gray-400 mt-1">ICO or PNG (max. 750kb)</p>
                            </div>
                        </div>
                        @error('favicon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="favicon-preview-container">
                        @if ($identity->favicon)
                            <div class="relative inline-block">
                                <img src="{{ asset('storage/identity/' . $identity->favicon) }}?v={{ time() }}"
                                    id="favicon-preview" class="h-16 w-auto mt-4 rounded border border-gray-200">
                                <button type="button"
                                    class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center -mt-2 -mr-2 hover:bg-red-600"
                                    onclick="removeImage('favicon')">
                                    &times;
                                </button>
                            </div>
                            <input type="hidden" name="existing_favicon" value="{{ $identity->favicon }}"
                                id="existing-favicon">
                        @else
                            <img src="" id="favicon-preview"
                                class="h-16 w-auto mt-4 rounded border border-gray-200 hidden">
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tombol -->
            <div class="pt-6">
                <button type="submit" id="submit-button"
                    class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center justify-center min-w-24 transition duration-150 ease-in-out">
                    <span id="button-text">Update Identity</span>
                    <span id="button-loading" class="hidden ml-2">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </span>
                </button>
            </div>
        </form>
    </div>

    
    <script>
        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#description'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo']
            })
            .catch(error => {
                console.error('Description editor initialization error:', error);
            });

        ClassicEditor
            .create(document.querySelector('#address'), {
                toolbar: ['bold', 'italic', 'link', '|', 'undo', 'redo']
            })
            .catch(error => {
                console.error('Address editor initialization error:', error);
            });

        // Image preview and upload handling
        function setupFileUpload(inputId, previewId, dropzoneId, uploadTextId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            const dropzone = document.getElementById(dropzoneId);
            const uploadText = document.getElementById(uploadTextId);
            const existingInput = document.getElementById(`existing-${inputId.split('-')[0]}`);

            // Handle file selection
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Validate file size (750KB for both logo and favicon)
                    if (file.size > 750 * 1024) {
                        alert('File size must be less than 750KB');
                        input.value = ''; // Clear the input
                        return;
                    }

                    // Validate file type
                    const validTypes = inputId === 'logo-input' ?
                        ['image/png', 'image/jpeg'] :
                        ['image/x-icon', 'image/png'];

                    if (!validTypes.includes(file.type)) {
                        alert(inputId === 'logo-input' ?
                            'Only PNG or JPG files are allowed for logo' :
                            'Only ICO or PNG files are allowed for favicon');
                        input.value = ''; // Clear the input
                        return;
                    }

                    // Create preview
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        preview.src = event.target.result;
                        preview.classList.remove('hidden');
                        uploadText.classList.add('hidden');

                        // Remove the existing image reference if a new file is selected
                        if (existingInput) {
                            existingInput.remove();
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropzone.classList.add('border-indigo-500');
                dropzone.classList.remove('border-gray-300');
            }

            function unhighlight() {
                dropzone.classList.remove('border-indigo-500');
                dropzone.classList.add('border-gray-300');
            }

            dropzone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length) {
                    input.files = files;
                    const event = new Event('change');
                    input.dispatchEvent(event);
                }
            }
        }

        // Setup for logo and favicon
        setupFileUpload('logo-input', 'logo-preview', 'logo-dropzone', 'logo-upload-text');
        setupFileUpload('favicon-input', 'favicon-preview', 'favicon-dropzone', 'favicon-upload-text');

        // Remove image function
        function removeImage(type) {
            const preview = document.getElementById(`${type}-preview`);
            const input = document.getElementById(`${type}-input`);
            const uploadText = document.getElementById(`${type}-upload-text`);
            const existingInput = document.getElementById(`existing-${type}`);

            preview.src = '';
            preview.classList.add('hidden');
            input.value = '';
            uploadText.classList.remove('hidden');

            // Remove the existing image reference
            if (existingInput) {
                existingInput.remove();
            }
        }

        // Form submission with loading state
        document.getElementById('identity-form').addEventListener('submit', function(e) {
            const submitButton = document.getElementById('submit-button');
            const buttonText = document.getElementById('button-text');
            const buttonLoading = document.getElementById('button-loading');

            // Validate file sizes before submission
            const logoInput = document.getElementById('logo-input');
            if (logoInput.files.length > 0 && logoInput.files[0].size > 750 * 1024) {
                e.preventDefault();
                alert('Logo size must be less than 750KB');
                return;
            }

            const faviconInput = document.getElementById('favicon-input');
            if (faviconInput.files.length > 0 && faviconInput.files[0].size > 750 * 1024) {
                e.preventDefault();
                alert('Favicon size must be less than 750KB');
                return;
            }

            // Show loading state
            submitButton.disabled = true;
            buttonText.classList.add('hidden');
            buttonLoading.classList.remove('hidden');
        });
    </script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif
@endsection
