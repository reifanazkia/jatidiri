{{-- @extends('layouts.app')

@section('page_title', 'Program - Step 2')

@section('content')
<div class="bg-white rounded-[24px] shadow-md p-[32px]">
    <h2 class="text-[20px] font-semibold mb-8">Step 2 - Supporting & Section 2-3</h2>

    <form action="{{ route('program.step2.update', $program->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <!-- Supporting By -->
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium">Supporting By</label>
            <div class="grid grid-cols-2 gap-2">
                @foreach(['Kabid SMK Disdik Jabar','Walikota Cimahi','Rektor IKIP Siliwangi','Ketua HIMPSI','Ketua DPRD Kota Cimahi','Dewan Pakar'] as $sup)
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="supporting[]" value="{{ $sup }}">
                    {{ $sup }}
                </label>
                @endforeach
            </div>
        </div>

        <!-- Section 2 -->
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium">Title Section 2</label>
            <input type="text" name="title2" class="w-full border px-4 py-2 rounded-lg">
        </div>
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium">Description Section 2</label>
            <textarea name="description2" id="description2" rows="4" class="w-full border rounded-lg"></textarea>
        </div>
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium">Image 2</label>
            <input type="file" name="image2" class="w-full border px-4 py-2 rounded-lg">
        </div>

        <!-- Section 3 -->
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium">Title Section 3</label>
            <input type="text" name="title3" class="w-full border px-4 py-2 rounded-lg">
        </div>
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium">Description Section 3</label>
            <textarea name="description3" id="description3" rows="4" class="w-full border rounded-lg"></textarea>
        </div>
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium">Image 3</label>
            <input type="file" name="image3" class="w-full border px-4 py-2 rounded-lg">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('program.create') }}" class="px-6 py-2 border rounded-lg">Previous</a>
            <button type="submit" class="px-6 py-2 bg-[#9A8FFF] text-white rounded-lg">Next</button>
        </div>
    </form>
</div>
@endsection --}}
