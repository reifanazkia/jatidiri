@extends('layouts.app')

@section('page_title', 'Supports')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white rounded-[24px] shadow p-8">
            <h2 class="text-xl font-semibold mb-6">Edit</h2>

            <form action="{{ route('dukungan.update', $data->id) }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @csrf
                @method('PUT')

                {{-- Left Column --}}
                <div class="space-y-5 col-span-2">
                    <div>
                        <label class="block text-sm font-medium mb-1">Support’s Title</label>
                        <input type="text" name="title" value="{{ old('title', $data->title) }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $data->name) }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Title</label>
                        <input type="text" name="jabatan" value="{{ old('jabatan', $data->jabatan) }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300">
                    </div>
                </div>

                {{-- Right Column --}}
                <div class="space-y-4">
                    {{-- Preview Image --}}
                    <div>
                        <label class="block text-sm font-medium mb-2">Image 1</label>
                        <div class="w-full h-36 rounded-md overflow-hidden border border-gray-300">
                            <img id="preview-image"
                                src="{{ $data->image ? asset('storage/' . $data->image) : '#' }}"
                                alt="Preview"
                                class="w-full h-full object-cover {{ $data->image ? '' : 'hidden' }}">
                        </div>
                    </div>

                    {{-- File Upload --}}
                    <div>
                        <label class="block text-sm font-medium mb-2">Upload Image 1 (Max Size: 750Kb)</label>

                        <div
                            class="h-[200px] border border-gray-300 rounded-md p-4 flex flex-col items-center justify-center text-center">
                            <label for="image4" class="cursor-pointer w-full py-[80px]">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775
                                        5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18
                                        19.5H6.75Z" />
                                    </svg>
                                    <span class="text-sm text-gray-600">Drag and drop a file here or click</span>
                                </div>
                                <input type="file" name="image4" id="image4" class="hidden"
                                    onchange="previewImage(event)">
                            </label>
                        </div>
                    </div>

                    {{-- YouTube Video Preview --}}
                    <div>
                        @if ($data->id_yt)
                            <iframe class="w-full h-36 rounded-md" src="https://www.youtube.com/embed/{{ $data->id_yt }}"
                                frameborder="0" allowfullscreen></iframe>
                        @else
                            <div class="w-full h-36 bg-black rounded-md flex items-center justify-center">
                                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- YouTube ID --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">ID Youtube</label>
                        <input type="text" name="id_yt" value="{{ old('id_yt', $data->id_yt) }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-indigo-300">
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="col-span-1 md:col-span-2">
                    <button type="submit"
                        class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md shadow">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- JS Preview --}}
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview-image');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
