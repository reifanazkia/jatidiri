<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="./css/output.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit&display=swap" rel="stylesheet">
    <title>LOGIN</title>

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>

</head>

<body class="bg-gradient-to-r from-[#3030F8] to-[#D7D7FE] ">
    <div
        class="mt-30 p-auto border w-464px border-white bg-white rounded-xl 
                    mx-auto shadow-md p-5 relative text-16 gap-10">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-10px mx-auto mb-2">
        <p class="text-center mb-4 text-24px font-bold">Jatidiri</p>
        <form action="">
            <label for="text">
                <span
                    class="mt-16 block font-semibold text-16 mb-3 text-slate-700 ">Email<span
                        class="text-slate-700 ml-">*</span></span>
                <input type="username" id="text" placeholder="Masukan Email"
                    class="px-3 py-2 border rounded w-full block text-sm">
            </label>
        </form>
        <form action="">
            <label for="password">
                <span class="mt-3 block font-semibold text-16 mb-3 text-slate-700 ">Password <span
                        class="text-slate-700 ml-">*</span>
                </span>

                <div class="relative">
                    <input type="password" id="password" placeholder="Masukan Password Anda.."
                        class="px-3 py-2 border rounded w-full block text-sm">

                    <!-- Tombol mata -->
                    <button type="button" onclick="togglePassword()"
                        class="absolute right-3 top-2/4 -translate-y-1/2 text-gray-500">
                        <!-- Mata tertutup -->
                        <svg id="eye-slash" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-5.523 0-10-4.477-10-10
                        0-1.308.25-2.557.7-3.7m3.028-1.896a9.986 9.986 0 014.272-.9c5.523
                        0 10 4.477 10 10a9.96 9.96 0 01-1.175 4.725M15 12a3 3 0 11-6
                        0 3 3 0 016 0zM3 3l18 18" />
                        </svg>

                        <!-- Mata terbuka -->
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
            </label>
        </form>

        <div class="flex items-center justify-between mt-3">
            <label>
                <input type="checkbox" name="" id="" class="h-4 w-4 ">
                <span class="text-sm font-bold">Ingatkan Saya</span>
            </label>

            <a href="#" class=" text-sm text-blue-600 hover:text-blue-800 underline">Lupa Password
                ?</a>
        </div>
        <div class="mt-2 flex justify-center">
            <button type="submit" class="px-3 py-2 bg-indigo-700 rounded-full w-full text-white">Login</button>
        </div>
    </div>



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
    </script>


</body>


</html>
