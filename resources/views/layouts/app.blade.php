<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ $title ?? 'Dashboard' }}</title>
    <link href="./css/output.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="bg-[#D7D7FE]">
    <div
        class=" bg-white w-full h-[58px] md:p-6 md:w-full md:h-[116px] flex items-center justify-between gap-6 shadow-md rounded-r-2xl relative">
        <!-- Kiri: Tombol Menu, Logo, dan Home -->
        <div class="flex items-center gap-3 md:gap-6 ">
            <!-- Tombol Menu -->
            <button onclick="toggleNavbar()" id="menuButton" class="z-30">
                <svg id="iconBars"
                    class=" w-4 h-4 md:w-8 md:h-8 text-blue-600 hover:scale-125 transition cursor-pointer"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>




            <!-- Logo -->
            <img src="./img/Jatidiri.png" alt="Logo" class="w-[69px] h-[28px] md:w-[138px] md:h-[57px]" />

            <!-- Garis Vertikal -->
            <div class="w-px h-10 md:h-20 border border-gray-500"></div>

            <!-- Home Text -->
            <span class="text-[20px] font-semibold text-gray-800">Home</span>
        </div>

        <!-- Kanan: Avatar dan Info User -->
        <div
            class="flex items-center gap-3 bg-gray-50 px-4 py-2 rounded-full shadow hover:scale-105 transition duration-300">
            <!-- Avatar -->
            <img src="https://i.pravatar.cc/40?img=3" alt="User" class="w-10 h-10 rounded-full" />

            <!-- Info user -->
            <div class="flex flex-col justify-center">
                <span class="font-semibold text-[16px] leading-tight">Aelxander</span>
                <span class="text-[14px] text-gray-500 leading-tight">Admin</span>
            </div>

            <!-- Logout Button -->
            <button onclick="confirmLogout()" title="Logout">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2" class="w-6 h-6 text-red-600 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                </svg>
            </button>
        </div>
    </div>


    <!-- Sidebar -->
    <div class=" flex justify-between gap-4  w-full h-full">
        <nav id="sidebar"
            class=" scroll p-5 rounded-b-xl transition-all duration-500 ease-in-out transform -translate-x-full opacity-0 hidden w-[250px] min-h-screen bg-white shadow-lg ">
            <ul class="mb-60">
                <li class="mt-5">
                    <a href="dashboard"
                        class="group flex items-center gap-3 px-5 py-3 bg-white rounded-2xl shadow-md font-semibold hover:bg-[#3030F8] hover:scale-110 transition duration-200">

                        <span class="flex gap-2 text-black group-hover:text-white text-[15px] leading-none transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 text-black group-hover:text-white transition">
                                <path
                                    d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                                <path
                                    d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                            </svg>
                            Home</span>
                    </a>
                </li>

                <!-- Dropdown Blog & Agenda -->
                <!-- Dropdown Blog & Agenda (mirip About) -->
                <li class="mt-5">
                    <!-- Toggle Button -->
                    <button type="button" onclick="document.getElementById('blogDropdown').classList.toggle('hidden')"
                        class="group flex items-center gap-3 px-5 py-3 bg-white rounded-2xl shadow-md font-semibold hover:bg-[#3030F8] hover:scale-110 transition duration-200 w-full">
                        <span class="flex gap-2 text-black group-hover:text-white text-[15px] leading-none transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 text-black group-hover:text-white transition">
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
                        <svg class="w-4 h-4 text-black group-hover:text-white  transform transition-transform"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- Submenu -->
                    <div id="blogDropdown" class="hidden ml-4 mt-3 space-y-3">

                        <!-- Submenu: Posts -->
                        <div
                            class="bg-slate-700 rounded-xl shadow-md px-4 py-3 transition hover:bg-[#3030F8] hover:scale-105 group">
                            <a href="{{ route('posts.index') }}"
                                class="block text-[16px] font-medium text-gray-300 transition group-hover:text-white">
                                • Posts
                            </a>
                        </div>

                        <!-- Submenu: Agenda -->
                        <div
                            class="bg-slate-700 rounded-xl shadow-md px-4 py-3 transition hover:bg-[#3030F8] hover:scale-105 group">
                            <a href="/agenda"
                                class="block text-[16px] font-medium text-gray-300 transition group-hover:text-white">
                                • Agenda
                            </a>
                        </div>

                    </div>

                </li>




                <li class="mt-5">
                    <a href="#"
                        class="group flex items-center gap-3 px-5 py-3 bg-white rounded-2xl shadow-md font-semibold hover:bg-[#3030F8] hover:scale-110 transition duration-200">

                        <span class="flex gap-2 text-black group-hover:text-white text-[15px] leading-none transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 text-black group-hover:text-white transition">
                                <path fill-rule="evenodd"
                                    d="M12 6.75a5.25 5.25 0 0 1 6.775-5.025.75.75 0 0 1 .313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 0 1 1.248.313 5.25 5.25 0 0 1-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 1 1 2.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309A5.342 5.342 0 0 1 12 6.75ZM4.117 19.125a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="m10.076 8.64-2.201-2.2V4.874a.75.75 0 0 0-.364-.643l-3.75-2.25a.75.75 0 0 0-.916.113l-.75.75a.75.75 0 0 0-.113.916l2.25 3.75a.75.75 0 0 0 .643.364h1.564l2.062 2.062 1.575-1.297Z" />
                                <path fill-rule="evenodd"
                                    d="m12.556 17.329 4.183 4.182a3.375 3.375 0 0 0 4.773-4.773l-3.306-3.305a6.803 6.803 0 0 1-1.53.043c-.394-.034-.682-.006-.867.042a.589.589 0 0 0-.167.063l-3.086 3.748Zm3.414-1.36a.75.75 0 0 1 1.06 0l1.875 1.876a.75.75 0 1 1-1.06 1.06L15.97 17.03a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>

                            Services</span>
                    </a>
                </li>


                <li class="mt-5">
                    <a href="#"
                        class="group flex items-center gap-3 px-5 py-3 bg-white rounded-2xl shadow-md font-semibold hover:bg-[#3030F8] hover:scale-110 transition duration-200">

                        <span class="flex gap-2 text-black group-hover:text-white text-[15px] leading-none transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 text-black group-hover:text-white transition">
                                <path fill-rule="evenodd"
                                    d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Profile</span>
                    </a>
                </li>
                <li class="mt-5">
                    <a href="#"
                        class="group flex items-center gap-3 px-5 py-3 bg-white rounded-2xl shadow-md font-semibold hover:bg-[#3030F8] hover:scale-110 transition duration-200">

                        <span class="flex gap-2 text-black group-hover:text-white text-[15px] leading-none transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 text-black group-hover:text-white transition">
                                <path fill-rule="evenodd"
                                    d="M9 4.5a.75.75 0 0 1 .721.544l.813 2.846a3.75 3.75 0 0 0 2.576 2.576l2.846.813a.75.75 0 0 1 0 1.442l-2.846.813a3.75 3.75 0 0 0-2.576 2.576l-.813 2.846a.75.75 0 0 1-1.442 0l-.813-2.846a3.75 3.75 0 0 0-2.576-2.576l-2.846-.813a.75.75 0 0 1 0-1.442l2.846-.813A3.75 3.75 0 0 0 7.466 7.89l.813-2.846A.75.75 0 0 1 9 4.5ZM18 1.5a.75.75 0 0 1 .728.568l.258 1.036c.236.94.97 1.674 1.91 1.91l1.036.258a.75.75 0 0 1 0 1.456l-1.036.258c-.94.236-1.674.97-1.91 1.91l-.258 1.036a.75.75 0 0 1-1.456 0l-.258-1.036a2.625 2.625 0 0 0-1.91-1.91l-1.036-.258a.75.75 0 0 1 0-1.456l1.036-.258a2.625 2.625 0 0 0 1.91-1.91l.258-1.036A.75.75 0 0 1 18 1.5ZM16.5 15a.75.75 0 0 1 .712.513l.394 1.183c.15.447.5.799.948.948l1.183.395a.75.75 0 0 1 0 1.422l-1.183.395c-.447.15-.799.5-.948.948l-.395 1.183a.75.75 0 0 1-1.422 0l-.395-1.183a1.5 1.5 0 0 0-.948-.948l-1.183-.395a.75.75 0 0 1 0-1.422l1.183-.395c.447-.15.799-.5.948-.948l.395-1.183A.75.75 0 0 1 16.5 15Z"
                                    clip-rule="evenodd" />
                            </svg>

                            Features</span>
                    </a>
                </li>


                <li class="mt-5">
                    <a href="#"
                        class="group flex items-center gap-3 px-5 py-3 bg-white rounded-2xl shadow-md font-semibold hover:bg-[#3030F8] hover:scale-110 transition duration-200">

                        <span class="flex gap-2 text-black group-hover:text-white text-[15px] leading-none transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 text-black group-hover:text-white transition">
                                <path fill-rule="evenodd"
                                    d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"
                                    clip-rule="evenodd" />
                            </svg>


                            Setting</span>
                    </a>
                </li>

            </ul>
        </nav>

        <main id="mainContent"
            class="flex-1 py-2 px-6 bg-[#D7D7FE] min-h-screen transition-all duration-500 ease-in-out">
            <!-- Konten Putih -->
            <div class="bg-[#D7D7FE] p-1 rounded-xl">
                @yield('content')
            </div>

    </div>
    </main>
    </div>
    <footer class="bg-white w-full shadow-md py-4 mt-3">
        <div class="text-center text-gray-500 text-sm">
            &copy; {{ date('2012-2025 ') }} Jatidiri.app
        </div>
    </footer>

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
    document.addEventListener("DOMContentLoaded", function () {
        const sidebar = document.getElementById("sidebar");
        const savedState = localStorage.getItem("sidebarOpen");

        if (savedState === "true") {
            sidebar.classList.remove("hidden");
            setTimeout(() => {
                sidebar.classList.remove("opacity-0", "-translate-x-full");
            }, 10);
        }
    });
</script>





    <!-- SweetAlert2 CDN -->

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Yakin ingin logout?',
                text: 'Kamu akan diarahkan ke halaman login.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then(result => {
                if (result.isConfirmed) {
                    // Kirim POST logout pakai fetch + CSRF
                    fetch("{{ route('logout') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                        credentials: 'same-origin',
                    }).then(() => {
                        // Redirect ke halaman login
                        window.location.href = "{{ route('login') }}";
                    });
                }
            });
        }
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



</body>

</html>
