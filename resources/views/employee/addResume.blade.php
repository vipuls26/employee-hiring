<x-layout>

    <x-components.header />

    <div class="mx-auto max-w-7xl px-4 py-8">
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Upload your resume</h1>
            <form action="{{ route('employee.resumeStore') }}" method="POST" enctype="multipart/form-data">

                {{-- resume --}}
                <div>
                    <label for="resume" class="block text-sm font-medium text-gray-900">
                        Upload resume
                        <span class="text-red-600">*</span>
                    </label>
                    <div class="mt-2">
                        <div class="relative w-full">
                            <i class="pi pi-file absolute p-2.5 text-gray-400"> </i>
                            <input id="resume" type="file" name="resume" value="{{ old('resume') }}"
                                placeholder="Upload resume"
                                class="block w-full rounded-md border-0 bg-white
                                pl-10 py-1.5 px-2.5 text-gray-900 shadow-sm
                                ring-1 ring-inset ring-gray-300 placeholder:text-gray-400
                                focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm" />
                        </div>
                    </div>
                    @error('resume')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Upload</button>
                </div>

            </form>
        </div>
    </div>

    <x-components.footer />
</x-layout>
