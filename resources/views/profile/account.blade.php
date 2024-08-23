<!-- resources/views/profile/account.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Account Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Profile Information</h3>
                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Member Since:</strong> {{ Auth::user()->created_at->format('d M Y') }}</p>

                <div class="mt-6">
                    <a href="{{ route('profile.edit') }}" class="bg-primary text-white px-4 py-2 rounded hover:bg-primaryHover">
                        Edit Profile
                    </a>
                </div>
            </div>

            <!-- Address Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Address Information</h3>
                <p>Manage your shipping and billing addresses here.</p>
                <div class="mt-6">
{{--                    <a href="{{ route('address.index') }}" class="bg-primary text-white px-4 py-2 rounded hover:bg-primaryHover">--}}
                        Manage Addresses
                    </a>
                </div>
            </div>

            <!-- Payment Methods Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Payment Methods</h3>
                <p>Manage your saved payment methods.</p>
                <div class="mt-6">
{{--                    <a href="{{ route('payment-methods.index') }}" class="bg-primary text-white px-4 py-2 rounded hover:bg-primaryHover">--}}
                        Manage Payment Methods
                    </a>
                </div>
            </div>

            <!-- Password Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Security</h3>
                <p>Update your password to keep your account secure.</p>
                <div class="mt-6">
                    <a href="{{ route('profile.edit') }}" class="bg-primary text-white px-4 py-2 rounded hover:bg-primaryHover">
                        Change Password
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
