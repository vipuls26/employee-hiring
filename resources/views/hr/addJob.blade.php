<x-layout>

    <x-components.header />

    <div class="flex min-h-screen items-center justify-center bg-gray-50 px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8 bg-white p-8 rounded-xl shadow-md border border-gray-100">
            <div>
                <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900">Add Job Application</h2>
            </div>

            @if (session('error'))
                <div class="rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('hr.createJob') }}" method="POST" class="mt-8 space-y-4">
                @csrf

                {{-- job name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Job Name <span class="text-red-600">*</span></label>
                    <div class="mt-1">
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                            class="block w-full rounded-md border-0 bg-white py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm" />
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- slary email --}}
                <div>
                    <label for="salary" class="block text-sm font-medium text-gray-700">Salary <span class="text-red-600">*</span></label>
                    <div class="mt-1">
                        <input id="salary" type="number" name="salary" value="{{ old('salary') }}"
                            class="block w-full rounded-md border-0 bg-white py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm" />
                    </div>
                    @error('salary')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- job type --}}
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Job Type <span class="text-red-600">*</span></label>
                    <div class="mt-1">
                        <select id="type" name="type"
                            class="block w-full rounded-md border-0 bg-white py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                            <option value="full-time" {{ old('type') == 'full-time' ? 'selected' : '' }}>Full-time
                            </option>
                            <option value="part-time" {{ old('type') == 'part-time' ? 'selected' : '' }}>Part-time
                            </option>
                            <option value="hybrid" {{ old('type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                            <option value="internship" {{ old('type') == 'internship' ? 'selected' : '' }}>
                                Internship</option>
                        </select>
                    </div>
                    @error('type')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <div class="pt-2">
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add
                        job</button>
                </div>
            </form>
        </div>
    </div>

    <x-components.footer />
</x-layout>

