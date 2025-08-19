@extends('layouts.app')

@section('page_title', 'Legal Documents')

@section('content')
<div class="max-w-full mx-auto p-[32px] bg-white rounded-[24px] shadow-md">
    <h2 class="text-xl font-semibold mb-6">Edit</h2>

    @if (session('success'))
        <div class="mb-4 text-green-600 font-medium">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('legal.update', $legals->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="title" id="title"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring focus:border-blue-500"
                value="{{ old('title', $legals->title) }}">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description"
                class="w-full border border-gray-300 rounded-md px-4 py-2 min-h-[150px] focus:outline-none focus:ring focus:border-blue-500">{{ old('description', $legals->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Image Upload + Preview -->
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Upload Image <span class="text-xs text-gray-500">(Max Size: 750kb)</span>
        </label>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
            <div>
                <label for="image"
                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 rounded-md cursor-pointer">
                    <div class="space-y-1 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-7 h-7 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <span>Drag and drop a file here or click</span>
                        </div>
                    </div>
                    <input id="image" name="image" type="file" class="sr-only" accept="image/*"
                        onchange="previewImage(event)">
                </label>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Preview Image -->
            <div>
                <img id="preview" src="{{ asset('storage/' . $legals->image) }}" alt="Image preview"
                    class="rounded-lg w-full h-[250px] object-cover border border-gray-300 {{ $legals->image ? '' : 'hidden' }}" />
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit"
                class="bg-[#7C6AED] hover:bg-[#6a59ff] text-white px-6 py-2 rounded-full text-sm font-medium transition">
                Update
            </button>
        </div>
    </form>
</div>

<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#description'), {
            ckfinder: {
                uploadUrl: '{{ route("legal.upload") }}?_token={{ csrf_token() }}'
            }
        })
        .catch(error => {
            console.error(error);
        });

    function previewImage(event) {
        const preview = document.getElementById('preview');
        const file = event.target.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        } else {
            preview.src = '';
            preview.classList.add('hidden');
        }
    }
</script>
@endsection
