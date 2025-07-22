@extends('layouts.app')

@section('page_title', 'Agenda')

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
                    <a href="{{ route('agenda.create') }}" class="text-sm font-semibold text-white px-3">
                        Add Agenda
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <form action="{{ route('agenda.index') }}" method="GET" class="relative gap-3">
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

        {{-- Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($agendas as $agenda)
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden p-4 relative">
                    {{-- Checkbox --}}
                    <div class="absolute top-4 left-4">
                        <input type="checkbox"
                            class="w-4 h-4 text-[#3030F8] bg-gray-100 border-gray-300 rounded hover:scale-110 focus:ring-[#3030F8]">
                    </div>

                    {{-- Image --}}
                    <img src="{{ asset('storage/agenda/' . $agenda->image) }}" alt="{{ $agenda->title }}"
                        class="w-full h-[200px] object-cover rounded-xl mb-4">

                    {{-- Title --}}
                    <h3 class="text-[16px] font-semibold text-gray-800 text-center uppercase mb-2">
                        {{ $agenda->title }}
                    </h3>

                    {{-- Short Description --}}
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2 text-justify">
                        {{ Str::limit(strip_tags($agenda->description), 100) }}
                    </p>

                    {{-- Buttons --}}
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('agenda.edit', $agenda->id) }}"
                            class="bg-[#8989FC] hover:bg-[#6f6ffc] text-white text-xs px-4 py-2 rounded-full transition">
                            Edit
                        </a>

                        <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white text-xs px-4 py-2 rounded-full transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500 text-sm">Tidak ada agenda ditemukan.</p>
            @endforelse
        </div>
    </div>
@endsection
