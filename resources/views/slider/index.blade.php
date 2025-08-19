@extends('layouts.app')

@section('page_title', 'Slider')

@section('content')
    <div class="bg-white container mx-auto p-[32px] rounded-[24px] gap-8">
        <!-- Loading Overlay -->
        <div id="loading-overlay" class="fixed inset-0  bg-opacity-30 z-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center space-x-4">
                <svg class="animate-spin h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-gray-700">Processing...</span>
            </div>
        </div>

        <!-- Tombol Add Slider (posisi kiri atas) -->
        <div class="mb-8 flex justify-between items-center">
            {{-- Add Post --}}
            <div
                class=" bg-blue-500 rounded-full w-[130px] h-[40px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                <!-- Icon Section -->
                <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </div>

                <!-- Text Section -->
                <a href="{{ route('slider.create') }}" class="text-sm font-normal leading-[130%] text-white px-2 py-4">
                    Add Slider
                </a>
            </div>

            <!-- Search Bar -->
            <div class="flex items-center gap-3">
                <form action="#" class="relative gap-3">
                    <!-- Input -->
                    <input type="text" name="search" id="search" placeholder="Search"
                        class=" font-normal px-6 border border-gray-300 rounded-full pl-10 pr-4 h-[40px] w-[240px] text-sm focus:outline-[#3030F8] placeholder-gray-400" />

                    <!-- Icon di dalam input -->
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none px-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0a7.5 7.5 0 1 0-10.607-10.607 7.5 7.5 0 0 0 10.607 10.607z" />
                        </svg>
                    </div>
                </form>

                <!-- Tombol Search -->
                <button class="bg-[#8989FC] text-white px-5 h-[40px] rounded-full text-sm hover:bg-[#6f6ffc] transition">
                    Search
                </button>
            </div>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($sliders as $slider)
                <div class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col transition hover:shadow-lg">
                    <img src="{{ asset('storage/' . $slider->image) }}" alt=""
                        class="w-full h-56 object-cover">
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-base font-semibold text-gray-800 mb-2">
                            {{ $slider->title }}
                        </h3>
                    </div>
                    <!-- Deskripsi Dihilangkan -->
                    <div class=" flex gap-2 px-3 py-2">
                        <a href="{{ route('slider.edit', $slider->id) }}"
                            class="text-xs px-[16px] py-[7px] rounded-[12px] bg-[#8989FC] text-white hover:bg-blue-600">
                            Edit
                        </a>
                        <form id="delete-form-{{ $slider->id }}" action="{{ route('slider.destroy', $slider->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete({{ $slider->id }})" class="text-xs px-[16px] py-[7px] rounded-[12px] bg-red-500 text-white hover:bg-red-200">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-3">
                    <p class="text-gray-500 text-center">Tidak ada slider ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert for create success
        @if(session('success'))
            showLoading(false);
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        // SweetAlert for errors
        @if($errors->any()))
            showLoading(false);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                html: `@foreach($errors->all() as $error) <p>{{ $error }}</p> @endforeach`,
            });
        @endif

        // Confirm delete function
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading(true);
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }

        // Loading overlay functions
        function showLoading(show) {
            const overlay = document.getElementById('loading-overlay');
            overlay.classList.toggle('hidden', !show);
        }

        // Show loading when submitting forms
        document.addEventListener('DOMContentLoaded', function() {
            // For all forms except delete forms
            const forms = document.querySelectorAll('form:not([id^="delete-form-"])');
            forms.forEach(form => {
                form.addEventListener('submit', () => showLoading(true));
            });

            // For navigation links that might take time
            const navLinks = document.querySelectorAll('a[href]:not([href^="#"]):not([href*="javascript"])');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (link.getAttribute('href') !== '#') {
                        showLoading(true);
                    }
                });
            });
        });
    </script>
@endsection
