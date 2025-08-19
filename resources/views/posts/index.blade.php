@extends('layouts.app')

@section('page_title', 'Blog & Agenda')

@section('content')
    <div class="container p-6 bg-white rounded-[24px]">
        {{-- Header Action (Add Post & Categories) --}}
        <div class="flex flex-wrap items-center justify-between gap-4 mb-[32px]">
            <div class="flex gap-4 items-center">
                {{-- Add Post --}}
                <div
                    class=" bg-blue-500 rounded-full w-[120px] h-[40px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                    <!-- Icon Section -->
                    <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>

                    <!-- Text Section -->
                    <a href="{{ route('posts.create') }}" class="text-sm font-normal leading-[130%] text-white px-2 py-4">
                        Add posts
                    </a>
                </div>


                {{-- Categories --}}
                <a href="{{ route('category.index') }}" class="inline-block">
                    <button type="button"
                        class="flex items-center bg-blue-500 rounded-full px-5 h-[40px] gap-3 cursor-pointer hover:bg-blue-600 transition focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2">
                        <p class="text-[15px] text-white">Categories</p>
                        <div class="border-l border-white h-[20px]"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                        </svg>
                    </button>
                </a>
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

        {{-- Tempat konten blog nanti --}}
        <div id="posts-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[32px] px-2">
            @foreach ($posts as $post)
                <div class="relative rounded-xl w-full h-full overflow-hidden bg-[#D1D5DB8C] group">
                    <!-- Gambar -->
                    <img src="{{ asset('storage/' . $post->image) }}" alt="" class="w-full h-[200px] object-cover">

                    <!-- Konten -->
                    <div class="px-4 py-4">
                        <!-- Judul -->
                        <p class="font-semibold text-[20px] leading-[130%] line-clamp-2">
                            {{ $post->title }}
                        </p>

                        <!-- Info Tanggal & Kategori -->
                        <div class="flex items-center justify-between mt-3">
                            <div class="bg-[#E8E8E8] rounded-md px-3 py-[2px]">
                                <p class="text-sm">
                                    {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d F Y') }}
                                </p>
                            </div>
                            <div class="px-3 w-[61px] h-[21px] rounded-md bg-[#9689FF4D] flex items-center justify-center">
                                <p class="text-sm font-normal text-[#603EFF]">Artikel</p>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex gap-2 mt-10">
                            <!-- Edit -->
                            <a href="{{ route('posts.edit', $post->id) }}"
                                class="w-[55px] h-[32px] rounded-md bg-[#7C6AED] text-white text-center flex items-center justify-center font-medium text-[14px] hover:scale-110 transition">
                                Edit
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="w-[65px] h-[32px] rounded-md bg-red-500 text-white text-center flex items-center justify-center font-medium text-[14px] hover:scale-110 transition delete-btn">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginasi -->
        <div class="flex justify-center mt-10 space-x-2">
            {{-- Tombol Previous --}}
            @php
                $start = max($posts->currentPage() - 1, 1);
                $end = min($posts->currentPage() + 1, $posts->lastPage());
            @endphp

            {{-- Tombol Previous --}}
            @if ($posts->onFirstPage())
                <span class="px-3 py-1 text-gray-400 cursor-not-allowed">« Previous</span>
            @else
                <a href="{{ $posts->previousPageUrl() }}" class="px-3 py-1 text-[#3030F8] hover:underline">« Previous</a>
            @endif

            {{-- Angka halaman --}}
            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $posts->currentPage())
                    <span class="px-3 py-1 bg-[#3030F8] text-white rounded shadow ">{{ $i }}</span>
                @else
                    <a href="{{ $posts->url($i) }}"
                        class="px-3 py-1 border border-[#3030F8] text-black rounded hover:bg-purple-700">{{ $i }}</a>
                @endif
            @endfor

            {{-- Tombol Next --}}
            @if ($posts->hasMorePages())
                <a href="{{ $posts->nextPageUrl() }}" class="px-3 py-1 text-[#3030F8] hover:underline">Next »</a>
            @else
                <span class="px-3 py-1 text-gray-400 cursor-not-allowed">Next »</span>
            @endif
        </div>
    </div>

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
        // SweetAlert for delete confirmation
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listener to all delete buttons
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('.delete-form');

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
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
