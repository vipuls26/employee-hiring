<x-layout>

    <x-components.header />
    <form action="{{ route('employee.resumeStore') }}" method="POST" enctype="multipart/form-data">

        {{-- resume --}}
        <div>
            <label for="resume" class="block text-sm font-medium text-gray-700">Upload resume <span
                    class="text-red-600">*</span></label>
            <div class="mt-1">
                <input id="resume" type="file" name="resume" value="{{ old('resume') }}"
                    class="block w-full rounded-md border-0 bg-white py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm" />
            </div>
            @error('resume')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-2">
            <button type="submit"
                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
        </div>

    </form>

    <x-components.footer />
</x-layout>
