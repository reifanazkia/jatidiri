@extends('layouts.app')

@section('page_title', 'services')

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
                        Add service
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <form action="{{ route('service.index') }}" method="GET" class="relative gap-3">
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

    @endsection
