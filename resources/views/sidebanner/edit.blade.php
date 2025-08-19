@extends('layouts.app')

@section('page_title', 'Edit Sidebanner')

@section('content')
    <div class="max-w-full mx-auto p-8 bg-white rounded-[24px] shadow-md">
        <h2 class="text-xl font-semibold mb-6">Edit</h2>

        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        @endif

        <form id="editForm" action="{{ route('sidebanner.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image (Max: 750kb)</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Upload Image --}}
                <div>
                    <div id="uploadContainer"
                        class="relative items-center w-full h-[200px] border border-gray-300 rounded-lg py-16 p-6 text-center text-gray-500 hover:border-indigo-500 transition cursor-pointer">
                        <input type="file" id="imageInput" name="image" accept="image/*"
                            class="w-full h-full opacity-0 absolute cursor-pointer z-10 top-0 left-0" />
                        <div id="uploadContent" class="z-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-7 h-7 mx-auto text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                            </svg>
                            <p>Drag and drop a file here or click</p>
                        </div>
                    </div>
                    @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Preview Image --}}
                <div id="previewContainer">
                    @if ($data->image)
                        <div class="relative">
                            <img id="imagePreview" src="{{ asset('uploads/sidebanner/' . $data->image) }}"
                                class="rounded-lg w-full h-[200px] object-cover shadow">
                            <div class="mt-2">
                                <button type="button" onclick="confirmDelete()"
                                    class="text-red-600 text-sm hover:text-red-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    Delete Image
                                </button>
                            </div>
                        </div>
                    @else
                        <p id="noImageText" class="text-gray-400 italic px-[8px] py-[16px]">No image uploaded.</p>
                    @endif

                    {{-- Link input --}}
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Link Banner</label>
                        <input type="text" name="link" value="{{ old('link', $data->link) }}"
                            class="px-[8px] py-[16px] mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('link')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="mt-8">
                <button type="submit" id="submitBtn"
                    class="px-6 py-2 rounded-full bg-indigo-600 text-white hover:bg-indigo-700 transition">Update</button>
            </div>
        </form>
    </div>

    <form id="deleteForm" action="{{ route('sidebanner.destroy', $data->id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Form submission with loading
        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                    <span class="inline-flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Processing...
                    </span>
                `;

            Swal.fire({
                title: 'Updating...',
                html: 'Please wait while we update your sidebanner.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                    this.submit();
                }
            });
        });

        // Delete confirmation
        function confirmDelete() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Deleting...',
                        html: 'Please wait while we delete the image.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                            document.getElementById('deleteForm').submit();
                        }
                    });
                }
            });
        }

        // Preview image when selected
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewContainer = document.getElementById('previewContainer');
            const noImageText = document.getElementById('noImageText');

            if (file) {
                // Validate file size (750KB)
                if (file.size > 750 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File too large',
                        text: 'Maximum file size is 750KB',
                    });
                    this.value = ''; // Clear the input
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(event) {
                    // Remove no image text if exists
                    if (noImageText) {
                        noImageText.remove();
                    }

                    // Check if preview image already exists
                    let previewImage = document.getElementById('imagePreview');

                    if (!previewImage) {
                        // Create new image element
                        previewImage = document.createElement('img');
                        previewImage.id = 'imagePreview';
                        previewImage.className = 'rounded-lg w-full h-[200px] object-cover shadow';
                        previewContainer.insertBefore(previewImage, previewContainer.firstChild);
                    }

                    // Set the image source
                    previewImage.src = event.target.result;

                    // Show delete button if not exists
                    if (!document.querySelector('#previewContainer button')) {
                        const deleteBtn = document.createElement('div');
                        deleteBtn.className = 'mt-2';
                        deleteBtn.innerHTML = `
                                <button type="button" onclick="confirmDelete()" class="text-red-600 text-sm hover:text-red-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    Delete Image
                                </button>
                            `;
                        previewContainer.insertBefore(deleteBtn, document.querySelector(
                            '#previewContainer > div:last-child'));
                    }
                };
                reader.readAsDataURL(file);
            }
        });

        // Drag and drop functionality
        const uploadContainer = document.getElementById('uploadContainer');

        uploadContainer.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadContainer.classList.add('border-indigo-500', 'bg-indigo-50');
        });

        uploadContainer.addEventListener('dragleave', () => {
            uploadContainer.classList.remove('border-indigo-500', 'bg-indigo-50');
        });

        uploadContainer.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadContainer.classList.remove('border-indigo-500', 'bg-indigo-50');

            if (e.dataTransfer.files.length) {
                document.getElementById('imageInput').files = e.dataTransfer.files;
                // Trigger change event manually
                const event = new Event('change');
                document.getElementById('imageInput').dispatchEvent(event);
            }
        });
    </script>
@endsection
