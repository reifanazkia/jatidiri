<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Jatidiri</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit&display=swap" rel="stylesheet">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#3030F8] to-[#D7D7FE]">

    <div class="w-xs h-xs sm:w-[464px] sm:h-[512px] bg-white p-8 rounded-2xl shadow-lg ">
        <!-- Logo -->
        <div class="flex justify-center mb-[12px]">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-[38px] h-[54px]">
        </div>

        <!-- Judul -->
        <h2 class="text-[24px] font-bold text-center mb-[24px] text-gray-800">Jatidiri</h2>

        <!-- Form -->
        <form action="{{ route('login') }}" method="POST" class="space-y-4" id="loginForm">
            @csrf
            <!-- Email -->
            <div>
                <label for="email" class="block text-[16px] font-semibold text-[#010143] mb-[16px]">EMAIL <span
                        class="text-[#010143]">*</span></label>
                <input type="email" id="email" name="email" placeholder="Alamat Email"
                    class="w-full px-4 py-4 border rounded-xl text-[18px] font-normal focus:outline-none focus:ring-2 focus:ring-indigo-500 mb-[12px]"
                    required>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-[16px] font-semibold text-[#010143] mb-[16px]">PASSWORD <span
                        class="text-[#010143]">*</span></label>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="Password"
                        class="w-full px-4 py-4 border rounded-xl text-[18px] font-normal focus:outline-none focus:ring-2 focus:ring-indigo-500 pr-10"
                        required>
                    <!-- Eye toggle -->
                    <button type="button" onclick="togglePassword()"
                        class="absolute top-1/2 right-3 transform -translate-y-1/2 text-gray-500">

                        <!-- Eye Slash (hidden password) -->
                        <svg id="eye-slash" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 block">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5
            12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1
            12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293
            5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21
            21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242
            4.242L9.88 9.88" />
                        </svg>

                        <!-- Eye Open (visible password) -->
                        <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12
            4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0
            .639C20.577 16.49 16.64 19.5 12 19.5c-4.638
            0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </button>

                </div>
            </div>

            <!-- Ingatkan Saya + Lupa Password -->
            <div class="flex items-center justify-between">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="remember"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <span class="text-[16px] font-semibold text-gray-900">Ingatkan Saya</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-[16px] text-indigo-600 hover:underline">Lupa
                    Password?</a>
            </div>

            <!-- Tombol -->
            <button id="btnSubmit" type="submit"
                class="relative w-full py-3 mb-8 bg-indigo-700 text-white rounded-full hover:bg-indigo-800 transition text-[18px] font-semibold tracking-wider overflow-hidden">
                <!-- Teks -->
                <span id="btnText">Login</span>

                <!-- Spinner di tengah -->
                <div id="btnSpinner" class="hidden absolute inset-0 flex items-center justify-center">
                    <span class="flex items-center gap-2 text-white text-[16px] font-semibold">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke-width="4" />
                            <path class="opacity-75" stroke-width="4" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                        </svg>
                        Loading...
                    </span>
                </div>
            </button>
        </form>
    </div>

    <!-- SweetAlert Error Handling -->
    @if (session('login_error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '{{ session('login_error') }}',
                confirmButtonColor: '#d33'
            });
        </script>
    @endif



    <!-- Script -->

    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const eyeOpen = document.getElementById("eye-open");
            const eyeSlash = document.getElementById("eye-slash");

            const isHidden = passwordField.type === "password";
            passwordField.type = isHidden ? "text" : "password";

            eyeOpen.classList.toggle("hidden", !isHidden);
            eyeSlash.classList.toggle("hidden", isHidden);
        }
    </script>





    {{-- spinner --}}
    <script>
        // Spinner saat form disubmit
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById("btnSubmit");
            const text = document.getElementById("btnText");
            const spinner = document.getElementById("btnSpinner");

            spinner.classList.remove("hidden");
            text.classList.add("opacity-0");
            btn.disabled = true;
        });
    </script>

    {{-- sweet alert --}}
    <!-- SweetAlert2 CDN (di <head> atau sebelum </body>) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Ambil elemen sekali saja
        const form = document.getElementById('loginForm');
        const btn = document.getElementById("btnSubmit");
        const text = document.getElementById("btnText");
        const spinner = document.getElementById("btnSpinner");
    </script>


</body>

</html>
