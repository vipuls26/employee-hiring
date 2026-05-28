<x-layout>
    <x-components.header />

    @php
        $statusColors = [
            'hr_approved' => 'bg-green-100 text-green-800',
            'hr_rejected' => 'bg-red-100 text-red-800',
            'manager_approved' => 'bg-blue-100 text-blue-800',
            'manager_rejected' => 'bg-orange-100 text-orange-800',
            'owner_approved' => 'bg-emerald-100 text-emerald-800',
            'owner_rejected' => 'bg-rose-100 text-rose-800',
        ];
    @endphp

    <div class="mx-auto max-w-7xl px-4 py-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-slate-900">Manager Dashboard</h1>
            <p class="mt-2 text-sm text-slate-600">Manager can review every application after HR has made an accept or reject decision. Your decision then sends it to the owner stage.</p>
        </div>

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Applicant</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Job</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">HR Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Current Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Approval Trail</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse ($applications as $application)
                            @php
                                $canReview = in_array($application->overall_status, ['hr_approved', 'hr_rejected', 'manager_approved', 'manager_rejected'], true);
                                $hrDecision = $application->approvals->firstWhere('role', 'hr');
                            @endphp
                            <tr class="align-top">
                                <td class="px-4 py-4">
                                    <div class="font-semibold text-slate-900">{{ $application->employee_name }}</div>
                                    <div class="text-sm text-slate-500">{{ $application->employee_email }}</div>
                                </td>
                                <td class="px-4 py-4 text-sm text-slate-700">
                                    <div>{{ $application->job?->name ?? 'Unknown job' }}</div>
                                    <div class="text-slate-500">{{ $application->job?->company?->name ?? 'No company' }}</div>
                                </td>
                                <td class="px-4 py-4 text-sm text-slate-700">
                                    @if ($hrDecision)
                                        {{ ucfirst($hrDecision->action) }} by {{ $hrDecision->user?->name ?? 'Unknown' }}
                                    @else
                                        <span class="text-slate-400">Waiting for HR</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusColors[$application->overall_status] ?? 'bg-slate-100 text-slate-700' }}">
                                        {{ str_replace('_', ' ', $application->overall_status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-sm text-slate-600">
                                    @foreach ($application->approvals as $approval)
                                        <div>{{ strtoupper($approval->role) }}: {{ $approval->action }} by {{ $approval->user?->name ?? 'Unknown' }}</div>
                                    @endforeach
                                </td>
                                <td class="px-4 py-4">
                                    @if ($canReview)
                                        <div class="flex flex-wrap gap-2">
                                            <form action="{{ route('manager.applications.decide', $application) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="action" value="accept">
                                                <button type="submit" class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700">Accept</button>
                                            </form>
                                            <form action="{{ route('manager.applications.decide', $application) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="action" value="reject">
                                                <button type="submit" class="rounded-md bg-orange-600 px-3 py-2 text-sm font-semibold text-white hover:bg-orange-700">Reject</button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-sm text-slate-400">Waiting for HR</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-10 text-center text-sm text-slate-500">No applications are ready for manager review.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-components.footer />
</x-layout>
