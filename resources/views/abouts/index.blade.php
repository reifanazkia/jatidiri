@extends('layouts.app')

@section('page_title', 'About Us')

@section('content')
    <div class="bg-white max-w-full rounded-[24px] mx-auto p-[32px]">
        <h2 class="text-[32px] font-semibold mb-6">Tentang JATIDIRI.APP</h2>

        @foreach ($abouts as $about)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                {{-- Kiri --}}
                <div class="bg-white rounded-xl p-6 space-y-4">

                    @if ($about->title)
                        <h3 class="text-[32px] font-medium text-left leading-snug">
                            {{ $about->title }}
                        </h3>
                    @endif

                    @if ($about->image1)
                        <img src="{{ asset('storage/' . $about->image1) }}" alt="Image 1"
                            class="w-full rounded-lg object-cover">
                    @endif

                    @if ($about->description)
                        <p class="text-sm text-gray-700">
                            {!! nl2br(e($about->description)) !!}
                        </p>
                    @endif

                    @if ($about->content)
                        <p class="text-sm text-gray-700">
                            {!! nl2br(e($about->content)) !!}
                        </p>
                    @endif
                </div>

                {{-- Kanan --}}
                <div class="bg-white rounded-xl p-6 space-y-4">
                    <h3 class="text-[18px] font-semibold text-gray-800">
                        {{ $about->subtitle }}
                    </h3>

                    @if ($about->image2)
                        <img src="{{ asset('storage/' . $about->image2) }}" alt="Image 2"
                            class="w-full rounded-lg object-cover">
                    @endif

                    @if ($about->description)
                        <p class="text-sm text-gray-700">
                            {!! nl2br(e($about->description)) !!}
                        </p>
                    @endif

                    {{-- Video --}}
                    @if ($about->video)
                        <div class="relative w-full aspect-video bg-black rounded-lg overflow-hidden">
                            <video controls class="w-full h-full object-cover">
                                <source src="{{ asset('storage/' . $about->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        {{-- Tombol Edit --}}
        <div class="mt-6">
            @foreach ($abouts as $about)
                <div
                    class=" bg-blue-500 rounded-full w-[90px] h-[40px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition edit-btn"
                    data-url="{{ route('about.edit', $about->id) }}">
                    <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>
                    <span class="text-sm font-normal leading-[130%] text-white px-2 py-4">Edit</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Card Visi --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <img src="{{ asset('images/visi.jpg') }}" alt="Visi" class="w-full h-64 object-cover">
            <div class="p-6">
                <h3 class="text-lg font-bold mb-1">VISI JATIDIRI</h3>
                <p class="text-sm text-gray-500 mb-2">2024–2029</p>
                <p class="text-sm text-gray-700 mb-4">
                    Mewujudkan masyarakat Indonesia yang berdaya melalui pemahaman diri yang mendalam.
                </p>
                <div class="mt-6">
                    @foreach ($visis as $visi)
                        <a href="{{ route('visi.edit', $visi->id) }}"
                            class="bg-blue-500 rounded-full w-[90px] h-[40px] flex items-center justify-between hover:bg-blue-600 transition edit-btn"
                            data-url="{{ route('visi.edit', $visi->id) }}">
                            <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </div>
                            <span class="text-sm font-normal leading-[130%] text-white px-2 py-4">Edit</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Card Misi --}}
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <img src="{{ asset('images/misi.jpg') }}" alt="Misi" class="w-full h-64 object-cover">
            <div class="p-6">
                <h3 class="text-lg font-bold mb-1">MISI JATIDIRI</h3>
                <p class="text-sm text-gray-500 mb-2">2024–2029</p>
                <ul class="text-sm text-gray-700 list-disc list-inside mb-4">
                    <li>Mengembangkan platform yang memadukan teknologi terkini dengan pendekatan psikologi...</li>
                </ul>
                <div class="mt-6">
                    @foreach ($abouts as $about)
                        <div
                            class=" bg-blue-500 rounded-full w-[90px] h-[40px] flex items-center justify-between cursor-pointer hover:bg-blue-600 transition edit-btn"
                            data-url="{{ route('misi.edit', $about->id) }}">
                            <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </div>
                            <span class="text-sm font-normal leading-[130%] text-white px-2 py-4">Edit</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // SweetAlert sukses setelah edit
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif

            // Loading saat klik edit
            document.querySelectorAll('.edit-btn').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Memuat...',
                        text: 'Harap tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                    window.location.href = this.getAttribute('data-url');
                });
            });
        });
    </script>

@endsection



