<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Dashboard' }}</title>
    <link href="./css/output.css" rel="stylesheet" />

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>

</head>

<body class="bg-[#D7D7FE]">

    <div class="flex gap-2 ">

        <!-- Icon Bars-3 -->
        <div
            class="p-6 bg-white w-[288px] h-[116px] flex items-center gap-[24px] shadow-2xl rounded-2xl">
            <button onclick="toggleNavbar()" id="menuButton">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                    stroke="currentColor"
                    class="w-10 h-10 text-[#3030F8] hover:scale-125 transition delay-100 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <img src="./img/Jatidiri.png" alt="laptop" class="w-[138px] h-[57px] justify-left">
        </div>

        <div
            class="p-6 bg-white w-[1384px] h[116px] text-[20px] shadow-2xl flex items-center gap-[29px] rounded-2xl relative ">
            Home

            <div
                class="flex items-center bg-white px-4 py-2 w-[213px] h-[68px] rounded-full shadow gap-2 absolute right-3 hover:scale-110 transition">
                <!-- Avatar -->
                <img src="https://i.pravatar.cc/40?img=3" alt="User" class="w-10 h-10 rounded-full" />

                <!-- Teks (vertikal) -->
                <div class="flex flex-col justify-center ">
                    <span class="font-semibold text-[16px] leading-tight text-right">Aelxander</span>
                    <span class="text-[16px] text-gray-500 leading-tight text-left">Admin</span>
                </div>
            </div>
        </div>
    </div>


        
        
        <div class="flex  flex-col p-2  justify-between gap-4 relative h-full ">
            <nav class="bg-white px-5 py-5 absolute left-1 w-63 h-full rounded-xl">
                <ul>
                    <li class="mt-5 bg-white rounded-2xl shadow-md hover:bg-[#3030F8] px-5 py-3 "><a href="#" class="mt-5">HOME</a>
                    <li class="mt-5 bg-white rounded-2xl shadow-md hover:bg-[#3030F8] px-5 py-3 "><a href="#" class="mt-5">BLOG & AGENDA</a>
                    <li class="mt-5 bg-white rounded-2xl shadow-md hover:bg-[#3030F8] px-5 py-3 "><a href="#" class="mt-5">SERVICES</a>
                    <li class="mt-5 bg-white rounded-2xl shadow-md hover:bg-[#3030F8] px-5 py-3 "><a href="#" class="mt-5">PROFILE</a>
                    <li class="mt-5 bg-white rounded-2xl shadow-md hover:bg-[#3030F8] px-5 py-3 "><a href="#" class="mt-5">SETTING</a>
                </ul>
            </nav>
            <img src="{{ asset('img/Jatidiri.png') }}" alt="Logo"
                class="mt-[64px] mx-auto items-center w-[458px] h-[189px] hover:scale-125 transition ">


            <p class="p-6 mx-auto max-w-[500px] text-center text-[16px] font-normal leading[130%] bg-amber-400">Jatidiri.app adalah
                platform revolusioner yang menggabungkan teknologi mutakhir dengan layanan psikologi profesional untuk
                membantu individu, keluarga, institusi pendidikan, dan perusahaan memahami potensi diri, meningkatkan
                kualitas hidup, dan membangun sumber daya manusia yang berdaya saing.</p>
        </div>
</body>

</html>
