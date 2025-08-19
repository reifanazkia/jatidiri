@extends('layouts.app')

@section('page_title', 'Blog')

@section('content')
    <div class="container max-w-full mx-auto h-auto overflow-y-auto">
        <div class="bg-white rounded-[24px] shadow-md px-8 py-6 h-full">
            <h2 class="text-xl font-semibold mb-8">Edit Post</h2>

            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input id="title" name="title" type="text" placeholder="Judul Post"
                        value="{{ old('title', $post->title ?? '') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200" />
                </div>

                {{-- Resume --}}
                <div>
                    <label for="resume" class="block text-sm font-medium text-gray-700 mb-1">Resume</label>
                    <textarea name="resume" id="resume" rows="5"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 resize-none">{{ old('resume', $post->resume ?? '') }}</textarea>
                </div>

                {{-- Content --}}
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                    <textarea name="content" id="content" rows="10"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200 resize-none">{{ old('content', $post->content ?? '') }}</textarea>
                </div>

                {{-- Category & Publish Date --}}
                <div class="flex flex-col md:flex-row gap-6 mt-6">
                    {{-- Category --}}
                    <div class="w-full md:w-1/2">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <div class="relative">
                            <select name="category_id" id="category_id"
                                class="w-full pl-4 pr-12 py-2 h-10 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-200 appearance-none bg-white">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Publish Date --}}
                    <div class="w-full md:w-1/2">
                        <label for="publish_date" class="block text-sm font-medium text-gray-700 mb-1">Publish Date</label>
                        <input type="date" name="publish_date" id="publish_date"
                            value="{{ old('publish_date', $post->publish_date ?? '') }}"
                            class="w-full px-4 py-2 h-10 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-200">
                    </div>
                </div>

                {{-- Upload Image & Preview --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 items-start">
                    {{-- Upload --}}
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload Image (Max:
                            750kb)</label>
                        <div
                            class="border border-gray-300 rounded-md w-full h-40 flex items-center justify-center cursor-pointer">
                            <label for="image" class="flex flex-col items-center cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-7 h-7 mx-auto text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                                </svg>
                                <span class="text-sm text-gray-400">Drag and drop or click</span>
                                <input type="file" name="image" id="image" class="hidden">
                            </label>
                        </div>
                    </div>

                    {{-- Preview --}}
                    <div>
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Preview"
                                class="rounded-md max-h-40 object-cover w-full">
                        @endif
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="pt-6">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-full text-sm font-semibold transition duration-200">
                        Update
                    </button>
                </div>

        </div>

        {{-- CKEditor Script --}}
        <script>
            ClassicEditor
                .create(document.querySelector('#content'))
                .catch(error => {
                    console.error(error);
                });
            ClassicEditor
                .create(document.querySelector('#resume'))
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endsection
