@extends('layouts.app')

@section('page_title', 'Partners')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-10 bg-white rounded-[24px] shadow-md">
        <h2 class="text-xl font-semibold mb-6">Edit</h2>

        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Partner's Name</label>
                    <input type="text" name="name" id="name" required value="{{ old('name', $partner->name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-indigo-500" />
                </div>

                <!-- Web -->
                <div class="col-span-2">
                    <label for="web" class="block text-sm font-medium text-gray-700 mb-1">Partner's Web Address</label>
                    <input type="text" name="web" id="web" placeholder="Website"
                        value="{{ old('web', $partner->web) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-indigo-500" />
                </div>

                <!-- Description -->
                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Partner
                        Description</label>
                    <textarea name="description" id="description" class="ckeditor w-full border border-gray-300 rounded-md">
                        {{ old('description', $partner->description) }}
                    </textarea>
                </div>

                <!-- Program Desc -->
                <div class="col-span-2">
                    <label for="program_desc" class="block text-sm font-medium text-gray-700 mb-1">Partnership
                        Details</label>
                    <textarea name="program_desc" id="program_desc" class="ckeditor w-full border border-gray-300 rounded-md">
                        {{ old('program_desc', $partner->program_desc) }}
                    </textarea>
                </div>

                <!-- Image Upload -->
                <div class="col-span-2 md:col-span-1">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Image (Max: Size 750kb)</label>
                        <div
                            class="w-full h-full border-2 border-gray-300 rounded p-6 flex flex-col items-center justify-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                            </svg>
                            <input type="file" name="image" accept="image/*"
                                class="w-full opacity-0 absolute cursor-pointer">
                            <span>Drag and drop a file here or click.</span>
                        </div>
                    </div>
                </div>

                <!-- Preview Box -->
                <div class="col-span-2 md:col-span-1">
                    <img id="imagePreview"
                        src="{{ $partner->image ? asset('storage/' . $partner->image) : 'https://via.placeholder.com/400x250?text=Image+Preview' }}"
                        class="rounded-lg object-cover w-full h-[250px]" />
                </div>
            </div>

            <div class="mt-8">
                <button type="submit"
                    class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium px-6 py-2 rounded-full">
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
            .create(document.querySelector('#program_desc'))
            .catch(error => {
                console.error(error);
            });

        // Preview image when selected
        document.querySelector('input[name="image"]').addEventListener('change', function(e) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>
@endsection
