@extends('layouts.app')

@section('page_title', 'Our Team')

@section('content')
    <div class="max-w-full mx-auto px-6 py-10 bg-white rounded-[24px] shadow-md">
        <h2 class="text-xl font-semibold mb-6">Add</h2>

        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ourteam.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Kategori --}}
            <div>
                <div class="relative">
                    <label for="ot_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Our Team's Category <span class="text-red-500">*</span>
                    </label>
                    <select name="ot_id" id="ot_id"
                        class="w-full rounded border-gray-300 focus:ring-indigo-400 border px-[8px] py-[8px] pr-10 bg-white appearance-none">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('ot_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->category }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Arrow -->
                    <svg class="pointer-events-none absolute right-3 mt-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-500"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6"></path>
                    </svg>
                </div>
            </div>

            {{-- Nama, Title, Email --}}
            <div class="flex flex-col gap-8">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="mt-1 w-full rounded border border-gray-300 px-[8px] py-[8px]" placeholder="Nama">
                </div>
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="mt-1 w-full rounded border border-gray-300 px-[8px] py-[8px]" placeholder="Title">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="mt-1 w-full rounded border border-gray-300 px-[8px] py-[8px]"
                        placeholder="Ex. someone@email.com">
                </div>
            </div>

            {{-- Phone, FB, IG, TikTok --}}
            <div class="grid grid-cols-2 grid-rows-2 gap-8">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                        class="mt-1 w-full rounded border border-gray-300 px-[8px] py-[8px]"
                        placeholder="Ex. 0811-1111-1111">
                </div>
                <div>
                    <label for="fb" class="block text-sm font-medium text-gray-700">Facebook ID</label>
                    <input type="text" name="fb" id="fb" value="{{ old('fb') }}"
                        class="mt-1 w-full rounded border border-gray-300 px-[8px] py-[8px]" placeholder="someone">
                </div>
                <div>
                    <label for="ig" class="block text-sm font-medium text-gray-700">Instagram ID</label>
                    <input type="text" name="ig" id="ig" value="{{ old('ig') }}"
                        class="mt-1 w-full rounded border border-gray-300 px-[8px] py-[8px]" placeholder="someone">
                </div>
                <div>
                    <label for="tt" class="block text-sm font-medium text-gray-700">Tiktok ID</label>
                    <input type="text" name="tt" id="tt" value="{{ old('t') }}"
                        class="mt-1 w-full rounded border border-gray-300 px-[8px] py-[8px]" placeholder="someone">
                </div>
            </div>

            {{-- Upload Image --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Upload Image (Max: Size 750kb) <span class="text-red-500">*</span>
                    </label>
                    <div
                        class="relative w-full h-[114px] border-2 border-gray-300 rounded p-6 flex flex-col items-center justify-center text-gray-400 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                        </svg>
                        <input type="file" name="image" accept="image/*" required
                            class="absolute inset-0 opacity-0 cursor-pointer">
                        <span>Drag and drop a file here or click.</span>
                    </div>
                </div>

                {{-- Preview image (hidden by default) --}}
                <div>
                    <img id="preview-image" alt="Preview" class="hidden rounded-lg w-full h-[327px] object-cover">
                </div>
            </div>

            {{-- Submit Button --}}
            <div>
                <button type="submit"
                    class="px-6 py-2 rounded-full bg-indigo-500 text-white hover:bg-indigo-600 transition">Save</button>
            </div>
        </form>
    </div>

    {{-- Preview image script --}}
    <script>
        const input = document.querySelector('input[name="image"]');
        const preview = document.getElementById('preview-image');

        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden'); // tampilkan gambar
            } else {
                preview.classList.add('hidden'); // sembunyikan jika tidak ada file
                preview.src = "";
            }
        });
    </script>
@endsection
