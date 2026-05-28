<x-layout>

    <x-components.header />

    <div class="flex min-h-screen items-center justify-center bg-gray-50 px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8 bg-white p-8 rounded-xl shadow-md border border-gray-100">
            <div>
                <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900">Edit Job</h2>
            </div>

            <form action="{{ route('hr.job.update', $job->id) }}" method="POST" class="mt-8 space-y-4">
                @csrf
                @method('PUT')

                {{-- job name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Job Name
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-2">
                        <div class="relative w-full">
                            <i class="pi pi-briefcase absolute p-2.5 text-gray-400"></i>
                            <input id="name" type="text" name="name" value="{{ old('name', $job->name ?? '') }}"
                                placeholder="Enter Job Name"
                                class="block w-full rounded-md border-0 bg-white
                                pl-10 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm" />
                        </div>
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                {{-- salary --}}
                <div>
                    <label for="salary" class="block text-sm font-medium text-gray-700">
                        Salary <span class="text-red-600">*</span>
                    </label>
                    <div class="mt-2">
                        <div class="relative w-full">
                            <i class="pi pi-wallet absolute p-2.5 text-gray-400"> </i>
                            <input id="salary" type="number" name="salary"
                                value="{{ old('salary', $job->salary ?? '') }}" placeholder="Enter Salary"
                                class="block w-full rounded-md border-0 bg-white
                                pl-10 py-1.5 px-3 text-gray-900 shadow-sm
                                ring-1 ring-inset ring-gray-300 placeholder:text-gray-400
                                focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm" />
                        </div>
                    </div>
                    @error('salary')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                {{-- job type --}}
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Job Type <span
                            class="text-red-600">*</span></label>
                    <div class="mt-1">
                        <select id="type" name="type"
                            class="block w-full rounded-md border-0 bg-white py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                            <option value="full-time"
                                {{ (old('type') ?? ($job->type ?? '')) == 'full-time' ? 'selected' : '' }}>Full-time
                            </option>
                            <option value="part-time"
                                {{ (old('type') ?? ($job->type ?? '')) == 'part-time' ? 'selected' : '' }}>Part-time
                            </option>
                            <option value="hybrid"
                                {{ (old('type') ?? ($job->type ?? '')) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                            <option value="internship"
                                {{ (old('type') ?? ($job->type ?? '')) == 'internship' ? 'selected' : '' }}>
                                Internship</option>
                        </select>
                    </div>
                    @error('type')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- job status --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Job Status <span
                            class="text-red-600">*</span></label>
                    <div class="mt-1">
                        <select id="status" name="status"
                            class="block w-full rounded-md border-0 bg-white py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                            <option value="active"
                                {{ (old('status') ?? ($job->status ?? '')) == 'active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="inActive"
                                {{ (old('status') ?? ($job->status ?? '')) == 'inActive' ? 'selected' : '' }}>Inactive
                            </option>

                        </select>
                    </div>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update
                        job</button>
                </div>
            </form>
        </div>
    </div>

    <x-components.footer />
</x-layout>
