@extends('layouts.app')

@section('page_title', 'FAQs')

@section('content')
    <div class="max-w-full mx-auto p-[32px] bg-white rounded-[24px] shadow-sm">

        <h2 class="text-xl font-semibold mb-6">Add FAQ</h2>

        <form action="{{ route('faqs.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Title (changed from Question to match controller) --}}
            <div>
                <label for="title" class="block text-sm font-medium mb-1">Title</label>
                <input type="text" name="title" id="title"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300"
                    placeholder="Title" value="{{ old('title') }}">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Content (changed from Answer to match controller) --}}
            <div>
                <label for="description" class="block text-sm font-medium mb-1">Answer</label>
                <textarea name="description" id="description" rows="6"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category --}}
            <div>
                <label for="category_id" class="block text-sm font-medium mb-1">Category</label>
                <div class="relative">
                    <select name="category_id" id="category_id"
                        class="w-full border border-gray-300 bg-white text-gray-700 rounded-md px-4 py-2 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 appearance-none">
                        <option value="">Select Category</option>
                        @foreach (\App\Models\Category::all() as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    {{-- Custom Arrow Icon --}}
                    <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit" class="bg-[#7E74F1] text-white px-6 py-2 rounded-full hover:bg-[#6259e6] transition">
                    Save
                </button>
            </div>
        </form>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
