<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Jatidiri</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit&display=swap" rel="stylesheet">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet" />
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
                        <svg id="eye-slash" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 block" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-5.523 0-10-4.477-10-10
                                  0-1.308.25-2.557.7-3.7m3.028-1.896a9.986 9.986 0 014.272-.9c5.523
                                  0 10 4.477 10 10a9.96 9.96 0 01-1.175 4.725M15 12a3 3 0 11-6
                                  0 3 3 0 016 0zM3 3l18 18" />
                        </svg>
                        <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943
                                9.542 7-1.274 4.057-5.064 7-9.542 7-4.477
                                0-8.268-2.943-9.542-7z" />
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

    <!-- Script -->
    <script>
        function togglePassword() {
            const input = document.getElementById("password");
            const eyeOpen = document.getElementById("eye-open");
            const eyeSlash = document.getElementById("eye-slash");

            if (input.type === "password") {
                input.type = "text";
                eyeSlash.classList.add("hidden");
                eyeOpen.classList.remove("hidden");
            } else {
                input.type = "password";
                eyeOpen.classList.add("hidden");
                eyeSlash.classList.remove("hidden");
            }
        }

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
</body>

</html>
