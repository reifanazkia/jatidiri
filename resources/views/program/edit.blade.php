@extends('layouts.app')

@section('page_title', 'Edit Program')

@section('content')
    <div class="max-w-full min-h-screen mx-auto" x-data="{
        step: 1,
        formData: {
            // Step 1 Fields
            name: '{{ $program->name }}',
            facility_id: {!! json_encode($program->facility_id ?? []) !!},
            age: '{{ $program->age }}',
            weekly: '{{ $program->weekly }}',
            periode: '{{ $program->periode }}',
            class_size: '{{ $program->class_size }}',
            title1: '{{ $program->title1 }}',
            description1: '{!! $program->description1 !!}',
            id_yt: '{{ $program->id_yt }}',
            ourteam_id: '{{ $program->ourteam_id }}',
            category: '{{ $program->category }}',

            // Step 2 Fields
            supporting: {!! json_encode($program->supporting ?? []) !!},
            title2: '{{ $program->title2 }}',
            description2: '{!! $program->description2 !!}',
            title3: '{{ $program->title3 }}',
            description3: '{!! $program->description3 !!}',

            // Step 3 Fields
            title4: '{{ $program->title4 }}',
            description4: '{!! $program->description4 !!}',
            content: '{!! $program->content !!}',
            cta: '{{ $program->cta ?? 'Call to Action' }}',
            link_program: '{{ $program->link_program }}',
            brosur: '',

            // Images
            image1: '{{ $program->image1 ? asset('storage/' . $program->image1) : null }}',
            image2: '{{ $program->image2 ? asset('storage/' . $program->image2) : null }}',
            image3: '{{ $program->image3 ? asset('storage/' . $program->image3) : null }}',
            image4: '{{ $program->image4 ? asset('storage/' . $program->image4) : null }}',
            existing_brosur: '{{ $program->brosur ? asset('storage/' . $program->brosur) : null }}'
        },
        nextStep() {
            if (this.step < 3) {
                this.step++;
            }
        },
        prevStep() {
            if (this.step > 1) {
                this.step--;
            }
        }
    }">
        <div class="bg-white rounded-[24px] shadow-md p-[32px]">
            <h2 class="text-[20px] font-semibold mb-8">Edit Program</h2>

            <div class="flex items-center justify-center gap-8 mb-[32px]">
                <!-- Step 1 -->
                <div class="w-6 h-6 flex items-center justify-center rounded-full"
                    :class="{
                        'bg-[#3030F8] text-white': step > 1,
                        'border border-[#3030F8] text-[#3030F8]': step === 1,
                        'border border-[#C2C2C2] text-[#C2C2C2]': step < 1
                    }">
                    1
                </div>
                <div class="h-px w-24" :class="step > 1 ? 'bg-[#3030F8]' : 'bg-[#C2C2C2]'"></div>

                <!-- Step 2 -->
                <div class="w-6 h-6 flex items-center justify-center rounded-full"
                    :class="{
                        'bg-[#3030F8] text-white': step > 2,
                        'border border-[#3030F8] text-[#3030F8]': step === 2,
                        'border border-[#C2C2C2] text-[#C2C2C2]': step < 2
                    }">
                    2
                </div>
                <div class="h-px w-24" :class="step > 2 ? 'bg-[#3030F8]' : 'bg-[#C2C2C2]'"></div>

                <!-- Step 3 -->
                <div class="w-6 h-6 flex items-center justify-center rounded-full"
                    :class="{
                        'bg-[#3030F8] text-white': step > 3,
                        'border border-[#3030F8] text-[#3030F8]': step === 3,
                        'border border-[#C2C2C2] text-[#C2C2C2]': step < 3
                    }">
                    3
                </div>
            </div>

            <form action="{{ route('program.update', $program->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Step 1 Content -->
                <div x-show="step === 1" x-transition>
                    <!-- Program Name -->
                    <div class="w-full flex items-center gap-8 relative">
                        <div class="flex flex-col w-full">
                            <div class="mb-6">
                                <label class="block mb-1 text-sm font-medium">Name</label>
                                <input type="text" name="name" placeholder="Name of Program" x-model="formData.name"
                                    required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <!-- Assessment -->
                            <div class="mb-6">
                                <label class="block mb-1 text-sm font-medium">Assessment</label>
                                <div class="grid grid-cols-2 space-y-2">
                                    @foreach ($facilities as $facility)
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" name="facility_id[]" value="{{ $facility->id }}"
                                                @checked(in_array($facility->id, (array) json_decode($program->facility_id ?? '[]'))) class="accent-[#9A8FFF]">
                                            {{ $facility->name }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Upload Image -->
                        <div class="mb-6 !w-[50%]">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image (Max Size:
                                750kb)</label>
                            <div class="flex justify-center items-center w-full h-60 border-2 border-dashed border-gray-300 rounded-xl bg-white cursor-pointer"
                                @click="$refs.image1.click()">
                                <template x-if="!formData.image1">
                                    <div
                                        class="flex flex-col items-center text-gray-500 cursor-pointer w-full h-full justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                        </svg>
                                        <span class="text-sm">Drag and drop a file here or click</span>
                                    </div>
                                </template>
                                <template x-if="formData.image1">
                                    <div class="relative w-full h-full">
                                        <img :src="formData.image1 instanceof File ? URL.createObjectURL(formData.image1) :
                                            formData.image1"
                                            class="w-full h-full object-contain p-2">
                                        <button type="button" @click="formData.image1 = null"
                                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                                <input type="file" name="image1" x-ref="image1"
                                    @change="formData.image1 = $event.target.files[0]" accept="image/*" class="hidden">
                            </div>
                        </div>
                    </div>

                    <!-- Age Group and Weekly Info -->
                    <div class="grid grid-cols-6 gap-4 mb-6">
                        <!-- Age Group -->
                        <div>
                            <label class="block mb-1 text-sm font-medium">Age Group (y.o)</label>
                            <input type="text" name="age" placeholder="Student age range" x-model="formData.age"
                                required
                                class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                        </div>

                        <!-- Weekly Meets -->
                        <div>
                            <label class="block mb-1 text-sm font-medium">Weekly Meets</label>
                            <input type="number" name="weekly" placeholder="Number of weekly meets"
                                x-model="formData.weekly" required
                                class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                        </div>

                        <!-- Meeting Duration -->
                        <div>
                            <label class="block mb-1 text-sm font-medium">Meeting Duration</label>
                            <input type="number" name="periode" placeholder="Meeting duration in a day"
                                x-model="formData.periode" required
                                class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                        </div>

                        <!-- Class Size -->
                        <div>
                            <label class="block mb-1 text-sm font-medium">Class Size</label>
                            <input type="number" name="class_size" placeholder="Number of students"
                                x-model="formData.class_size" required
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
                            <select name="ourteam_id" x-model="formData.ourteam_id"
                                class="w-full h-[50px] border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                                @foreach ($outreams as $outream)
                                    <option value="{{ $outream->id }}"
                                        :selected="formData.ourteam_id == {{ $outream->id }}">{{ $outream->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Description Section 1 -->
                    <div class="mb-6">
                        <label class="block mb-1 text-sm font-medium">Description Section 1</label>
                        <textarea name="description1" id="description1" rows="4"
                            class="w-full border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500"
                            placeholder="Write description...">{!! $program->description1 !!}</textarea>
                    </div>


                    <!-- Navigation Buttons -->
                    <div class="flex justify-end mt-8">
                        <button type="button" @click="nextStep()"
                            class="px-6 py-2 bg-[#9A8FFF] text-white rounded-xl hover:bg-[#8171e2] transition">
                            Next
                        </button>
                    </div>
                </div>

                <!-- Step 2 Content -->
                <div x-show="step === 2" x-transition>
                    <!-- Supporting By -->
                    <div class="grid grid-cols-2">
                        <p class="mt-[32px]text-[14px] text-gray-500 mb-2">Supporting By</p>
                        @foreach (['Kabid SMK Disdik Jabar', 'Walikota Cimahi', 'Rektor IKIP Siliwangi', 'ketua HIMPSI', 'Ketua DPRD Kota Cimahi', 'Dewan Pakar'] as $supporter)
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="supporting[]" value="{{ $supporter }}"
                                    @checked(in_array($supporter, (array) json_decode($program->supporting ?? '[]'))) class="accent-[#9A8FFF]">
                                {{ $supporter }}
                            </label>
                        @endforeach
                    </div>

                    <!-- Section 2 -->
                    <div class="grid grid-cols-2 w-full gap-8 mb-8 items-center">
                        <div class="w-full">
                            <div class="mb-6">
                                <label class="block mb-1 text-sm font-medium">Title Section 2</label>
                                <input type="text" name="title2" placeholder="Title Section 2"
                                    x-model="formData.title2" required
                                    class="w-full border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <!-- Description Section 1 -->
                            <div class="mb-6">
                                <label class="block mb-1 text-sm font-medium">Description Section 2</label>
                                <textarea name="description2" id="description2" rows="4"
                                    class="w-full border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500"
                                    placeholder="Write description...">{!! $program->description2 !!}</textarea>
                            </div>

                        </div>

                        <!-- Upload Image Section 2 -->
                        <div class="w-full">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image (Max Size:
                                750kb)</label>
                            <div class="flex justify-center items-center w-full h-60 border-2 border-dashed border-gray-300 rounded-xl bg-white cursor-pointer"
                                @click="$refs.image2.click()">
                                <template x-if="!formData.image2">
                                    <div
                                        class="flex flex-col items-center text-gray-500 cursor-pointer w-full h-full justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                        </svg>
                                        <span class="text-sm">Drag and drop a file here or click</span>
                                    </div>
                                </template>
                                <template x-if="formData.image2">
                                    <div class="relative w-full h-full">
                                        <img :src="formData.image2 instanceof File ? URL.createObjectURL(formData.image2) :
                                            formData.image2"
                                            class="w-full h-full object-contain p-2">
                                        <button type="button" @click="formData.image2 = null"
                                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                                <input type="file" name="image2" x-ref="image2"
                                    @change="formData.image2 = $event.target.files[0]" accept="image/*" class="hidden">
                            </div>
                        </div>
                    </div>

                    <!-- Section 3 -->
                    <div class="grid grid-cols-2 w-full gap-8 mb-8">
                        <div class="w-full">
                            <div class="mb-6">
                                <label class="block mb-1 text-sm font-medium">Title Section 3</label>
                                <input type="text" name="title3" placeholder="Title Section 3"
                                    x-model="formData.title3" required
                                    class="w-full border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <!-- Description Section 1 -->
                            <div class="mb-6">
                                <label class="block mb-1 text-sm font-medium">Description Section 3</label>
                                <textarea name="description3" id="description3" rows="4"
                                    class="w-full border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500"
                                    placeholder="Write description...">{!! $program->description3 !!}</textarea>
                            </div>

                        </div>

                        <!-- Upload Image Section 3 -->
                        <div class="w-full">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image (Max Size:
                                750kb)</label>
                            <div class="flex justify-center items-center w-full h-60 border-2 border-dashed border-gray-300 rounded-xl bg-white cursor-pointer"
                                @click="$refs.image3.click()">
                                <template x-if="!formData.image3">
                                    <div
                                        class="flex flex-col items-center text-gray-500 cursor-pointer w-full h-full justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                        </svg>
                                        <span class="text-sm">Drag and drop a file here or click</span>
                                    </div>
                                </template>
                                <template x-if="formData.image3">
                                    <div class="relative w-full h-full">
                                        <img :src="formData.image3 instanceof File ? URL.createObjectURL(formData.image3) :
                                            formData.image3"
                                            class="w-full h-full object-contain p-2">
                                        <button type="button" @click="formData.image3 = null"
                                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                                <input type="file" name="image3" x-ref="image3"
                                    @change="formData.image3 = $event.target.files[0]" accept="image/*" class="hidden">
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-8">
                        <button type="button" @click="prevStep()"
                            class="px-6 py-2 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition">
                            Previous
                        </button>
                        <button type="button" @click="nextStep()"
                            class="px-6 py-2 bg-[#9A8FFF] text-white rounded-xl hover:bg-[#8171e2] transition">
                            Next
                        </button>
                    </div>
                </div>

                <!-- Step 3 Content -->
                <div x-show="step === 3" x-transition>
                    <!-- Section 4 -->
                    <div class="flex justify-between w-full gap-4 mb-8">
                        <div class="w-1/2">
                            <div class="mb-6">
                                <label class="block mb-1 text-sm font-medium">Title Section 4</label>
                                <input type="text" name="title4" placeholder="Title Section 4"
                                    x-model="formData.title4" required
                                    class="w-full border rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <!-- Description Section 1 -->
                            <div class="mb-6">
                                <label class="block mb-1 text-sm font-medium">Description Section 4</label>
                                <textarea name="description4" id="description4" rows="4"
                                    class="w-full border border-gray-300 rounded-sm px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500"
                                    placeholder="Write description...">{!! $program->description4 !!}</textarea>
                            </div>

                        </div>

                        <!-- Upload Image Section 4 -->
                        <div class="w-1/2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image (Max Size:
                                750kb)</label>
                            <div class="flex justify-center items-center w-full h-60 border-2 border-dashed border-gray-300 rounded-xl bg-white cursor-pointer"
                                @click="$refs.image4.click()">
                                <template x-if="!formData.image4">
                                    <div
                                        class="flex flex-col items-center text-gray-500 cursor-pointer w-full h-full justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 16.5V9.75m0 0l3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                        </svg>
                                        <span class="text-sm">Drag and drop a file here or click</span>
                                    </div>
                                </template>
                                <template x-if="formData.image4">
                                    <div class="relative w-full h-full">
                                        <img :src="formData.image4 instanceof File ? URL.createObjectURL(formData.image4) :
                                            formData.image4"
                                            class="w-full h-full object-contain p-2">
                                        <button type="button" @click="formData.image4 = null"
                                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                                <input type="file" name="image4" x-ref="image4"
                                    @change="formData.image4 = $event.target.files[0]" accept="image/*" class="hidden">
                            </div>
                        </div>
                    </div>

                    <!-- CTA Section -->
                    <div class="mb-6">
                        <label class="block mb-1 text-sm font-medium">CTA Description</label>
                        <textarea name="content" rows="4" x-model="formData.content"
                            class="w-full border rounded-lg px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500"
                            placeholder="Write CTA description..."></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-1 text-sm font-medium">CTA Button Text</label>
                        <input type="text" name="cta" placeholder="Call to Action" x-model="formData.cta"
                            class="w-full border rounded-lg px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block mb-1 text-sm font-medium">Link CTA</label>
                            <input type="text" name="link_program" placeholder="Link Call to Action"
                                x-model="formData.link_program"
                                class="w-full border rounded-lg px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium">Link Brochure</label>
                            <div class="flex items-center gap-2">
                                <template x-if="formData.existing_brosur">
                                    <a :href="formData.existing_brosur" target="_blank"
                                        class="text-blue-500 text-sm">View Current Brochure</a>
                                </template>
                                <input type="file" name="brosur" placeholder="Link untuk brosur"
                                    @change="formData.brosur = $event.target.files[0]"
                                    class="w-full border rounded-lg px-4 py-2 text-sm outline-none focus:ring-1 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-8">
                        <button type="button" @click="prevStep()"
                            class="px-6 py-2 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition">
                            Previous
                        </button>
                        <button type="submit"
                            class="px-6 py-2 bg-[#9A8FFF] text-white rounded-xl hover:bg-[#8171e2] transition">
                            Update Program
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#description1'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#description2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#description3'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#description4'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
