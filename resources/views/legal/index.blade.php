@extends('layouts.app')

@section('page_title', 'Legal Documents')

@section('content')
    <div class="container p-8 bg-white rounded-[24px]">
        <!-- SweetAlert Success Message for Create/Update -->
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        timer: 3000,
                        showConfirmButton: false
                    });
                });
            </script>
        @endif

        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <div class="flex gap-4 items-center">
                <div
                    class="bg-blue-500 rounded-full w-[130px] h-[34px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                    <div
                        class="w-[40px] h-[40px] bg-white rounded-full border border-white flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </div>
                    <a href="{{ route('legal.create') }}" id="addLegalBtn"
                        class="text-sm font-normal leading-[130%] text-white px-3 py-[11px]">
                        Add Legal
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <form action="{{ route('legal.index') }}" method="GET" class="relative gap-3">
                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search"
                        class="font-normal px-6 border border-gray-300 rounded-full pl-10 pr-4 h-[40px] w-[240px] text-sm focus:outline-[#3030F8] placeholder-gray-400" />
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 px-2">
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

        <!-- Improved Loading Indicator -->
        <div id="loadingIndicator" class="fixed inset-0 flex items-center justify-center bg-opacity-30 z-50 hidden">
            <div class="bg-white p-6 rounded-xl shadow-2xl flex flex-col items-center">
                <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-b-4 border-blue-500 mb-4"></div>
                <p class="text-gray-700 font-medium">Loading, please wait...</p>
                <p class="text-sm text-gray-500 mt-1">Processing your request</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($legals as $legal)
                <div class="relative rounded-xl shadow-xl h-[467px] overflow-hidden bg-white group">
                    <!-- Gambar -->
                    @if ($legal->image)
                        <img src="{{ asset('storage/' . $legal->image) }}" alt="{{ $legal->title }}"
                            class="w-full h-[266px] object-cover">
                    @else
                        <div class="w-full h-[266px] bg-gray-100 flex items-center justify-center text-gray-400">
                            No Image
                        </div>
                    @endif

                    <!-- Konten -->
                    <div class="px-4 py-4">
                        <!-- Judul -->
                        <p class="font-semibold text-[20px] leading-[130%] line-clamp-2">
                            {{ $legal->title }}
                        </p>

                        <!-- Info Tanggal -->
                        <div class="flex items-center justify-between mt-3">
                            <div class="bg-[#E8E8E8] rounded-md px-3 py-[2px]">
                                <p class="text-sm">
                                    {{ \Carbon\Carbon::parse($legal->created_at)->translatedFormat('d F Y') }}
                                </p>
                            </div>
                            <div class="px-3 w-[61px] h-[21px] rounded-md bg-[#9689FF4D] flex items-center justify-center">
                                <p class="text-sm font-normal text-[#603EFF]">Legal</p>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex gap-2 mt-10">
                            <!-- Edit -->
                            <a href="{{ route('legal.edit', $legal->id) }}"
                                class="w-[55px] h-[32px] rounded-md bg-[#7C6AED] text-white text-center flex items-center justify-center font-medium text-[14px] hover:scale-110 transition">
                                Edit
                            </a>
                            <!-- Delete -->
                            <form action="{{ route('legal.destroy', $legal->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-[70px] h-[32px] rounded-md bg-red-500 text-white font-medium text-[14px] hover:scale-110 transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Loading indicator for all links and forms
            document.querySelectorAll('a:not([target="_blank"]), button:not([type="button"]), form').forEach(element => {
                element.addEventListener('click', function(e) {
                    // Don't show loading for delete forms (handled separately)
                    if (!this.classList.contains('delete-form') &&
                        !this.classList.contains('no-loading') &&
                        this.tagName !== 'FORM') {
                        showLoading();
                    }
                });
            });

            // Add loading to "Add Legal" button
            document.getElementById('addLegalBtn').addEventListener('click', function() {
                showLoading();
            });

            // Search form submission
            document.querySelector('form[action="{{ route('legal.index') }}"]').addEventListener('submit', function() {
                showLoading();
            });

            // Delete confirmation with SweetAlert
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

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
                            this.submit();
                        }
                    });
                });
            });

            // Show loading function
            function showLoading() {
                const loader = document.getElementById('loadingIndicator');
                loader.classList.remove('hidden');
                loader.classList.add('flex');

                // Hide after 30 seconds max in case something goes wrong
                setTimeout(() => {
                    if (!loader.classList.contains('hidden')) {
                        loader.classList.add('hidden');
                        Swal.fire({
                            icon: 'error',
                            title: 'Timeout',
                            text: 'The request is taking longer than expected',
                        });
                    }
                }, 30000);
            }

            // Hide loading when page is fully loaded
            window.addEventListener('load', function() {
                hideLoading();
            });

            // Hide loading function
            function hideLoading() {
                const loader = document.getElementById('loadingIndicator');
                loader.classList.add('hidden');
                loader.classList.remove('flex');
            }

            // Also hide loading if there's an error
            window.addEventListener('error', hideLoading);
        });
    </script>
@endsection
