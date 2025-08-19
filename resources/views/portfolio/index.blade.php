@extends('layouts.app')

@section('page_title', 'Portfolio')

@section('content')
    <div class="bg-white max-w-full mx-auto p-8 rounded-[24px]">
        <!-- Loading Indicator -->
        <div id="loading" class="hidden fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Processing...</span>
            </div>
        </div>

        <!-- Header -->
        <div class="flex justify-between items-center">
            <div
                class="bg-blue-500 rounded-full w-[140px] h-[40px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                <!-- Icon Section -->
                <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </div>

                <!-- Text Section -->
                <a href="{{ route('portfolio.create') }}" id="create-btn"
                    class="text-sm font-normal leading-[130%] text-white px-2 py-4">
                    Add Portfolio
                </a>
            </div>
            <div class="flex gap-2">
                <input type="text" placeholder="Search"
                    class="border rounded-full px-4 py-2 focus:ring focus:ring-indigo-300">
                <button class="bg-blue-500 px-4 py-2 text-white rounded-full hover:bg-blue-600">Search</button>
            </div>
        </div>

        <!-- Filter Style Tab-like -->
        <div class="w-full flex items-baseline mt-8">
            <div class="w-full bg-white px-4 py-1 border-b border-gray-300 rounded-t-xl text-sm font-medium">
                <span class="bg-[#E8E8E8BF] py-[8px] rounded-t-lg px-[12px]">Jatidiri Sekolah</span>
            </div>
        </div>

        <!-- Portfolio List -->
        <div class="grid md:grid-cols-2 gap-6 mt-8">
            @foreach ($data as $portfolio)
                <div class="bg-white rounded-2xl border border-gray-300 shadow p-4 space-y-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-semibold">{{ $portfolio->title }}</h2>
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="edit-btn px-[16px] py-[7px] bg-[#8989FC] text-white rounded-[12px] hover:bg-blue-200">Edit</a>
                            <button onclick="confirmDelete({{ $portfolio->id }})" class="px-4 py-2 bg-red-500 text-white rounded-[12px] hover:bg-red-600">Delete</button>
                            <form id="delete-form-{{ $portfolio->id }}" action="{{ route('portfolio.destroy', $portfolio->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                    <div class="grid grid-cols-4 gap-2">
                        @foreach (['image1', 'image2', 'image3', 'image4'] as $field)
                            @if ($portfolio->$field)
                                <img src="{{ asset('storage/' . $portfolio->$field) }}" class="rounded-lg w-full h-24 object-cover">
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Show loading indicator
        function showLoading() {
            document.getElementById('loading').classList.remove('hidden');
        }

        // Hide loading indicator
        function hideLoading() {
            document.getElementById('loading').classList.add('hidden');
        }

        // Success message after create/edit
        @if(session('success'))
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

        // Error message
        @if(session('error'))
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                });
            });
        @endif

        // Delete confirmation
        function confirmDelete(id) {
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
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        // Add loading indicator to form submissions and links
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading to create/edit links
            document.getElementById('create-btn').addEventListener('click', function(e) {
                showLoading();
            });

            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    showLoading();
                });
            });

            // Add loading to search form
            const searchForm = document.querySelector('form[action="{{ route("portfolio.index") }}"]');
            if (searchForm) {
                searchForm.addEventListener('submit', function() {
                    showLoading();
                });
            }
        });
    </script>
@endsection
