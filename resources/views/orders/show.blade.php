<!-- resources/views/orders/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Details') }}
        </h2>

    </x-slot>
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3>Order #{{ $order->id }}</h3>
                    <p>Date: {{ $order->created_at->format('d/m/Y') }}</p>
                    <p>Status: {{ $order->status }}</p>

                    <h4 class="mt-4">Items:</h4>
                    <ul class="list-disc pl-5">
                        @foreach($order->items as $item)
                            <li>{{ $item->product->name }} (x{{ $item->quantity }}) - ${{ $item->price * $item->quantity }}</li>
                        @endforeach
                    </ul>

                    <p class="mt-4">Total: ${{ $order->total_price }}</p>

                    <h4 class="mt-4">Shipping Information:</h4>
                    <p>{{ $order->shipping_address ?? 'Not available' }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
