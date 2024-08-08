<x-guest-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ $category->name }}</h1>

        <h2 class="text-xl font-bold mt-4">Products</h2>
        <ul class="flex flex-col">
            @foreach ($products as $product)
                <li>
                    <div class="flex gap-6">
                        <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                        <div>{{ $product->description }}</div>
                        <div>${{ $product->price }}</div>
                        <div>In Stock: {{ $product->stock }}</div>
                        <div>Colors: {{ implode(', ', json_decode($product->colors)) }}</div>
                        @foreach ($product->images as $image)
                            <img src="{{ asset($image->path) }}" alt="{{ $product->name }}" class="w-[100px] h-[100px]">
                        @endforeach
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-guest-layout>
