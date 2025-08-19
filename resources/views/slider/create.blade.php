@extends('layouts.app')

@section('page_title', 'Slider')

@section('content')

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white container mx-auto p-[32px] gap-8 rounded-[24px]">
        <h2 class="text-xl font-semibold mb-6">Add Slider</h2>

        <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @csrf

            <!-- Left Side -->
            <div class="space-y-4 col-span-2">
                <!-- Display on Home -->
                <div class="flex items-center space-x-2 mb-6">
                    <input type="checkbox" name="home" id="home" value="1" class="w-4 h-4 text-indigo-600">
                    <label for="home" class="text-sm text-gray-700">Display on Home</label>
                </div>

                <!-- Program Name -->
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Program *</label>
                    <div class="relative">
                        <select name="program_id" required
                            class="px-[8px] py-[18px] pr-[32px] w-full border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 text-sm appearance-none">
                            <option value="">-- Select Program --</option>
                            @foreach ($programs as $program)
                                <option value="{{ $program->id }}">{{ $program->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Title -->
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Title *</label>
                    <input type="text" name="title" required
                        class="w-full px-[8px] py-[18px] border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 text-sm"
                        placeholder="Slider's Title">
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-[8px] py-[18px] border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 text-sm"
                        placeholder="Write something..."></textarea>
                </div>

                <div>
                    <label class="block text-sm text-gray-700 mb-1">Content Alignment</label>
                    <div class="relative">
                        <select name="align"
                            class="w-full px-3 py-[18px] border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 text-sm appearance-none">
                            <option value="left">Left</option>
                            <option value="center">Center</option>
                            <option value="right">Right</option>
                        </select>

                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Button Text -->
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Button Text</label>
                    <input type="text" name="button"
                        class="w-full px-[8px] py-[18px] border border-gray-300 rounded-md focus:ring focus:ring-indigo-200 text-sm"
                        placeholder="Button Text">
                </div>

                <!-- URL Link -->
                <div>
                    <label class="block text-sm text-gray-700 mb-1">URL Link</label>
                    <input type="text" name="link"
                        class="w-full px-[8px] py-[18px] border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 text-sm"
                        placeholder="Url">
                </div>

                <!-- Save Button -->
                <div class="pt-4">
                    <button type="submit"
                        class="px-6 py-3 bg-indigo-500 hover:bg-indigo-600 text-white rounded-full text-sm">
                        Save Slider
                    </button>
                </div>
            </div>

            <!-- Right Side -->
            <div class="space-y-4">
                <!-- Image Preview -->
                <div id="imagePreviewContainer" class="hidden">
                    <label class="block text-sm text-gray-700 mb-1">Image Preview</label>
                    <div class="h-[200px] border border-gray-300 rounded-lg overflow-hidden">
                        <img id="imagePreview" src="#" alt="Preview" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Image *</label>
                    <label for="image"
                        class="block mt-1 h-[252px] cursor-pointer flex flex-col items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 rounded-lg hover:border-gray-400 transition">
                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">Drag and drop a file here or click</p>
                        <input id="image" name="image" type="file" class="hidden"
                            accept="image/jpeg,image/png,image/jpg" required>
                    </label>
                    <p class="mt-1 text-xs text-gray-500">JPEG, PNG, JPG (Max: 2MB)</p>
                </div>

                <!-- YouTube ID -->
                <div>
                    <label class="block text-sm text-gray-700 mb-1">YouTube Video ID</label>
                    <input type="text" name="yt_id"
                        class="w-full px-[8px] py-[18px] border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 text-sm"
                        placeholder="e.g. dQw4w9WgXcQ">
                </div>
            </div>
        </form>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {
                simpleUpload: {
                    uploadUrl: "{{ route('slider.upload') }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                }
            })
            .catch(error => {
                console.error(error);
            });

        // Image preview functionality
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const previewContainer = document.getElementById('imagePreviewContainer');
                    const previewImage = document.getElementById('imagePreview');

                    previewImage.src = event.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
