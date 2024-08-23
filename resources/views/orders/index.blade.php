<!-- views/orders/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($orders->count())
                        <!-- Make table responsive -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left">Order Number</th>
                                    <th class="px-4 py-2 text-left">Date</th>
                                    <th class="px-4 py-2 text-left">Total</th>
                                    <th class="px-4 py-2 text-left">Status</th>
                                    <th class="px-4 py-2 text-left">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $order->id }}</td>
                                        <td class="border px-4 py-2">{{ $order->created_at->format('d/m/Y') }}</td>
                                        <td class="border px-4 py-2">${{ number_format($order->total_price, 2) }}</td>
                                        <td class="border px-4 py-2">{{ ucfirst($order->status) }}</td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('orders.show', $order->id) }}" class="text-primary hover:text-primaryHover hover:underline">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center">You have no orders.</p>
                        <div class="mt-6 text-center">
                            <a href="{{ route('products.index') }}" class="bg-primary text-white px-4 py-2 rounded hover:bg-primaryHover">
                                Start Shopping
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
