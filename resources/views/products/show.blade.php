<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $product->name }}</h3>
                    <p class="mt-4">Product ID: {{ $product->id }}</p>
                    <p class="mt-2">Description: {{ $product->description }}</p>
                    <p class="mt-2">Price: ${{ $product->price }}</p>
                    <p class="mt-2">Stock: {{ $product->stock }}</p>
                    <p class="mt-2">Category: {{ $product->category->name }}</p>
                    <p class="mt-2">Colors: {{ implode(', ', json_decode($product->colors, true)) }}</p>
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="mt-4">

                    @if(Auth::check())
                        <p>User Role: {{ Auth::user()->role }}</p> <!-- Debugging line -->
                        @if(Auth::user()->role === 'admin')
                            dd(user()->role);
                            <div class="mt-4">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
