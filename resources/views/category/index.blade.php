@extends('layouts.app')

@section('page_title', 'blog')

@section('content')
    <div class="container p-4 bg-white rounded-lg">
        {{-- Header Action (Add Agenda & Search) --}}
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <div class="flex gap-4 items-center">
                <div
                    class="bg-blue-500 rounded-full w-[180px] h-[50px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                    <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </div>
                    <a href="{{ route('category.create') }}" class="text-sm font-semibold text-white px-3">
                        Add kategori
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <form action="{{ route('category.index') }}" method="GET" class="relative gap-3">
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

        {{-- Checkbox Pilih Semua --}}
        <div class="mb-6">
            <label class="px-5 inline-flex items-center space-x-2">
                <input id="checkAll" type="checkbox"
                    class="w-4 h-4 text-[#3030F8] bg-gray-100 border-gray-300 rounded hover:scale-110 focus:ring-[#3030F8] cursor-pointer">
                <span class="text-sm font-semibold text-gray-700">Pilih semua</span>
            </label>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($categories as $post)
                <div class="relative rounded-xl shadow-xl h-[467px] overflow-hidden bg-white group">
                    <!-- Checkbox -->
                    <input type="checkbox" name="selected_posts[]" value="{{ $post->id }}"
                        class="item-checkbox w-4 h-4 text-purple-600 bg-white border-gray-300 rounded focus:ring-purple-500 absolute top-5 right-10">


                    <!-- Gambar -->
                    <img src="{{ asset('storage/' . $post->image) }}" alt="" class="w-full h-[266px] object-cover">

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
                            <a href="{{ route('category.edit', $post->id) }}"
                                class="w-[55px] h-[32px] rounded-md bg-[#7C6AED] text-white text-center flex items-center justify-center font-medium text-[14px] hover:scale-110 transition">
                                Edit
                            </a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>


    @endsection
