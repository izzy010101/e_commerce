<!-- views/layouts/quests/personalization.blade.php -->
<x-guest-layout>
    <div class="flex flex-col items-center p-6 md:p-12 text-center justify-center text-gray-600">
        <h1 class="uppercase font-thin text-3xl md:text-4xl">personalization</h1>

        <p class="text-base md:text-lg pt-4 font-bold">Add a unique touch to your wardrobe with personalized embroidery and custom engraving on your clothes</p>

        <div class="w-full pt-6 md:pt-12 pb-6 md:pb-12">
            <video muted autoplay loop class="w-full h-auto"
                   preload="metadata">
                <source src="{{ asset('videos/video1.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <p class="pb-6 md:pb-12 text-sm md:text-base">Whether you intend to keep or gift it, enhance a Ziara item by adding a special detail.</p>

        <div class="flex flex-col md:flex-row gap-4 md:gap-6">
            <a href="#online" class="underline hover:text-primaryHover text-sm md:text-base">Online</a>
            <a href="#instore" class="underline hover:text-primaryHover text-sm md:text-base">In Store Service</a>
        </div>

        <section id="online" class="mt-8 md:mt-12 w-full">
            <h2 class="uppercase text-xl md:text-2xl text-black">Online</h2>

            <div class="flex flex-col items-center gap-2 md:gap-4 pb-4">
                <p class="p-2 w-full md:w-1/2 text-sm md:text-base">Personalize your cultural garments, including select robes, scarves, belts, and accessories, with custom embroidery or monogramming either before purchasing online or by bringing the item to our boutique once your order arrives.</p>
                <p class="text-sm md:text-base">If an item is available for online customization, you'll find the dedicated 'personalize with embroidery' link on its product page.</p>
            </div>

            <!-- images of cultural bags -->
            <div class="flex flex-col md:flex-row gap-2">
                <div class="flex-1">
                    <img src="{{ asset('assets/images/indian_bag1.jpg') }}" alt="indian_bag1" class="w-full h-auto">
                </div>
                <div class="flex-1">
                    <img src="{{ asset('assets/images/indian_bag2.jpg') }}" alt="indian_bag2" class="w-full h-full object-cover">
                </div>
            </div>
        </section>

        <section id="instore" class="mt-8 md:mt-12 w-full">
            <h2 class="uppercase text-xl md:text-2xl text-black">In Store Service</h2>

            <div class="flex flex-col items-center gap-2 md:gap-4 pb-4">
                <p class="p-2 w-full md:w-1/2 text-sm md:text-base">Whether you're picking up a Collect In Store order, bringing in a garment purchased online, or buying an item directly from our boutique, you can choose from an extended range of customization options, including embroidery of names, symbols, and meaningful phrases. The Ziara clothing line offers personalized stitching through our in-store service, while select accessories and home items can be customized with intricate designs.</p>
                <p class="text-sm md:text-base">At the boutique, you can consult with a Style Advisor to choose the most suitable options for your item together.</p>
            </div>

            <!-- images of custom items -->
            <div class="flex flex-col md:flex-row gap-2">
                <div class="flex-1">
                    <img src="{{ asset('assets/images/custom1.jpg') }}" alt="custom_jewerly1" class="w-full h-auto">
                </div>
                <div class="flex-1">
                    <img src="{{ asset('assets/images/custom2.jpg') }}" alt="custom_jewerly2" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <img src="{{ asset('assets/images/custom3.jpg') }}" alt="custom_jewerly3" class="w-full h-full object-cover">
                </div>
            </div>
        </section>
    </div>
</x-guest-layout>
