@extends('layouts.app')

@section('page_title', 'Blog')

@section('content')
    {{-- Pindahkan CKEditor ke section scripts --}}
    <div class="container mt-[32px] p-[32px] max-h-auto max-w-auto bg-white rounded-[16px] shadow-md">
        <h2 class="text-[24px] font-medium px-[18px] mb-[32px]">Add</h2>

        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="space-y-6">
                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                    <input id="title" name="title" type="text" placeholder="Name category"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200" />
                </div>
                {{-- Upload Image --}}
                <div class="w-full max-w-4xl mt-10">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image (Max Size: 750kb)</label>

                    {{-- Area Upload --}}
                    <div id="upload-box"
                        class="relative flex justify-center items-center w-full border-2 border-dashed border-gray-300 rounded-xl h-60 cursor-pointer bg-white">

                        {{-- Icon & Text --}}
                        <label id="upload-placeholder" for="image"
                            class="flex flex-col items-center space-y-3 text-gray-500 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-10 h-10">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                            </svg>
                            <span class="text-center text-sm">Drag and drop a file here or click</span>
                        </label>

                        {{-- Input File --}}
                        <input id="image" name="image" type="file" accept="image/*" class="hidden"
                            onchange="previewImage(event)">

                        {{-- Preview Image (inside box) --}}
                        <img id="image-preview" src="#" alt="Preview"
                            class="absolute inset-0 w-full h-full object-contain rounded-xl hidden z-10" />
                    </div>
                </div>



                {{-- Tombol Submit --}}
                <div class="text-right">
                    <button type="submit"
                        class="bg-[#6F4FF2] hover:bg-[#523dc2] text-white font-semibold text-[14px] px-6 py-2 rounded shadow-lg">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')


    {{-- Trix Editor (kalau kamu masih pakai) --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById("image-preview");
            const placeholder = document.getElementById("upload-placeholder");

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove("hidden");
                    placeholder.classList.add("hidden"); // sembunyikan icon+teks
                };
                reader.readAsDataURL(file);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById("sidebar");
            if (sidebar) {
                sidebar.classList.add("hidden");
            }
        });
    </script>
@endsection
