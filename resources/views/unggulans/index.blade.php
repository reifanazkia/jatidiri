@extends('layouts.app')

@section('page_title', 'Unggulans')

@section('content')
    <div class="container w-full p-[32px] bg-white rounded-[24px]">
        {{-- Header Action --}}
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            {{-- Tombol Add --}}
            <div class="flex gap-4 items-center">
                <div
                    class="bg-blue-500 rounded-full w-[150px] h-[38px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                    <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>
                    <a href="{{ route('unggulans.create') }}" id="addButton"
                        class="text-sm font-normal leading-[130%] text-white px-2 py-4">
                        Add Unggulan
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
                <button id="searchButton"
                    class="bg-[#8989FC] text-white px-5 h-[40px] rounded-full text-sm hover:bg-[#6f6ffc] transition">
                    Search
                </button>
            </div>
        </div>

        <div class="px-5 border-b border-gray-300 relative">
            <button class="px-4 py-1 text-sm font-medium bg-gray-100 border border-gray-300 rounded-t-md">
                Jatidiri Sekolah
            </button>
        </div>

        {{-- Loading Indicator --}}
        <div id="loadingIndicator"
            class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500 mb-4"></div>
                <p class="text-gray-700">Memproses...</p>
            </div>
        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach ($unggulans as $unggulan)
                <div class="relative rounded-xl shadow-xl w-full h-auto overflow-hidden bg-[#D1D5DB8C] group" data-card>
                    <img src="{{ asset('storage/' . $unggulan->image) }}" alt=""
                        class="w-[399px] h-[346px] object-cover">

                    <div class="px-4 py-4">
                        <p class="font-semibold text-[20px] leading-[130%] line-clamp-2">
                            {{ $unggulan->title }}
                        </p>

                        <div class="flex items-center justify-between mt-3">
                            <div class="bg-[#E8E8E8] rounded-md px-3 py-[2px]">
                                <p class="text-sm">
                                    {{ \Carbon\Carbon::parse($unggulan->created_at)->translatedFormat('d F Y') }}
                                </p>
                            </div>
                            <div class="px-3 w-[61px] h-[21px] rounded-md bg-[#9689FF4D] flex items-center justify-center">
                                <p class="text-sm font-normal text-[#603EFF]">Artikel</p>
                            </div>
                        </div>

                        <div class="flex gap-2 mt-8">
                            <a href="{{ route('unggulans.edit', $unggulan->id) }}" id="editButton-{{ $unggulan->id }}"
                                class="w-[55px] h-[32px] rounded-md bg-[#7C6AED] text-white text-center flex items-center justify-center font-medium text-[14px] hover:scale-110 transition">
                                Edit
                            </a>
                            <form action="{{ route('unggulans.destroy', $unggulan->id) }}" method="POST"
                                class="inline delete-form" data-id="{{ $unggulan->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 w-[55px] h-[32px] text-white px-3 py-1 rounded text-xs flex items-center gap-1">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if ($unggulans->hasPages())
            <div class="flex justify-center mt-10 space-x-2">
                {{-- Previous Page --}}
                @if ($unggulans->onFirstPage())
                    <span class="px-3 py-1 text-gray-400 cursor-not-allowed">« Previous</span>
                @else
                    <a href="{{ $unggulans->previousPageUrl() }}" class="px-3 py-1 text-[#3030F8] hover:underline">«
                        Previous</a>
                @endif

                {{-- Pages --}}
                @foreach ($unggulans->getUrlRange(1, $unggulans->lastPage()) as $page => $url)
                    @if ($page == $unggulans->currentPage())
                        <span class="px-3 py-1 bg-[#3030F8] text-white rounded shadow">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            class="px-3 py-1 border border-[#3030F8] text-black rounded hover:bg-purple-700">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                {{-- Next Page --}}
                @if ($unggulans->hasMorePages())
                    <a href="{{ $unggulans->nextPageUrl() }}" class="px-3 py-1 text-[#3030F8] hover:underline">Next »</a>
                @else
                    <span class="px-3 py-1 text-gray-400 cursor-not-allowed">Next »</span>
                @endif
            </div>
        @endif
    </div>

    <script>
        // Show SweetAlert loading indicator with better design
        function showSwalLoading(title = 'Memproses...') {
            Swal.fire({
                title: title,
                allowOutsideClick: false,
                showConfirmButton: false,
                backdrop: `
                rgba(255,255,255,0.8)
                url("/images/loading-animation.gif")
                center top
                no-repeat
            `,
                customClass: {
                    popup: 'rounded-xl shadow-2xl',
                    title: 'text-lg font-semibold text-gray-700'
                },
                willOpen: () => {
                    Swal.showLoading();
                }
            });
        }

        // Handle search with stylish alert
        function handleSearch() {
            showSwalLoading('Mencari data...');
            const searchTerm = document.getElementById('search').value.toLowerCase().trim();
            document.querySelectorAll('[data-card]').forEach(card => {
                card.style.display = card.textContent.toLowerCase().includes(searchTerm) ? '' : 'none';
            });
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Pencarian selesai',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                toast: true,
                background: '#f8f9fa',
                customClass: {
                    popup: 'animate__animated animate__fadeInRight',
                    title: 'text-sm font-medium text-gray-800'
                }
            });
        }

        // Beautiful delete confirmation dialog
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const id = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    backdrop: `
                rgba(0,0,0,0.5)
                url("/images/nyan-cat.gif")
                left top
                no-repeat
            `
                }).then((result) => {
                    if (result.isConfirmed) {
                        showSwalLoading('Menghapus data...');
                        // Pastikan menggunakan this.submit() yang benar
                        this.submit();
                    }
                });
            });
        });
        // Enhanced success message
        @if (session('success'))
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                background: 'white',
                backdrop: `
                rgba(0,0,0,0.2)
                url("/images/confetti.svg")
                center top
                no-repeat
            `,
                customClass: {
                    popup: 'rounded-xl border-0 shadow-lg',
                    icon: 'w-16 h-16',
                    title: 'text-xl font-semibold text-gray-800'
                },
                showClass: {
                    popup: 'animate__animated animate__bounceIn'
                }
            });
        @endif

        // Enhanced error message
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                html: '<div class="text-gray-600">{{ session('error') }}</div>',
                confirmButtonText: 'Mengerti',
                background: 'white',
                customClass: {
                    popup: 'rounded-xl border-0 shadow-lg',
                    confirmButton: 'px-6 py-2 bg-blue-500 hover:bg-blue-600 rounded-lg text-white font-medium transition',
                    title: 'text-xl font-semibold text-gray-800'
                },
                buttonsStyling: false,
                showClass: {
                    popup: 'animate__animated animate__headShake'
                }
            });
        @endif

        // Add loading for edit buttons with animation
        document.querySelectorAll('[id^="editButton-"]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                showSwalLoading('Menyiapkan halaman edit...');
                setTimeout(() => {
                    window.location.href = this.href;
                }, 500);
            });
        });

        // Add loading for create button with animation
        document.getElementById('addButton')?.addEventListener('click', function(e) {
            e.preventDefault();
            showSwalLoading('Menyiapkan formulir tambah data...');
            setTimeout(() => {
                window.location.href = this.href;
            }, 500);
        });

        // Search button event with animation
        document.getElementById('searchButton')?.addEventListener('click', function(e) {
            e.preventDefault();
            handleSearch();
        });

        // Search input event with animation
        document.getElementById('search')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                handleSearch();
            }
        });
    </script>
@endsection
