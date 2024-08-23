<!-- views/layouts/quests/mencampaign.blade.php -->
<x-guest-layout>
    <div class="flex flex-col items-center p-6 md:p-12 text-center justify-center text-gray-800">
        <h1 class="uppercase font-bold text-3xl md:text-5xl tracking-wide">Men's Campaign</h1>
        <h2 class="text-lg md:text-2xl mt-2 font-semibold text-gray-600">Fall/Winter 2024 Collection</h2>

        <!-- Call-to-Action Banner -->
        <div class="w-full bg-gray-900 text-white py-12 md:py-20 mt-8 md:mt-12 flex flex-col items-center justify-center">
            <h3 class="text-xl md:text-3xl font-bold">Exclusive Fall/Winter 2024 Offer</h3>
            <p class="text-sm md:text-base mt-4 max-w-xl text-center">Enjoy early access to our Fall/Winter 2024 collection with exclusive discounts for a limited time only.</p>
            <a href="{{ url('register') }}" class="mt-6 bg-primary text-white py-3 px-8 rounded-full text-sm md:text-base uppercase font-semibold hover:bg-primaryHover transition duration-300">Shop Now</a>
        </div>

        <p class="pb-6 md:pb-12 text-sm md:text-base text-gray-600 max-w-2xl mt-6 md:mt-12">Discover the essence of contemporary fashion in our Fall/Winter 2024 men's campaign. Explore bold designs, luxurious fabrics, and cutting-edge styles that define the season.</p>

        <!-- Hero Image Section -->
        <div class="w-full relative">
            <img src="{{ asset('assets/images/men_campaign_hero.jpg') }}" alt="Men Campaign Hero" class="w-full h-auto object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <h3 class="text-white text-2xl md:text-4xl font-bold">The Future of Men's Fashion</h3>
            </div>
        </div>

        <!-- Campaign Highlights Section -->
        <section class="w-full mt-8 md:mt-12 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="relative">
                <img src="{{ asset('assets/images/men_highlight1.jpg') }}" alt="Men Highlight 1" class="w-full h-full object-cover rounded-lg">
                <div class="absolute bottom-0 left-0 bg-black bg-opacity-50 p-4 text-white">
                    <h4 class="text-lg font-semibold">Modern Elegance</h4>
                    <p class="text-sm md:text-base mt-1">Sophisticated silhouettes with a modern twist.</p>
                </div>
            </div>
            <div class="relative">
                <img src="{{ asset('assets/images/men_highlight2.jpg') }}" alt="Men Highlight 2" class="w-full h-full object-cover rounded-lg">
                <div class="absolute bottom-0 left-0 bg-black bg-opacity-50 p-4 text-white">
                    <h4 class="text-lg font-semibold">Winter Warmth</h4>
                    <p class="text-sm md:text-base mt-1">Luxurious layers to keep you warm and stylish.</p>
                </div>
            </div>
        </section>

        <!-- Collection Overview Section -->
        <section class="w-full mt-12 md:mt-16">
            <h3 class="uppercase text-xl md:text-2xl text-black text-center">Collection Overview</h3>
            <p class="text-sm md:text-base text-gray-600 text-center mt-4 max-w-3xl mx-auto">Our Fall/Winter 2024 collection for men is a blend of timeless classics and innovative designs. Each piece is crafted to perfection, ensuring both style and comfort.</p>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-4 shadow-lg rounded-lg">
                    <img src="{{ asset('assets/images/men_overview1.jpg') }}" alt="Overview 1" class="w-full h-48 object-cover rounded-md mb-4">
                    <h4 class="uppercase text-lg font-semibold">Tailored Coats</h4>
                    <p class="text-sm md:text-base mt-2">Precision-tailored coats for a sharp and sophisticated look.</p>
                </div>

                <div class="bg-white p-4 shadow-lg rounded-lg">
                    <img src="{{ asset('assets/images/men_overview2.jpg') }}" alt="Overview 2" class="w-full h-48 object-cover rounded-md mb-4">
                    <h4 class="uppercase text-lg font-semibold">Knitwear Essentials</h4>
                    <p class="text-sm md:text-base mt-2">Comfort meets style with our premium knitwear collection.</p>
                </div>

                <div class="bg-white p-4 shadow-lg rounded-lg">
                    <img src="{{ asset('assets/images/men_overview3.jpg') }}" alt="Overview 3" class="w-full h-48 object-cover rounded-md mb-4">
                    <h4 class="uppercase text-lg font-semibold">Statement Footwear</h4>
                    <p class="text-sm md:text-base mt-2">Step into the season with bold and stylish footwear.</p>
                </div>
            </div>
        </section>

    </div>
</x-guest-layout>
