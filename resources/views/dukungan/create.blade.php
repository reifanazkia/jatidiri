@extends('layouts.app')

@section('page_title', 'Supports')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white rounded-[24px] shadow p-8">
            <h2 class="text-xl font-semibold mb-6">Add</h2>

            <form action="{{ route('dukungan.store') }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @csrf

                {{-- Left Column --}}
                <div class="space-y-5 col-span-2">
                    <div>
                        <label class="block text-sm font-medium mb-1">Support's Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Title</label>
                        <input type="text" name="jabatan" value="{{ old('jabatan') }}" required
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300">
                    </div>
                </div>

                {{-- Right Column --}}
                <div class="space-y-4">
                    <!-- Image preview container -->
                    <div id="image-preview-container" class="hidden mt-4">
                        <img id="preview-image" src="#" alt="Preview" class="w-full h-[200px] rounded-md">
                    </div>

                    {{-- File Upload --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image (Max Size: 750Kb)</label>
                        <div
                            class="border-2 h-[200px] border-gray-300 rounded-md p-4 flex flex-col items-center justify-center text-center hover:border-gray-400 transition-colors">
                            <label for="image-upload" class="cursor-pointer w-full py-[80px]">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                    </svg>
                                    <span class="text-sm text-gray-600">Click to upload image</span>
                                    <span class="text-xs text-gray-500">PNG, JPG, JPEG (Max. 750KB)</span>
                                </div>
                                <input type="file" name="image" id="image-upload" class="hidden" accept="image/*"> <!-- Changed from image4 to image -->
                            </label>
                        </div>
                    </div>

                    <!-- YouTube ID Input -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">YouTube ID</label>
                        <input type="text" name="id_yt" id="youtube-id-input" value="{{ old('id_yt') }}"
                            placeholder="Masukkan ID YouTube"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300 focus:border-indigo-500">
                    </div>

                    <!-- YouTube preview container -->
                    <div id="youtube-preview-container"
                        class="hidden mt-4 w-full h-36 bg-black rounded-md overflow-hidden flex items-center justify-center relative">
                        <div id="youtube-placeholder" class="flex flex-col items-center justify-center text-center p-4">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                            <span class="text-white text-sm mt-2">No YouTube video selected</span>
                        </div>
                        <img id="youtube-thumbnail" src="" alt="YouTube thumbnail"
                            class="absolute inset-0 w-full h-full object-cover hidden">
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="col-span-3 flex justify-end">
                    <button type="submit"
                        class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md shadow transition-colors duration-200">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('image-upload').addEventListener('change', function(event) {
            const input = event.target;
            const previewContainer = document.getElementById('image-preview-container');
            const previewImage = document.getElementById('preview-image');

            if (input.files && input.files[0]) {
                // Check file size
                if (input.files[0].size > 750000) {
                    alert('File size exceeds 750KB limit');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                previewContainer.classList.add('hidden');
            }
        });

        document.getElementById('youtube-id-input').addEventListener('input', function(e) {
            const youtubeId = e.target.value;
            const previewContainer = document.getElementById('youtube-preview-container');
            const placeholder = document.getElementById('youtube-placeholder');
            const thumbnail = document.getElementById('youtube-thumbnail');

            if (!youtubeId) {
                thumbnail.src = '';
                thumbnail.classList.add('hidden');
                placeholder.classList.remove('hidden');
                return;
            }

            // Validasi dasar ID YouTube (11 karakter)
            if (!/^[a-zA-Z0-9_-]{11}$/.test(youtubeId)) {
                placeholder.classList.remove('hidden');
                thumbnail.classList.add('hidden');
                return;
            }

            // Tampilkan thumbnail YouTube
            thumbnail.src = `https://img.youtube.com/vi/${youtubeId}/mqdefault.jpg`;
            thumbnail.onload = function() {
                thumbnail.classList.remove('hidden');
                placeholder.classList.add('hidden');
            };
            thumbnail.onerror = function() {
                thumbnail.classList.add('hidden');
                placeholder.classList.remove('hidden');
            };
        });

        // Inisialisasi jika ada nilai awal
        document.addEventListener('DOMContentLoaded', function() {
            const initialId = document.getElementById('youtube-id-input').value;
            if (initialId) {
                const event = {
                    target: {
                        value: initialId
                    }
                };
                document.getElementById('youtube-id-input').dispatchEvent(new Event('input'));
            }
        });
    </script>
@endsection
