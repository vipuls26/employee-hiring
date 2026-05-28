<x-layout>

    <x-components.header />

    <div class="mx-auto max-w-7xl px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($jobs as $job)
                <form action="{{ route('employee.apply', $job->id) }}" method="POST">
                    @csrf
                    <div
                        class="group bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col h-full">

                        {{-- job + salary --}}
                        <div class="p-6 flex-grow">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">
                                        <i class="pi pi-briefcase text-gray-400 mr-2"></i>{{ $job->name }}
                                    </h3>
                                    <p class="text-base font-semibold text-gray-600 mt-1">
                                        <i class="pi pi-wallet text-gray-400 mr-2"></i> ₹ {{ $job->salary }}
                                    </p>
                                </div>
                                {{-- job type --}}
                                <span
                                    class="inline-block bg-indigo-50 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full border border-indigo-100/50">
                                    {{ $job->type }}
                                </span>
                            </div>

                            {{-- company detail --}}
                            <div class="space-y-3 bg-gray-50 rounded-xl p-4 mt-4">
                                <div class="flex items-center text-gray-700">
                                    <i class="pi pi-building text-gray-400 w-5"></i>
                                    <span
                                        class="text-sm font-medium text-gray-900 ml-2">{{ $job->company->name }}</span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="pi pi-map-marker text-gray-400 w-5"></i>
                                    <span class="text-sm text-gray-600 ml-2">{{ $job->company->location }}</span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="pi pi-phone text-gray-400 w-5"></i>
                                    <span class="text-sm text-gray-600 ml-2">{{ $job->company->phone }}</span>
                                </div>
                            </div>
                        </div>


                        <div class="p-6 bg-gray-50/50 border-t border-gray-100 flex items-center justify-end">
                            <button type="submit"
                                class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-all duration-200 shadow-sm hover:shadow flex items-center justify-center gap-2">
                                Apply
                            </button>
                        </div>

                    </div>

                </form>
            @endforeach
        </div>
    </div>

    <x-components.footer />
</x-layout>
