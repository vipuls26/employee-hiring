<x-layout>

    <x-components.header />

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($jobs as $job)
            <form action="{{ route('employee.apply', $job->id) }}" method="POST">
                @csrf

                <div
                    class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-200">
                    <div class="p-6">

                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            {{ $job->name }}
                        </h3>


                        <p class="text-lg font-semibold text-indigo-600 mb-4">
                            ₹ {{ $job->salary }}
                        </p>


                        <div class="flex items-center">
                            <span
                                class="inline-block bg-indigo-50 text-indigo-700 text-xs font-medium px-3 py-1 rounded-full">
                                {{ $job->type }}
                            </span>
                        </div>

                        <button type="submit" class="bg-cyan-500">Apply for Job</button>

                        <div>



                        </div>

                    </div>

                </div>

            </form>
        @endforeach
    </div>


    <x-components.footer />
</x-layout>
