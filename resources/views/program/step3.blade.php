{{-- @extends('layouts.app')

@section('page_title', 'Program - Step 3')

@section('content')
<div class="bg-white rounded-[24px] shadow-md p-[32px]">
    <h2 class="text-[20px] font-semibold mb-8">Step 3 - Section 4 & CTA</h2>

    <form action="{{ route('program.step3.update', $program->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <!-- Section 4 -->
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium">Title Section 4</label>
            <input type="text" name="title4" class="w-full border px-4 py-2 rounded-lg">
        </div>
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium">Description Section 4</label>
            <textarea name="description4" id="description4" rows="4" class="w-full border rounded-lg"></textarea>
        </div>
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium">Image 4</label>
            <input type="file" name="image4" class="w-full border px-4 py-2 rounded-lg">
        </div>

        <!-- CTA -->
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium">CTA Content</label>
            <textarea name="content" rows="4" class="w-full border rounded-lg"></textarea>
        </div>
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium">CTA Button Text</label>
            <input type="text" name="cta" value="Call to Action" class="w-full border px-4 py-2 rounded-lg">
        </div>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block mb-1 text-sm font-medium">Link CTA</label>
                <input type="text" name="link_program" class="w-full border px-4 py-2 rounded-lg">
            </div>
            <div>
                <label class="block mb-1 text-sm font-medium">Upload Brochure</label>
                <input type="file" name="brosur" class="w-full border px-4 py-2 rounded-lg">
            </div>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('program.step2', $program->id) }}" class="px-6 py-2 border rounded-lg">Previous</a>
            <button type="submit" class="px-6 py-2 bg-[#9A8FFF] text-white rounded-lg">Finish</button>
        </div>
    </form>
</div>
@endsection --}}
