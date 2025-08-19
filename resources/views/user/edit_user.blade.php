@extends('layouts.app')

@section('page_title', 'User')

@section('content')
    <div class="bg-white max-w-full mx-auto p-8 rounded-[24px] space-y-10">

        {{-- Header --}}
        <h2 class="text-2xl font-semibold mb-8">Edit Profile</h2>

        <div class="w-full h-px md:h-px border border-gray-300 mb-8"></div>

        {{-- Profile Info --}}
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6 bg-white p-6 rounded-full-lg  items-start">
            {{-- Profile Photo --}}
            <div class="text-center grid grid-cols-2 gap-0">
                <!-- Profile Photo -->
                <div>
                    <img src="{{ $editUser->photo_url ?? asset('default-avatar.png') }}"
                        class="w-24 h-24 mx-auto rounded-full mb-4" alt="Profile Photo">
                </div>

                <!-- Title and Description -->
                <div class="flex-col">
                    <h1 class="text-xl text-left font-bold mb-2">Foto profil</h1>
                    <p class="text-left text-gray-600 mb-4">
                        Perbarui foto Anda<br>
                        untuk jangkawan yang<br>
                        lebih baik
                    </p>

                    <form method="POST" action="{{ route('user.update.photo', $editUser->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="file" name="photo" id="photoInput" class="hidden">
                        <label for="photoInput" class="block text-left">
                            <span
                                class="bg-white border border-gray-300 text-black px-6 py-2 rounded-full hover:bg-gray-100 cursor-pointer inline-block text-sm">
                                Unggah
                            </span>
                        </label>
                    </form>
                </div>
            </div>

            {{-- Name & Email --}}
            <div class="col-span-2">
                <form method="POST" action="{{ route('user.update', $editUser->id) }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium mb-4">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $editUser->name) }}"
                            class="w-full border border-gray-300 px-4 py-2 rounded-[12px]" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-4">Email</label>
                        <input type="email" name="email" value="{{ old('email', $editUser->email) }}"
                            class="w-full border border-gray-300 px-4 py-2 rounded-[12px]" required>
                    </div>
                    <button type="submit"
                        class="btn-action bg-[#8989FC]  text-black px-6 py-2 cursor-pointer rounded-full hover:bg-indigo-500">
                        Update
                    </button>
                </form>
            </div>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Password Update --}}
            <div class="bg-white p-6 rounded-lg">
                <h3 class="text-lg font-semibold mb-8">Update Password</h3>
                <div class="w-full h-px md:h-px border border-gray-300 mb-8"></div>
                <form method="POST" action="{{ route('user.updatePassword', $editUser->id) }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-[16px]">Old Password</label>
                        <input type="password" name="old_password"
                            class="w-full border border-gray-300 px-4 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-[16px]">New Password</label>
                        <input type="password" name="new_password"
                            class="w-full border border-gray-300 px-4 py-2 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-[16px]">New Password
                            Confirmation</label>
                        <input type="password" name="new_password_confirmation"
                            class="w-full border border-gray-300 px-4 py-2 rounded-md">
                    </div>
                    <div class="flex gap-[16px] pt-2">
                        <button type="submit"
                            class="bg-[#8989FC]  text-black px-4 py-2 rounded-full cursor-pointer hover:bg-indigo-500">Update</button>
                        <button type="reset" class="border border-gray-300 px-4 py-2 rounded-full">Clear all</button>
                    </div>
                </form>
            </div>

            {{-- Two-Factor Authentication --}}
            <div class="bg-white p-6 rounded-lg relative">
                <h3 class="text-lg font-semibold mb-8">Two-Factor Authentication</h3>
                <div class="w-full h-px md:h-px border border-gray-300 mb-8"></div>
                <button type="button" onclick="open2FAModal()"
                    class="bg-[#8989FC] text-black px-6 py-2 rounded-full mt-8 hover:bg-indigo-500 absolute left-6 cursor-pointer">
                    Enable Two-Faktor
                </button>
            </div>

            {{-- Two-Factor Authentication Modal --}}
            <div id="enable2FAModal"
                class="fixed inset-0 bg-opacity-30 backdrop-blur-sm z-50 flex items-center justify-center opacity-0 invisible transition-opacity duration-300">
                <div class="bg-white rounded-[24px] p-8 w-full max-w-md relative mx-4 shadow-xl transition-all duration-300 transform scale-95"
                    id="2FAModalContent">
                    <button onclick="close2FAModal()"
                        class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-center ">CONFIRM PASSWORD</h3>
                    </div>

                    <form method="POST" action="{{ route('user.enable2fa', $editUser->id) }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium mb-2">Password</label>
                            <input type="password" name="password"
                                class="w-full border border-gray-300 px-4 py-2 rounded-[12px]" required>
                        </div>
                        <div class="flex justify-end gap-4 pt-4">

                            <button type="submit"
                                class="bg-[#8989FC] text-black font-semibold w-full px-6 py-2 rounded-full hover:bg-indigo-500 transition">
                                CONFIRM PASSWORD
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="mt-8 rounded-xl">
        {{-- Role User Table --}}
        <div class="bg-white p-[32px] rounded-[24px] shadow">
            <div class="flex items-center gap-[8px] mb-4">
                <h3 class="text-lg font-semibold">Role User</h3>
                <div class=" bg-[#8989FC] rounded-full w-[150px] h-[40px] flex items-center justify-between cursor-pointer hover:bg-indigo-500 transition"
                    onclick="openModal()">
                    <!-- Icon Section -->
                    <div class="w-[40px] h-[40px] bg-white rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>

                    <!-- Text Section -->
                    <span class="text-sm font-normal leading-[130%] text- px-2 py-4">
                        Add New Role
                    </span>
                </div>
            </div>

            <!-- Create User Modal -->
            <div id="createUserModal"
                class="fixed inset-0 bg-opacity-30 backdrop-blur-sm z-50 flex items-center justify-center opacity-0 invisible transition-opacity duration-300">
                <div class="bg-white rounded-[24px] p-8 w-full max-w-md relative mx-4 shadow-xl transition-all duration-300 transform scale-95"
                    id="modalContent">
                    <button onclick="closeModal()"
                        class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold">Create User</h3>
                    </div>

                    <div class="w-full h-px border border-gray-300 mb-8"></div>

                    <form method="POST" action="{{ route('user.store') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium mb-2">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full border border-gray-300 px-4 py-2 rounded-[12px]" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full border border-gray-300 px-4 py-2 rounded-[12px]" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Password</label>
                            <input type="password" name="password"
                                class="w-full border border-gray-300 px-4 py-2 rounded-[12px]" required>
                        </div>
                        <div class="flex justify-end gap-4 pt-4">
                            <button type="button" onclick="closeModal()"
                                class="border bg-gray-200 px-4 py-2 rounded-full hover:bg-gray-300 transition">
                                Cancel
                            </button>
                            <button type="submit"
                                class="bg-[#8989FC] text-white px-6 py-2 rounded-full hover:bg-indigo-600 transition">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="overflow-x-auto mt-8">
                <table class="w-full border border-gray-500 table-auto border-collapse text-sm text-left">
                    <thead class="bg-gray-300">
                        <tr>
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $index + 1 }}</td>
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('user.edit', $user->id) }}"
                                        class="btn-action bg-[#8989FC] text-white px-3 py-1 rounded-full hover:bg-indigo-500">Edit</a>
                                    <form method="POST" action="{{ route('user.destroy', $user->id) }}"
                                        class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="btn-delete bg-red-500 text-white px-3 py-1 rounded-full hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            const modal = document.getElementById('createUserModal');
            const content = document.getElementById('modalContent');

            modal.classList.remove('invisible', 'opacity-0');
            modal.classList.add('visible', 'opacity-100');

            setTimeout(() => {
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('createUserModal');
            const content = document.getElementById('modalContent');

            content.classList.remove('scale-100');
            content.classList.add('scale-95');

            setTimeout(() => {
                modal.classList.remove('visible', 'opacity-100');
                modal.classList.add('invisible', 'opacity-0');
            }, 150);
        }

        document.getElementById('createUserModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>

    <script>
        function open2FAModal() {
            const modal = document.getElementById('enable2FAModal');
            const content = document.getElementById('2FAModalContent');

            // Show modal without black backdrop
            modal.classList.remove('invisible', 'opacity-0');
            modal.classList.add('visible', 'opacity-100');

            // Content scale animation
            setTimeout(() => {
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        }

        function close2FAModal() {
            const modal = document.getElementById('enable2FAModal');
            const content = document.getElementById('2FAModalContent');

            // Content scale animation
            content.classList.remove('scale-100');
            content.classList.add('scale-95');

            // Hide modal after animation completes
            setTimeout(() => {
                modal.classList.remove('visible', 'opacity-100');
                modal.classList.add('invisible', 'opacity-0');
            }, 150);
        }

        // Close modal when clicking outside modal content
        document.getElementById('enable2FAModal').addEventListener('click', function(e) {
            if (e.target === this) {
                close2FAModal();
            }
        });

        // Loading animation saat klik tombol
        document.querySelectorAll('.btn-action').forEach(btn => {
            btn.addEventListener('click', function() {
                Swal.fire({
                    title: 'Loading...',
                    text: 'Mohon tunggu',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
            });
        });

        // Delete confirmation
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                let form = this.closest('form');

                Swal.fire({
                    title: 'Yakin hapus?',
                    text: "Data ini tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Mohon tunggu',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });
                        form.submit();
                    }
                })
            });
        });

        // Sweetalert sukses / error dari Laravel session
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>


@endsection
