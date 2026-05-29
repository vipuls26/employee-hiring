<div>
    @if (auth()->user()->role->role === 'employee')
        <header class="bg-gray-900">
            <nav aria-label="Global" class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
                <div class="flex lg:flex-1">
                    <a href={{ route('employee.dashboard') }}>
                        <p class="text-white"> Dashboard</p>
                    </a>
                </div>
                <div class="flex lg:hidden">
                    <button type="button" command="show-modal" commandfor="mobile-menu"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400">
                        <span class="sr-only">Open main menu</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                            data-slot="icon" aria-hidden="true" class="size-6">
                            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <el-popover-group class="hidden lg:flex lg:gap-x-12">

                    @if (auth()->user()->resume_path === null)
                        <a href="{{ route('employee.addResume') }}" class="text-sm/6 font-semibold text-white">Add
                            Resume</a>
                    @else
                        <a href="{{ route('employee.viewResume') }}" class="text-sm/6 font-semibold text-white">View
                            Resume</a>
                    @endif

                    <a href="{{ route('employee.jobStatus') }}" class="text-sm/6 font-semibold text-white"> View application status
                    </a>

                </el-popover-group>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <a href="{{ route('auth.logout') }}" class="text-sm/6 font-semibold text-white">Log out</a>
                </div>
            </nav>
            <el-dialog>
                <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
                    <div tabindex="0" class="fixed inset-0 focus:outline-none">
                        <el-dialog-panel
                            class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-gray-900 p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-100/10">
                            <div class="flex items-center justify-between">

                                <button type="button" command="close" commandfor="mobile-menu"
                                    class="-m-2.5 rounded-md p-2.5 text-gray-400">
                                    <span class="sr-only">Close menu</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        data-slot="icon" aria-hidden="true" class="size-6">
                                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                            <div class="mt-6 flow-root">
                                <div class="-my-6 divide-y divide-white/10">
                                    <div class="space-y-2 py-6">

                                        @if (auth()->user()->resume_path === null)
                                            <a href="{{ route('employee.addResume') }}"
                                                class="text-sm/6 font-semibold text-white">Add
                                                Resume</a>
                                        @else
                                            <a href="{{ route('employee.viewResume') }}"
                                                class="text-sm/6 font-semibold text-white">View
                                                Resume</a>
                                        @endif

                                    </div>
                                    <div class="py-6">
                                        <a href="{{ route('auth.logout') }}"
                                            class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-white hover:bg-white/5">Log
                                            out</a>
                                    </div>
                                </div>
                            </div>
                        </el-dialog-panel>
                    </div>
                </dialog>
            </el-dialog>
        </header>
    @elseif(auth()->user()->role->role === 'HR')
        <header class="bg-gray-900">
            <nav aria-label="Global" class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
                <div class="flex lg:flex-1">
                    <a href={{ route('hr.dashboard') }}>
                        <p class="text-white"> Dashboard</p>
                    </a>
                </div>
                <div class="flex lg:hidden">
                    <button type="button" command="show-modal" commandfor="mobile-menu"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400">
                        <span class="sr-only">Open main menu</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                            data-slot="icon" aria-hidden="true" class="size-6">
                            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <el-popover-group class="hidden lg:flex lg:gap-x-12">
                    <a href="{{ route('hr.showForm') }}" class="text-sm/6 font-semibold text-white">Add Job</a>

                    <a href="{{ route('hr.jobList') }}" class="text-sm/6 font-semibold text-white">Job List</a>
                </el-popover-group>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <a href="{{ route('auth.logout') }}" class="text-sm/6 font-semibold text-white">Log out</a>
                </div>
            </nav>
            <el-dialog>
                <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
                    <div tabindex="0" class="fixed inset-0 focus:outline-none">
                        <el-dialog-panel
                            class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-gray-900 p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-100/10">
                            <div class="flex items-center justify-between">

                                <button type="button" command="close" commandfor="mobile-menu"
                                    class="-m-2.5 rounded-md p-2.5 text-gray-400">
                                    <span class="sr-only">Close menu</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        data-slot="icon" aria-hidden="true" class="size-6">
                                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                            <div class="mt-6 flow-root">
                                <div class="-my-6 divide-y divide-white/10">
                                    <div class="space-y-2 py-6">

                                        <a href="{{ route('hr.showForm') }}"
                                            class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-white/5">Add
                                            Job</a>

                                        <a href="{{ route('hr.jobList') }}"
                                            class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-white/5">Job
                                            List</a>
                                    </div>
                                    <div class="py-6">
                                        <a href="{{ route('auth.logout') }}"
                                            class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-white hover:bg-white/5">Log
                                            out</a>
                                    </div>
                                </div>
                            </div>
                        </el-dialog-panel>
                    </div>
                </dialog>
            </el-dialog>
        </header>
    @elseif(auth()->user()->role->role === 'Manager')
        <header class="bg-gray-900">
            <nav aria-label="Global" class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
                <div class="flex lg:flex-1">
                    <a href={{ route('manager.dashboard') }}>
                        <p class="text-white"> Dashboard</p>
                    </a>
                </div>
                <div class="flex lg:hidden">
                    <button type="button" command="show-modal" commandfor="mobile-menu"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400">
                        <span class="sr-only">Open main menu</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                            data-slot="icon" aria-hidden="true" class="size-6">
                            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <a href="{{ route('auth.logout') }}" class="text-sm/6 font-semibold text-white">Log out</a>
                </div>
            </nav>
            <el-dialog>
                <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
                    <div tabindex="0" class="fixed inset-0 focus:outline-none">
                        <el-dialog-panel
                            class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-gray-900 p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-100/10">
                            <div class="flex items-center justify-between">

                                <button type="button" command="close" commandfor="mobile-menu"
                                    class="-m-2.5 rounded-md p-2.5 text-gray-400">
                                    <span class="sr-only">Close menu</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        data-slot="icon" aria-hidden="true" class="size-6">
                                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                            <div class="mt-6 flow-root">
                                <div class="-my-6 divide-y divide-white/10">
                                    <div class="py-6">
                                        <a href="{{ route('auth.logout') }}"
                                            class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-white hover:bg-white/5">Log
                                            out</a>
                                    </div>
                                </div>
                            </div>
                        </el-dialog-panel>
                    </div>
                </dialog>
            </el-dialog>
        </header>
    @elseif(auth()->user()->role->role === 'Owner')
        <header class="bg-gray-900">
            <nav aria-label="Global" class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
                <div class="flex lg:flex-1">
                    <a href={{ route('owner.dashboard') }}>
                        <p class="text-white"> Dashboard</p>
                    </a>

                </div>
                <div class="flex lg:hidden">
                    <button type="button" command="show-modal" commandfor="mobile-menu"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400">
                        <span class="sr-only">Open main menu</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                            data-slot="icon" aria-hidden="true" class="size-6">
                            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <el-popover-group class="hidden lg:flex lg:gap-x-12">
                    <button class="text-sm/6 font-semibold text-white">

                        @if (Auth::user()->company === null)
                            <a href="{{ route('owner.showform') }}">
                                Register company
                            </a>
                        @endif

                    </button>
                </el-popover-group>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <a href="{{ route('auth.logout') }}" class="text-sm/6 font-semibold text-white">Log out</a>
                </div>
            </nav>
            <el-dialog>
                <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
                    <div tabindex="0" class="fixed inset-0 focus:outline-none">
                        <el-dialog-panel
                            class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-gray-900 p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-100/10">
                            <div class="flex items-center justify-between">

                                <button type="button" command="close" commandfor="mobile-menu"
                                    class="-m-2.5 rounded-md p-2.5 text-gray-400">
                                    <span class="sr-only">Close menu</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        data-slot="icon" aria-hidden="true" class="size-6">
                                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                            <div class="mt-6 flow-root">
                                <div class="-my-6 divide-y divide-white/10">
                                    <div class="space-y-2 py-6">

                                        <button class="text-sm/6 font-semibold text-white">
                                            <a href="{{ route('owner.showform') }}">
                                                Register company
                                            </a>
                                        </button>

                                    </div>
                                    <div class="py-6">
                                        <a href="{{ route('auth.logout') }}"
                                            class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-white hover:bg-white/5">Log
                                            out</a>
                                    </div>
                                </div>
                            </div>
                        </el-dialog-panel>
                    </div>
                </dialog>
            </el-dialog>
        </header>
    @endif
</div>
