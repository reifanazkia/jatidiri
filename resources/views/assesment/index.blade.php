@extends('layouts.app')

@section('page_title', 'Assesments')

@section('content')
    <div class="container w-full p-8 bg-white rounded-[24px] relative">
        {{-- Header Action --}}
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            {{-- Tombol Add --}}
            <div class="flex gap-4 items-center">
                <div
                    class="bg-blue-500 rounded-full w-[160px] h-[38px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                    <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>
                    <a href="{{ route('assesment.create') }}" id="add-button"
                        class="text-sm font-normal leading-[130%] text-white px-2 py-4">
                        Add assesments
                    </a>
                </div>
            </div>

            {{-- Form Search --}}
            <div class="flex items-center gap-3">
                <form action="#" class="relative gap-3">
                    <input type="text" name="search" id="search" placeholder="Search"
                        class="font-normal px-6 border border-gray-300 rounded-full pl-10 pr-4 h-[40px] w-[240px] text-sm focus:outline-[#3030F8] placeholder-gray-400" />
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none px-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0a7.5 7.5 0 1 0-10.607-10.607 7.5 7.5 0 0 0 10.607 10.607z" />
                        </svg>
                    </div>
                </form>
                <button class="bg-[#8989FC] text-white px-5 h-[40px] rounded-full text-sm hover:bg-[#6f6ffc] transition">
                    Search
                </button>
            </div>
        </div>

        {{-- Inline Loading Indicator --}}
        <div id="loading-indicator" class="absolute inset-0 bg-white bg-opacity-90 z-10 flex flex-col items-center justify-center rounded-[24px] hidden">
            <div class="text-center space-y-4">
                {{-- Animated Circles --}}
                <div class="flex justify-center space-x-2">
                    <div class="w-4 h-4 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                    <div class="w-4 h-4 bg-blue-600 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    <div class="w-4 h-4 bg-blue-700 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                </div>
                
                {{-- Loading Text --}}
                <h3 class="text-xl font-semibold text-gray-800">Memproses Permintaan</h3>
                <p class="text-gray-600">Silakan tunggu sebentar...</p>
                
                {{-- Progress Text --}}
                <p id="progress-text" class="text-sm text-blue-600 font-medium">0%</p>
                
                {{-- Minimal Progress Bar --}}
                <div class="w-64 h-2 bg-gray-200 rounded-full overflow-hidden mx-auto">
                    <div id="progress-bar" class="h-full bg-gradient-to-r from-blue-500 to-blue-700 transition-all duration-300 ease-out" style="width: 0%"></div>
                </div>
            </div>
        </div>

        {{-- Cards Wrapper --}}
        <div id="cards-wrapper">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($facilities as $assesment)
                    <div class="relative rounded-xl shadow-xl w-full h-[350px] overflow-hidden bg-white group" data-card>
                        <img src="{{ asset('storage/' . $assesment->image) }}" alt=""
                            class="w-[399px] h-[171px] object-cover">
                        <div class="px-4 py-4">
                            <p class="font-semibold text-[20px] leading-[130%] line-clamp-2">
                                {{ $assesment->title }}
                            </p>

                            <div class="flex items-center justify-between mt-3">
                                <div class="bg-[#E8E8E8] rounded-md px-3 py-[2px]">
                                    <p class="text-sm">
                                        {{ \Carbon\Carbon::parse($assesment->created_at)->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                                <div
                                    class="px-3 w-[61px] h-[21px] rounded-md bg-[#9689FF4D] flex items-center justify-center">
                                    <p class="text-sm font-normal text-[#603EFF]">Artikel</p>
                                </div>
                            </div>

                            <div class="flex gap-2 mt-8">
                                <a href="{{ route('assesment.edit', $assesment->id) }}" id="edit-button-{{ $assesment->id }}"
                                    class="w-[55px] h-[32px] rounded-md bg-[#7C6AED] text-white text-center flex items-center justify-center font-medium text-[14px] hover:scale-110 transition">
                                    Edit
                                </a>
                                <form action="{{ route('assesment.destroy', $assesment->id) }}" method="POST"
                                    class="inline" id="delete-form-{{ $assesment->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $assesment->id }})"
                                        class="bg-red-500 w-[55px] h-[32px] text-white px-3 py-1 rounded text-xs flex items-center gap-1">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Pagination --}}
        @if ($facilities->hasPages())
            <div class="flex justify-center mt-10 space-x-2">
                {{-- Previous Page --}}
                @if ($facilities->onFirstPage())
                    <span class="px-3 py-1 text-gray-400 cursor-not-allowed">« Previous</span>
                @else
                    <a href="{{ $facilities->previousPageUrl() }}" class="px-3 py-1 text-[#3030F8] hover:underline">«
                        Previous</a>
                @endif

                {{-- Pages --}}
                @foreach ($facilities->getUrlRange(1, $facilities->lastPage()) as $page => $url)
                    @if ($page == $facilities->currentPage())
                        <span class="px-3 py-1 bg-[#3030F8] text-white rounded shadow">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            class="px-3 py-1 border border-[#3030F8] text-black rounded hover:bg-purple-700">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                {{-- Next Page --}}
                @if ($facilities->hasMorePages())
                    <a href="{{ $facilities->nextPageUrl() }}" class="px-3 py-1 text-[#3030F8] hover:underline">Next »</a>
                @else
                    <span class="px-3 py-1 text-gray-400 cursor-not-allowed">Next »</span>
                @endif
            </div>
        @endif
    </div>

    {{-- JavaScript --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function handleSearch() {
            const searchTerm = document.getElementById('search').value.toLowerCase().trim();
            document.querySelectorAll('[data-card]').forEach(card => {
                card.style.display = card.textContent.toLowerCase().includes(searchTerm) ? '' : 'none';
            });
        }

        // Simulate progress for demo purposes
        function simulateProgress() {
            const progressBar = document.getElementById('progress-bar');
            const progressText = document.getElementById('progress-text');
            let progress = 0;
            
            const interval = setInterval(() => {
                progress += Math.random() * 10;
                if (progress > 90) {
                    progress = 90; // Don't complete until actual load
                }
                
                progressBar.style.width = `${progress}%`;
                progressText.textContent = `${Math.round(progress)}%`;
            }, 300);
            
            return interval;
        }

        // Show loading indicator
        function showLoading() {
            const loadingIndicator = document.getElementById('loading-indicator');
            loadingIndicator.classList.remove('hidden');
            
            // Start progress simulation
            const progressInterval = simulateProgress();
            loadingIndicator.dataset.interval = progressInterval;
        }

        // Hide loading indicator
        function hideLoading() {
            const loadingIndicator = document.getElementById('loading-indicator');
            const progressBar = document.getElementById('progress-bar');
            const progressText = document.getElementById('progress-text');
            
            // Complete progress animation
            progressBar.style.width = '100%';
            progressText.textContent = '100%';
            
            // Clear interval if exists
            if (loadingIndicator.dataset.interval) {
                clearInterval(loadingIndicator.dataset.interval);
            }
            
            // Hide after short delay
            setTimeout(() => {
                loadingIndicator.classList.add('hidden');
                progressBar.style.width = '0%';
                progressText.textContent = '0%';
            }, 500);
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Add click event for all links
            document.querySelectorAll('a[href]:not([href^="#"]), form').forEach(element => {
                element.addEventListener('click', function(e) {
                    if (element.tagName === 'FORM') return;
                    showLoading();
                });
            });

            // Search functionality
            document.querySelector('.flex.items-center.gap-3 button').addEventListener('click', function(e) {
                e.preventDefault();
                handleSearch();
            });
            
            document.getElementById('search').addEventListener('input', handleSearch);
        });

        window.addEventListener('load', hideLoading);

        // SweetAlert notifications
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
                background: '#fff',
                customClass: {
                    popup: 'rounded-2xl shadow-xl border border-gray-200'
                }
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000,
                background: '#fff',
                customClass: {
                    popup: 'rounded-2xl shadow-xl border border-gray-200'
                }
            });
        @endif

        // Confirm delete function
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                background: '#fff',
                customClass: {
                    popup: 'rounded-2xl shadow-xl border border-gray-200'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        // Add loading for edit and add buttons
        document.getElementById('add-button')?.addEventListener('click', showLoading);
        
        @foreach ($facilities as $assesment)
            document.getElementById('edit-button-{{ $assesment->id }}')?.addEventListener('click', showLoading);
        @endforeach
    </script>
@endsection