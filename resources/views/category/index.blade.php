@extends('layouts.app')

@section('page_title', 'blog')

@section('content')
    <div class="container p-8 w-full bg-white rounded-[24px]">
        <div class="flex flex-wrap items-center justify-between gap-8 mb-6">
            <div class="flex gap-4 items-center">
                <div
                    class=" bg-blue-500 rounded-full  w-[150px] h-[40px]  flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                    {{-- Icon Section --}}
                    <div
                        class="w-[40px] h-[40px] bg-white rounded-full border border-white flex items-center justify-center ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </div>

                    {{-- Text Section --}}
                    <a href="{{ route('category.create') }}" id="addCategoryBtn"
                        class="text-sm font-normal leading-[130%] text-white px-3 py-[11px]">
                        Add category
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

        <div class="grid grid-cols-3 gap-8">
            @foreach ($categories as $post)
                <div class="relative rounded-[12px] w-full h-full overflow-hidden bg-[#D1D5DB8C] group">
                    <!-- Gambar -->
                    <img src="{{ asset('storage/' . $post->image) }}" alt="" class="w-full h-[200px] object-cover">

                    <!-- Konten -->
                    <div class="px-4 py-4">
                        <!-- Judul -->
                        <p class="font-semibold text-[20px] leading-[130%] line-clamp-2">
                            {{ $post->title }}
                        </p>

                        <!-- Info Tanggal & Kategori -->
                        <div class=" mt-3">
                            <div class="px-3 w-[61px] h-[21px] rounded-md bg-[#9689FF4D] flex items-center justify-center">
                                <p class="text-sm font-normal text-[#603EFF]">Artikel</p>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex gap-2 mt-4 mb-4">
                            <!-- Edit -->
                            <a href="{{ route('category.edit', $post->id) }}"
                                class="edit-btn w-[55px] h-[32px] rounded-md bg-[#7C6AED] text-white text-center flex items-center justify-center font-medium text-[14px] hover:scale-110 transition"
                                data-id="{{ $post->id }}">
                                Edit
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('category.destroy', $post->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="delete-btn w-[55px] h-[32px] rounded-md bg-red-500 text-white text-center flex items-center justify-center font-medium text-[14px] hover:scale-110 transition"
                                    data-id="{{ $post->id }}">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // SweetAlert for Add Category button
        document.getElementById('addCategoryBtn').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Add New Category',
                html: `Redirecting to category creation page...`,
                icon: 'info',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    setTimeout(() => {
                        window.location.href = "{{ route('category.create') }}";
                    }, 1500);
                }
            });
        });

        // SweetAlert for Edit buttons
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const categoryId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Edit Category',
                    html: `Redirecting to edit page for category ID: ${categoryId}...`,
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        setTimeout(() => {
                            window.location.href =
                                `{{ url('category') }}/${categoryId}/edit`;
                        }, 1500);
                    }
                });
            });
        });

        // SweetAlert for Delete buttons
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const categoryId = this.getAttribute('data-id');
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
                        // Show loading indicator
                        Swal.fire({
                            title: 'Deleting...',
                            html: 'Please wait while we delete the category.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                                // Submit the form after showing the loading indicator
                                form.submit();
                            }
                        });
                    }
                });
            });
        });

        // Show success/error messages from session
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#6F4FF2'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonColor: '#6F4FF2'
            });
        @endif
    </script>
@endsection
