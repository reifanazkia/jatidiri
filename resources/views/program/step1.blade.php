{{-- <!-- Step 1 Content -->
<div x-show="step === 1" x-transition>
    <form method="POST" action="{{ route('program.store') }}" enctype="multipart/form-data">
        @csrf
        <!-- Program Name -->
        <div class="w-full flex items-center gap-8 relative">
            <div class="flex flex-col w-full">
                <div class="mb-6">
                    <label class="block mb-1 text-sm font-medium">Name</label>
                    <input type="text" name="name" placeholder="Name of Program"
                        x-model="formData.name"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <!-- Assessments (Facilities) -->
                <div class="mb-6">
                    <label class="block mb-1 text-sm font-medium">Assessments</label>
                    <div class="grid grid-cols-2 space-y-2">
                        @foreach($facilities as $facility)
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="facility_id[]" value="{{ $facility->id }}"
                                x-model="formData.facility_id" class="accent-[#9A8FFF]">
                            {{ $facility->name }}
                        </label>
                        @endforeach
                    </div>z
                </div>
            </div>

            <!-- Upload Image -->
            <div class="mb-6 !w-[50%]">
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image (Max Size: 750kb)</label>
                <div class="flex justify-center items-center w-full h-60 border-2 border-dashed border-gray-300 rounded-xl bg-white cursor-pointer"
                    @click="$refs.image1.click()">
                    <template x-if="!formData.image1">
                        <div class="flex flex-col items-center text-gray-500 cursor-pointer w-full h-full justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                            </svg>
                            <span class="text-sm">Drag and drop a file here or click</span>
                        </div>
                    </template>
                    <template x-if="formData.image1">
                        <div class="relative w-full h-full">
                            <img :src="formData.image1 instanceof File ? URL.createObjectURL(formData.image1) : '{{ asset('storage') }}/'+formData.image1"
                                class="w-full h-full object-contain p-2">
                            <button type="button" @click="formData.image1 = null"
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </template>
                    <input type="file" name="image1" x-ref="image1"
                        @change="formData.image1 = $event.target.files[0]" accept="image/*"
                        class="hidden">
                    <input type="hidden" name="image1_preview" x-model="formData.image1_preview">
                </div>
            </div>
        </div>

        <!-- Age Group and Weekly Info -->
        <div class="grid grid-cols-6 gap-4 mb-6">
            <!-- Age Group -->
            <div>
                <label class="block mb-1 text-sm font-medium">Age Group (y.o)</label>
                <input type="text" name="age" placeholder="Student age range"
                    x-model="formData.age"
                    class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <!-- Weekly Meets -->
            <div>
                <label class="block mb-1 text-sm font-medium">Weekly Meets</label>
                <input type="number" name="weekly" placeholder="Number of weekly meets"
                    x-model="formData.weekly"
                    class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <!-- Meeting Duration -->
            <div>
                <label class="block mb-1 text-sm font-medium">Meeting Duration</label>
                <input type="number" name="periode" placeholder="Meeting duration in a day"
                    x-model="formData.periode"
                    class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <!-- Class Size -->
            <div>
                <label class="block mb-1 text-sm font-medium">Class Size</label>
                <input type="number" name="class_size" placeholder="Number of students"
                    x-model="formData.class_size"
                    class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <!-- YouTube and Leader Info -->
            <div class="col-span-2">
                <label class="block mb-1 text-sm font-medium">ID Youtube</label>
                <input type="text" name="id_yt" x-model="formData.id_yt"
                    class="w-full h-[50px] gap-8 border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
            </div>
        </div>

        <!-- Title Section 1 -->
        <div class="grid grid-cols-6 gap-4">
            <div class="mb-6 col-span-4">
                <label class="block mb-1 text-sm font-medium">Title Section 1</label>
                <input type="text" name="title1" x-model="formData.title1"
                    class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="col-span-2">
                <label class="block mb-1 text-sm font-medium">Program's Leader</label>
                <select name="outream_id" x-model="formData.outream_id"
                    class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="">Select Leader</option>
                    @foreach($outreams as $leader)
                    <option value="{{ $leader->id }}">{{ $leader->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Description Section 1 -->
        <div class="mb-6">
            <label class="block mb-1 text-sm font-medium">Description Section 1</label>
            <textarea name="description1" rows="4"
                x-model="formData.description1"
                class="w-full border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500"
                placeholder="Write description..."></textarea>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-end mt-8">
            <button type="submit"
                class="px-6 py-2 bg-[#9A8FFF] text-white rounded-xl hover:bg-[#8171e2] transition">
                Next
            </button>
        </div>
    </form>
</div> --}}
