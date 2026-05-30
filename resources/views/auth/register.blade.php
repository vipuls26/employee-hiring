<x-layout title="Register Page">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">

            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Create your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="{{ route('auth.create') }}" method="POST" class="space-y-6">
                @csrf

                {{-- name --}}
                <div>
                    <label for="name" class="block text-sm/6 font-medium text-gray-900">
                        Name
                        <span class="text-red-600">*</span>
                    </label>
                    <div class="mt-2">
                        <div class="relative w-full">
                            <i class="pi pi-user absolute p-3 text-gray-400"></i>
                            <input id="name" type="text" name="name" value="{{ old('name') }}"
                                placeholder="Enter Name"
                                class="block w-full rounded-md bg-white
                                        pl-10 pr-3 py-1.5 text-base
                                        text-gray-900 outline-1 -outline-offset-1 outline-gray-300
                                        placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2
                                        focus:outline-indigo-600 sm:text-sm/6" />
                        </div>

                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- email --}}
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">
                        Email address
                        <span class="text-red-600">*</span>
                    </label>
                    <div class="mt-2">
                        <div class="relative w-full">
                            <i class="pi pi-envelope absolute p-3 text-gray-400"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                placeholder="Enter Email"
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
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Password <span
                            class="text-red-600">*</span></label>
                    <div class="mt-2">
                        <div class="relative w-full flex items-center">
                            <i class="pi pi-lock absolute left-3 text-gray-400"></i>
                            <input id="password" type="password" name="password" placeholder="Enter Password"
                                class="block w-full rounded-md bg-white pl-10 pr-10 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            <span class="absolute right-3 cursor-pointer text-gray-400 hover:text-gray-600"
                                onclick="togglePasswordVisibility('password', 'toggle-eye-password')">
                                <i id="toggle-eye-password" class="pi pi-eye"></i>
                            </span>
                        </div>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- confirm password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900"> Confirm
                        Password <span class="text-red-600">*</span> </label>
                    <div class="mt-2">
                        <div class="relative w-full flex items-center">
                            <i class="pi pi-lock absolute left-3 text-gray-400"></i>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                placeholder="Enter Confirm Password"
                                class="block w-full rounded-md bg-white pl-10 pr-10 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            <span class="absolute right-3 cursor-pointer text-gray-400 hover:text-gray-600"
                                onclick="togglePasswordVisibility('password_confirmation', 'toggle-eye-confirm')">
                                <i id="toggle-eye-confirm" class="pi pi-eye"></i>
                            </span>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role --}}
                <div>
                    <label class="block text-sm/6 font-medium text-gray-900">
                        Role <span class="text-red-600">*</span>
                    </label>

                    <fieldset class="mt-2 space-y-4">
                        <div class="flex items-center">
                            <input id="employee" name="role" type="radio" value="employee"
                                @checked(old('role') == 'employee') class="role-radio h-4 w-4 border-gray-300 text-indigo-600">
                            <label for="employee" class="ml-3 text-sm font-medium text-gray-700">
                                Employee
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="HR" name="role" type="radio" value="HR"
                                @checked(old('role') == 'HR') class="role-radio h-4 w-4 border-gray-300 text-indigo-600">
                            <label for="HR" class="ml-3 text-sm font-medium text-gray-700">
                                HR
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="Manager" name="role" type="radio" value="Manager"
                                @checked(old('role') == 'Manager') class="role-radio h-4 w-4 border-gray-300 text-indigo-600">
                            <label for="Manager" class="ml-3 text-sm font-medium text-gray-700">
                                Manager
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="Owner" name="role" type="radio" value="Owner"
                                @checked(old('role') == 'Owner') class="role-radio h-4 w-4 border-gray-300 text-indigo-600">
                            <label for="Owner" class="ml-3 text-sm font-medium text-gray-700">
                                Owner
                            </label>
                        </div>
                    </fieldset>

                    @error('role')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Company --}}
                <div id="company-selection" class="{{ in_array(old('role'), ['HR', 'Manager']) ? '' : 'hidden' }}">

                    <label for="company_id" class="block text-sm/6 font-medium text-gray-900">
                        Company <span class="text-red-600">*</span>
                    </label>

                    <div class="mt-2">
                        <select id="company_id" name="company_id" class="block w-full rounded-md border-gray-300">

                            <option value="">Select Company</option>

                            {{-- HR Companies --}}
                            @foreach ($hrCompanies as $company)
                                <option value="{{ $company->id }}" data-role="HR" @selected(old('company_id') == $company->id)>
                                    {{ $company->name }}
                                </option>
                            @endforeach

                            {{-- Manager Companies --}}
                            @foreach ($managerCompanies as $company)
                                <option value="{{ $company->id }}" data-role="Manager" @selected(old('company_id') == $company->id)>
                                    {{ $company->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    @error('company_id')
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
                <a href="{{ route('auth.login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign
                    in</a>
            </p>
        </div>
    </div>

</x-layout>


<script>
    function togglePasswordVisibility(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const eyeIcon = document.getElementById(iconId);

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.className = "pi pi-eye-slash";
        } else {
            passwordInput.type = "password";
            eyeIcon.className = "pi pi-eye";
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const roleRadios = document.querySelectorAll('.role-radio');
        const companySection = document.getElementById('company-selection');
        const companySelect = document.getElementById('company_id');
        const companyOptions = companySelect.querySelectorAll('option[data-role]');

        function updateCompanies() {
            const selectedRole = document.querySelector(
                'input[name="role"]:checked'
            )?.value;

            if (selectedRole === 'HR' || selectedRole === 'Manager') {
                companySection.classList.remove('hidden');

                companyOptions.forEach(option => {
                    option.hidden = option.dataset.role !== selectedRole;
                });

                const selectedOption = companySelect.selectedOptions[0];

                if (
                    selectedOption &&
                    selectedOption.dataset.role &&
                    selectedOption.dataset.role !== selectedRole
                ) {
                    companySelect.value = '';
                }
            } else {
                companySection.classList.add('hidden');
                companySelect.value = '';
            }
        }

        roleRadios.forEach(radio => {
            radio.addEventListener('change', updateCompanies);
        });

        updateCompanies();
    });
</script>
