@extends('layouts.app')

@section('page_title', 'Alasan services')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white rounded-[24px] shadow-md p-6">
            <!-- Filter and Search Section -->
            <div class="flex gap-4 items-center mb-3 relative">
                <!-- Services Filter -->
                <div class="w-[180px]">
                    <div class="relative">
                        <select name="alasan" id="alasan" required
                            class="appearance-none w-full px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-1 focus:ring-blue-100 focus:border-blue-500 pr-10 transition-all">
                            <option value="" disabled selected class="text-gray-400">-- Select Service --</option>
                            @foreach ($data as $service)
                                @if ($service->type === 'Select Service' || $service->category === 'Select Service')
                                    <option value="{{ $service->id }}" class="py-2">{{ $service->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Search Form -->
                <div class="flex items-center gap-2">
                    <form action="#" class="relative">
                        <input type="text" name="search" id="search" placeholder="Search"
                            class="font-normal px-6 border border-gray-300 rounded-full pl-10 pr-4 h-[40px] w-[221px] text-sm focus:outline-[#3030F8] placeholder-gray-400" />
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none px-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0a7.5 7.5 0 1 0-10.607-10.607 7.5 7.5 0 0 0 10.607 10.607z" />
                            </svg>
                        </div>
                    </form>
                    <button
                        class="bg-[#8989FC] text-white px-5 h-[40px] rounded-full text-sm hover:bg-[#6f6ffc] transition">
                        Search
                    </button>
                </div>

                <!-- Add New Button -->
                <div
                    class="bg-blue-500 rounded-full w-[130px] h-[40px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition absolute right-2">
                    <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>
                    <a href="{{ route('alasan.create') }}" id="addNewButton"
                        class="text-sm font-normal leading-[130%] text-white px-3 py-[11px]">
                        Add New
                    </a>
                </div>
            </div>

            <!-- Data Table -->
            <div class="overflow-x-auto mt-1">
                <table class="table-auto border border-gray-300 w-full text-sm">
                    <thead>
                        <tr class="h-[36px] bg-gray-100 text-left">
                            <th class="w-[42px] px-2 py-2 border border-gray-300">No</th>
                            <th class="w-[251px] px-2 py-2 border border-gray-300">Service</th>
                            <th class="w-[251px] px-2 py-2 border border-gray-300">Title</th>
                            <th class="w-[200px] px-2 py-2 border border-gray-300">Image</th>
                            <th class="w-[201px] px-2 py-2 border border-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr class="h-[36px]">
                                <td class="px-2 py-2 border border-gray-300">{{ $loop->iteration }}</td>
                                <td class="px-2 py-2 border border-gray-300">{{ $item->service->name }}</td>
                                <td class="px-2 py-2 border border-gray-300">{{ $item->title }}</td>
                                <td class="px-2 py-2 border border-gray-300">
                                    @if ($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                            class="h-10 object-cover">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td class="px-2 py-2 flex border border-gray-300">
                                    <a href="{{ route('alasan.edit', $item->id) }}" id="editButton{{ $item->id }}"
                                        class="bg-blue-500 flex items-center gap-2 justify-between text-white px-3 py-1 rounded text-xs mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('alasan.destroy', $item->id) }}" method="POST"
                                        class="inline delete-form" id="deleteForm{{ $item->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $item->id }})"
                                            class="bg-red-500 flex items-center gap-2 justify-between text-white px-3 py-1 rounded text-xs">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Loading indicator for Add New button
        document.getElementById('addNewButton').addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');

            Swal.fire({
                title: 'Loading',
                html: 'Preparing the form...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                    setTimeout(() => {
                        window.location.href = href;
                    }, 500);
                }
            });
        });

        // Loading indicator for Edit buttons
        document.querySelectorAll('[id^="editButton"]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.getAttribute('href');

                Swal.fire({
                    title: 'Loading',
                    html: 'Preparing the edit form...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                        setTimeout(() => {
                            window.location.href = href;
                        }, 500);
                    }
                });
            });
        });

        // Delete confirmation with SweetAlert
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
                    // Show loading indicator
                    Swal.fire({
                        title: 'Deleting',
                        html: 'Please wait...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                            // Submit the form
                            document.getElementById('deleteForm' + id).submit();
                        }
                    });
                }
            });
        }

        // Check for success message from server
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        // Check for error message from server
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}'
            });
        @endif
    </script>
@endsection
