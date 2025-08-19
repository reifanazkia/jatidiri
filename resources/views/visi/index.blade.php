@extends('layouts.app')

@section('page_title', 'Visi')

@section('content')
    <div class="bg-white rounded-[24px] shadow-md overflow-hidden">
        <h1 class="p-8 font-bold text-xl">Tentang JATIDIRI.APP</h1>

        @foreach ($visis as $visi)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-8 pb-8">
                <div class="flex flex-col">
                    <!-- Image -->
                    <div class="col-span-1">
                        <img src="{{ asset('storage/' . $visi->image) }}" alt="Visi"
                            class="w-full h-64 object-cover rounded-lg shadow-sm">
                    </div>

                    <!-- Edit Button -->
                    <div class="mt-6">
                        @foreach ($visis as $visi)
                            <a href="{{ route('visi.edit', $visi->id) }}"
                                class="bg-blue-500 rounded-full w-[90px] h-[40px] flex items-center justify-between hover:bg-blue-600 transition">
                                <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </div>
                                <span class="text-sm font-normal leading-[130%] text-white px-2 py-4">Edit</span>
                            </a>
                        @endforeach
                    </div>
                </div>
                <!-- Text -->
                <div class="col-span-2">
                    <h3 class="text-xl font-semibold mb-1">VISI JATIDIRI</h3>
                    <p class="text-sm text-gray-500 mb-2">{{ $visi->subtitle }}</p>
                    <p class="text-base text-gray-700 mb-4 leading-relaxed">
                        {{ $visi->visi }}
                    </p>

                </div>
            </div>
        @endforeach
    </div>
@endsection
