@extends('layouts.app')

@section('page_title', 'FAQs')

@section('content')
    <div class="bg-white max-w-full rounded-[24px] mx-auto p-[32px]">
        {{-- Filter + Search + Button --}}
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
            {{-- Filter Form --}}
            <form method="GET" action="{{ route('faqs.index') }}" class="flex flex-wrap items-center gap-[64px] w-full">

                {{-- Dropdown Category --}}
                <div class="relative inline-block">
                    {{-- Dropdown Category --}}
                    <select name="category"
                        class="w-auto min-w-[140px] max-w-xs border border-gray-300 bg-white text-gray-700 text-sm rounded-lg px-4 py-2 pr-8 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 appearance-none">
                        <option value="">All Category</option>
                        @foreach (\App\Models\Category::all() as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Custom Arrow Icon --}}
                    <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                {{-- Search Input --}}
                <div class="gap-[16px] flex items-center">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Search" value="{{ request('search') }}"
                            class="pl-9 pr-4 py-2 rounded-full border border-gray-200 bg-white text-sm w-64 focus:outline-none focus:ring focus:ring-indigo-200" />
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    {{-- Search Button --}}
                    <button type="submit"
                        class="bg-[#7E74F1] text-white text-sm px-5 py-2 rounded-full hover:bg-[#6a61e5] transition">
                        Search
                    </button>
                </div>
            </form>

            {{-- Add FAQ Button --}}
            <div
                class=" bg-blue-500 rounded-full w-[150px] h-[40px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                <!-- Icon Section -->
                <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </div>

                <!-- Text Section -->
                <a href="{{ route('faqs.create') }}" class="text-sm font-normal leading-[130%] text-white px-2 py-4">
                    Add FAQs
                </a>
            </div>
        </div>

        {{-- List of FAQs --}}
        <div class=" grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse ($data as $faq)
                <div class="border flex justify-between border-gray-200 rounded-xl p-6 bg-white shadow-sm">
                    <div class="flex flex-col">
                    <h3 class="text-lg font-semibold mb-2">{{ $faq->title }}</h3>
                    <p class="text-sm text-gray-700 mb-4">
                        {{ \Illuminate\Support\Str::limit(strip_tags($faq->description), 200) }}</p>
                    </div>

                    <div class="flex flex-col justify-between gap-4">
                        {{-- Category --}}
                        <div class="flex flex-col gap-2">
                            <span class="text-sm text-gray-500">Category</span>
                            <span class="text-xs bg-purple-100 text-purple-600 px-2 py-0.5 rounded-full">
                                {{ $faq->category->name ?? '-' }}
                            </span>
                        </div>

                        {{-- Action --}}
                        <div class="flex gap-2">
                            <a href="{{ route('faqs.edit', $faq->id) }}"
                                class="bg-indigo-500 text-white text-xs px-4 py-1 rounded hover:bg-indigo-600">Edit</a>
                            <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white text-xs px-4 py-1 rounded hover:bg-red-600 flex items-center justify-center gap-1">
                                    <span class="delete-text">Delete</span>
                                    <svg class="delete-spinner hidden w-4 h-4 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Tidak ada data ditemukan.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $data->withQueryString()->links() }}
        </div>
    </div>

    <!-- Loading overlay -->
    <div id="loading-overlay" class="fixed inset-0  bg-opacity-30 z-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
            <svg class="animate-spin h-12 w-12 text-indigo-600 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="text-gray-700">Processing, please wait...</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle form submissions with loading indicators
            const loadingOverlay = document.getElementById('loading-overlay');

            // Add event listener for create/edit links
            document.querySelectorAll('a[href*="faqs/create"], a[href*="faqs/edit"]').forEach(link => {
                link.addEventListener('click', function(e) {
                    loadingOverlay.classList.remove('hidden');
                });
            });

            // Handle delete forms
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const deleteButton = this.querySelector('button[type="submit"]');
                    const deleteText = deleteButton.querySelector('.delete-text');
                    const deleteSpinner = deleteButton.querySelector('.delete-spinner');

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
                            // Show loading state on the button
                            deleteText.textContent = 'Deleting...';
                            deleteSpinner.classList.remove('hidden');

                            // Submit the form
                            this.submit();
                        }
                    });
                });
            });

            // Hide loading overlay when page fully loads (in case of back navigation)
            window.addEventListener('load', function() {
                loadingOverlay.classList.add('hidden');
            });

            // Check for success messages from create or edit actions
            @if (session('success'))
                const successMessage = "{{ session('success') }}";
                let icon = 'success';
                let title = 'Success!';

                // Determine if it's a create or edit action based on the message
                if (successMessage.includes('created')) {
                    title = 'FAQ Created!';
                } else if (successMessage.includes('updated')) {
                    title = 'FAQ Updated!';
                } else if (successMessage.includes('deleted')) {
                    title = 'FAQ Deleted!';
                }

                Swal.fire({
                    icon: icon,
                    title: title,
                    text: successMessage,
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif

            // Check for error messages
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
        });
    </script>
@endsection
