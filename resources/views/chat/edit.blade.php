@extends('layouts.app')

@section('page_title', 'Edit Chat Greeting')

@section('content')
    <div class="bg-white rounded-[24px] p-6 max-w-full mx-auto shadow">
        <h2 class="text-lg font-semibold mb-4">Edit</h2>

        @if (session('success'))
            <div class="mb-4 text-green-600 hidden" id="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('chat.update', $data->id) }}" method="POST" id="edit-greeting-form">
            @csrf
            @method('PUT')

            <textarea name="greating" rows="10"
                class="w-full h-[150px] border border-gray-300 rounded-md px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 resize-y"
                placeholder="Masukkan teks greeting">{{ old('greating', $data->greating) }}</textarea>

            <div class="mt-4">
                <button type="submit"
                    class="bg-[#8989FC] text-black px-6 py-2 rounded-full hover:bg-indigo-600 transition">
                    Update
                </button>
            </div>
        </form>
    </div>

    <!-- Add SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#8989FC',
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        @endif
    </script>
@endsection
