@extends('layouts.app')

@section('page_title', 'Headers')

@section('content')
    <div class="bg-white max-w-full mx-auto p-[32px] rounded-[24px]">
        {{-- Search Bar --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center mb-6 gap-4">
            <div class="w-full sm:w-[300px]">
                <form method="GET" action="{{ route('header.index') }}" id="searchForm">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full border border-gray-300 rounded-full py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-purple-300"
                            placeholder="Search">
                        <span class="absolute left-3 top-2.5 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M17 11a6 6 0 1 1-12 0 6 6 0 0 1 12 0z" />
                            </svg>
                        </span>
                    </div>
                </form>
            </div>
            <button type="submit" form="searchForm"
                class="bg-[#7A6FF0] hover:bg-[#665ae3] text-white px-6 py-2 rounded-full transition-all">Search</button>
        </div>

        {{-- Grid of Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($headers as $header)
                <div class="bg-white w-full h-full rounded-[16px] shadow-sm overflow-hidden">
                    <img src="{{ asset($header->image) }}" alt="Header Image"
                        class="w-full h-[150px] object-cover overflow-hidden">
                    <div class="p-4 flex justify-between items-center">
                        <span
                            class="text-sm font-medium text-gray-800 truncate w-3/4">{{ $header->title ?? 'About Us' }}</span>
                        <a href="{{ route('header.edit', $header->id) }}"
                            class="flex items-center gap-2 bg-[#7A6FF0] hover:bg-[#665ae3] text-sm text-white px-4 py-2 rounded-full edit-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5">
                                    <path
                                        d="M19.09 14.441v4.44a2.37 2.37 0 0 1-2.369 2.369H5.12a2.37 2.37 0 0 1-2.369-2.383V7.279a2.356 2.356 0 0 1 2.37-2.37H9.56" />
                                    <path
                                        d="M6.835 15.803v-2.165c.002-.357.144-.7.395-.953l9.532-9.532a1.36 1.36 0 0 1 1.934 0l2.151 2.151a1.36 1.36 0 0 1 0 1.934l-9.532 9.532a1.36 1.36 0 0 1-.953.395H8.197a1.36 1.36 0 0 1-1.362-1.362M19.09 8.995l-4.085-4.086" />
                                </g>
                            </svg>
                            Edit
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>



    @if (session('success'))
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Loading state for edit buttons
            const editButtons = document.querySelectorAll('.edit-btn');

            editButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    Swal.fire({
                        title: 'Loading...',
                        html: 'Please wait while we load the edit page',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                });
            });

            // Loading state for search form
            const searchForm = document.getElementById('searchForm');
            if (searchForm) {
                searchForm.addEventListener('submit', function() {
                    Swal.fire({
                        title: 'Searching...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                });
            }
        });
    </script>
@endsection
