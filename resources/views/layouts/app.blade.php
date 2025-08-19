<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ $title ?? 'Dashboard' }}</title>
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>


    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        /* FOR BULLETED LISTS (UNORDERED LISTS) */
        .ck-content ul {
            list-style-type: disc !important;
            /* Force bullets to show */
            padding-left: 25px !important;
            /* Proper indentation */
            margin-left: 0 !important;
            /* Reset any margin overrides */
        }

        /* FOR NUMBERED LISTS (ORDERED LISTS) - Reinforcement */
        .ck-content ol {
            list-style-type: decimal !important;
            padding-left: 25px !important;
        }

        /* Fix for nested lists */
        .ck-content ul ul,
        .ck-content ol ul {
            list-style-type: circle !important;
            /* Different bullet for nested */
        }

        /* Blockquote override (if needed) */
        .ck-content blockquote ul,
        .ck-content blockquote ol {
            list-style-type: inherit !important;
            /* Respect parent list styles */
        }
    </style>
</head>

<body class="bg-[#D7D7FE] flex flex-col min-h-screen">

    <div
        class=" bg-white w-full h-[58px] md:p-6 md:w-full md:h-[116px] flex items-center justify-between gap-6 relative">
        <!-- Kiri: Tombol Menu, Logo, dan Home -->
        <div class="flex items-center gap-3 md:gap-8 ">
            <!-- Tombol Menu -->
            <button onclick="toggleNavbar()" id="menuButton" class="z-30">
                <svg id="iconBars"
                    class=" w-4 h-4 md:w-8 md:h-8 text-blue-600 hover:scale-125 transition cursor-pointer"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <!-- Logo -->
            <img src="{{ asset('img/Jatidiri.png') }}" alt="Logo"
                class="w-[69px] h-[28px] md:w-[138px] md:h-[57px]" />

            <!-- Garis Vertikal -->
            <div class="w-px h-[68px] md:h-[68px] border border-gray-300"></div>

            <!-- Home Text -->
            <span class="text-[20px] font-semibold text-gray-800">@yield('page_title', 'Home')
            </span>
        </div>

        <!-- Kanan: Avatar, Info, dan Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <!-- Trigger -->
            <button @click="open = !open"
                class="flex items-center gap-3 bg-white px-4 py-3 rounded-full shadow-md hover:scale-105 transition duration-300">
                <!-- Avatar -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                        clip-rule="evenodd" />
                </svg>


                <!-- Info -->
                <div class="flex flex-col items-start">
                    <span
                        class="font-semibold text-[16px] leading-tight">{{ Auth::user()->name ?? 'Ael Xander' }}</span>
                    <span
                        class="text-[14px] text-gray-500 leading-tight capitalize">{{ Auth::user()->role ?? 'Admin' }}</span>
                </div>

                <!-- Chevron -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Dropdown -->
            <div x-show="open" @click.away="open = false" x-transition
                class="absolute right-0 z-50 mt-2 w-56 bg-white rounded-xl shadow-lg py-4 px-4 space-y-3" x-cloak>

                <hr>

                <!-- Profile -->
                <a href="{{ route('user.edit', auth()->user()->id) }}"
                    class="flex items-center gap-3 px-2 py-1 text-gray-800 hover:text-blue-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a5 5 0 100 10 5 5 0 000-10zM2 18a8 8 0 1116 0H2z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm">My Profile</span>
                </a>

                <hr>

                <!-- Logout -->
                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" id="btn-logout"
                        class="flex items-center gap-3 px-2 py-1 text-gray-800 hover:text-red-500 transition w-full">
                        <!-- Icon dan teks tetap sama -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M15.75 9V6a3.75 3.75 0 00-3.75-3.75h-3A3.75 3.75 0 005.25 6v12A3.75 3.75 0 009 21.75h3a3.75 3.75 0 003.75-3.75v-3h-1.5v3A2.25 2.25 0 0112 20.25H9a2.25 2.25 0 01-2.25-2.25V6A2.25 2.25 0 019 3.75h3A2.25 2.25 0 0114.25 6v3h1.5zM18.28 8.72a.75.75 0 10-1.06-1.06l-3.75 3.75a.75.75 0 000 1.06l3.75 3.75a.75.75 0 101.06-1.06L16.31 12l1.97-1.97z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>


    <!-- Sidebar -->
    <div class=" flex w-full h-full ">
        <nav id="sidebar"
            class="scroll p-5 gap-6 rounded-b-[24px] transition-all duration-500 ease-in-out transform -translate-x-full opacity-0 hidden w-[258px] min-h-full mb-5 bg-white outline outline-1 outline-gray-200 shadow-lg">
            <ul class="mb-60 space-y-2">
                <!-- Home Item -->
                <li>
                    <button onclick="window.location.href='{{ route('dashboard') }}'"
                        class="group flex items-center gap-3 px-5 py-3 rounded-2xl font-semibold hover:scale-105 transition duration-200 w-full text-left outline outline-1 outline-gray-200 hover:outline-blue-500
                {{ request()->is('dashboard') ? 'bg-[#3030F8] text-white outline-none shadow-md' : 'bg-white text-black hover:bg-[#3030F8] hover:text-white' }}">

                        <span
                            class="flex items-center gap-2 text-[15px] leading-none transition
                    {{ request()->is('dashboard') ? 'text-white' : 'text-black group-hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 transition
                        {{ request()->is('dashboard') ? 'text-white' : 'text-black group-hover:text-white' }}">
                                <path
                                    d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                                <path
                                    d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                            </svg>
                            Home
                        </span>
                    </button>
                </li>

                <!-- Dropdown Blog & Agenda -->
                <li>
                    <!-- Toggle Button -->
                    <button type="button" onclick="document.getElementById('blogDropdown').classList.toggle('hidden')"
                        class="group flex items-center justify-between gap-3 px-5 py-3 rounded-2xl font-semibold hover:scale-105 transition duration-200 w-full outline outline-1 outline-gray-200 hover:outline-blue-500
                {{ request()->routeIs('posts.*') || request()->routeIs('agenda.*') ? 'bg-[#3030F8] text-white outline-none shadow-md' : 'bg-white text-black hover:bg-[#3030F8] hover:text-white' }}">
                        <span
                            class="flex items-center gap-2 text-[15px] leading-none transition
                    {{ request()->routeIs('posts.*') || request()->routeIs('agenda.*') ? 'text-white' : 'text-black group-hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 transition
                        {{ request()->routeIs('posts.*') || request()->routeIs('agenda.*') ? 'text-white' : 'text-black group-hover:text-white' }}">
                                <path fill-rule="evenodd"
                                    d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z"
                                    clip-rule="evenodd" />
                                <path fill-rule="evenodd"
                                    d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375ZM6 12a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V12Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 15a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V15Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V18Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Blog & Agenda
                        </span>
                        <!-- Chevron -->
                        <svg class="w-4 h-4 transform transition-transform
                    {{ request()->routeIs('posts.*') || request()->routeIs('agenda.*') ? 'text-white rotate-180' : 'text-black group-hover:text-white' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- Submenu -->
                    <div id="blogDropdown" class="hidden ml-4 mt-2 space-y-2">
                        <!-- Submenu: Posts -->
                        <button onclick="window.location.href='{{ route('posts.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('posts.*') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Posts
                        </button>

                        <!-- Submenu: Agenda -->
                        <button onclick="window.location.href='{{ route('agenda.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('agenda.*') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Agenda
                        </button>
                    </div>
                </li>

                @php
                    $isActiveServiceDropdown = request()->routeIs('service.*') || request()->routeIs('why.*');
                @endphp

                <li>
                    <!-- Toggle Button -->
                    <button type="button"
                        onclick="document.getElementById('serviceDropdown').classList.toggle('hidden')"
                        class="group flex items-center justify-between gap-3 px-5 py-3 rounded-2xl font-semibold hover:scale-105 transition duration-200 w-full outline outline-1 outline-gray-200 hover:outline-blue-500
                {{ $isActiveServiceDropdown ? 'bg-[#3030F8] text-white outline-none shadow-md' : 'bg-white text-black hover:bg-[#3030F8] hover:text-white' }}">
                        <span
                            class="flex items-center gap-2 text-[15px] leading-none transition
                    {{ $isActiveServiceDropdown ? 'text-white' : 'text-black group-hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 transition
                        {{ $isActiveServiceDropdown ? 'text-white' : 'text-black group-hover:text-white' }}">
                                <path fill-rule="evenodd"
                                    d="M12 6.75a5.25 5.25 0 0 1 6.775-5.025.75.75 0 0 1 .313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 0 1 1.248.313 5.25 5.25 0 0 1-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 1 1 2.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309A5.342 5.342 0 0 1 12 6.75ZM4.117 19.125a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="m10.076 8.64-2.201-2.2V4.874a.75.75 0 0 0-.364-.643l-3.75-2.25a.75.75 0 0 0-.916.113l-.75.75a.75.75 0 0 0-.113.916l2.25 3.75a.75.75 0 0 0 .643.364h1.564l2.062 2.062 1.575-1.297Z" />
                                <path fill-rule="evenodd"
                                    d="m12.556 17.329 4.183 4.182a3.375 3.375 0 0 0 4.773-4.773l-3.306-3.305a6.803 6.803 0 0 1-1.53.043c-.394-.034-.682-.006-.867.042a.589.589 0 0 0-.167.063l-3.086 3.748Zm3.414-1.36a.75.75 0 0 1 1.06 0l1.875 1.876a.75.75 0 1 1-1.06 1.06L15.97 17.03a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Services
                        </span>
                        <!-- Chevron -->
                        <svg class="w-4 h-4 transform transition-transform
                    {{ $isActiveServiceDropdown ? 'text-white rotate-180' : 'text-black group-hover:text-white' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- Submenu -->
                    <div id="serviceDropdown"
                        class="{{ $isActiveServiceDropdown ? '' : 'hidden' }} ml-4 mt-2 space-y-2">
                        <!-- Service Link -->
                        <button onclick="window.location.href='{{ route('service.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('service.*') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Service
                        </button>

                        <!-- Why Link -->
                        <button onclick="window.location.href='{{ route('why.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('why.*') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Why
                        </button>

                        <!-- alasan Link -->
                        <button onclick="window.location.href='{{ route('alasan.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('alasan.*') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Alasan
                        </button>

                        <button onclick="window.location.href='{{ route('how.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('how.*') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • How
                        </button>

                        <button onclick="window.location.href='{{ route('bonus.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('bonus.*') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Bonus
                        </button>

                        <button onclick="window.location.href='{{ route('masalah.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('masalah.*') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Masalah
                        </button>

                        <button onclick="window.location.href='{{ route('activity.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('activity.*') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Activity
                        </button>

                        <button onclick="window.location.href='{{ route('manfaat.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('manfaat.*') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Manfaat
                        </button>
                    </div>
                </li>

                <!-- Features Item -->
                <li>
                    <!-- Toggle Button -->
                    <button type="button"
                        onclick="document.getElementById('featuresDropdown').classList.toggle('hidden')"
                        class="group flex items-center justify-between gap-3 px-5 py-3 rounded-2xl font-semibold hover:scale-105 transition duration-200 w-full outline outline-1 outline-gray-200 hover:outline-blue-500
                {{ request()->routeIs('features.*') ? 'bg-[#3030F8] text-white outline-none shadow-md' : 'bg-white text-black hover:bg-[#3030F8] hover:text-white' }}">
                        <span
                            class="flex items-center gap-2 text-[15px] leading-none transition
                    {{ request()->routeIs('features.*') ? 'text-white' : 'text-black group-hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 transition
                        {{ request()->routeIs('features.*') ? 'text-white' : 'text-black group-hover:text-white' }}">
                                <path fill-rule="evenodd"
                                    d="M9 4.5a.75.75 0 0 1 .721.544l.813 2.846a3.75 3.75 0 0 0 2.576 2.576l2.846.813a.75.75 0 0 1 0 1.442l-2.846.813a3.75 3.75 0 0 0-2.576 2.576l-.813 2.846a.75.75 0 0 1-1.442 0l-.813-2.846a3.75 3.75 0 0 0-2.576-2.576l-2.846-.813a.75.75 0 0 1 0-1.442l2.846-.813A3.75 3.75 0 0 0 7.466 7.89l.813-2.846A.75.75 0 0 1 9 4.5ZM18 1.5a.75.75 0 0 1 .728.568l.258 1.036c.236.94.97 1.674 1.91 1.91l1.036.258a.75.75 0 0 1 0 1.456l-1.036.258c-.94.236-1.674.97-1.91 1.91l-.258 1.036a.75.75 0 0 1-1.456 0l-.258-1.036a2.625 2.625 0 0 0-1.91-1.91l-1.036-.258a.75.75 0 0 1 0-1.456l1.036-.258a2.625 2.625 0 0 0 1.91-1.91l.258-1.036A.75.75 0 0 1 18 1.5ZM16.5 15a.75.75 0 0 1 .712.513l.394 1.183c.15.447.5.799.948.948l1.183.395a.75.75 0 0 1 0 1.422l-1.183.395c-.447.15-.799.5-.948.948l-.395 1.183a.75.75 0 0 1-1.422 0l-.395-1.183a1.5 1.5 0 0 0-.948-.948l-1.183-.395a.75.75 0 0 1 0-1.422l1.183-.395c.447-.15.799-.5.948-.948l.395-1.183A.75.75 0 0 1 16.5 15Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Features
                        </span>
                        <!-- Chevron -->
                        <svg class="w-4 h-4 transform transition-transform
                    {{ request()->routeIs('features.*') ? 'text-white rotate-180' : 'text-black group-hover:text-white' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- Submenu -->
                    <div id="featuresDropdown" class="hidden ml-4 mt-2 space-y-2">
                        <!-- Submenu: Feature 1 -->
                        <button onclick="window.location.href='{{ route('program.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('program.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Programs
                        </button>

                        <button onclick="window.location.href='{{ route('unggulans.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('unggulan.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Unggulan
                        </button>

                        <button onclick="window.location.href='{{ route('assesment.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('assesment.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Assesment
                        </button>

                        <button onclick="window.location.href='{{ route('pricing.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('pricing.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Pricings
                        </button>

                        <button onclick="window.location.href='{{ route('benefits.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('benefits.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Benefits
                        </button>

                        <button onclick="window.location.href='{{ route('testimonies.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('testimonies.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Testimony
                        </button>

                        <button onclick="window.location.href='{{ route('portfolio.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('portofolio.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Portfolio
                        </button>

                        <button onclick="window.location.href='{{ route('dukungan.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('dukungan.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Supports
                        </button>

                        <button onclick="window.location.href='{{ route('faqs.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 group font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('faqs.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • FAQs
                        </button>
                    </div>
                </li>

                <!-- Profile Item -->
                <!-- Profile Dropdown -->
                <li>
                    <button type="button"
                        onclick="document.getElementById('profileDropdown').classList.toggle('hidden')"
                        class="group flex items-center justify-between gap-3 px-5 py-3 rounded-2xl font-semibold hover:scale-105 transition duration-200 w-full outline outline-1 outline-gray-200 hover:outline-blue-500
                {{ request()->routeIs('about.*') || request()->routeIs('visi.*') || request()->routeIs('misi.*') ? 'bg-[#3030F8] text-white outline-none shadow-md' : 'bg-white text-black hover:bg-[#3030F8] hover:text-white' }}">
                        <span
                            class="flex items-center gap-2 text-[15px] leading-none transition
                    {{ request()->routeIs('about.*') || request()->routeIs('visi.*') || request()->routeIs('misi.*') ? 'text-white' : 'text-black group-hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 transition
                        {{ request()->routeIs('about.*') || request()->routeIs('visi.*') || request()->routeIs('misi.*') ? 'text-white' : 'text-black group-hover:text-white' }}">
                                <path fill-rule="evenodd"
                                    d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Profile
                        </span>

                        <!-- Chevron -->
                        <svg class="w-4 h-4 transform transition-transform
                    {{ request()->routeIs('about.*') || request()->routeIs('visi.*') || request()->routeIs('misi.*') ? 'text-white rotate-180' : 'text-black group-hover:text-white' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="profileDropdown" class="hidden ml-4 mt-2 space-y-2">
                        <button onclick="window.location.href='{{ route('about.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('about.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • About Us
                        </button>

                        <button onclick="window.location.href='{{ route('visi.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('visi.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Visi
                        </button>

                        <button onclick="window.location.href='{{ route('usp.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('usp.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Usp
                        </button>

                        <button onclick="window.location.href='{{ route('statistik.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('statistik.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Statistik
                        </button>

                        <button onclick="window.location.href='{{ route('ourteam.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('ourteam.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Our Team
                        </button>

                        <button onclick="window.location.href='{{ route('svg.edit', 1) }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('svg.edit') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Data
                        </button>

                        <button onclick="window.location.href='{{ route('legal.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('legal.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Legals Document
                        </button>

                        <button onclick="window.location.href='{{ route('partners.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('partners.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Partners
                        </button>
                    </div>
                </li>

                <!-- Setting Dropdown -->
                <li>
                    <button type="button"
                        onclick="document.getElementById('settingDropdown').classList.toggle('hidden')"
                        class="group flex items-center justify-between gap-3 px-5 py-3 rounded-2xl font-semibold hover:scale-105 transition duration-200 w-full outline outline-1 outline-gray-200 hover:outline-blue-500
                {{ request()->routeIs('setting.*') || request()->routeIs('account.*') || request()->routeIs('security.*') ? 'bg-[#3030F8] text-white outline-none shadow-md' : 'bg-white text-black hover:bg-[#3030F8] hover:text-white' }}">
                        <span
                            class="flex items-center gap-2 text-[15px] leading-none transition
                    {{ request()->routeIs('setting.*') || request()->routeIs('account.*') || request()->routeIs('security.*') ? 'text-white' : 'text-black group-hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 transition
                        {{ request()->routeIs('setting.*') || request()->routeIs('account.*') || request()->routeIs('security.*') ? 'text-white' : 'text-black group-hover:text-white' }}">
                                <path fill-rule="evenodd"
                                    d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Setting
                        </span>

                        <!-- Chevron -->
                        <svg class="w-4 h-4 transform transition-transform
                    {{ request()->routeIs('setting.*') || request()->routeIs('account.*') || request()->routeIs('security.*') ? 'text-white rotate-180' : 'text-black group-hover:text-white' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="settingDropdown" class="hidden ml-4 mt-2 space-y-2">
                        <button onclick="window.location.href='{{ route('identity.edit', 1) }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('identity.edit') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Identity
                        </button>

                        <button onclick="window.location.href='{{ route('header.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('header.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Header
                        </button>

                        <button onclick="window.location.href='{{ route('sidebanner.edit', 1) }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('sidebanner.edit') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Slide Banner
                        </button>

                        <button onclick="window.location.href='{{ route('slider.index') }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('slider.index') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Slider
                        </button>

                        <button onclick="window.location.href='{{ route('pixel.edit', 1) }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('pixel.edit') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Meta Pixel
                        </button>

                        <button onclick="window.location.href='{{ route('ganalytics.edit', 1) }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('ganalytics.edit') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Google Analytics
                        </button>

                        <button onclick="window.location.href='{{ route('chat.edit', 1) }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('chat.edit') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • Welcome Chat
                        </button>

                        <button onclick="window.location.href='{{ route('user.edit', auth()->user()->id) }}'"
                            class="w-full text-left rounded-xl px-4 py-2.5 transition hover:scale-105 font-medium text-[15px] outline outline-1 outline-gray-200 hover:outline-blue-500
                    {{ request()->routeIs('user.edit') ? 'bg-[#3030F8] text-white outline-none shadow-sm' : 'bg-white text-gray-700 hover:bg-[#3030F8] hover:text-white' }}">
                            • User
                        </button>
                    </div>
                </li>
            </ul>
        </nav>

        <main id="mainContent" class="flex-1 p-8 bg-[#D7D7FE] min-h-screen transition-all duration-500 ease-in-out">
            <!-- Konten Putih -->
            <div class="bg-[#D7D7FE] rounded-xl">
                @yield('content')
                @stack('script')
            </div>

    </div>
    </main>
    </div>

    <script>
        function toggleNavbar() {
            const sidebar = document.getElementById("sidebar");

            const isVisible = !sidebar.classList.contains("hidden");

            if (isVisible) {
                // Tutup sidebar
                sidebar.classList.add("opacity-0", "-translate-x-full");
                setTimeout(() => {
                    sidebar.classList.add("hidden");
                }, 300);
                localStorage.setItem("sidebarOpen", "false");
            } else {
                // Buka sidebar
                sidebar.classList.remove("hidden");
                setTimeout(() => {
                    sidebar.classList.remove("opacity-0", "-translate-x-full");
                }, 10);
                localStorage.setItem("sidebarOpen", "true");
            }
        }

        // Saat halaman dimuat, cek localStorage dan tampilkan sidebar jika sebelumnya terbuka
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById("sidebar");
            const isCreatePage = "{{ Route::currentRouteName() }}" === "posts.create";

            if (isCreatePage) {
                // Paksa sidebar tertutup saat masuk halaman create
                sidebar.classList.add("hidden", "opacity-0", "-translate-x-full");
                localStorage.setItem("sidebarOpen", "false");
            } else {
                const savedState = localStorage.getItem("sidebarOpen");

                if (savedState === "true") {
                    sidebar.classList.remove("hidden");
                    setTimeout(() => {
                        sidebar.classList.remove("opacity-0", "-translate-x-full");
                    }, 10);
                }
            }
        });

        function toggleNavbar() {
            const sidebar = document.getElementById("sidebar");
            const isHidden = sidebar.classList.contains("hidden");

            if (!isHidden) {
                // Tutup sidebar
                sidebar.classList.add("opacity-0", "-translate-x-full");
                setTimeout(() => {
                    sidebar.classList.add("hidden");
                }, 300);
                localStorage.setItem("sidebarOpen", "false");
            } else {
                // Buka sidebar
                sidebar.classList.remove("hidden");
                setTimeout(() => {
                    sidebar.classList.remove("opacity-0", "-translate-x-full");
                }, 10);
                localStorage.setItem("sidebarOpen", "true");
            }
        }
    </script>






    <!-- SweetAlert2 CDN -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoutButton = document.getElementById('btn-logout');
            const logoutForm = document.getElementById('logout-form');

            if (logoutButton && logoutForm) {
                logoutButton.addEventListener('click', function(e) {
                    e.preventDefault(); // Tambahkan ini untuk hindari form submit langsung
                    Swal.fire({
                        title: 'Yakin ingin logout?',
                        text: "Sesi Anda akan diakhiri.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#7367F0',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, logout!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            logoutForm.submit();
                        }
                    });
                });
            } else {
                console.error("Elemen btn-logout atau logout-form tidak ditemukan!");
            }
        });
    </script>





    @if (session('login_success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil!',
                text: 'Selamat datang kembali 👋',
                confirmButtonColor: '#6366f1'
            });
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dapatkan path URL saat ini
            const currentPath = window.location.pathname;

            // Seleksi semua link di sidebar
            const navLinks = document.querySelectorAll('#sidebar a');

            // Loop melalui setiap link
            navLinks.forEach(link => {
                // Cek apakah href link sesuai dengan path saat ini
                if (link.getAttribute('href') === currentPath) {
                    // Tambahkan class aktif
                    link.classList.remove('bg-white', 'text-black');
                    link.classList.add('bg-[#3030F8]', 'text-white');

                    // Juga update icon warna jika ada
                    const icon = link.querySelector('svg');
                    if (icon) {
                        icon.classList.remove('text-black');
                        icon.classList.add('text-white');
                    }
                }
            });

            // Handle untuk submenu Posts dan Agenda
            const routeName = "{{ Route::currentRouteName() }}";
            if (routeName === 'posts.index' || currentPath.includes('/posts')) {
                const postsLink = document.querySelector('#sidebar a[href*="posts"]');
                if (postsLink) {
                    postsLink.parentElement.classList.remove('bg-slate-700', 'text-gray-300');
                    postsLink.parentElement.classList.add('bg-[#3030F8]', 'text-white');
                }
            }
        });
    </script>

    <!-- Footer -->
    <footer class="bg-white text-center text-sm  text-gray-500 py-4 shadow-md">
        &copy; {{ date('Y') }} Jatidiri.app
    </footer>


</body>

</html>
