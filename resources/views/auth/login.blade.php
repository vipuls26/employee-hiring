<x-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">

            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-indigo-500">Sign in</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="{{ route('auth.login') }}" method="POST" class="space-y-6">
                @csrf
                {{-- email --}}
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">
                        Email address
                        <span class="text-red-600">*</span>
                    </label>
                    <div class="mt-2">
                        <div class="relative w-full">
                            <i class="pi pi-envelope absolute p-3 text-gray-400"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email"
                                class="block w-full rounded-md bg-white
                                        pl-10 pr-3 py-1.5 text-base
                                        text-gray-900 outline-1 -outline-offset-1 outline-gray-300
                                        placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2
                                        focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- password --}}
                <div>
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">
                        Password
                        <span class="text-red-600">*</span>
                    </label>
                    <div class="mt-2">
                        <div class="relative w-full">
                            <i class="pi pi-lock absolute p-3 text-gray-400"></i>
                        </div>
                        <input id="password" type="password" name="password" placeholder="Enter Password"
                            class="block w-full rounded-md bg-white
                                        pl-10 pr-3 py-1.5 text-base
                                        text-gray-900 outline-1 -outline-offset-1 outline-gray-300
                                        placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2
                                        focus:outline-indigo-600 sm:text-sm/6" />
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Login</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm/6 text-gray-500">
                Don't have account?
                <a href="{{ route('auth.register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign up</a>
            </p>
        </div>
    </div>

</x-layout>
