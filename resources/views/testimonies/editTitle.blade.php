@extends('layouts.app')

@section('page_title', 'Testimony')

@section('content')
<div class="max-w-full mx-auto p-[32px] bg-white rounded-[24px] shadow-sm">
    <h2 class="text-xl font-semibold mb-6">Edit</h2>

    <form action="{{ route('testimonies.updateTitle', $testimony->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="title" id="title" placeholder="Title Post" value="{{ old('title', $testimony->title) }}"
                class="w-full rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400" />
        </div>

        <div>
            <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-1">Sub Title</label>
            <input type="text" name="subtitle" id="subtitle" placeholder="Testimonial" value="{{ old('subtitle', $testimony->subtitle) }}"
                class="w-full text-sm rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400" />
        </div>

        <div>
            <button type="submit"
                class="bg-blue-400 hover:bg-blue-500 text-white font-semibold px-6 py-2 rounded-full transition duration-300">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
