<x-layout>
    <x-header />

    <div class="mx-auto max-w-7xl px-4 py-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-slate-900">Manager Dashboard</h1>
        </div>

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Applicant</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Job</th>

                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Current Status</th>
                            <th
                                class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                View Resume</th>
                            <th
                                class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse ($applications as $application)
                            <tr class="align-top">
                                {{-- name + email --}}
                                <td class="px-4 py-4">
                                    <div class="font-semibold text-slate-900">{{ $application->employee_name }}</div>
                                    <div class="text-sm text-slate-500">{{ $application->employee_email }}</div>
                                </td>
                                {{-- job --}}
                                <td class="px-4 py-4 text-sm text-slate-700">
                                    <div>{{ $application->job?->name }}</div>
                                    </div>
                                </td>

                                {{-- status --}}
                                <td class="px-4 py-4">
                                    <span
                                        class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusColors[$application->overall_status] ?? 'bg-slate-100 text-slate-700' }}">
                                        {{ $application->overall_status }}
                                    </span>
                                </td>
                                {{-- resume --}}
                                <td class="px-4 py-4 text-sm text-slate-600">
                                    @if ($application->resume_path)
                                        <a href="{{ route('applications.resume', $application) }}" target="_blank"
                                            rel="noopener noreferrer"
                                            class="text-blue-600 hover:text-blue-800 underline">View Resume</a>
                                    @else
                                        <span class="text-slate-400">No resume</span>
                                    @endif
                                </td>
                                {{-- action --}}
                                <td class="px-4 py-4">
                                    @if ($application->overall_status === 'hr_approved')
                                        <form action="{{ route('manager.applications.decide', $application) }}"
                                            method="POST" class="space-y-2">
                                            @csrf
                                            <div class="flex flex-wrap gap-2">
                                                <button type="submit" name="action" value="accept"
                                                    class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700">Accept</button>
                                                <button type="submit" name="action" value="reject"
                                                    class="rounded-md bg-orange-600 px-3 py-2 text-sm font-semibold text-white hover:bg-orange-700">Reject</button>

                                                <textarea name="reason" rows="2" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm"
                                                    placeholder="Add rejection reason if rejecting"></textarea>
                                            </div>
                                        </form>
                                    @else
                                        <span class="text-sm text-slate-400">No Current applications</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-10 text-center text-sm text-slate-500">No applications
                                    are review.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-footer />
</x-layout>
