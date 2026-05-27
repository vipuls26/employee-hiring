<x-layout>

    <x-components.header />
    <form action="{{ route('employee.resumeStore') }}" method="POST">

        <div>
            upload resume form
        </div>

    </form>

    <x-components.footer />
</x-layout>
