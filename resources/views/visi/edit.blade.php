@extends('layouts.app')

@section('page_title', 'Visi')

@section('content')
    <div class="max-w-full mx-auto bg-white p-8 rounded-[24px] shadow-md">
        <h2 class="text-xl font-semibold mb-6">Edit</h2>

        <form action="{{ route('visi.update', $visi->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <!-- Title -->
            <div>
                <label for="title" class="block text-[14px] font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title"
                    value="{{ $errors->has('title') ? old('title') : $visi->title }}"
                    class="mt-[8px] block py-[16px] px-[8px] w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500">
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Subtitle -->
            <div>
                <label for="subtitle" class="block text-[14px] font-medium text-gray-700">Subtitle</label>
                <input type="text" id="subtitle" name="subtitle" value="{{ old('subtitle', $visi->subtitle) }}"
                    class="mt-[8px] block py-[16px] px-[8px] w-full border border-gray-300 rounded-md  p-2 focus:ring-indigo-500 focus:border-indigo-500">
                @error('subtitle')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="visi" class="block text-[14px] font-medium text-gray-700 mb-[8px]">Description</label>
                <textarea id="visi" name="visi"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                    rows="4">{{ old('visi', $visi->visi) }}</textarea>
                @error('visi')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Image and Preview -->
            <div class="items-center">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Image <span class="text-xs text-gray-500">(Max 750kb)</span>
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="image"
                            class="block mt-1 h-[214px] cursor-pointer flex flex-col items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 rounded-lg hover:border-gray-400 transition">
                            <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775
                                5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1
                                18 19.5H6.75Z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">Drag and drop a file here or click</p>
                            <p class="mt-1 text-xs text-gray-500" id="file-name"></p>
                            <input id="image" name="image" type="file" class="hidden" accept="image/*">
                        </label>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Preview Area (akan menampilkan gambar lama atau preview baru) -->
                    <div class="rounded-lg overflow-hidden">
                        <p class="text-sm font-medium text-gray-700 mb-2" id="image-label">
                            {{ $visi->image ? 'Current Image' : 'No Image Available' }}
                        </p>
                        <div class="relative">
                            <!-- Gambar lama (akan disembunyikan saat ada preview baru) -->
                            <div id="current-image-container" class="{{ $visi->image ? '' : 'hidden' }}">
                                @if ($visi->image)
                                    <img src="{{ asset('storage/' . $visi->image) }}" alt="Current Image"
                                        class="w-full h-[327px] rounded-xl shadow-sm object-cover" id="current-image">
                                @else
                                    <div
                                        class="w-full h-[327px] bg-gray-100 rounded-xl flex items-center justify-center text-gray-400">
                                        No Image Available
                                    </div>
                                @endif
                            </div>

                            <!-- Preview gambar baru (awalnya hidden) -->
                            <div id="new-image-preview-container" class="hidden">
                                <img id="new-image-preview" class="w-full h-[327px] rounded-xl shadow-sm object-cover">
                            </div>

                            <!-- Tombol reset (awalnya hidden) -->
                            <button type="button" id="reset-image-btn"
                                class="hidden absolute top-2 right-2 bg-white/80 hover:bg-white text-gray-800 p-1 rounded-full shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-4">
                <button type="submit"
                    class="px-6 py-2 bg-indigo-500 text-white font-semibold rounded-full shadow hover:bg-indigo-600">
                    Update
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('image');
            const fileName = document.getElementById('file-name');
            const currentImageContainer = document.getElementById('current-image-container');
            const newImagePreviewContainer = document.getElementById('new-image-preview-container');
            const newImagePreview = document.getElementById('new-image-preview');
            const resetImageBtn = document.getElementById('reset-image-btn');
            const imageLabel = document.getElementById('image-label');

            fileInput.addEventListener('change', function(e) {
                if (fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    fileName.textContent = file.name;

                    // Membuat preview gambar baru
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Tampilkan preview baru dan sembunyikan gambar lama
                        newImagePreview.src = e.target.result;
                        newImagePreviewContainer.classList.remove('hidden');
                        currentImageContainer.classList.add('hidden');
                        resetImageBtn.classList.remove('hidden');
                        imageLabel.textContent = 'New Image Preview';
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Tombol reset untuk membatalkan pilihan gambar baru
            resetImageBtn.addEventListener('click', function() {
                fileInput.value = '';
                fileName.textContent = '';
                newImagePreviewContainer.classList.add('hidden');
                currentImageContainer.classList.remove('hidden');
                resetImageBtn.classList.add('hidden');
                imageLabel.textContent = '{{ $visi->image ? 'Current Image' : 'No Image Available' }}';
            });

            // Inisialisasi CKEditor jika diperlukan
            if (document.querySelector('#visi')) {
                ClassicEditor
                    .create(document.querySelector('#visi'))
                    .catch(error => {
                        console.error(error);
                    });
            }
        });
    </script>
@endsection
