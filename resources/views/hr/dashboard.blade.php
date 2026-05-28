<x-layout>
    <x-components.header />

    @php
        $statusColors = [
            'pending' => 'bg-yellow-100 text-yellow-800',
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
            <h1 class="text-3xl font-bold text-slate-900">HR Dashboard</h1>
            <p class="mt-2 text-sm text-slate-600">HR reviews new applications first. After your accept or reject decision, the application moves to the manager dashboard.</p>
        </div>

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Applicant</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Job</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Company</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Approval Trail</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse ($applications as $application)
                            @php
                                $canReview = in_array($application->overall_status, ['pending', 'hr_approved', 'hr_rejected'], true);
                            @endphp
                            <tr class="align-top">
                                <td class="px-4 py-4">
                                    <div class="font-semibold text-slate-900">{{ $application->employee_name }}</div>
                                    <div class="text-sm text-slate-500">{{ $application->employee_email }}</div>
                                </td>
                                <td class="px-4 py-4 text-sm text-slate-700">
                                    <div>{{ $application->job?->name ?? 'Unknown job' }}</div>
                                    <div class="text-slate-500">{{ $application->job?->type ?? 'N/A' }}</div>
                                </td>
                                <td class="px-4 py-4 text-sm text-slate-700">{{ $application->job?->company?->name ?? 'No company' }}</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusColors[$application->overall_status] ?? 'bg-slate-100 text-slate-700' }}">
                                        {{ str_replace('_', ' ', $application->overall_status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-sm text-slate-600">
                                    @forelse ($application->approvals as $approval)
                                        <div>{{ strtoupper($approval->role) }}: {{ $approval->action }} by {{ $approval->user?->name ?? 'Unknown' }}</div>
                                    @empty
                                        <span class="text-slate-400">No decisions yet</span>
                                    @endforelse
                                </td>
                                <td class="px-4 py-4">
                                    @if ($canReview)
                                        <div class="flex flex-wrap gap-2">
                                            <form action="{{ route('hr.applications.decide', $application) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="action" value="accept">
                                                <button type="submit" class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white hover:bg-green-700">Accept</button>
                                            </form>
                                            <form action="{{ route('hr.applications.decide', $application) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="action" value="reject">
                                                <button type="submit" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-700">Reject</button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-sm text-slate-400">Moved to next stage</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-10 text-center text-sm text-slate-500">No applications found yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-components.footer />
</x-layout>
