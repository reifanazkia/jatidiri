@extends('layouts.app')

@section('page_title', 'services')

@section('content')
    <div class="container p-8 bg-white rounded-[24px]">
        {{-- Header Action --}}
        <div class="flex flex-wrap items-center justify-between gap-8 mb-6">
            <div class="flex gap-4 items-center">
                <div
                    class="bg-blue-500 border-1 border-white rounded-full w-[130px] h-[40px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition">
                    <div class="w-[40px] h-[40px] px-2 bg-white rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>
                    <a href="{{ route('service.create') }}"
                        class="text-sm font-normal leading-[130%] text-white px-3 py-[11px]">
                        Add New
                    </a>
                </div>
            </div>

            {{-- Search --}}
            <div class="flex items-center gap-3">
                <form action="{{ route('service.index') }}" method="GET" class="relative gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search"
                        class="font-normal px-6 border border-gray-300 rounded-full pl-10 pr-4 h-[40px] w-[240px] text-sm focus:outline-[#3030F8] placeholder-gray-400" />
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 px-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0a7.5 7.5 0 1 0-10.607-10.607 7.5 7.5 0 0 0 10.607 10.607z" />
                        </svg>
                    </div>
                </form>
                <button type="submit"
                    class="bg-[#8989FC] text-white px-5 h-[40px] rounded-full text-sm hover:bg-[#6f6ffc] transition">
                    Search
                </button>
            </div>
        </div>

        <div class="overflow-x-auto rounded-[24px]">
            <table class="table-auto border border-gray-300 w-full text-sm">
                <thead>
                    <tr class="h-[36px] bg-gray-100 text-left">
                        <th class="w-[42px] px-2 py-2 border border-gray-300">No</th>
                        <th class="w-[251px] px-2 py-2 border border-gray-300">Nama</th>
                        <th class="w-[818px] px-2 py-2 border border-gray-300">Title</th>
                        <th class="w-[201px] px-2 py-2 border border-gray-300">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr class="h-[36px]">
                            <td class="px-2 py-2 border border-gray-300">{{ $loop->iteration }}</td>
                            <td class="px-2 py-2 border border-gray-300">{{ $service->name }}</td>
                            <td class="px-2 py-2 border border-gray-300">{{ $service->title1 }}</td>
                            <td class="px-2 py-2 border border-gray-300 flex">
                                <a href="{{ route('service.edit', $service->id) }}"
                                    class="bg-blue-500 flex items-center gap-2 justify-between text-white px-3 py-1 rounded text-xs mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>Edit</a>

                                {{-- Button Delete dengan class .btn-delete --}}
                                <form action="{{ route('service.destroy', $service->id) }}" method="POST"
                                    class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="bg-red-500 flex gap-2 items-center text-white px-3 py-1 rounded text-xs btn-delete">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="-3 -2 24 24">
                                            <path fill="currentColor"
                                                d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2a3 3 0 0 1-2.993 2.8H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm10 2H2v1h14zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7zM7 8a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1" />
                                        </svg>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $services->links() }}
            </div>
        </div>
    </div>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Notifikasi sukses
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    timer: 1500,
                    showConfirmButton: false
                });
            @endif

            // Konfirmasi delete
            document.querySelectorAll('.btn-delete').forEach((button) => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');

                    Swal.fire({
                        title: 'Apakah Anda Yakin?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
