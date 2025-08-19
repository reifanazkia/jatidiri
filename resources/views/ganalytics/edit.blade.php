@extends('layouts.app')

@section('page_title', 'Kode Google Ganalytics')

@section('content')
    <div class="bg-white rounded-[24px] p-6 max-w-full mx-auto shadow">
        <h2 class="text-lg font-semibold mb-4">Edit</h2>

        @if (session('success'))
            <div class="mb-4 text-green-600 hidden" id="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('ganalytics.update', $data->id) }}" method="POST" id="edit-form">
            @csrf
            @method('PUT')

            <textarea name="ganalytics_code" rows="10"
                class="w-full h-[150px] border border-gray-300 rounded-md px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 resize-y"
                placeholder="Masukkan kode Google Analytics">{{ old('ganalytics_code', $data->ganalytics_code) }}</textarea>

            <div class="mt-4">
                <button type="submit"
                    class="bg-[#8989FC] text-black px-6 py-2 rounded-full hover:bg-indigo-600 transition">
                    Update
                </button>
            </div>
        </form>
    </div>

    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: document.getElementById('success-message').textContent,
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#8989FC',
                });
            });
        </script>
    @endif
@endsection
