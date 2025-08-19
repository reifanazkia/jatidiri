@extends('layouts.app')

@section('page_title', 'Statistik')

@section('content')
    <div class="bg-white w-full rounded-[24px] mx-auto p-[32px]">
        <!-- Top bar -->
        <div class="flex justify-between items-center mb-4">
            <!-- Tombol tambah -->
            <div
                class="bg-blue-500 rounded-full w-[140px] h-[40px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <a href="{{ route('statistik.create') }}" id="addButton"
                    class="text-sm font-normal leading-[130%] text-white px-2 py-4">Add Statistik</a>
            </div>

            <!-- Search -->
            <form action="{{ route('statistik.index') }}" method="GET" class="flex items-center" id="searchForm">
                <input type="text" name="search" placeholder="Search"
                    class="border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" id="searchButton"
                    class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-full text-sm hover:bg-blue-600 transition">
                    <span id="searchButtonText">Search</span>
                    <span id="searchButtonLoader" class="hidden">
                        <svg class="animate-spin -ml-1 mr-1 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </span>
                </button>
            </form>
        </div>

        <!-- Loading overlay -->
        <div id="loadingOverlay" class="fixed inset-0 bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center">
                <svg class="animate-spin h-10 w-10 text-blue-500 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                    </circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <p class="text-gray-700">Memproses data...</p>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-md text-sm">
                <thead class="bg-gray-200 text-left text-gray-700">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Pengguna</th>
                        <th class="px-4 py-3">Psikologi</th>
                        <th class="px-4 py-3">Assesmen</th>
                        <th class="px-4 py-3">Konselor</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $item->pengguna }}</td>
                            <td class="px-4 py-3">{{ $item->psikologi }}</td>
                            <td class="px-4 py-3">{{ $item->assesmen }}</td>
                            <td class="px-4 py-3">{{ $item->konsoler }}</td>
                            <td class="px-4 py-3 flex space-x-2">
                                <a href="{{ route('statistik.edit', $item->id) }}"
                                    class="edit-button flex items-center gap-2 bg-blue-500 text-white px-3 py-1 rounded text-xs mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('statistik.destroy', $item->id) }}" method="POST"
                                    class="inline-block delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="-3 -2 24 24">
                                            <path fill="currentColor"
                                                d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2a3 3 0 0 1-2.993 2.8H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm10 2H2v1h14zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7zM7 8a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($data->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-4">Belum ada data statistik.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show loading on form submission
            document.getElementById('searchForm').addEventListener('submit', function() {
                document.getElementById('searchButtonText').classList.add('hidden');
                document.getElementById('searchButtonLoader').classList.remove('hidden');
            });

            // Show loading on add button click
            document.getElementById('addButton').addEventListener('click', function(e) {
                e.preventDefault();
                showLoading();
                window.location.href = this.href;
            });

            // Show loading on edit button click
            document.querySelectorAll('.edit-button').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    showLoading();
                    window.location.href = this.href;
                });
            });

            // Handle delete forms with confirmation
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            showLoading();
                            this.submit();
                        }
                    });
                });
            });

            // Show success messages from session
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            function showLoading() {
                document.getElementById('loadingOverlay').classList.remove('hidden');
            }

            function hideLoading() {
                document.getElementById('loadingOverlay').classList.add('hidden');
            }

            // Hide loading when page fully loaded
            window.addEventListener('load', hideLoading);
        });
    </script>
@endsection
