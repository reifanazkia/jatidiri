@extends('layouts.app')

@section('page_title', 'About Us')

@section('content')
    <div class="max-w-full mx-auto p-[32px] bg-white rounded-[24px] shadow-sm">
        <h2 class="text-xl font-semibold mb-6">Edit</h2>

        <form action="{{ route('about.update', $about->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ $about->title }}"
                    class="mt-1 px-[8px] py-[16px] w-full rounded-sm border text-gray-500 border-gray-400 focus:ring-purple-500 focus:border-purple-500">
            </div>

            <div>
                <label for="subtitle" class="block text-sm font-medium text-gray-700">Subtitle</label>
                <input type="text" name="subtitle" id="subtitle" value="{{ $about->subtitle }}"
                    class="mt-1 px-[8px] py-[16px] w-full text-gray-500 border border-gray-500 rounded-sm focus:ring-purple-500 focus:border-purple-500">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                <textarea name="description" id="description"
                    class="ckeditor mt-1 w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                    rows="4">{{ $about->description }}</textarea>
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Deskripsi Lengkap</label>
                <textarea name="content" id="content"
                    class="ckeditor mt-1 w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                    rows="6">{{ $about->content }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 mb-6 gap-6">
                <!-- Video Youtube -->
                <!-- Video Upload -->
                <div>
                    <label for="video" class="block text-sm font-medium text-gray-700 mb-1">
                        Upload Video <span class="text-xs text-gray-500">(mp4, webm, ogg | Max 50MB)</span>
                    </label>

                    <label for="video"
                        class="block mt-1 h-[50%] cursor-pointer flex flex-col items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 rounded-lg hover:border-gray-400 transition">
                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775
                5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848
                A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">Drag and drop a file here or click</p>
                        <input id="video" name="video" type="file" accept="video/mp4,video/webm,video/ogg"
                            class="hidden">
                    </label>

                    @if (optional($about)->video)
                        <div class="mt-4">
                            <video controls class="rounded-lg w-full max-h-60">
                                <source src="{{ asset('storage/' . $about->video) }}" type="video/mp4">
                                Browser Anda tidak mendukung video.
                            </video>
                            <div class="mt-2 flex items-center">
                                <input type="checkbox" id="remove_video" name="remove_video" class="mr-2">
                                <label for="remove_video" class="text-sm text-gray-600">Hapus video saat ini</label>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Image 1 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Image 1 <span class="text-xs text-gray-500">(Max 750kb)</span>
                    </label>

                    <label for="image1"
                        class="block mt-1 h-[50%] cursor-pointer flex flex-col items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 rounded-lg hover:border-gray-400 transition">
                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775
                    5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848
                    A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">Drag and drop a file here or click</p>
                        <input id="image1" name="image1" type="file" class="hidden" accept="image/*">
                    </label>

                    @if (optional($about)->image1)
                        <div class="mt-4">
                            <img src="{{ asset('storage/' . $about->image1) }}" alt="Image 1"
                                class="rounded-lg object-cover w-full h-40">
                            <div class="mt-2 flex items-center">
                                <input type="checkbox" id="remove_image1" name="remove_image1" class="mr-2">
                                <label for="remove_image1" class="text-sm text-gray-600">Hapus gambar saat ini</label>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Image 2 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Image 2 <span class="text-xs text-gray-500">(Max 750kb)</span>
                    </label>

                    <label for="image2"
                        class="block mt-1 h-[50%] cursor-pointer flex flex-col items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 rounded-lg hover:border-gray-400 transition">
                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775
                    5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848
                    A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">Drag and drop a file here or click</p>
                        <input id="image2" name="image2" type="file" class="hidden" accept="image/*">
                    </label>

                    @if (optional($about)->image2)
                        <div class="mt-4">
                            <img src="{{ asset('storage/' . $about->image2) }}" alt="Image 2"
                                class="rounded-lg object-cover w-full h-40">
                            <div class="mt-2 flex items-center">
                                <input type="checkbox" id="remove_image2" name="remove_image2" class="mr-2">
                                <label for="remove_image2" class="text-sm text-gray-600">Hapus gambar saat ini</label>
                            </div>
                        </div>
                    @endif
                </div>

            </div>

            <div>
                <button type="submit"
                    class="inline-flex mt-6 items-center px-[24px] py-[15px] bg-[#8989FC] text-white text-sm font-medium rounded-full hover:bg-blue-500 transition">
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

        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
