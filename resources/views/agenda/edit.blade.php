@extends('layouts.app')

@section('content')
    <div class="container max-w-6xl mx-auto h-auto px-6 py-6 overflow-y-auto">
        <div class="bg-white rounded-xl shadow-md px-8 py-6 h-full">
            <h2 class="text-xl font-semibold mb-8">Edit Post</h2>

            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Category --}}
                <div>
                    <label for="category_id" class="block text-gray-600 text-sm mb-2">Category</label>
                    <select name="category_id" id="category_id"
                        class="w-full border px-4 py-2 text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Upload Image & Preview --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    {{-- Upload Image --}}
                    <div>
                        <label for="image" class="block text-gray-600 text-sm mb-2">Upload Image (Max: 750kb)</label>
                        <div
                            class="border border-dashed border-gray-400 rounded-md w-full h-40 flex items-center justify-center cursor-pointer">
                            <label for="image" class="flex flex-col items-center cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400 mb-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12v6m0 0l-3-3m3 3l3-3m6-5a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm text-gray-400">Drag and drop or click</span>
                                <input type="file" name="image" id="image" class="hidden">
                            </label>
                        </div>
                    </div>

                    {{-- Preview Image --}}
                    <div>
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Preview"
                                class="rounded-md max-h-40 object-cover w-full">
                        @endif
                    </div>
                </div>

                {{-- Submit Button --}}
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
