<!-- views/products/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-500 text-white p-4 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <a href="{{ route('products.create') }}" class="bg-[#C5B358] text-white py-2 px-4 rounded shadow hover:bg-yellow-600">Add Product</a>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
                        @foreach ($products as $product)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition transform hover:-translate-y-1 hover:shadow-xl p-4">
                                <h3 class="font-bold text-xl text-gray-800 dark:text-gray-100">{{ $product->name }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 mt-1">Category: {{ $product->category->name }}</p>
                                <p class="text-[#C5B358] text-lg font-semibold mt-2">${{ $product->price }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Stock: {{ $product->stock }}</p>

                                <div class="flex justify-between items-center mt-4">
                                    <a href="{{ route('products.show', $product->id) }}" class="text-white bg-[#C5B358] hover:bg-yellow-600 px-3 py-1 rounded shadow">View</a>

                                    @if(Auth::check() && Auth::user()->role === 'admin')
                                        <div class="flex space-x-2">
                                            <a href="{{ route('products.edit', $product->id) }}" class="text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded shadow">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded shadow">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
