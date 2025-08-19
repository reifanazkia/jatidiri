@extends('layouts.app')

@section('page_title', 'Edit FAQ')

@section('content')
<div class="max-w-full mx-auto p-[32px] bg-white rounded-[24px] shadow-sm">

    <h2 class="text-xl font-semibold mb-6">Edit</h2>

    <form action="{{ route('faqs.update', $faq->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div>
            <label for="title" class="block text-sm font-medium mb-1">Title</label>
            <input type="text" name="title" id="title"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300"
                placeholder="Title" value="{{ old('title', $faq->title) }}">
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" id="description" rows="6"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300">{{ old('description', $faq->description) }}</textarea>
        </div>

        {{-- Category --}}
        <div>
            <label for="category_id" class="block text-sm font-medium mb-1">Category</label>
            <select name="category_id" id="category_id"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300">
                <option value="">Select Category</option>
                @foreach (\App\Models\Category::all() as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $faq->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Submit --}}
        <div>
            <button type="submit"
                class="bg-[#7E74F1] text-white px-6 py-2 rounded-full hover:bg-[#6259e6] transition">
                Update
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
