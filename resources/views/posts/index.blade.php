@extends('layouts.app')

@section('page_title', 'Blog & Agenda')



@section('content')
    <div class="container p-6 bg-white">
        {{-- Header Action (Add Post & Categories) --}}
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <div class="flex gap-4 items-center">
                {{-- Add Post --}}
                <div
                    class=" bg-blue-500 rounded-full w-[150px] h-[50px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                    <div class="px-4 py-4 bg-white rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>
                    <p class="text-[15px] text-white px-4">Add Post</p>
                </div>

                {{-- Categories --}}
                <div
                    class="flex items-center bg-blue-500 rounded-full px-5 h-[50px] gap-3 cursor-pointer hover:bg-blue-600 transition">
                    <p class="text-[15px] text-white">Categories</p>
                    <div class="border-l border-white h-[20px]"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                    </svg>
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

        {{-- Checkbox Pilih Semua --}}
        <div class="mb-6">
            <label class="px-5 mt-4 inline-flex items-center space-x-2">
                <input id="checkAll" type="checkbox"
                    class="w-4 h-4 text-[#3030F8] bg-gray-100 border-gray-300 rounded hover:scale-110 focus:ring-[#3030F8] cursor-pointer">
                <span class="text-sm font-semibold text-gray-700">Pilih semua</span>
            </label>
        </div>

        <!-- Pesan & Tombol Delete Terpilih -->
        <div id="bulk-actions"
            class="overflow-hidden transition-all duration-500 ease-in-out max-h-0 opacity-0 scale-95 mb-6 flex items-center justify-between bg-red-50 p-4 rounded-lg border border-red-200">
            <p class="text-sm font-medium text-red-600">
                <span id="selected-count">0</span> artikel dipilih
            </p>

            <div class="flex items-center gap-3">
                <form id="bulk-delete-form" action="{{ route('posts.bulkDelete') }}" method="POST">
                    @csrf
                    <input type="hidden" id="selected-ids" name="selected_ids">
                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition duration-300">
                        Delete
                    </button>
                </form>
                <button onclick="cancelSelection()"
                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition duration-300">
                    Cancel
                </button>
            </div>
        </div>



        {{-- Tempat konten blog nanti --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
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
                            <a href="#"
                                class="w-[55px] h-[32px] rounded-md bg-[#7C6AED] text-white text-center flex items-center justify-center font-medium text-[14px] hover:scale-110 transition">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <script>
        const selectAllCheckbox = document.getElementById('select-all');
        const individualCheckboxes = document.querySelectorAll('input[name="selected_posts[]"]');
        const bulkActions = document.getElementById('bulk-actions');
        const selectedCount = document.getElementById('selected-count');
        const selectedIdsInput = document.getElementById('selected-ids');

        function updateBulkActions() {
            const checkedBoxes = [...individualCheckboxes].filter(cb => cb.checked);
            const count = checkedBoxes.length;

            if (count > 0) {
                bulkActions.classList.remove('max-h-0', 'opacity-0', 'scale-95');
                bulkActions.classList.add('max-h-40', 'opacity-100', 'scale-100');
            } else {
                bulkActions.classList.add('max-h-0', 'opacity-0', 'scale-95');
                bulkActions.classList.remove('max-h-40', 'opacity-100', 'scale-100');
            }

            selectedCount.textContent = count;
            const selectedIds = checkedBoxes.map(cb => cb.value);
            selectedIdsInput.value = selectedIds.join(',');
        }

        individualCheckboxes.forEach(cb => {
            cb.addEventListener('change', updateBulkActions);
        });

        selectAllCheckbox.addEventListener('change', function() {
            individualCheckboxes.forEach(cb => cb.checked = this.checked);
            updateBulkActions();
        });

        function cancelSelection() {
            individualCheckboxes.forEach(cb => cb.checked = false);
            selectAllCheckbox.checked = false;
            updateBulkActions();
        }
    </script>

    <script>
        const checkAll = document.getElementById('checkAll');
        const checkboxes = document.querySelectorAll('.item-checkbox');

        checkAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateBulkActions(); // Kalau kamu pakai bulk action
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                checkAll.checked = [...checkboxes].every(cb => cb.checked);
                updateBulkActions(); // opsional
            });
        });
    </script>





@endsection
