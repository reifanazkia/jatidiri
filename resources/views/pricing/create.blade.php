@extends('layouts.app')

@section('page_title', 'Pricings')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white rounded-[24px] shadow-md p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-8">Add Pricing</h1>

            <form method="POST" action="{{ route('pricing.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div>
                        <label for="program_id" class="block text-sm font-medium text-gray-700 mb-1">Program</label>
                        <select id="program_id" name="program_id" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}">{{ $program->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title*</label>
                        <input type="text" id="title" name="title" required maxlength="255"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Price (Rp)*</label>
                        <input type="number" name="price" required placeholder="Enter price"
                            class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Discount (%)</label>
                        <input type="number" name="diskon" min="0" max="100" placeholder="Enter discount"
                            class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Description -->
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="6"
                            class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-purple-500 focus:border-purple-500"></textarea>
                    </div>

                <div class="flex text-left">
                    <button type="submit"
                        class="bg-[#5050F8] hover:bg-[#3030F8] text-white font-semibold px-6 py-3 rounded-lg shadow-md">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- CKEditor -->
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection