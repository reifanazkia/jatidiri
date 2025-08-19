@extends('layouts.app')

@section('page_title', 'Our Team')

@section('content')
    <div class="max-w-full mx-auto px-6 py-10 bg-white rounded-[24px] shadow-md">
        <h2 class="text-xl font-semibold mb-6">Edit Team Member</h2>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- Notifikasi error --}}
        @if ($errors->any())
            <div class="mb-4 text-red-600 font-medium">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ourteam.update', $team->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Category --}}
            <div>
                <label for="ot_id" class="block text-sm font-medium text-gray-700 mb-1">Our Team's Category</label>
                <select name="ot_id" id="ot_id"
                    class="w-full rounded border-gray-300 focus:ring-indigo-400 px-3 py-2">
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('ot_id', $team->ot_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->category }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Name, Title, Email --}}
            <div class="flex flex-col mb-6 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $team->name) }}"
                        class="mt-1 w-full rounded border border-gray-300 px-3 py-2" required>
                </div>
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $team->title) }}"
                        class="mt-1 w-full rounded border border-gray-300 px-3 py-2" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $team->email) }}"
                        class="mt-1 w-full rounded border border-gray-300 px-3 py-2" placeholder="someone@email.com">
                </div>
            </div>

            {{-- Phone, FB, IG, TikTok --}}
            <div class="grid grid-cols-2 mb-6 gap-6">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $team->phone) }}"
                        class="mt-1 w-full rounded border border-gray-300 px-3 py-2" placeholder="0811-1111-1111">
                </div>
                <div>
                    <label for="fb" class="block text-sm font-medium text-gray-700">Facebook</label>
                    <input type="text" name="fb" value="{{ old('fb', $team->fb) }}"
                        class="mt-1 w-full rounded border border-gray-300 px-3 py-2" placeholder="username">
                </div>
                <div>
                    <label for="ig" class="block text-sm font-medium text-gray-700">Instagram</label>
                    <input type="text" name="ig" value="{{ old('ig', $team->ig) }}"
                        class="mt-1 w-full rounded border border-gray-300 px-3 py-2" placeholder="username">
                </div>
                <div>
                    <label for="t" class="block text-sm font-medium text-gray-700">TikTok</label>
                    <input type="text" name="t" value="{{ old('t', $team->t) }}"
                        class="mt-1 w-full rounded border border-gray-300 px-3 py-2" placeholder="username">
                </div>
            </div>

            {{-- Upload Image --}}
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Upload Image (Max: Size 750kb) <span class="text-red-500">*</span>
            </label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div
                        class="relative w-full h-[114px] border-2 border-gray-300 rounded p-6 flex flex-col items-center justify-center text-gray-400 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                        </svg>
                        <input type="file" name="image" accept="image/*"
                            class="absolute inset-0 opacity-0 cursor-pointer">
                        <span>Drag and drop a file here or click.</span>
                    </div>
                </div>

                {{-- Preview --}}
                <div>
                    <img id="preview-image"
                        src="{{ $team->image ? asset('storage/' . $team->image) : 'https://via.placeholder.com/300x200.png?text=Preview' }}"
                        alt="Preview" class="rounded-lg w-full max-w-sm">
                </div>
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit"
                    class="px-6 py-2 rounded-full bg-indigo-500 text-white hover:bg-indigo-600 transition">
                    Update
                </button>
            </div>
        </form>
    </div>

    {{-- Preview Script --}}
    <script>
        document.querySelector('input[name="image"]').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                document.getElementById('preview-image').src = URL.createObjectURL(file);
            }
        });
    </script>
@endsection
