@extends('layouts.app')

@section('page_title', 'Testimony')

@section('content')
    <div class="max-w-full  mx-auto px-6 py-10 bg-white rounded-xl shadow-md">
        <h2 class="text-xl font-semibold mb-6">Edit Testimony</h2>

        <form action="{{ route('testimonies.update', $testimony->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Display on Home Toggle -->
            <div class="flex items-center space-x-3">
                <input type="checkbox" id="home" name="home" value="1"
                    class="h-4 w-4 text-purple-500 focus:ring-purple-400 border-gray-300 rounded"
                    {{ $testimony->home ? 'checked' : '' }}>
                <label for="home" class="text-sm font-medium text-gray-700">Display on Home</label>
            </div>

            <div class="grid grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Program -->
                    <div class="relative items-center">
                        <label for="program_id" class="block mb-2 text-sm font-medium text-gray-700">Assessment</label>
                        <select name="program_id" id="program_id" required
                            class="w-full py-2.5 pl-4 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 appearance-none bg-white">
                            <option value="" disabled selected>Select Program</option>
                            @foreach ($programs as $program)
                                <option value="{{ $program->id }}" @if (isset($testimony) && $testimony->program_id == $program->id) selected @endif>
                                    {{ $program->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none mt-6">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" id="name" name="name" placeholder="Full name" required
                            value="{{ $testimony->name }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" id="title" name="title" placeholder="Position/Title" required
                            value="{{ $testimony->title }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="description" name="description" rows="5" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">{{ $testimony->description }}</textarea>
                    </div>

                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Image Upload Card -->
                    <!-- Image Preview -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image 1</label>
                        <img src="{{ $testimony->image ? asset('storage/' . $testimony->image) : 'https://via.placeholder.com/640x360?text=No+Image' }}"
                            alt="Image 1" class="w-full h-[230px] rounded-lg object-cover shadow-sm">
                    </div>

                    <!-- Upload Area -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Image 1 <span
                                class="text-xs text-gray-500">(Max Size: 750kb)</span></label>
                        <label for="image-upload"
                            class="border border-dashed border-gray-300 rounded-lg w-full h-40 flex flex-col justify-center items-center text-gray-500 hover:border-purple-400 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path
                                    d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                            </svg>
                            <span>Drag and drop a file here or click</span>
                            <input type="file" id="image-upload" name="image" class="hidden">
                        </label>
                    </div>

                    <!-- YouTube Thumbnail -->
                    <div class="w-full bg-black aspect-video rounded-lg relative overflow-hidden group">
                        <img id="youtube-thumbnail"
                            src="{{ $testimony->yt_link ? 'https://img.youtube.com/vi/' . $testimony->yt_link . '/hqdefault.jpg' : '' }}"
                            class="absolute inset-0 w-full h-full object-cover" alt="YouTube Thumbnail">
                        <button type="button" onclick="playYoutubeVideo()"
                            class="absolute inset-0 flex items-center justify-center z-10">
                            <svg class="h-14 w-14 text-white opacity-90 group-hover:scale-110 transition-transform"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </button>
                        <div id="youtube-iframe-container" class="hidden absolute inset-0">
                            <iframe id="youtube-iframe" class="w-full h-full" frameborder="0" allowfullscreen
                                allow="autoplay; encrypted-media"></iframe>
                        </div>
                    </div>

                    <!-- YouTube ID Input -->
                    <div>
                        <label for="yt_link" class="block text-sm font-medium text-gray-700 mb-1">ID YouTube</label>
                        <input type="text" name="yt_link" id="yt_link" value="{{ $testimony->yt_link }}"
                            oninput="updateVideoPreview()" placeholder="ID YouTube"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none">
                    </div>
                </div>
            </div>

            <div class="flex">
                <button type="submit"
                    class="px-6 py-2 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    Save
                </button>
            </div>
    </div>



    <!-- CKEditor -->
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => console.error(error));
    </script>

    <!-- YouTube Preview Script -->
    <!-- YouTube Scripts -->
    <script>
        function updateVideoPreview() {
            const videoId = document.getElementById('yt_link').value.trim();
            const thumbnail = document.getElementById('youtube-thumbnail');
            const iframe = document.getElementById('youtube-iframe');
            const iframeContainer = document.getElementById('youtube-iframe-container');

            if (videoId) {
                thumbnail.src = `https://img.youtube.com/vi/${videoId}/hqdefault.jpg`;
                thumbnail.classList.remove('hidden');
                iframeContainer.classList.add('hidden');
                iframe.src = '';
            } else {
                thumbnail.classList.add('hidden');
                iframeContainer.classList.add('hidden');
                iframe.src = '';
            }
        }

        function playYoutubeVideo() {
            const videoId = document.getElementById('yt_link').value.trim();
            const iframe = document.getElementById('youtube-iframe');
            const iframeContainer = document.getElementById('youtube-iframe-container');

            if (videoId) {
                iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
                iframeContainer.classList.remove('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateVideoPreview();
        });
    </script>

@endsection
