@extends('layouts.app')

@section('page_title', 'Edit Agenda')

@section('content')
<div class="container max-w-full mx-auto h-auto overflow-y-auto">
    <div class="bg-white rounded-[24px] shadow-md px-8 py-6 h-full">
        <h2 class="text-xl font-semibold mb-8">Edit Agenda</h2>

        <form action="{{ route('agenda.update', $agenda->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label for="title" class="block text-gray-600 text-sm mb-2">Title</label>
                <input type="text" name="title" id="title"
                    value="{{ old('title', $agenda->title) }}"
                    class="w-full border px-4 py-2 text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            {{-- Start & End Date --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="start_date" class="block text-gray-600 text-sm mb-2">Start Date</label>
                    <input type="date" name="start_date" id="start_date"
                        value="{{ old('start_date', $agenda->start_date) }}"
                        class="w-full border px-4 py-2 text-sm rounded-md">
                </div>
                <div>
                    <label for="end_date" class="block text-gray-600 text-sm mb-2">End Date</label>
                    <input type="date" name="end_date" id="end_date"
                        value="{{ old('end_date', $agenda->end_date) }}"
                        class="w-full border px-4 py-2 text-sm rounded-md">
                </div>
            </div>

            {{-- Start & End Time --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="start_time" class="block text-gray-600 text-sm mb-2">Start Time</label>
                    <input type="time" name="start_time" id="start_time"
                        value="{{ old('start_time', $agenda->start_time) }}"
                        class="w-full border px-4 py-2 text-sm rounded-md">
                </div>
                <div>
                    <label for="end_time" class="block text-gray-600 text-sm mb-2">End Time</label>
                    <input type="time" name="end_time" id="end_time"
                        value="{{ old('end_time', $agenda->end_time) }}"
                        class="w-full border px-4 py-2 text-sm rounded-md">
                </div>
            </div>

            {{-- Content --}}
            <div>
                <label for="description" class="block text-gray-600 text-sm mb-2">Content</label>
                <textarea name="content" id="description" rows="6"
                    class="w-full border px-4 py-2 text-sm rounded-md">{{ old('content', $agenda->content) }}</textarea>
            </div>

            {{-- Optional Fields --}}
            <div>
                <label for="location" class="block text-gray-600 text-sm mb-2">Location</label>
                <input type="text" name="location" id="location"
                    value="{{ old('location', $agenda->location) }}"
                    class="w-full border px-4 py-2 text-sm rounded-md">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="yt_link" class="block text-gray-600 text-sm mb-2">YouTube Link</label>
                    <input type="url" name="yt_link" id="yt_link"
                        value="{{ old('yt_link', $agenda->yt_link) }}"
                        class="w-full border px-4 py-2 text-sm rounded-md">
                </div>
                <div>
                    <label for="register_link" class="block text-gray-600 text-sm mb-2">Register Link</label>
                    <input type="url" name="register_link" id="register_link"
                        value="{{ old('register_link', $agenda->register_link) }}"
                        class="w-full border px-4 py-2 text-sm rounded-md">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="organizer" class="block text-gray-600 text-sm mb-2">Organizer</label>
                    <input type="text" name="organizer" id="organizer"
                        value="{{ old('organizer', $agenda->organizer) }}"
                        class="w-full border px-4 py-2 text-sm rounded-md">
                </div>
                <div>
                    <label for="contact" class="block text-gray-600 text-sm mb-2">Contact</label>
                    <input type="text" name="contact" id="contact"
                        value="{{ old('contact', $agenda->contact) }}"
                        class="w-full border px-4 py-2 text-sm rounded-md">
                </div>
            </div>

            {{-- Image Upload & Preview --}}
            <label for="image" class="block text-gray-600 text-sm mb-2">Upload Image (Max: 2MB)</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                <div>
                    <div class="border-2 border-gray-400 rounded-md w-full h-40 flex items-center justify-center cursor-pointer">
                        <label for="image" class="flex flex-col items-center cursor-pointer">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                            </svg>
                            <span class="text-sm text-gray-400">Drag and drop or click</span>
                            <input type="file" name="image" id="image" class="hidden">
                        </label>
                    </div>
                </div>
                <div>
                    @if ($agenda->image)
                        <img src="{{ asset('storage/' . $agenda->image) }}" alt="Preview"
                            class="rounded-md max-h-40 object-cover w-full">
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

{{-- CKEditor --}}
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection
