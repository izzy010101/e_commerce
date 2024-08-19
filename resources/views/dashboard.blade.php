<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                        <!-- Display success message if available -->
                    @if (session('success'))
                        <div class="text-black mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(Auth::check())
                        @if(Auth::user()->role === 'admin')

                            <br>
                                <?php var_dump(Auth::user()->role); ?>
                            <br>

                            <p class="mt-4">You are logged in as an <strong>Admin</strong>.</p>
                        @else
                            <p class="mt-4">You are logged in as a <strong>User</strong>.</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
