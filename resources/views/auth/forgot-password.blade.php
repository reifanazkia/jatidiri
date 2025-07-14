<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
    <link href="./css/output.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#3030F8] to-[#D7D7FE]">

    <!-- Card -->
    <div class="w-xs h-xs bg-white rounded-[16px] shadow-2xl sm:w-[464px] p-8">
        <h1 class="text-[48px] font-bold text-[#010143] leading-[100%] mb-[8px] ">Reset Password</h1>
        <p class="text-sm text-gray-500 text-[16px] mb-[24px]">Silakan masukkan detail anda di bawah ini</p>

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf
            <div>
                <label for="email"
                    class="block font-semibold text-[16px] weight-[500] leading-[100%] text-[#010143] mb-[16px]">EMAIL</label>
                <input id="email" name="email" type="email" placeholder="Alamat Email" required
                    class="w-full px-4 py-4 leading-[100%] text-[18px] border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <!-- Submit Button with Spinner -->
            <button type="submit" id="btnReset"
                class="text-[18px] flex items-center justify-center gap-2 w-full py-4 tracking-wider mb-[24px] bg-gradient-to-r from-[#5B36F7] to-[#7F4DFF] text-white font-semibold rounded-full cursor-pointer hover:opacity-90 transition">
                <svg id="spinner" class="hidden animate-spin h-5 w-5 text-white " xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
                <span id="btnText">Kirim ulang password</span>
            </button>

            <!-- Back to Login Button -->
            <a href="{{ route('login') }}" id="backToLogin"
                class="text-[18px] flex items-center justify-center gap-2 w-full py-4 border text-gray-500 font-semibold rounded-full text-sm hover:bg-gray-100 transition relative">

                <!-- Spinner -->
                <svg id="spinnerBack" class="hidden animate-spin h-5 w-5 text-gray-500"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>

                <!-- Icon -->
                <svg id="iconBack" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>

                <span id="backText">Kembali ke Login</span>
            </a>

        </form>
    </div>

    <!-- Spinner Logic -->
    <script>
        const form = document.querySelector("form");
        const btnReset = document.getElementById("btnReset");
        const spinner = document.getElementById("spinner");
        const btnText = document.getElementById("btnText");

        form.addEventListener("submit", function() {
            spinner.classList.remove("hidden");
            btnText.textContent = "Loading...";
            btnReset.disabled = true;
            btnReset.classList.add("opacity-70", "cursor-not-allowed");
        });
    </script>
    <script>
        const backLink = document.getElementById('backToLogin');
        const spinnerBack = document.getElementById('spinnerBack');
        const iconBack = document.getElementById('iconBack');
        const backText = document.getElementById('backText');

        backLink.addEventListener('click', function(e) {
            e.preventDefault(); // stop default redirect

            // Tampilkan spinner, sembunyikan icon
            spinnerBack.classList.remove('hidden');
            iconBack.classList.add('hidden');
            backText.textContent = 'Loading...';
            backLink.classList.add('cursor-not-allowed', 'opacity-70');
            backLink.removeAttribute('href');

            // Redirect manual setelah 500ms
            setTimeout(() => {
                window.location.href = "{{ route('login') }}";
            }, 500);
        });
    </script>

    <script>
        show showalert() {
            swal.fire({
                title: 'Berhasil',
                text: 'Login anda Berhasil',
                icon: 'succes',
                confirmButtonText: 'OK'
            })
        }
    </script>


</body>

</html>
