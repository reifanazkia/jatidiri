@extends('layouts.app')

@section('page_title', 'Statistik')

@section('content')
    <div class="max-w-full mx-auto p-[32px] bg-white rounded-[24px] shadow-md">
        <h1 class="text-xl font-semibold mb-6">Add</h1>

        <form action="{{ route('statistik.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Pengguna -->
                <div>
                    <label for="pengguna" class="block mb-1 text-sm font-medium text-gray-700">
                        PENGGUNA <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="pengguna" id="pengguna" placeholder="Jumlah Pengguna"
                        required
                        class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <!-- Assesmen -->
                <div>
                    <label for="assesmen" class="block mb-1 text-sm font-medium text-gray-700">
                        ASSESMENT <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="assesmen" id="assesmen" placeholder="Jumlah Assesmen"
                        required
                        class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <!-- Psikologi -->
                <div>
                    <label for="psikologi" class="block mb-1 text-sm font-medium text-gray-700">
                        PSIKOLOGI <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="psikologi" id="psikologi" placeholder="Jumlah Psikologi"
                        required
                        class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <!-- Konselor -->
                <div>
                    <label for="konsoler" class="block mb-1 text-sm font-medium text-gray-700">
                        KONSELOR <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="konsoler" id="konsoler" placeholder="Jumlah Konselor"
                        required
                        class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                </div>
            </div>

            <!-- Save Button -->
            <div>
                <button type="submit"
                    class="bg-blue-500 cursor-pointer hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-full shadow-md transition duration-200">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
