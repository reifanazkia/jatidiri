@extends('layouts.app')

@section('page_title', 'Programs')

@section('content')
    <div class="container w-full p-[32px] bg-white rounded-[24px]">
        {{-- Header Action --}}
        <div class="flex flex-wrap items-center justify-between gap-8 mb-6">
            <div class="flex gap-4 items-center">
                {{-- Add Post --}}
                <div
                    class=" bg-blue-500 rounded-full w-[150px] h-[38px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                    <!-- Icon Section -->
                    <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>

                    <!-- Text Section -->
                    <a href="{{ route('program.create') }}" class="text-sm font-normal leading-[130%] text-white px-2 py-4">
                        Add Program
                    </a>
                </div>
            </div>

            {{-- Search --}}
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

        {{-- Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($programs as $program)
                <div class="relative rounded-xl shadow-xl w-full h-[309px] overflow-hidden bg-white group" data-card>
                    <img src="{{ asset('storage/' . $program->image) }}" alt=""
                        class="w-[399px] h-[171px] object-cover">
                    <div class="px-4 py-4">
                        <p class="font-semibold text-[20px] leading-[130%] line-clamp-2">
                            {{ $program->title }}
                        </p>
                        <div class="flex items-center justify-between mt-3">
                            <div class="bg-[#E8E8E8] rounded-md px-3 py-[2px]">
                                <p class="text-sm">
                                    {{ \Carbon\Carbon::parse($program->created_at)->translatedFormat('d F Y') }}
                                </p>
                            </div>
                            <div class="px-3 w-[61px] h-[21px] rounded-md bg-[#9689FF4D] flex items-center justify-center">
                                <p class="text-sm font-normal text-[#603EFF]">Artikel</p>
                            </div>
                        </div>
                        <div class="flex gap-2 mt-10">
                            <a href="{{ route('program.edit', $program->id) }}"
                                class="w-[55px] h-[32px] rounded-md bg-[#7C6AED] text-white text-center flex items-center justify-center font-medium text-[14px] hover:scale-110 transition">
                                Edit
                            </a>
                            <button onclick="confirmDelete('{{ route('program.destroy', $program->id) }}')"
                                class="w-[55px] h-[32px] rounded-md bg-red-500 text-white text-center flex items-center justify-center font-medium text-[14px] hover:scale-110 transition">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="flex justify-center mt-10 space-x-2">
            @php
                $start = max($programs->currentPage() - 1, 1);
                $end = min($programs->currentPage() + 1, $programs->lastPage());
            @endphp

            @if ($programs->onFirstPage())
                <span class="px-3 py-1 text-gray-400 cursor-not-allowed">« Previous</span>
            @else
                <a href="{{ $programs->previousPageUrl() }}" class="px-3 py-1 text-[#3030F8] hover:underline">« Previous</a>
            @endif

            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $programs->currentPage())
                    <span class="px-3 py-1 bg-[#3030F8] text-white rounded shadow">{{ $i }}</span>
                @else
                    <a href="{{ $programs->url($i) }}"
                        class="px-3 py-1 border border-[#3030F8] text-black rounded hover:bg-purple-700">{{ $i }}</a>
                @endif
            @endfor

            @if ($programs->hasMorePages())
                <a href="{{ $programs->nextPageUrl() }}" class="px-3 py-1 text-[#3030F8] hover:underline">Next »</a>
            @else
                <span class="px-3 py-1 text-gray-400 cursor-not-allowed">Next »</span>
            @endif
        </div>
    </div>

    {{-- SweetAlert Success --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    <script>
        // Confirm delete function
        function confirmDelete(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading indicator
                    Swal.fire({
                        title: 'Menghapus...',
                        html: 'Sedang memproses penghapusan data',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });

                    // Create a form and submit it
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';

                    form.appendChild(csrfToken);
                    form.appendChild(methodInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Loading indicator for form submissions
        document.addEventListener('DOMContentLoaded', function() {
            // For create and edit forms
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!this.classList.contains('no-loading')) {
                        Swal.fire({
                            title: 'Memproses...',
                            html: 'Sedang menyimpan data',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });
                    }
                });
            });
        });

        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const searchButton = document.querySelector('.flex.items-center.gap-3 button');
            const cards = document.querySelectorAll('[data-card]');

            function handleSearch() {
                const searchTerm = searchInput.value.toLowerCase().trim();

                cards.forEach(card => {
                    const cardText = card.textContent.toLowerCase();
                    if (cardText.includes(searchTerm)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            searchButton.addEventListener('click', handleSearch);
            searchInput.addEventListener('input', handleSearch);
        });
    </script>
@endsection
