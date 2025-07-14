<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Outfit&display=swap" rel="stylesheet">
    <title>Login - Jatidiri</title>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#3030F8] to-[#D7D7FE]">

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
            </div>

            <!-- Password -->
            <div>
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
                        </svg>
                    </button>
                </div>
            </div>

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

</body>

</html>
