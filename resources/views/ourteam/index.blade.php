@extends('layouts.app')

@section('page_title', 'Our Team')

@section('content')
    <div class="bg-white w-full p-8 rounded-[24px]">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div
                class="bg-blue-500 rounded-full w-[150px] h-[40px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                <!-- Icon Section -->
                <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </div>

                <!-- Text Section -->
                <a href="{{ route('ourteam.create') }}" id="addTeamButton"
                    class="text-sm font-normal leading-[130%] text-white px-2 py-4">
                    Add Ourteam
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
                <button class="bg-[#8989FC] text-white px-5 h-[40px] rounded-full text-sm hover:bg-[#6f6ffc] transition">
                    Search
                </button>
            </div>
        </div>

        <!-- Cards Grid -->
        <div class="w-full grid grid-cols-3 gap-8">
            @foreach ($data as $item)
                <div class="bg-gray-100 rounded-xl flex p-4 shadow-sm">
                    <div class="w-20 h-20 flex-shrink-0">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                            class="w-full h-full object-cover rounded-lg">
                    </div>
                    <div class="ml-4 flex flex-col justify-between flex-1">
                        <div>
                            <h2 class="font-semibold text-sm">{{ $item->name }}, {{ $item->title }}</h2>
                            <p class="text-xs text-gray-600">{{ $item->phone ?? '+62' }}</p>
                        </div>
                        <div class="mt-2 flex gap-2">
                            <a href="{{ route('ourteam.edit', $item->id) }}"
                                class="text-white bg-indigo-500 hover:bg-indigo-600 text-xs px-[8px] py-[8px] rounded-xl flex items-center gap-1 edit-team-button">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('ourteam.destroy', $item->id) }}" method="POST"
                                class="delete-team-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-red-500 hover:bg-red-600 text-xs px-[8px] py-[8px] rounded-xl flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-5 h-5 text-white">
                                        <path fill-rule="evenodd"
                                            d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Custom Pagination -->
        <div class="mt-6 flex justify-center items-center space-x-2">
            {{-- Tombol "First" --}}
            @if ($data->onFirstPage())
                <span class="px-3 py-1 rounded border text-sm text-gray-400">First</span>
            @else
                <a href="{{ $data->url(1) }}" class="px-3 py-1 rounded border text-sm">First</a>
            @endif

            {{-- Tombol Sebelumnya --}}
            @if ($data->onFirstPage())
                <span class="px-3 py-1 rounded border text-sm text-gray-400">Prev</span>
            @else
                <a href="{{ $data->previousPageUrl() }}" class="px-3 py-1 rounded border text-sm">Prev</a>
            @endif

            {{-- Tombol Nomor Halaman --}}
            @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                @if ($page == $data->currentPage())
                    <span class="px-3 py-1 rounded bg-indigo-500 text-white text-sm">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="px-3 py-1 rounded border text-sm">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Tombol Selanjutnya --}}
            @if ($data->hasMorePages())
                <a href="{{ $data->nextPageUrl() }}" class="px-3 py-1 rounded border text-sm">Next</a>
            @else
                <span class="px-3 py-1 rounded border text-sm text-gray-400">Next</span>
            @endif

            {{-- Tombol "Last" --}}
            @if ($data->hasMorePages())
                <a href="{{ $data->url($data->lastPage()) }}" class="px-3 py-1 rounded border text-sm">Last</a>
            @else
                <span class="px-3 py-1 rounded border text-sm text-gray-400">Last</span>
            @endif
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="fixed inset-0 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500 mb-4"></div>
            <p class="text-gray-700">Processing, please wait...</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Loading overlay functions
            function showLoading() {
                document.getElementById('loadingOverlay').classList.remove('hidden');
            }

            function hideLoading() {
                document.getElementById('loadingOverlay').classList.add('hidden');
            }


            // Delete Team Forms
            document.querySelectorAll('.delete-team-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const form = this;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            showLoading();
                            form.submit();
                        }
                    });
                });
            });

            // Handle success messages from server
            @if (session('success'))
                hideLoading();
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @endif

            // Handle error messages from server
            @if (session('error'))
                hideLoading();
                Swal.fire({
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
@endsection
