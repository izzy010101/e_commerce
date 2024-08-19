<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Cart and Wishlist -->
                <div class="flex flex-col pl-6 pt-6 text-center pr-4 bg-white dark:bg-gray-800 dark:border-gray-700 relative">
                    <div id="app1">
                        <div class="flex w-full space-x-2 mt-2 mb-2">
                            <span>Colors:</span>
                            @foreach (json_decode($product->colors) as $color)
                                <div class="w-6 h-6 rounded-full border-gray-500 border-[0.5px] cursor-pointer"
                                     style="background-color: {{ $color }};"
                                     @click="setColor('{{ $color }}')">
                                </div>
                            @endforeach
                        </div>

                        <button
                            @click="addToWishlist({
                                id: {{ $product->id }},
                                name: '{{ addslashes($product->name) }}',
                                price: {{ $product->price }},
                                color: selectedColor,
                            })"
                            class="absolute top-2 right-2 bg-transparent border-none cursor-pointer"
                        >
                            <img src="{{ asset('assets/icons/wishlist_icon.png') }}" alt="Add to Wishlist" class="wishlist-button w-[30px] pt-2 pl-2 hover:w-[35px]">
                        </button>
                    </div>

                    <!-- Add to cart only if auth -->
                    @if(Auth::check())
                        <form action="{{ route('products.addToCart', $product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="selected_color" :value="selectedColor">
                            <button class="absolute top-2 right-10 bg-transparent border-none cursor-pointer">
                                <img src="{{asset('assets/icons/cart_icon.png')}}" alt="cart_icon_auth_showcat" class="w-[30px] pt-2 pl-2 hover:w-[35px]">
                            </button>
                        </form>
                    @endif
                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $product->name }}</h3>
                    <p class="mt-2">Description: {{ $product->description }}</p>

                    <!-- Conditionally display price or login link -->
                    @if(Auth::check())
                        <p class="text-md pt-4 text-gray-900 dark:text-white">Price: ${{ $product->price }}</p>
                    @else
                        <p class="text-md pt-4 text-red-400 underline pb-2 dark:text-white"><a href="{{ route('login') }}">Login to see the price</a></p>
                    @endif

                    <p class="mt-2">Stock: {{ $product->stock }}</p>
                    <p class="mt-2">Category: {{ $product->category->name }}</p>





                    <!-- Product Image Gallery -->
                    <div id="image-gallery" class="relative w-[300px] h-[300px] mt-6" data-current-image="{{ $product->images[0]->path }}">
                        @foreach($product->images as $index => $image)
                            <img src="{{ asset($image->path) }}"
                                 data-path="{{ $image->path }}"
                                 alt="{{ $product->name }}"
                                 class="product-image w-full h-full object-cover rounded-lg absolute inset-0 {{ $index === 0 ? 'active' : 'hidden' }}"
                                 loading="lazy"
                                 onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder.png') }}';">
                        @endforeach
                        <!-- Left and Right Navigation Buttons -->
                        <button class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-300 text-black p-2 rounded focus:outline-none" onclick="prevImage(this)">&#10094;</button>
                        <button class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-300 text-black p-2 rounded focus:outline-none" onclick="nextImage(this)">&#10095;</button>
                    </div>

                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <div class="mt-4">
                            <a href="{{ route('products.edit', $product->id) }}" class="bg-amber-500 p-2 rounded text-white hover:bg-amber-300 mr-2">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 p-1.5 rounded hover:bg-red-700 text-white">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function prevImage(button) {
            const gallery = button.parentElement;
            const images = gallery.querySelectorAll('.product-image');
            let activeIndex = Array.from(images).findIndex(image => image.classList.contains('active'));

            images[activeIndex].classList.remove('active');
            images[activeIndex].classList.add('hidden');

            activeIndex = (activeIndex === 0) ? images.length - 1 : activeIndex - 1;

            images[activeIndex].classList.remove('hidden');
            images[activeIndex].classList.add('active');

            // Update the current image in the gallery
            document.querySelector('#image-gallery').dataset.currentImage = images[activeIndex].getAttribute('data-path');
        }

        function nextImage(button) {
            const gallery = button.parentElement;
            const images = gallery.querySelectorAll('.product-image');
            let activeIndex = Array.from(images).findIndex(image => image.classList.contains('active'));

            images[activeIndex].classList.remove('active');
            images[activeIndex].classList.add('hidden');

            activeIndex = (activeIndex === images.length - 1) ? 0 : activeIndex + 1;

            images[activeIndex].classList.remove('hidden');
            images[activeIndex].classList.add('active');

            // Update the current image in the gallery
            document.querySelector('#image-gallery').dataset.currentImage = images[activeIndex].getAttribute('data-path');
        }

        document.addEventListener("DOMContentLoaded", function() {
            const images = document.querySelectorAll('.product-image');

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const image = entry.target;
                        const imagePath = image.getAttribute('data-path');
                        const imageKey = `image_${btoa(imagePath)}`;

                        const storedImagePath = localStorage.getItem(imageKey);

                        if (storedImagePath) {
                            image.src = storedImagePath;
                        } else {
                            image.src = imagePath;
                            localStorage.setItem(imageKey, imagePath);
                        }

                        observer.unobserve(image);
                    }
                });
            });

            images.forEach(image => {
                observer.observe(image);
            });
        });
    </script>
</x-app-layout>
