@extends('layouts.app')

@section('page_title', 'Testimony')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-10 bg-white rounded-xl shadow-md">
        <h2 class="text-xl font-semibold mb-6">Add Testimony</h2>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('testimonies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Display on Home Toggle -->
            <div class="flex items-center space-x-3">
                <input type="checkbox" id="home" name="home" value="1"
                    class="h-4 w-4 text-purple-500 focus:ring-purple-400 border-gray-300 rounded">
                <label for="home" class="text-sm font-medium text-gray-700">Display on Home</label>
            </div>

            <div class="grid grid-cols-3 gap-8">
                <!-- Left Column -->
                <div class="space-y-6 col-span-2">
                    <!-- Program Selection -->
                    <div>
                        <div class="relative">
                            <label for="program_id" class="block mb-2 text-sm font-medium text-gray-700">Assessment</label>
                            <select name="program_id" id="program_id" required
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
                        @error('program_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" id="name" name="name" placeholder="Full name" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                            value="{{ old('name') }}">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div class="mt-[32px]">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" id="title" name="title" placeholder="Position/Title" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                            value="{{ old('title') }}">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-0">
                    <!-- Image Upload -->
                    <div class="h-full">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-700">Upload Image (Max:
                            750kb)</label>
                        <div id="dropzone"
                            class="flex flex-col justify-center items-center border-2 border-gray-300 rounded-lg h-56 text-gray-500 text-sm text-center cursor-pointer">
                            <input type="file" name="image" id="image" accept="image/*" class="hidden"
                                onchange="previewImage(event)">
                            <label for="image"
                                class="w-full h-full flex flex-col justify-center items-center cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                </svg>
                                <span>Drag and drop a file here or click</span>
                            </label>
                        </div>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="grid grid-cols-3 gap-8">
                <div class="col-span-2">
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="6"
                            class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500"></textarea>
                    </div>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- YouTube ID -->
                <div>
                    <label for="yt_link" class="block text-sm font-medium text-gray-700 mb-1">YouTube Video ID</label>
                    <input type="text" id="yt_link" name="yt_link" placeholder="YouTube video ID"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                        value="{{ old('yt_link') }}">
                    @error('yt_link')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex">
                <button type="submit"
                    class="px-6 py-2 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    Save
                </button>
            </div>
        </form>
    </div>

    <script>
        // Image preview function
        function previewImage(event) {
            const dropzone = document.getElementById('dropzone');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    dropzone.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover rounded-lg" />
                        <label for="image" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white cursor-pointer opacity-0 hover:opacity-100 transition-opacity">
                            Change Image
                        </label>
                    `;
                    dropzone.querySelector('label').addEventListener('click', function(e) {
                        e.stopPropagation();
                    });
                };
                reader.readAsDataURL(file);
            }
        }

        // CKEditor

        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

    </script>
@endsection
