@extends('layouts.app')

@section('page_title', 'Misi')

@section('content')
    <div class="max-w-full mx-auto px-6 py-10 bg-white rounded-[24px] shadow-md">
        <h2 class="text-xl font-semibold mb-6">Edit</h2>

        <form action="{{ route('misi.update', $misi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-4">
                <label class="block text-[14px] font-medium text-gray-700 mb-[8px]">Title</label>
                <input type="text" name="title" value="{{ old('title', $misi->title) }}"
                    class="w-full py-[16px] px-[8px] border border-gray-300 rounded-md  focus:ring-purple-500 focus:border-purple-500"
                    required>
            </div>

            <!-- Subtitle -->
            <div class="mb-4">
                <label class="block text-[14px] font-medium text-gray-700 mb-[8px]">Subtitle</label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $misi->subtitle) }}"
                    class="w-full py-[16px] px-[8px] border border-gray-300 rounded-md  focus:ring-purple-500 focus:border-purple-500">
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block text-[14px] font-medium text-gray-700 mb-[8px]">Description</label>
                <textarea name="misi" id="misi" rows="6"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">{{ old('misi', $misi->misi) }}</textarea>
            </div>

            <!-- Upload Image -->
            <div class="flex justify-between gap-8">
                <div class="mb-6 w-full">
                    <label for="image2"
                        class="block mt-1 h-[214px] cursor-pointer flex flex-col items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 rounded-lg hover:border-gray-400 transition">
                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775
                            5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1
                            18 19.5H6.75Z" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">Drag and drop a file here or click</p>
                        <input id="image2" name="image2" type="file" class="hidden">
                    </label>
                </div>

                <!-- Existing Image Preview -->
                @if ($misi->image)
                    <div class="mb-6 w-full">
                        <img src="{{ asset('storage/' . $misi->image) }}" alt="Current Image"
                            class="w-full h-[327px] px-[50px] py-[60px] object-cover rounded-lg shadow">
                    </div>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg">
                    Update
                </button>
            </div>
        </form>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#misi'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
