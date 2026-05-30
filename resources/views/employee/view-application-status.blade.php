<x-layout title="Application Status">

    <x-header />

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="overflow-hidden border border-gray-200 shadow sm:rounded-lg">

            @if ($applications->isNotEmpty())
                <table class="min-w-full divide-y divide-gray-200 table-auto border-2">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Job
                                Title</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Application Status</th>

                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rejection Reason</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Job
                                Salary</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Applied on</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($applications as $application)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $application->job->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    @switch($application->overall_status)
                                        @case('pending')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        @break

                                        @case('hr_approved')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">HR
                                                Approved</span>
                                        @break

                                        @case('hr_rejected')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">HR
                                                Rejected</span>
                                        @break

                                        @case('manager_approved')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">Manager
                                                Approved</span>
                                        @break

                                        @case('manager_rejected')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pink-100 text-pink-800">Manager
                                                Rejected</span>
                                        @break

                                        @case('owner_approved')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Owner
                                                Approved</span>
                                        @break

                                        @case('owner_rejected')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-200 text-red-900">Owner
                                                Rejected</span>
                                        @break

                                        @default
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ $application->overall_status }}</span>
                                    @endswitch
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $application->reject_reason ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $application->job->salary }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $application->created_at }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="flex justify-center p-10 bg-gray-200">
                    <p class="text-gray-500 text-2xl"> No job application found apply
                        <a href={{ route('employee.dashboard') }} class="text-gray-900">
                            here
                        </a> .
                    </p>
                </div>

            @endif



        </div>
    </div>

    <x-footer />
</x-layout>
