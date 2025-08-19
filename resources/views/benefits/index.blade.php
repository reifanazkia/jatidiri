@extends('layouts.app')

@section('page_title', 'Benefits')

@section('content')
    <div class="max-w-full mx-auto space-y-10">
        <!-- Loading Overlay -->
        <div id="loading-overlay" class="hidden fixed inset-0 bg-white bg-opacity-70 z-50 flex items-center justify-center">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
        </div>

        {{-- Section: Title --}}
        <div class="bg-white rounded-[24px] px-6 py-10 text-center shadow-sm">
            <h1 class="text-[20px] font-semibold text-gray-800">Manfaat Mengikuti</h1>
            <p class="text-sm text-gray-500 mb-4">Benefits</p>
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
                @if ($benefits->count() > 0)
                    <a href="{{ route('benefits.editTitle', $benefits[0]->id) }}" class="text-white px-3">Edit Title</a>
                @endif
            </div>
        </div>

        {{-- Section: Action + Search --}}
        <div class="bg-white p-[38px] rounded-2xl">
            <div class="flex flex-wrap justify-between items-center">
                <div
                    class="bg-blue-500 rounded-full w-[140px] h-[40px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                    <!-- Icon Section -->
                    <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>

                    <!-- Text Section -->
                    <a href="{{ route('benefits.create') }}"
                        class="text-sm font-normal leading-[130%] text-white px-2 py-4">
                        Add Benefits
                    </a>
                </div>

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
                    <button
                        class="bg-[#8989FC] text-white px-5 h-[40px] rounded-full text-sm hover:bg-[#6f6ffc] transition">
                        Search
                    </button>
                </div>
            </div>

            {{-- Section: Benefit Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-8">
                @forelse($benefits as $benefit)
                    <div
                        class="bg-white rounded-[20px] overflow-hidden shadow hover:shadow-md transition group flex flex-col">
                        {{-- Gambar --}}
                        @if ($benefit->file_path)
                            <img src="{{ asset('storage/' . $benefit->file_path) }}" alt="{{ $benefit->title }}"
                                class="w-full h-[200px] object-contain bg-gray-100" />
                        @else
                            <div
                                class="w-full h-[200px] bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                                No Image
                            </div>
                        @endif

                        {{-- Content --}}
                        <div class="flex-1 px-4 py-3 flex flex-col justify-between">
                            <p class="text-base font-semibold text-gray-800">{{ $benefit->title }}</p>
                        </div>

                        {{-- Actions --}}
                        <div class="px-4 pb-4 flex justify-start gap-2">
                            <a href="{{ route('benefits.edit', $benefit->id) }}"
                                class="bg-[#8A79F8] text-white text-sm px-4 py-1.5 rounded-full hover:bg-[#6B5DF3] transition">
                                Edit
                            </a>
                            <form action="{{ route('benefits.destroy', $benefit->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="bg-red-500 text-white text-sm px-4 py-1.5 rounded-full hover:bg-red-600 transition delete-btn">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500">
                        No benefits found.
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($benefits->hasPages())
                <div class="mt-8 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        {{-- Previous Page Link --}}
                        @if ($benefits->onFirstPage())
                            <span class="px-3 py-1 rounded text-gray-400 cursor-not-allowed">
                                &laquo; Previous
                            </span>
                        @else
                            <a href="{{ $benefits->previousPageUrl() }}"
                                class="px-3 py-1 rounded text-[#8A79F8] hover:bg-[#8A79F8]/10 hover:text-[#8A79F8] transition">
                                &laquo; Previous
                            </a>
                        @endif

                        {{-- Pagination Elements --}}
                        @php
                            // Hitung range halaman yang akan ditampilkan
                            $currentPage = $benefits->currentPage();
                            $lastPage = $benefits->lastPage();
                            $startPage = max($currentPage - 1, 1);
                            $endPage = min($currentPage + 1, $lastPage);

                            // Sesuaikan jika di awal atau akhir
                            if ($currentPage <= 2) {
                                $endPage = min(3, $lastPage);
                            }
                            if ($currentPage >= $lastPage - 1) {
                                $startPage = max($lastPage - 2, 1);
                            }
                        @endphp

                        @for ($page = $startPage; $page <= $endPage; $page++)
                            @if ($page == $benefits->currentPage())
                                <span class="px-3 py-1 rounded bg-[#8A79F8] text-white">{{ $page }}</span>
                            @else
                                <a href="{{ $benefits->url($page) }}"
                                    class="px-3 py-1 rounded text-[#8A79F8] hover:bg-[#8A79F8]/10 hover:text-[#8A79F8] transition">
                                    {{ $page }}
                                </a>
                            @endif
                        @endfor

                        {{-- Next Page Link --}}
                        @if ($benefits->hasMorePages())
                            <a href="{{ $benefits->nextPageUrl() }}"
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

    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Show loading overlay
        function showLoading() {
            document.getElementById('loading-overlay').classList.remove('hidden');
        }

        // Hide loading overlay
        function hideLoading() {
            document.getElementById('loading-overlay').classList.add('hidden');
        }

        // Check for success messages from Laravel
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        // Delete confirmation with SweetAlert
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                const form = this.closest('form');
                
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
                        form.submit();
                    }
                });
            });
        });

        // Show loading for other form submissions (not delete)
        document.querySelectorAll('form:not(.delete-form)').forEach(form => {
            form.addEventListener('submit', function() {
                showLoading();
            });
        });

        // Show loading for all link clicks that might navigate
        document.querySelectorAll('a').forEach(link => {
            if (link.getAttribute('href') && !link.getAttribute('href').startsWith('#')) {
                link.addEventListener('click', function() {
                    showLoading();
                });
            }
        });
    </script>
@endsection