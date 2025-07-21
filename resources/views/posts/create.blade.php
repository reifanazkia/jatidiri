@extends('layouts.app')

@section('page_title', 'Blog')

@section('content')
    {{-- Pindahkan CKEditor ke section scripts --}}
    <div class="container mt-[32px] p-[32px] w-[1376px] max-h-auto bg-white rounded-[16px] shadow-md">
        <h2 class="text-[24px] font-medium px-[18px] mb-[32px]">Add</h2>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="space-y-6">
                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input id="title" name="title" type="text" placeholder="Judul Post"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200" />
                </div>

                {{-- Resume --}}
                <div class="space-y-4">
                    <label for="resume" class="block text-sm font-medium text-gray-700">Resume</label>
                    <textarea name="resume" id="resume" rows="5"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 resize-none">
                        {{ old('resume', $data->resume ?? '') }}
                    </textarea>
                </div>

                {{-- Content --}}
                <div class="space-y-4 mt-6">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea name="content" id="content" rows="10"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 resize-none">
                        {{ old('content', $data->content ?? '') }}
                    </textarea>
                </div>

                {{-- Kategori & Tanggal --}}
                <div class="flex gap-4 items-center">
                    <div class="w-1/2">
                        <label for="category" class="block text-gray-500 text-[14px] px-[18px] mb-1">Category</label>
                        <select name="category" id="category"
                            class="w-full px-4 py-2 text-[14px] border rounded shadow focus:outline-none">
                            <option value="Artikel">Artikel</option>
                            <option value="Berita">Berita</option>
                            <option value="Agenda">Agenda</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="publish_date" class="block text-gray-500 text-[14px] px-[18px] mb-1">Publish
                            Date</label>
                        <input type="date" name="publish_date" id="publish_date"
                            class="w-full px-4 py-2 text-[14px] border rounded shadow focus:outline-none">
                    </div>
                </div>

                {{-- Upload Image --}}
                <div class="w-full max-w-4xl mx-auto mt-10">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image (Max Size: 750kb)</label>

                    {{-- Area Upload --}}
                    <div id="upload-box"
                        class="relative flex justify-center items-center w-full border-2 border-dashed border-gray-300 rounded-xl h-60 cursor-pointer bg-white">

                        {{-- Icon & Text --}}
                        <label id="upload-placeholder" for="image"
                            class="flex flex-col items-center space-y-3 text-gray-500 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16V4m10 12V4m-5 16l-5-5m10 0l-5 5" />
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
    {{-- CKEditor CDN --}}
    <script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
    <script>
        console.log("CKEditor mulai...");
        CKEDITOR.replace('resume');
        CKEDITOR.replace('content');
    </script>

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

