@extends('layouts.app')

@section('page_title', 'Data & Values')

@section('content')
    <div class="max-w-full bg-white rounded-[24px] mx-auto p-[32px]">
        <h1 class="text-[24px] font-bold mb-6 text-left">Edit</h1>

        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
            @push('scripts')
                <script>
                    Swal.fire({
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                </script>
            @endpush
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @push('scripts')
                <script>
                    Swal.fire({
                        title: 'Error!',
                        html: `@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach`,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                </script>
            @endpush
        @endif

        <form method="POST" action="{{ route('svg.update', $data->id) }}" id="editForm">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-4 grid-rows-2 gap-8 mb-8">
                @for ($i = 1; $i <= 4; $i++)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title Data {{ $i }}</label>
                        <input type="text" name="title{{ $i }}"
                            value="{{ old('title' . $i, $data->{'title' . $i}) ?? '' }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                @endfor

                @for ($i = 1; $i <= 4; $i++)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Data {{ $i }}</label>
                        <input type="text" name="data{{ $i }}"
                            value="{{ old('data' . $i, $data->{'data' . $i}) ?? '' }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                @endfor
            </div>

            <!-- Values Section -->
            <div class="mb-10">
                <h2 class="text-lg font-bold mb-4">Values</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    @for ($i = 1; $i <= 6; $i++)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Value {{ $i }}</label>
                            <input type="text" name="value{{ $i }}"
                                value="{{ old('value' . $i, $data->{'value' . $i}) ?? '' }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    @endfor
                </div>
            </div>

            <div class="flex justify-start">
                <button type="submit"
                    class="mt-4 px-6 py-2 rounded-full bg-indigo-500 text-white text-sm hover:bg-indigo-600 transition">
                    Update
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Confirm before submitting form
            document.getElementById('editForm').addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You're about to update this data.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form
                        this.submit();
                    }
                });
            });

            // Check if there's a success message and reload the page to show updated data
            @if (session('success'))
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            @endif
        </script>
    @endpush
@endsection
