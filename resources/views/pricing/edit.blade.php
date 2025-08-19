@extends('layouts.app')

@section('page_title', 'Pricings')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="bg-white rounded-[24px] shadow-md p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-8">Edit Pricing</h1>

            <form method="POST" action="{{ route('pricing.update', $pricing->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div>
                        <label for="program_id" class="block text-sm font-medium text-gray-700 mb-1">Program</label>
                        <select id="program_id" name="program_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ $pricing->program_id == $program->id ? 'selected' : '' }}>
                                    {{ $program->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $pricing->title) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Price (Rp)</label>
                        <input type="number" name="price" value="{{ old('price', $pricing->price) }}" placeholder="Enter price"
                            class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium">Discount (%)</label>
                        <input type="number" name="diskon" min="0" max="100" value="{{ old('diskon', $pricing->diskon) }}" placeholder="Enter discount"
                            class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $pricing->description) }}</textarea>
                </div>

                <button type="submit"
                    class="bg-[#5050F8] hover:bg-[#3030F8] text-white font-semibold px-6 py-3 rounded-lg shadow-md">
                    Update
                </button>

            </form>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection