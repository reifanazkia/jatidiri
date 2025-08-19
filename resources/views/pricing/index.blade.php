@extends('layouts.app')

@section('page_title', 'Pricings')

@section('content')
    <div class="bg-white max-w-full rounded-[24px] mx-auto p-[32px] relative">
        <!-- Loading Overlay -->
        <div id="loading-overlay"
            class="hidden absolute inset-0 bg-white bg-opacity-70 z-50 rounded-[24px] flex items-center justify-center">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
        </div>

        {{-- Header Action (Add Post & Categories) --}}
        <div class="flex flex-wrap items-center justify-between gap-4 mb-[32px]">
            <div class="flex gap-4 items-center">
                {{-- Add Post --}}
                <div
                    class=" bg-blue-500 rounded-full w-[140px] h-[40px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                    <!-- Icon Section -->
                    <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>

                    <!-- Text Section -->
                    <a href="{{ route('pricing.create') }}" class="text-sm font-normal leading-[130%] text-white px-2 py-4">
                        Add Pricing
                    </a>
                </div>
            </div>

            {{-- Search Input + Button --}}
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
                <button class="bg-[#8989FC] text-white px-5 h-[40px] rounded-full text-sm hover:bg-[#6f6ffc] transition">
                    Search
                </button>
            </div>
        </div>

        <div class="px-5 border-b border-gray-300 relative mb-8">
            <button class="px-4 py-1 text-sm font-medium bg-gray-100 border border-gray-300 rounded-t-md">
                Jatidiri Sekolah
            </button>
        </div>

        {{-- Pricing Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($pricing as $item)
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm px-6 py-6 flex flex-col md:flex-row gap-6">
                    <div class="flex-1">
                        {{-- Title --}}
                        <h3 class="font-semibold text-lg text-gray-800 mb-4">{{ $item->title }}</h3>

                        {{-- Description --}}
                        <ul class="text-sm text-gray-600 space-y-2 list-disc pl-5">
                            @foreach (explode("\n", $item->description) as $line)
                                @if (trim($line) != '')
                                    <li class="leading-tight">{{ $line }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    {{-- Price and Actions --}}
                    <div class="flex flex-col justify-between items-end w-full md:w-auto">
                        {{-- Price --}}
                        <div class="text-right">
                            @if ($item->diskon)
                                <div class="text-sm text-gray-500 line-through">
                                    Rp{{ number_format($item->price, 0, ',', '.') }}k
                                </div>
                                @php
                                    $finalPrice = $item->price - ($item->price * $item->diskon) / 100;
                                @endphp
                                <div class="text-lg font-bold text-gray-900">
                                    Rp{{ number_format($finalPrice, 0, ',', '.') }}k
                                    <span class="text-xs font-normal text-red-500">(Disc. {{ $item->diskon }}%)</span>
                                </div>
                            @else
                                <div class="text-lg font-bold text-gray-900">
                                    Rp{{ number_format($item->price, 0, ',', '.') }}k
                                </div>
                            @endif
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex gap-2 mt-4">
                            <a href="{{ route('pricing.edit', $item->id) }}"
                                class="bg-[#6B5AED] hover:bg-[#4F47E2] text-white text-sm px-4 py-2 rounded-full font-medium transition">
                                Edit
                            </a>
                            <form action="{{ route('pricing.destroy', $item->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-2 rounded-full font-medium transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">Tidak ada data pricing.</div>
            @endforelse
        </div>
    </div>

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
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        // Delete confirmation with SweetAlert
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const form = this;

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
