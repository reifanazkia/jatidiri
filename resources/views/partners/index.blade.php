@extends('layouts.app')

@section('page_title', 'Partners')

@section('content')
    <div class="bg-white w-full p-8 rounded-[24px]">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div
                class="bg-blue-500 rounded-full w-[140px] h-[40px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                <!-- Icon -->
                <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </div>
                <a href="{{ route('partners.create') }}" id="create-link" class="text-sm font-normal text-white px-2 py-4">Add Partner</a>
            </div>

            <div class="flex items-center gap-3">
                <form action="{{ route('partners.index') }}" method="GET" class="relative">
                    <input type="text" name="search" placeholder="Search"
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

        <!-- Loading Indicator -->
        <div id="loading-indicator"
            class="fixed inset-0 bg-opacity-30 flex items-center justify-center z-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center">
                <svg class="animate-spin -ml-1 mr-3 h-8 w-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                    </circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <span class="text-gray-700">Processing...</span>
            </div>
        </div>

        <!-- Cards Grid -->
        <div class="w-full grid grid-cols-3 gap-6">
            @foreach ($partners as $partner)
                <div class="h-full w-full bg-gray-100 rounded-xl flex p-4 shadow-sm">
                    <div class="w-20 h-20 flex-shrink-0">
                        <img src="{{ asset('storage/' . $partner->image) }}" alt="{{ $partner->name }}"
                            class="w-full h-full object-cover rounded-lg">
                    </div>
                    <div class="ml-4 flex flex-col justify-between flex-1">
                        <div>
                            <h2 class="font-semibold text-sm">{{ $partner->name }}</h2>
                            <p class="text-xs text-gray-600">{{ $partner->web ?? '-' }}</p>
                        </div>
                        <div class="mt-2 flex gap-2">
                            <a href="{{ route('partners.edit', $partner->id) }}"
                                class="text-white bg-indigo-500 hover:bg-indigo-600 text-xs px-[16px] py-[8px] rounded-xl flex items-center gap-1 edit-link">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('partners.destroy', $partner->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-red-500 hover:bg-red-600 text-xs px-[16px] py-[8px] rounded-xl flex items-center gap-1">
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

        <!-- Pagination -->
        <div class="mt-6 flex justify-center items-center space-x-2">
            @if ($partners->onFirstPage())
                <span class="px-3 py-1 rounded border text-sm text-gray-400">First</span>
                <span class="px-3 py-1 rounded border text-sm text-gray-400">Prev</span>
            @else
                <a href="{{ $partners->url(1) }}" class="px-3 py-1 rounded border text-sm">First</a>
                <a href="{{ $partners->previousPageUrl() }}" class="px-3 py-1 rounded border text-sm">Prev</a>
            @endif

            @foreach ($partners->getUrlRange(1, $partners->lastPage()) as $page => $url)
                @if ($page == $partners->currentPage())
                    <span class="px-3 py-1 rounded bg-indigo-500 text-white text-sm">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="px-3 py-1 rounded border text-sm">{{ $page }}</a>
                @endif
            @endforeach

            @if ($partners->hasMorePages())
                <a href="{{ $partners->nextPageUrl() }}" class="px-3 py-1 rounded border text-sm">Next</a>
                <a href="{{ $partners->url($partners->lastPage()) }}" class="px-3 py-1 rounded border text-sm">Last</a>
            @else
                <span class="px-3 py-1 rounded border text-sm text-gray-400">Next</span>
                <span class="px-3 py-1 rounded border text-sm text-gray-400">Last</span>
            @endif
        </div>
    </div>



        <script>
            // Show success message if created/updated
            @if (session('success'))
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        timer: 3000,
                        timerProgressBar: true
                    });
                });
            @endif

            // Delete confirmation with SweetAlert
            document.addEventListener('DOMContentLoaded', function() {
                const deleteForms = document.querySelectorAll('.delete-form');

                deleteForms.forEach(form => {
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
                                // Show loading indicator
                                const loadingIndicator = document.getElementById('loading-indicator');
                                loadingIndicator.classList.remove('hidden');

                                // Submit the form
                                form.submit();
                            }
                        });
                    });
                });

                // Show loading indicator for create and edit links
                const createLink = document.getElementById('create-link');
                const editLinks = document.querySelectorAll('.edit-link');
                const loadingIndicator = document.getElementById('loading-indicator');

                if (createLink) {
                    createLink.addEventListener('click', function(e) {
                        loadingIndicator.classList.remove('hidden');
                    });
                }

                if (editLinks) {
                    editLinks.forEach(link => {
                        link.addEventListener('click', function(e) {
                            loadingIndicator.classList.remove('hidden');
                        });
                    });
                }

                // Show loading indicator on form submissions (except delete forms)
                const forms = document.querySelectorAll('form:not(.delete-form)');
                forms.forEach(form => {
                    form.addEventListener('submit', function() {
                        loadingIndicator.classList.remove('hidden');
                    });
                });
            });
        </script>
@endsection
