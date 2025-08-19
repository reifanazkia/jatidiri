@extends('layouts.app')

@section('page_title', 'Supports')

@section('content')
    <div class="bg-white max-w-full mx-auto p-[32px] rounded-[24px]">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <div
                class=" bg-blue-500 rounded-full w-[145px] h-[40px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                <!-- Icon Section -->
                <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </div>

                <!-- Text Section -->
                <a href="{{ route('dukungan.create') }}" class="text-sm font-normal leading-[130%] text-white px-2 py-4">
                    Add Supports
                </a>
            </div>

            {{-- Search --}}
            <form method="GET" action="{{ route('dukungan.index') }}" class="flex gap-2">
                <input type="text" name="search" placeholder="Search" value="{{ request('search') }}"
                    class="border rounded-full px-4 py-2 focus:ring focus:ring-indigo-300">
                <button type="submit"
                    class="bg-blue-500 px-4 py-2 text-white rounded-full hover:bg-blue-600">Search</button>
            </form>
        </div>

        <div id="loading-indicator" class="fixed inset-0 flex items-center justify-center bg-opacity-80 z-50 hidden">
            <div class="flex flex-col items-center">
                <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-blue-500 mb-4"></div>
                <p class="text-gray-700 font-medium">Processing...</p>
            </div>
        </div>

        {{-- List --}}
        <div class="space-y-6 w-full">
            @foreach ($data as $item)
                <div class="bg-white rounded-[24px] shadow p-4 flex flex-col md:flex-row items-center md:items-start gap-4">
                    {{-- Text --}}
                    <div class="flex-1 w-full md:w-auto">
                        <p class="font-semibold text-base">{{ $item->name }} | {{ $item->jabatan }}</p>
                        <p class="font-medium text-gray-800 mt-1">{{ $item->title }}</p>

                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('dukungan.edit', $item->id) }}"
                                class="px-3 py-1 text-sm bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Edit</a>
                            <form action="{{ route('dukungan.destroy', $item->id) }}" method="POST"
                                onsubmit="showDeleteConfirmation(event)">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 text-sm bg-red-500 text-white rounded-md hover:bg-red-600">Delete</button>
                            </form>
                        </div>
                    </div>

                    {{-- Image --}}
                    <div class="w-[200px] h-[200px] shrink-0 ">
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Foto"
                                class="w-full h-full object-cover rounded-md">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center rounded-md">
                                <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4 5h16v14H4V5zm2 2v10h12V7H6zm5 2h2v6h-2V9zm3 2h2v4h-2v-4zm-6 2h2v2H8v-2z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- YouTube Video --}}
                    <div class="w-[300px] h-[200px] shrink-0">
                        @if ($item->id_yt)
                            <iframe class="w-full h-full rounded-md" src="https://www.youtube.com/embed/{{ $item->id_yt }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center rounded-md">
                                <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $data->withQueryString()->links() }}
        </div>
    </div>

    <script>
        // Show loading indicator
        function showLoading() {
            document.getElementById('loading-indicator').classList.remove('hidden');
        }

        // Hide loading indicator
        function hideLoading() {
            document.getElementById('loading-indicator').classList.add('hidden');
        }

        // Delete confirmation with SweetAlert
        function showDeleteConfirmation(event) {
            event.preventDefault();
            const form = event.target;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                // Tambahkan ini untuk menangani ketika modal ditutup
                allowOutsideClick: false,
                showLoaderOnConfirm: true
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();
                    form.submit();
                } else {
                    // Pastikan loading dihide ketika dibatalkan
                    hideLoading();
                }
            }).catch((error) => {
                // Tangkap error jika ada dan pastikan loading dihide
                hideLoading();
            });
        }

        // Check for success messages and show SweetAlert
        @if (session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            });
        @endif

        @if (session('error'))
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}'
                });
            });
        @endif

        // Show loading indicator on form submissions (kecuali untuk form delete)
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                if (!form.hasAttribute('data-no-loading') && !form.classList.contains('delete-form')) {
                    form.addEventListener('submit', function() {
                        showLoading();
                    });
                }
            });
        });
    </script>
@endsection
