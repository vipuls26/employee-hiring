<x-layout title="Register Company">

    <x-header />

    <div class="flex min-h-screen items-center justify-center bg-gray-50 px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8 bg-white p-8 rounded-xl shadow-md border border-gray-100">
            <div>
                <h2 class="text-center text-3xl font-bold tracking-tight text-indigo-500">Register Company</h2>
            </div>

            <form action="{{ route('owner.registerCompany') }}" method="POST" class="mt-8 space-y-4">
                @csrf

                {{-- company name --}}
                <div>
                    <label for="name" class="block text-sm/6 font-medium text-gray-900">
                        Company Name <span class="text-red-600">*</span>
                    </label>
                    <div class="mt-2">
                        <div class="relative w-full">
                            <i class="pi pi-building absolute text-gray-400 p-2.5"></i>
                            <input id="name" type="text" name="name" value="{{ old('name') }}"
                                placeholder="Enter Company Name"
                                class="block w-full rounded-md border-0 bg-white
                                pl-10 pr-3 py-1.5
                                text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400
                                focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm" />
                        </div>

                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- company email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900">
                        Email address <span class="text-red-600">*</span>
                    </label>
                    <div class="mt-2">
                        <div class="relative w-full">
                            <i class="pi pi-envelope absolute p-2.5 text-gray-400"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                placeholder="Enter Company Email"
                                class="block w-full rounded-md border-0 bg-white
                                pl-10 pr-3 py-1.5
                                text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400
                                focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm" />
                        </div>
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- phone number --}}
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-900">
                        Phone Number <span class="text-red-600">*</span>
                    </label>
                    <div class="mt-2">
                        <div class="relative w-full">
                            <i class="pi pi-phone absolute p-2.5 text-gray-400"></i>
                            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}"
                                placeholder="Enter Phone Number"
                                class="block w-full rounded-md border-0 bg-white
                                pl-10 pr-3 py-1.5
                                text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400
                                focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm" />
                        </div>
                    </div>
                    @error('phone')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- website --}}
                <div>
                    <label for="website" class="block text-sm font-medium text-gray-700">
                        Website <span class="text-red-600">*</span>
                    </label>
                    <div class="mt-2">
                        <div class="relative w-full">
                            <i class="pi pi-link absolute p-2.5 text-gray-400"></i>
                            <input id="website" type="url" name="website" value="{{ old('website') }}"
                                placeholder="Enter Company Website"
                                class="block w-full rounded-md border-0 bg-white
                                pl-10 pr-3 py-1.5 text-gray-900 shadow-sm
                                ring-1 ring-inset ring-gray-300 placeholder:text-gray-400
                                focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm" />
                        </div>
                    </div>
                    @error('website')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- location --}}
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">
                        Location <span class="text-red-600">*</span>
                    </label>
                    <div class="mt-2">
                        <div class="relative w-full">
                            <i class="pi pi-map-marker absolute p-2.5 text-gray-400"></i>
                            <input id="location" type="text" name="location" value="{{ old('location') }}"
                                placeholder="Enter Company Location"
                                class="block w-full rounded-md border-0 bg-white
                                pl-10 px-3 py-1.5 text-gray-900 shadow-sm ring-1
                                ring-inset ring-gray-300 placeholder:text-gray-400
                                focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm" />
                        </div>
                    </div>
                    @error('location')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">
                        Description <span class="text-red-600">*</span>
                    </label>
                    <div class="mt-2">
                        <div class="relative w-full">
                            <i class="pi pi-tags absolute p-2.5 text-gray-400"></i>
                            <textarea id="description" name="description" rows="3" placeholder="Enter Company Description"
                                class="block w-full rounded-md border-0 bg-white  pl-10 py-1.5 px-3
                                text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                                placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                                focus:ring-indigo-600 sm:text-sm">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2 pb-10">
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
                </div>
            </form>
        </div>
    </div>

    <x-footer />
</x-layout>
