<!-- views/cart/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($cart && $cart->items->count())
                        <ul>
                            @foreach ($cart->items as $item)
                                <li class="mb-4">
                                    <div class="flex items-center">
                                        <!-- Display the product image -->
                                        <img src="{{ $item->product->images->first()->path }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">

                                        <div class="ml-4">
                                            <!-- Display product details -->
                                            <h3 class="text-lg font-medium">{{ $item->product->name }}</h3>
                                            <p>Price: ${{ $item->product->price }}</p>
                                            <p>Quantity: {{ $item->quantity }}</p>

                                            <!-- Display the selected color -->
                                            <p>Color: {{ $item->color ?? 'Not specified' }}</p>

                                            <!-- Form to remove the item from the cart -->
                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Display the total cost -->
                        <div class="mt-4">
                            <strong>Total:</strong> ${{ $cart->items->sum(function($item) {
                                return $item->product->price * $item->quantity;
                            }) }}
                        </div>

                        <!-- Proceed to Checkout Button for Logged-in Users -->
                        @if(Auth::check())
                            <div class="mt-6">
                                <a href="{{ route('orders.checkout') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    Proceed to Checkout
                                </a>
                            </div>
                        @else
                            <div class="mt-6">
                                <p class="text-red-500">Please <a href="{{ route('login') }}" class="underline">log in</a> to proceed to checkout.</p>
                            </div>
                        @endif

                    @else
                        <p>Your cart is empty.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
