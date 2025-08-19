@extends('layouts.app')

@section('page_title', 'Unggulans')

@section('content')
    <div class="max-w-full bg-white mx-auto p-[32px] rounded-[24px] shadow-sm">
        <h2 class="text-xl font-semibold mb-6">Tambah Unggulan</h2>

        <form action="{{ route('unggulans.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="unggulan-form">
            @csrf

            <!-- Display on Home -->
            <div class="flex items-center mb-4">
                <input type="checkbox" name="home" id="home" value="1"
                    class="h-4 w-4 text-purple-500 focus:ring-purple-400 border-gray-300 rounded">
                <label for="home" class="ml-2 text-sm text-gray-700 font-medium">Tampilkan di Halaman Utama</label>
            </div>

            <!-- Grid: Program + Image -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-6">

                    <!-- Program Name -->
                    <div>
                        <label for="program_id" class="block mb-2 text-sm font-medium text-gray-700">Nama Program</label>
                        <div class="relative">
                            <select name="program_id" id="program_id"
                                class="w-full pl-4 pr-12 py-2 h-10 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-200 appearance-none bg-white">
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}">
                                        {{ $program->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" name="title" id="title" placeholder="Judul Unggulan" required
                            class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <!-- Link -->
                    <div>
                        <label for="link" class="block mb-2 text-sm font-medium text-gray-700">Link (URL)</label>
                        <input type="url" name="link" id="link" placeholder="https://contoh.com"
                            class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="6"
                            class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500"></textarea>
                    </div>
                </div>

                <!-- Image Upload -->
                <div>
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-700">Unggah Gambar (Maks: 750kb)</label>
                    <div id="dropzone"
                        class="flex flex-col justify-center items-center border-2  border-gray-300 rounded-lg h-56 text-gray-500 text-sm text-center cursor-pointer">
                        <input type="file" name="image" id="image" accept="image/*" class="hidden"
                            onchange="previewImage(event)">
                        <label for="image"
                            class="w-full h-full flex flex-col justify-center items-center cursor-pointer">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                            </svg>
                            <span>Seret dan lepas file di sini atau klik</span>
                        </label>
                    </div>
                    <div id="preview" class="mt-4"></div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit"
                    class="px-8 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-full transition-all">
                    Simpan
                </button>
                <a href="{{ route('unggulans.index') }}"
                    class="px-8 py-2 ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-full transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Image Preview Script -->
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            preview.innerHTML = '';
            const file = event.target.files[0];
            if (file) {
                const img = document.createElement("img");
                img.src = URL.createObjectURL(file);
                img.classList.add("max-h-40", "rounded-lg", "shadow", "mx-auto");
                preview.appendChild(img);
            }
        }
    </script>

    <!-- CKEditor -->
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <!-- SweetAlert for Success Message -->
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('unggulans.index') }}";
                }
            });
        });
    </script>
    @endif
@endsection
