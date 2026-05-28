<x-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">

            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="{{ route('auth.create') }}" method="POST" class="space-y-6">
                @csrf

                {{-- name --}}
                <div>
                    <label for="name" class="block text-sm/6 font-medium text-gray-900">Name <span class="text-red-600">*</span> </label>
                    <div class="mt-2">
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- email --}}
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address <span class="text-red-600">*</span></label>
                    <div class="mt-2">
                        <input id="email" type="email" name="email"
                            value="{{ old('email') }}"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- password --}}
                <div>
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Password <span class="text-red-600">*</span></label>
                    <div class="mt-2">
                        <input id="password" type="password" name="password"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- confirm password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900">Confirm
                        Password <span class="text-red-600">*</span></label>
                    <div class="mt-2">
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            autocomplete="new-password"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    </div>
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- role --}}
                <div>
                    <label for="role" class="block text-sm/6 font-medium text-gray-900">Role <span class="text-red-600">*</span></label>
                    <fieldset class="mt-2 space-y-4">
                        <legend class="sr-only">Select your role</legend>
                        <div class="flex items-center">
                            <input id="employee" name="role" type="radio" value="employee"
                                @checked(old('role') == 'employee')
                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="employee" class="ml-3 block text-sm font-medium text-gray-700">Employee</label>
                        </div>
                        <div class="flex items-center">
                            <input id="HR" name="role" type="radio" value="HR"
                                @checked(old('role') == 'HR')
                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="HR" class="ml-3 block text-sm font-medium text-gray-700">Hr</label>
                        </div>
                        <div class="flex items-center">
                            <input id="Manager" name="role" type="radio" value="Manager"
                                @checked(old('role') == 'Manager')
                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="Manager" class="ml-3 block text-sm font-medium text-gray-700">Manager</label>
                        </div>
                        <div class="flex items-center">
                            <input id="Owner" name="role" type="radio" value="Owner"
                                @checked(old('role') == 'Owner')
                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="Owner" class="ml-3 block text-sm font-medium text-gray-700">Owner</label>
                        </div>
                    </fieldset>
                    @error('role')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
                </div>
            </form>


            <p class="mt-10 text-center text-sm/6 text-gray-500">
                Already have account?
                <a href="/" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign in</a>
            </p>
        </div>
    </div>

</x-layout>
