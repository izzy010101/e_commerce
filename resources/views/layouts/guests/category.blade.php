<x-guest-layout>
    <div class="container mx-auto p-4">
        <div class="bg-[#C5B358] mt-1 ml-4 mr-4 mb-10 sm:mt-0 sm:ml-0 sm:mr-0 sm:mb-1 !mb-8 rounded-lg p-6 shadow-lg flex items-center justify-center">
            <h1 class="text-4xl font-extrabold text-white tracking-wide text-center">{{ $category->name }}</h1>
        </div>

        <!-- Grid Layout for Product Cards -->
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($products as $product)
                <div class="border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 bg-white dark:bg-gray-800 relative">
                    <figure class="flex flex-col items-center justify-center p-8 text-center bg-white dark:bg-gray-800 dark:border-gray-700 relative">
                        <!-- Product Details -->
                        <blockquote class="max-w-2xl mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $product->name }}</h3>
                            <p class="my-4">{{ $product->description }}</p>

                            <!-- Conditionally Display Price or Login Link -->
                            @if(Auth::check())
                                <p class="text-md text-gray-900 dark:text-white">${{ $product->price }}</p>
                            @else
                                <p class="text-md text-red-400 underline pb-2 dark:text-white"><a href="{{ route('login') }}">Login to see the price</a></p>
                            @endif

                            <p class="text-sm text-gray-500 dark:text-gray-400">In Stock: {{ $product->stock }}</p>
                        </blockquote>


                        <div id="app1-{{ $loop->index }}">


                            <!-- Display Color Circles -->
                            <div class="flex pb-4 justify-center w-full space-x-2 mt-2" id="colors_circles_container-{{ $product->id }}">
                                @foreach (json_decode($product->colors) as $color)
                                    <div
                                         class="w-6 h-6 rounded-full border-gray-500 border-[0.5px] cursor-pointer"
                                         style="background-color: {{ $color }};"
                                         @click="setColor('{{ $color }}', {{ $product->id }})"
                                    >
                                    </div>
                                @endforeach
                            </div>


                            <!-- wishlist button -->
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

                        <!-- Add to Cart Button -->
                        @if(Auth::check())
                            <form action="{{ route('products.addToCart', $product->id) }}" method="POST" id="add-to-cart-form-{{ $product->id }}">
                                @csrf
                                <input type="hidden" name="selected_color" id="selectedColor_{{ $product->id }}" value="{{$product->color}}">
                                <button class="absolute top-2 right-10 bg-transparent border-none cursor-pointer">
                                    <img src="{{asset('assets/icons/cart_icon.png')}}" alt="cart_icon_auth_categblade" class="w-[30px] pt-2 pl-2 hover:w-[35px]">
                                </button>
                            </form>
                        @endif


                        <!-- Product Image Gallery -->
                        <div class="relative w-[150px] h-[150px]">
                            @foreach($product->images as $index => $image)
                                <img src="{{ asset('assets/images/placeholder.png') }}"
                                     data-path="{{ $image->path }}"
                                     alt="{{ $product->name }}"
                                     class="product-image w-[150px] h-[150px] object-cover rounded-lg absolute inset-0 {{ $index === 0 ? 'active' : 'hidden' }}"
                                     loading="lazy"
                                     onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder.png') }}';">
                            @endforeach
                            <button class="absolute left-[-20px] top-1/2 transform -translate-y-1/2 text-black p-1 rounded focus:outline-none" onclick="prevImage(this)">&#10094;</button>
                            <button class="absolute right-[-20px] top-1/2 transform -translate-y-1/2 text-black p-1 rounded focus:outline-none" onclick="nextImage(this)">&#10095;</button>
                        </div>
                    </figure>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        // Function to navigate to the previous image
        function prevImage(button) {
            const gallery = button.parentElement;
            const images = gallery.querySelectorAll('.product-image');
            let activeIndex = Array.from(images).findIndex(image => image.classList.contains('active'));

            images[activeIndex].classList.remove('active');
            images[activeIndex].classList.add('hidden');

            activeIndex = (activeIndex === 0) ? images.length - 1 : activeIndex - 1;

            images[activeIndex].classList.remove('hidden');
            images[activeIndex].classList.add('active');
        }

        // Function to navigate to the next image
        function nextImage(button) {
            const gallery = button.parentElement;
            const images = gallery.querySelectorAll('.product-image');
            let activeIndex = Array.from(images).findIndex(image => image.classList.contains('active'));

            images[activeIndex].classList.remove('active');
            images[activeIndex].classList.add('hidden');

            activeIndex = (activeIndex === images.length - 1) ? 0 : activeIndex + 1;

            images[activeIndex].classList.remove('hidden');
            images[activeIndex].classList.add('active');
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
</x-guest-layout>
