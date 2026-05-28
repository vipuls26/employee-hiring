<x-layout>

    <x-components.header />

    <div>
        <div class="overflow-x-auto shadow-md rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Job Name</th>
                        <th scope="col" class="px-6 py-3">Salary</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Type</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $job->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $job->salary }}
                            </td>
                            <td class="px-6 py-4">

                                <span
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $job->status == 'approve' ? 'bg-green-100 text-green-800' : ($job->status == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ $job->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $job->type }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('hr.job.edit', $job->id) }}" class="inline-flex items-center px-3 py-1 mr-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('hr.job.delete', $job->id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <x-components.footer />
</x-layout>
