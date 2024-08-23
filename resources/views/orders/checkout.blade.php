<!-- views/orders/checkout.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Order Summary</h3>
                    <ul class="list-disc pl-5">
                        @foreach ($cart->items as $item)
                            <li>{{ $item->product->name }} (x{{ $item->quantity }}) - ${{ $item->product->price * $item->quantity }}</li>
                        @endforeach
                    </ul>
                    <p class="mt-4">Total: ${{ $cart->items->sum(fn($item) => $item->product->price * $item->quantity) }}</p>

                    <!-- Shipping Information -->
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mt-8">Shipping Information</h3>
                    <p>{{ auth()->user()->address }}</p>

                    <!-- Payment Information -->
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mt-8">Payment Information</h3>
                    <p>Payment details go here...</p>

                    <!-- Place Order Button -->
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="mt-4 bg-[#C5B358] text-white p-2 rounded hover:bg-[#b8a93e]">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
