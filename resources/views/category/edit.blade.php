@extends('layouts.app')

@section('page_title', 'Blog')

@section('content')
    <div class="container max-w-6xl mx-auto h-auto px-6 py-6 overflow-y-auto">
        <div class="bg-white rounded-xl shadow-md px-8 py-6 h-full">
            <h2 class="text-xl font-semibold mb-8">Edit</h2>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 p-4 rounded bg-green-100 text-green-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Category --}}
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category_id" id="category_id"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @foreach ($category as $categories)
                            <option value="{{ $category->id }}"
                                {{ $category->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Upload & Preview Image --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    {{-- Upload --}}
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload Image (Max:
                            750kb)</label>
                        <label for="image"
                            class="flex flex-col justify-center items-center border-2 border-dashed border-gray-300 rounded-md h-40 cursor-pointer transition hover:border-indigo-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-10 h-10 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                            </svg>
                            <span class="text-sm text-gray-400">Drag and drop or click</span>
                            <input type="file" name="image" id="image" class="hidden">
                        </label>
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Preview --}}
                    <div>
                        @if ($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="Preview"
                                class="rounded-lg max-h-40 object-cover w-full shadow">
                        @else
                            <p class="text-gray-400 italic text-sm">No image available</p>
                        @endif
                    </div>
                </div>

                {{-- Submit --}}
                <div class="pt-4">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-full text-sm font-semibold transition duration-200">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        if (typeof CKEDITOR !== 'undefined') {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
        }
    </script>
@endsection
