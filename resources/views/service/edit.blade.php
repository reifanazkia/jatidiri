@extends('layouts.app')

@section('page_title', 'Edit Service')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white rounded-xl shadow-lg px-8 py-10">
            <h2 class="text-3xl font-bold mb-10 text-gray-800">Edit Service</h2>

            <form action="{{ route('service.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-8">
                    <label for="name" class="block text-gray-800 font-semibold mb-2">Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $service->name) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300 text-gray-700"
                        required>
                </div>

                @for ($i = 1; $i <= 4; $i++)
                    <div class="mb-12 {{ $i < 4 ? 'border-b border-gray-100 pb-8' : '' }}">
                        <h3 class="text-xl font-semibold mb-5 text-gray-800">Section {{ $i }}</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm text-gray-600 font-medium mb-1">Title
                                    {{ $i }}</label>
                                <input type="text" name="title{{ $i }}"
                                    value="{{ old('title' . $i, $service->{'title' . $i}) }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-blue-200"
                                    placeholder="Enter title {{ $i }}">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Image {{ $i }}
                                </label>
                                <div class="flex flex-col">
                                    {{-- Input File --}}
                                    <input type="file" name="image{{ $i }}" id="image{{ $i }}"
                                        accept="image/*" class="hidden"
                                        onchange="previewImage(this, 'preview_image-{{ $i }}', 'preview-container-{{ $i }}', 'file-name-{{ $i }}')">

                                    {{-- Button Pilih File --}}
                                    <button type="button"
                                        onclick="document.getElementById('image{{ $i }}').click()"
                                        class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md text-sm flex items-center gap-4">
                                        <span
                                            class="inline-flex px-4 py-2 bg-gray-300 text-black text-xs font-medium rounded-md cursor-pointer">
                                            Pilih File
                                        </span>
                                        <span id="file-name-{{ $i }}" class="text-sm text-gray-500">No file
                                            chosen</span>
                                    </button>

                                    {{-- Preview --}}
                                    <div id="preview-container-{{ $i }}"
                                        class="flex flex-col items-center gap-1 mt-2 {{ old("image$i") || isset($service->{"image$i"}) ? '' : 'hidden' }}">
                                        <img id="preview_image-{{ $i }}"
                                            src="{{ $service->{'image' . $i} ? asset('storage/' . $service->{'image' . $i}) : '#' }}"
                                            alt="Preview" class="w-20 h-20 object-cover rounded-md border border-gray-200">
                                        <button type="button"
                                            onclick="removeImage('image{{ $i }}', 'preview-container-{{ $i }}', 'file-name-{{ $i }}', 'preview_image-{{ $i }}')"
                                            class="text-gray-500 hover:text-gray-700 text-xs flex items-center mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Remove image
                                        </button>
                                    </div>

                                </div>
                            </div>


                        </div>

                        <div class="mt-4">
                            <label class="block text-sm text-gray-600 font-medium mb-1">Description
                                {{ $i }}</label>
                            <textarea name="description{{ $i }}" id="description{{ $i }}" rows="3"
                                class="ckeditor w-full border border-gray-300 rounded-lg px-4 py-2"
                                placeholder="Enter description {{ $i }}">{{ old('description' . $i, $service->{'description' . $i}) }}</textarea>
                        </div>
                    </div>
                @endfor

                {{-- Submit Button --}}
                <div class="mt-10 text-left">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @for ($i = 1; $i <= 4; $i++)
                ClassicEditor.create(document.querySelector('#description{{ $i }}')).catch(e => console
                    .error(e));
            @endfor
        });

        function previewImage(input, imgId, containerId, fileNameId) {
            const file = input.files[0];
            const imgPreview = document.getElementById(imgId);
            const previewContainer = document.getElementById(containerId);
            const fileName = document.getElementById(fileNameId);

            function removeImage(inputId, containerId, fileNameId, imgId) {
                document.getElementById(inputId).value = ''; // kosongkan input file
                document.getElementById(containerId).classList.add('hidden'); // sembunyikan preview
                document.getElementById(fileNameId).textContent = "No file chosen"; // reset nama file
                document.getElementById(imgId).src = "#"; // reset preview src
                document.getElementById(`remove_${inputId}`).value = '1'; // tandai untuk dihapus
            }


            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imgPreview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    fileName.textContent = file.name;
                };
                reader.readAsDataURL(file);
            } else {
                imgPreview.src = "#";
                previewContainer.classList.add('hidden');
                fileName.textContent = "No file chosen";
            }
        }
    </script>
@endsection
