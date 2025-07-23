@extends('layouts.app')

@section('content')
<<<<<<< HEAD
    <h2 class="text-3xl font-semibold mb-6">Selamat Datang!</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-4 rounded shadow">Card 1</div>
        <div class="bg-white p-4 rounded shadow">Card 2</div>
        <div class="bg-white p-4 rounded shadow">Card 3</div>
=======
    <div class="grid grid-cols-1 gap-10 mx-auto p-6 w-full max-w-[1440px]">

        {{-- Card Deskripsi Jatidiri --}}
        <div class="mx-auto w-full bg-white rounded-xl px-6 py-8 shadow-sm">
            <img src="{{ asset('img/Jatidiri.png') }}" alt="Logo" class="mx-auto w-[458px] h-[189px]">
            <p class="mt-6 text-center text-base leading-relaxed w-[500px] text-[16px] mx-auto text-gray-600">
                Jatidiri.app adalah platform revolusioner yang menggabungkan teknologi mutakhir dengan layanan psikologi
                profesional untuk membantu individu, keluarga, institusi pendidikan, dan perusahaan memahami potensi diri,
                meningkatkan kualitas hidup, dan membangun sumber daya manusia yang berdaya saing.
            </p>
        </div>

        {{-- Kartu Statistik & Diagram --}}
        <div class="flex flex-col lg:flex-row gap-6 w-full">
            {{-- Kolom Statistik Kiri --}}
            <div class="w-full lg:w-[40%] flex flex-col gap-4">
                {{-- Kartu 1: Jumlah Pengunjung --}}
                <div class="bg-white rounded-xl p-6 flex flex-col items-center justify-center text-center shadow-sm">
                    <div class="bg-[#C9C4F9] w-12 h-12 flex items-center justify-center rounded-full mb-2">
                        <svg class=" w-6 h-6 text-[#7367F0]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="size-6">
                            <path fill-rule="evenodd"
                                d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                                clip-rule="evenodd" />
                            <path
                                d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                        </svg>

                    </div>
                    <h3 class="text-3xl font-extrabold text-black">1,224,332</h3>
                    <p class="mt-1 text-black font-normal font-[Urbanist] tracking-wide">Jumlah Pengunjung</p>
                </div>

                {{-- Kartu 2: Jumlah Artikel --}}
                <div class="bg-white rounded-xl p-6 flex flex-col items-center justify-center text-center shadow-sm">
                    <div class="bg-[#9DEBC0] w-12 h-12 flex items-center justify-center rounded-full mb-2">
                        <svg class="w-6 h-6 text-[#28C76F]" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>

                    </div>
                    <h3 class="text-2xl font-extrabold text-black">23</h3>
                    <p class="mt-1 black font-normal font-[Urbanist] tracking-wide">Jumlah Artikel</p>
                </div>

                {{-- Kartu 3: Tahun Akademik --}}
                <div class="bg-white rounded-xl p-6 flex flex-col items-center justify-center text-center shadow-sm">
                    <div class="bg-[#CCE8FD] w-12 h-12 flex items-center justify-center rounded-full mb-2">
                        <svg class="w-6 h-6 text-[#38A4F8]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>

                    </div>
                    <h3 class="text-xl font-extrabold text-black">2025–2026</h3>
                    <p class="mt-1 text-black font-normal font-[Urbanist] tracking-wide">Tahun Akademik</p>
                </div>
            </div>

            {{-- Kolom Diagram Kanan --}}
            <div class="w-full lg:w-[60%] bg-white rounded-xl px-6 py-8 shadow-xl">
                <h3 class="text-center text-[20px] font-normal font-[Outfit]  text-black mb-4">Grafik Pengunjung</h3>
                <div
                    class="w-full h-[410px] bg-gradient-to-t from-green-200 via-red-200 to-transparent rounded-lg flex items-end justify-around p-4">
                    {{-- Simulasi batang diagram --}}
                    @php
                        $data = [
                            ['bulan' => 'Januari', 'tinggi' => '40%'],
                            ['bulan' => 'Februari', 'tinggi' => '50%'],
                            ['bulan' => 'Maret', 'tinggi' => '65%'],
                            ['bulan' => 'April', 'tinggi' => '55%'],
                            ['bulan' => 'Mei', 'tinggi' => '75%'],
                            ['bulan' => 'Juni', 'tinggi' => '85%'],
                        ];
                    @endphp

                    @foreach ($data as $item)
                        <div class="flex flex-col items-center">
                            <div class="w-8 bg-gradient-to-t  from-red-300 to-green-400 rounded-md"
                                style="height: {{ $item['tinggi'] }}"></div>
                            <span class="mt-2 text-sm text-gray-700">{{ $item['bulan'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
>>>>>>> 0e1c82028b5296f1ffc528542e1144d0db22dd91
    </div>
@endsection
