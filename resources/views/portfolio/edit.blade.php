@extends('layouts.app')

@section('page_title', 'Portfolio')

@section('content')
    <div class="max-w-full mx-auto p-8">
        <div class="bg-white rounded-[24px] shadow px-10 py-10 space-y-6">
            <h2 class="text-[20px] font-semibold">Edit Portfolio</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Display on Home -->
                <div class="flex items-center gap-3">
                    <input type="checkbox" id="home" name="home"
                        class="w-5 h-5 text-indigo-600 border-gray-300 rounded"
                        {{ $portfolio->home ? 'checked' : '' }}>
                    <label for="home" class="text-sm font-medium">Display on Home</label>
                </div>

                <!-- Title & Program ID -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium mb-1">Title *</label>
                        <input type="text" name="title" value="{{ old('title', $portfolio->title) }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Program *</label>
                        <select name="program_id" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300">
                            <option value="">Select a program</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ old('program_id', $portfolio->program_id) == $program->id ? 'selected' : '' }}>
                                    {{ $program->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('program_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300">{{ old('description', $portfolio->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ID Youtube -->
                <div>
                    <label class="block text-sm font-medium mb-1">YouTube Video ID</label>
                    <input type="text" name="yt_id" value="{{ old('yt_id', $portfolio->yt_id) }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300">
                    @error('yt_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    @if ($portfolio->yt_id)
                        <div class="mt-3">
                            <iframe width="100%" height="250"
                                src="https://www.youtube.com/embed/{{ $portfolio->yt_id }}" frameborder="0" allowfullscreen
                                class="rounded-md"></iframe>
                        </div>
                    @endif
                </div>

                <!-- Image Upload (5x) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    <!-- Logo -->
                    <div>
                        <p class="text-xs text-gray-500 mb-1">
                            Logo (Max: 750kb, JPEG/PNG/JPG/GIF)
                        </p>

                        @if ($portfolio->logo)
                            <div class="mb-2 h-32 border border-gray-200 rounded-md overflow-hidden">
                                <img src="{{ asset('storage/' . $portfolio->logo) }}"
                                    alt="Logo Preview"
                                    class="w-full h-full object-contain bg-gray-50">
                            </div>
                        @endif

                        <div class="h-[180px] border border-gray-300 rounded-md p-4 flex flex-col items-center justify-center text-center relative">
                            <label for="logo" class="cursor-pointer w-full h-full flex items-center justify-center">
                                <div class="flex flex-col items-center justify-center space-y-2 text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                    </svg>
                                    <span class="text-sm">{{ $portfolio->logo ? 'Change logo' : 'Click to upload logo' }}</span>
                                </div>
                                <input type="file" name="logo" id="logo"
                                    class="hidden" accept="image/jpeg,image/png,image/jpg,image/gif">
                            </label>
                        </div>
                        @error('logo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Images 1-4 -->
                    @for ($i = 1; $i <= 4; $i++)
                        @php
                            $imageField = 'image' . $i;
                            $hasImage = !empty($portfolio->$imageField);
                        @endphp
                        <div>
                            <p class="text-xs text-gray-500 mb-1">
                                Image {{ $i }} (Max: 750kb, JPEG/PNG/JPG/GIF)
                            </p>

                            @if ($hasImage)
                                <div class="mb-2 h-32 border border-gray-200 rounded-md overflow-hidden">
                                    <img src="{{ asset('storage/' . $portfolio->$imageField) }}"
                                        alt="Image {{ $i }} Preview"
                                        class="w-full h-full object-contain bg-gray-50">
                                </div>
                            @endif

                            <div class="h-[180px] border border-gray-300 rounded-md p-4 flex flex-col items-center justify-center text-center relative">
                                <label for="image{{ $i }}" class="cursor-pointer w-full h-full flex items-center justify-center">
                                    <div class="flex flex-col items-center justify-center space-y-2 text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                        </svg>
                                        <span class="text-sm">{{ $hasImage ? 'Change image' : 'Click to upload' }}</span>
                                    </div>
                                    <input type="file" name="image{{ $i }}" id="image{{ $i }}"
                                        class="hidden" accept="image/jpeg,image/png,image/jpg,image/gif">
                                </label>
                            </div>
                            @error('image'.$i)
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endfor
                </div>

                <!-- Save Button -->
                <div class="pt-4 flex justify-between">
                    <a href="{{ route('portfolio.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-full hover:scale-105 transition">
                        Back
                    </a>
                    <button type="submit"
                        class="bg-[#A68BF0] text-black px-6 py-2 rounded-full hover:scale-105 transition">
                        Update Portfolio
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

        // Image preview function
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const container = this.closest('div').parentElement;
                const previewDiv = container.querySelector('.mb-2.h-32') || container.insertBefore(document.createElement('div'), container.firstChild);

                if (!previewDiv.classList.contains('mb-2')) {
                    previewDiv.className = 'mb-2 h-32 border border-gray-200 rounded-md overflow-hidden';
                }

                const file = this.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        let img = previewDiv.querySelector('img');
                        if (!img) {
                            img = document.createElement('img');
                            img.className = 'w-full h-full object-contain bg-gray-50';
                            previewDiv.appendChild(img);
                        }
                        img.src = e.target.result;
                    }

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
