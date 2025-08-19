@extends('layouts.app')

@section('page_title', 'Testimony')

@section('content')
    <div class="max-w-full mx-auto">

        {{-- Section: Title --}}
        <div class="bg-white rounded-[24px] p-8 text-center shadow-sm">
            <h1 class="text-[20px] font-semibold text-gray-800">Kata Mereka Tentang Jatidiri</h1>
            <p class="text-sm text-gray-500 mb-4">Testimony</p>
            <div
                class="mx-auto bg-blue-500 rounded-full w-[130px] h-[40px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                <!-- Icon Section -->
                <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </div>

                <!-- Text Section -->
                <span class="text-white px-3 text-sm text-centerfont-medium">Edit Title</span>
            </div>
        </div>

        {{-- Section: Action + Search --}}
        <div class="bg-white mt-8 p-[32px] rounded-[24px]">
            <div class="flex flex-wrap justify-between items-center">
                <div
                    class="bg-blue-500 rounded-full w-[160px] h-[40px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                    <!-- Icon Section -->
                    <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>

                    <!-- Text Section -->
                    <a href="{{ route('testimonies.create') }}"
                        class="text-sm font-normal leading-[130%] text-white px-2 py-4">
                        Add Testimony
                    </a>
                </div>

                <div class="flex items-center gap-3">
                    <form action="#" class="relative gap-3">
                        <!-- Input -->
                        <input type="text" name="search" id="search" placeholder="Search"
                            class="font-normal px-6 border border-gray-300 rounded-full pl-10 pr-4 h-[40px] w-[240px] text-sm focus:outline-[#3030F8] placeholder-gray-400" />

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
                    <button
                        class="bg-[#8989FC] text-white px-5 h-[40px] rounded-full text-sm hover:bg-[#6f6ffc] transition">
                        Search
                    </button>
                </div>
            </div>

            {{-- Loading Indicator --}}
            <div id="loading"
                class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span>Processing...</span>
                </div>
            </div>

            {{-- Section: Testimonial Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 h-[446px] md:grid-cols-3 gap-8 mt-8">
                @forelse($testimonies as $testimoni)
                    <div class="bg-white rounded-[20px] overflow-hidden shadow hover:shadow-md transition">
                        @if ($testimoni->image)
                            <img src="{{ Storage::url($testimoni->image) }}" alt="{{ $testimoni->title }}"
                                class="w-full h-[200px] object-cover bg-gray-100" />
                        @else
                            <div
                                class="w-full h-[200px] bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                                No Image
                            </div>
                        @endif

                        {{-- Content --}}
                        <div class="p-6">
                            {{-- Name/Title --}}
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $testimoni->title }}</h3>

                            {{-- Position/Subtitle --}}
                            <p class="text-sm text-gray-600 mb-3">{{ $testimoni->position ?? 'Jatidiri Sekolah' }}</p>

                            {{-- Description --}}
                            <p class="text-sm text-gray-700 mb-4 line-clamp-3">
                                {{ $testimoni->description ?? 'Karena Jati Diri bukan sekadar aplikasi. Jati Diri hadir sebagai sahabat dalam proses mengenali potensi...' }}
                            </p>

                            {{-- Actions --}}
                            <div class="flex gap-3">
                                <a href="{{ route('testimonies.edit', $testimoni->id) }}"
                                    class="text-sm font-medium text-white px-3 py-2 rounded-[12px] bg-[#8A79F8] hover:bg-[#6B5DF3] transition">
                                    Edit
                                </a>

                                <button onclick="confirmDelete({{ $testimoni->id }})"
                                    class="text-sm font-medium text-white px-3 py-2 rounded-[12px] bg-red-500 hover:bg-red-600 transition">
                                    Delete
                                </button>

                                <form id="delete-form-{{ $testimoni->id }}"
                                    action="{{ route('testimonies.destroy', $testimoni->id) }}" method="POST"
                                    class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 py-8">
                        No testimonials found.
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($testimonies->hasPages())
                <div class="mt-8 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        {{-- Previous Page Link --}}
                        @if ($testimonies->onFirstPage())
                            <span class="px-3 py-1 rounded text-gray-400 cursor-not-allowed">
                                &laquo; Previous
                            </span>
                        @else
                            <a href="{{ $testimonies->previousPageUrl() }}"
                                class="px-3 py-1 rounded text-[#8A79F8] hover:bg-[#8A79F8]/10 hover:text-[#8A79F8] transition">
                                &laquo; Previous
                            </a>
                        @endif

                        {{-- Pagination Elements --}}
                        @php
                            $currentPage = $testimonies->currentPage();
                            $lastPage = $testimonies->lastPage();
                            $startPage = max($currentPage - 1, 1);
                            $endPage = min($currentPage + 1, $lastPage);

                            if ($currentPage <= 2) {
                                $endPage = min(3, $lastPage);
                            }
                            if ($currentPage >= $lastPage - 1) {
                                $startPage = max($lastPage - 2, 1);
                            }
                        @endphp

                        @for ($page = $startPage; $page <= $endPage; $page++)
                            @if ($page == $testimonies->currentPage())
                                <span class="px-3 py-1 rounded bg-[#8A79F8] text-white">{{ $page }}</span>
                            @else
                                <a href="{{ $testimonies->url($page) }}"
                                    class="px-3 py-1 rounded text-[#8A79F8] hover:bg-[#8A79F8]/10 hover:text-[#8A79F8] transition">
                                    {{ $page }}
                                </a>
                            @endif
                        @endfor

                        {{-- Next Page Link --}}
                        @if ($testimonies->hasMorePages())
                            <a href="{{ $testimonies->nextPageUrl() }}"
                                class="px-3 py-1 rounded text-[#8A79F8] hover:bg-[#8A79F8]/10 hover:text-[#8A79F8] transition">
                                Next &raquo;
                            </a>
                        @else
                            <span class="px-3 py-1 rounded text-gray-400 cursor-not-allowed">
                                Next &raquo;
                            </span>
                        @endif
                    </nav>
                </div>
            @endif
        </div>
    </div>

    {{-- SweetAlert JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Show loading indicator
        function showLoading() {
            document.getElementById('loading').classList.remove('hidden');
        }

        // Hide loading indicator
        function hideLoading() {
            document.getElementById('loading').classList.add('hidden');
        }

        // Success message after create/edit
        @if (session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            });
        @endif

        // Error message
        @if (session('error'))
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                });
            });
        @endif

        // Delete confirmation
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
                    showLoading();
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        // Add loading indicator to form submissions
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    if (!this.classList.contains('ignore-loading')) {
                        showLoading();
                    }
                });
            });

            // Add loading to create/edit links
            const actionLinks = document.querySelectorAll(
                'a[href*="/testimonies/create"], a[href*="/testimonies/edit"]');
            actionLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    showLoading();
                });
            });
        });
    </script>
@endsection
