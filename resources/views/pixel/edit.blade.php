@extends('layouts.app')

@section('page_title', 'Kode Facebook Pixel')

@section('content')
    <div class="bg-white max-w-full rounded-[24px] mx-auto p-[32px]">
        <h2 class="text-xl font-semibold mb-6">Edit</h2>

        @if (session('success'))
            <div class="mb-4 text-green-600 hidden" id="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('pixel.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            <textarea name="pixelcode" rows="10"
                class="w-full h-[150px] border border-gray-300 rounded-md p-4 focus:ring focus:ring-indigo-300 resize-y"
                placeholder="Masukkan Pixel Code">{{ old('pixelcode', $data->pixel_code) }}</textarea>

            <button type="submit"
                class="mt-6 bg-[#8989FC] hover:bg-[#8B5CF6] text-black px-6 py-2 rounded-full transition">
                Update
            </button>
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
