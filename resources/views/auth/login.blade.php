<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Outfit&display=swap" rel="stylesheet">
    <title>Login - Jatidiri</title>
=======
    <title>Login - Jatidiri</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit&display=swap" rel="stylesheet">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

>>>>>>> 0e1c82028b5296f1ffc528542e1144d0db22dd91
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#3030F8] to-[#D7D7FE]">
<<<<<<< HEAD

    <div
        class=" w-xs h-xs mx-auto sm:w-[464px] sm:h-[512px] bg-white rounded-[16px] shadow-[0_6px_21px_0_rgba(0,0,0,0.15)] p-[32px] gap-[10px] justify-center relative">

        <!-- Logo -->
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-[38px] h-[54px] mx-auto mb-3 ">

        <!-- Title -->
        <h1 class="text-center text-[24px] font-bold text-gray-900 mb-4 leading[100%] ">Jatidiri</h1>

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-[10px]">
            @csrf

            <!-- Email -->
            <div>
                <label for="email"
                    class=" mb-[16px] block text-[16px] leading[100% ] font-semibold text-gray-700 mb-1">EMAIL <span
                        class="text-gray-600">*</span></label>
                <input type="email" name="email" id="email" placeholder="Alamat Email" required
                    class="text-[18px] font-normal w-full border border-gray-600 rounded-[8px] px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-indigo-500 mb-[16px]" />
=======

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
>>>>>>> 0e1c82028b5296f1ffc528542e1144d0db22dd91
            </div>

            <!-- Password -->
            <div>
<<<<<<< HEAD
                <label for="password" class="block text-[14px] font-semibold text-gray-700 mb-[16px]">PASSWORD <span
                        class="text-gray-600">*</span></label>
                <div class="relative">
                    <input type="password" name="password" id="password" placeholder="Password" required
                        class="w-full text-[18px] font-normal border-1 border-gray-600 rounded-[8px] px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-indigo-500 mb-[16px]" />
                    <!-- Eye icon toggle -->
                    <button type="button" onclick="togglePassword()"
                        class="absolute right-3 top-7 transform -translate-y-1/2 text-gray-400 focus:outline-none ">
                        <!-- Eye Closed Icon -->
                        <svg id="eye-slash" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>



                        <!-- Eye Open Icon -->
                        <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943
                9.542 7-1.274 4.057-5.064 7-9.542 7-4.477
                0-8.268-2.943-9.542-7z" />
=======
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
>>>>>>> 0e1c82028b5296f1ffc528542e1144d0db22dd91
                        </svg>
                    </button>

                </div>
            </div>

<<<<<<< HEAD
            <!-- Remember & Forgot -->
            <div class="flex items-center justify-between text-sm mt-1">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" class="h-4 w-4 text-indigo-600 cursor-pointer border">
                    <span class="font-normal text-[16px]">Ingatkan Saya</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-[16px] text-indigo-600 hover:text-indigo-800">
                    Lupa Password ?
                </a>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="btnLogin"
                class="mt-4 py-4 rounded-full text-white text-[18px] font-semibold bg-gradient-to-r from-[#5B36F7] to-[#7F4DFF] hover:opacity-90 transition cursor-pointer tracking-wider flex items-center justify-center gap-2">

                <!-- Spinner -->
                <svg id="spinner" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>

                <!-- Button Text -->
                <span id="btnText">Login</span>
            </button>

        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const eyeOpen = document.getElementById("eye-open");
            const eyeSlash = document.getElementById("eye-slash");

            const isPassword = passwordInput.type === "password";
            passwordInput.type = isPassword ? "text" : "password";

            eyeOpen.classList.toggle("hidden", !isPassword);
            eyeSlash.classList.toggle("hidden", isPassword);
=======
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
>>>>>>> 0e1c82028b5296f1ffc528542e1144d0db22dd91
        }
    </script>

    <script>
        const form = document.querySelector('form');
        const btnLogin = document.getElementById('btnLogin');
        const spinner = document.getElementById('spinner');
        const btnText = document.getElementById('btnText');

        form.addEventListener('submit', function() {
            // Tampilkan spinner dan ubah teks
            spinner.classList.remove('hidden');
            btnText.textContent = 'Loading...';
            btnLogin.disabled = true;
            btnLogin.classList.add('opacity-70', 'cursor-not-allowed');
        });
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
