@extends('layouts.app')

@section('page_title', 'Agenda')

@section('content')
    <div class="container p-8 bg-white rounded-[24px]">
        {{-- Header Action (Add Agenda & Search) --}}
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
                    <a href="{{ route('agenda.create') }}" class="text-sm font-normal leading-[130%] text-white px-2 py-4">
                        Add posts
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

        {{-- Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($agendas as $agenda)
                <div class="bg-white rounded-[24px] w-[399px] h-full shadow-lg overflow-hidden flex flex-col">
                    {{-- Image --}}
                    <div class="relative">
                        <img src="{{ asset('storage/' . $agenda->image) }}" alt="{{ $agenda->title }}"
                            class="w-full h-[380px] object-cover">
                    </div>

                    {{-- Content --}}
                    <div class="p-5 flex flex-col flex-grow">
                        {{-- Title --}}
                        <h3 class="text-[16px] font-semibold text-gray-800 mb-3">
                            {{ $agenda->title }}
                        </h3>

                        {{-- Date --}}
                        <div class="flex w-full text-[10px] text-gray-600">
                            <span class="bg-gray-100 rounded-full px-3 py-1">
                                {{ \Carbon\Carbon::parse($agenda->start_date)->format('g:i A, d M Y') }} -
                                {{ \Carbon\Carbon::parse($agenda->end_date)->format('g:i A, d M Y') }}
                            </span>
                        </div>

                        {{-- Buttons --}}
                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('agenda.edit', $agenda->id) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-4 py-2 rounded-full transition">
                                Edit
                            </a>
                            <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white text-xs px-4 py-2 rounded-full transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500 text-sm">No agendas found.</p>
            @endforelse
        </div>
    </div>

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Delete confirmation with SweetAlert - improved version
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const form = this; // Simpan referensi form

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading
                            Swal.fire({
                                title: 'Deleting...',
                                html: 'Please wait while we delete the agenda.',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();

                                    // Kirim form setelah dialog loading muncul
                                    setTimeout(() => {
                                        form.submit();
                                    }, 100);
                                }
                            });
                        }
                    });
                });
            });

            // Notifikasi session
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
@endsection
