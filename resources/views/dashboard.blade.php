<!-- views/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Welcome/Role Information -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if(Auth::check())
                            @if(Auth::user()->role === 'admin')
                                <p class="mt-4">You are logged in as an <strong class="uppercase">Admin</strong>.</p>
                            @else
                                <p class="mt-4">Welcome {{ ucfirst(Auth::user()->name) }}, you are logged in as a
                                    <strong class="uppercase">User</strong>.</p>
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Notifications/Success Message -->
                @if (session('success'))
                    <div class="bg-[#C5B358] text-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

{{--                <!-- Recent Orders or Activities -->--}}
{{--                  <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                    <div class="p-6 text-gray-900 dark:text-gray-100">--}}
{{--                        <h3 class="text-lg font-semibold mb-4">Recent Orders</h3>--}}

{{--                        @if($orders->isEmpty())--}}
{{--                            <p>You have no recent orders.</p>--}}
{{--                        @else--}}
{{--                            <ul class="space-y-2">--}}
{{--                                @foreach($orders as $order)--}}
{{--                                    <li class="flex justify-between">--}}
{{--                                        <span>Order #{{ $order->id }}</span>--}}
{{--                                        <span class="text-sm text-gray-500">{{ $order->created_at->diffForHumans() }}</span>--}}
{{--                                    </li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}

                <!-- Quick Actions -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg col-span-1 md:col-span-2">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <a href="{{url('products')}}" class="bg-gray-800 text-white p-4 rounded-lg text-center shadow-sm hover:bg-gray-900 transition">
                                View Products
                            </a>
                            <a href="{{url('orders')}}" class="bg-[#C5B358] text-white p-4 rounded-lg text-center shadow-sm hover:bg-[#b8a93e] transition">
                                Manage Orders
                            </a>
                            <a href="{{url('account')}}" class="bg-gray-300 text-gray-800 p-4 rounded-lg text-center shadow-sm hover:bg-gray-400 transition">
                                Account Settings
                            </a>
                            <a href="{{url('wishlist')}}" class="bg-black text-white p-4 rounded-lg text-center shadow-sm hover:bg-gray-700 transition">
                                View Wishlist
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
