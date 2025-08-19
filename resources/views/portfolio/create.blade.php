@extends('layouts.app')

@section('page_title', 'Portfolio')

@section('content')
    <div class="max-w-full mx-auto p-8">
        <div class="bg-white rounded-[24px] shadow p-8 ">
            <h2 class="text-[20px] font-semibold mb-6">Add</h2>

            <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Display on Home -->
                <div class="flex items-center gap-3">
                    <input type="checkbox" id="display" name="display_on_home"
                        class="w-5 h-5 text-indigo-600 border-gray-300 rounded">
                    <label for="display" class="text-sm font-medium">Display on Home</label>
                </div>

                <!-- Title & Program Name -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium mb-1">Title</label>
                        <input type="text" name="title"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300">
                    </div>
                    <div>
                        <div class="relative">
                            <label for="program_id" class="block mb-2 text-sm font-medium text-gray-700">Assessment</label>
                            <select name="program_id" id="program_id"
                                class="w-full py-2.5 pl-4 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 appearance-none bg-white">
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}">{{ $program->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none mt-5">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300"></textarea>
                </div>

                <!-- ID Youtube -->
                <div>
                    <label class="block text-sm font-medium mb-1">ID Youtube</label>
                    <input type="text" name="youtube_id"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300">
                </div>

                <!-- Image Upload (5x) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    <!-- Logo -->
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Logo (Max Size: 750kb)</p>
                        <div
                            class="h-[252px] border border-gray-300 rounded-md p-4 flex flex-col items-center justify-center text-center relative overflow-hidden">
                            <label for="image1" class="cursor-pointer w-full h-full">
                                <div class="flex flex-col items-center justify-center space-y-2" id="image1-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775
                                      5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18
                                      19.5H6.75Z" />
                                    </svg>
                                    <span class="text-sm text-gray-600">Drag and drop a file here or click</span>
                                </div>
                                <img id="image1-preview" class="absolute inset-0 w-full h-full object-cover hidden"
                                    src="" alt="Preview">
                                <input type="file" name="image1" id="image1" class="hidden" accept="image/*">
                            </label>
                        </div>
                        <button type="button" id="remove-image1" class="mt-2 text-xs text-red-500 hidden">Remove</button>
                    </div>

                    <!-- Image 1 -->
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Image 1 (Max Size: 750kb)</p>
                        <div
                            class="h-[252px] border border-gray-300 rounded-md p-4 flex flex-col items-center justify-center text-center relative overflow-hidden">
                            <label for="image2" class="cursor-pointer w-full h-full">
                                <div class="flex flex-col items-center justify-center space-y-2" id="image2-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775
                                      5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18
                                      19.5H6.75Z" />
                                    </svg>
                                    <span class="text-sm text-gray-600">Drag and drop a file here or click</span>
                                </div>
                                <img id="image2-preview" class="absolute inset-0 w-full h-full object-cover hidden"
                                    src="" alt="Preview">
                                <input type="file" name="image2" id="image2" class="hidden" accept="image/*">
                            </label>
                        </div>
                        <button type="button" id="remove-image2" class="mt-2 text-xs text-red-500 hidden">Remove</button>
                    </div>

                    <!-- Image 2 -->
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Image 2 (Max Size: 750kb)</p>
                        <div
                            class="h-[252px] border border-gray-300 rounded-md p-4 flex flex-col items-center justify-center text-center relative overflow-hidden">
                            <label for="image3" class="cursor-pointer w-full h-full">
                                <div class="flex flex-col items-center justify-center space-y-2" id="image3-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775
                                      5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18
                                      19.5H6.75Z" />
                                    </svg>
                                    <span class="text-sm text-gray-600">Drag and drop a file here or click</span>
                                </div>
                                <img id="image3-preview" class="absolute inset-0 w-full h-full object-cover hidden"
                                    src="" alt="Preview">
                                <input type="file" name="image3" id="image3" class="hidden" accept="image/*">
                            </label>
                        </div>
                        <button type="button" id="remove-image3"
                            class="mt-2 text-xs text-red-500 hidden">Remove</button>
                    </div>

                    <!-- Image 3 -->
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Image 3 (Max Size: 750kb)</p>
                        <div
                            class="h-[252px] border border-gray-300 rounded-md p-4 flex flex-col items-center justify-center text-center relative overflow-hidden">
                            <label for="image4" class="cursor-pointer w-full h-full">
                                <div class="flex flex-col items-center justify-center space-y-2" id="image4-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775
                                      5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18
                                      19.5H6.75Z" />
                                    </svg>
                                    <span class="text-sm text-gray-600">Drag and drop a file here or click</span>
                                </div>
                                <img id="image4-preview" class="absolute inset-0 w-full h-full object-cover hidden"
                                    src="" alt="Preview">
                                <input type="file" name="image4" id="image4" class="hidden" accept="image/*">
                            </label>
                        </div>
                        <button type="button" id="remove-image4"
                            class="mt-2 text-xs text-red-500 hidden">Remove</button>
                    </div>

                    <!-- Image 4 -->
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Image 4 (Max Size: 750kb)</p>
                        <div
                            class="h-[252px] border border-gray-300 rounded-md p-4 flex flex-col items-center justify-center text-center relative overflow-hidden">
                            <label for="image5" class="cursor-pointer w-full h-full">
                                <div class="flex flex-col items-center justify-center space-y-2" id="image5-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775
                                      5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18
                                      19.5H6.75Z" />
                                    </svg>
                                    <span class="text-sm text-gray-600">Drag and drop a file here or click</span>
                                </div>
                                <img id="image5-preview" class="absolute inset-0 w-full h-full object-cover hidden"
                                    src="" alt="Preview">
                                <input type="file" name="image5" id="image5" class="hidden" accept="image/*">
                            </label>
                        </div>
                        <button type="button" id="remove-image5"
                            class="mt-2 text-xs text-red-500 hidden">Remove</button>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="pt-4">
                    <button type="submit"
                        class="bg-[#A68BF0] text-black px-6 py-2 rounded-full hover:scale-105 transition">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Image preview functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Handle all image uploads
            for (let i = 1; i <= 5; i++) {
                const input = document.getElementById(`image${i}`);
                const preview = document.getElementById(`image${i}-preview`);
                const label = document.getElementById(`image${i}-label`);
                const removeBtn = document.getElementById(`remove-image${i}`);

                if (input && preview && label && removeBtn) {
                    input.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(event) {
                                preview.src = event.target.result;
                                preview.classList.remove('hidden');
                                label.classList.add('hidden');
                                removeBtn.classList.remove('hidden');
                            }
                            reader.readAsDataURL(file);
                        }
                    });

                    removeBtn.addEventListener('click', function() {
                        input.value = '';
                        preview.src = '';
                        preview.classList.add('hidden');
                        label.classList.remove('hidden');
                        removeBtn.classList.add('hidden');
                    });
                }
            }

            // Initialize CKEditor if needed
            if (document.querySelector('#description')) {
                ClassicEditor
                    .create(document.querySelector('#description'))
                    .catch(error => {
                        console.error(error);
                    });
            }
        });
    </script>
@endsection
