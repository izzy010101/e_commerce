<!-- views/layouts/quests/moderndesign.blade.php -->
<x-guest-layout>
    <div class="flex flex-col items-center p-6 md:p-12 text-center justify-center text-gray-600">
        <h1 class="uppercase font-thin text-3xl md:text-4xl">Modern Design</h1>

        <p class="text-base md:text-lg pt-4 font-bold">Explore the latest in contemporary fashion with our modern design collection.</p>

        <div class="w-full pt-6 md:pt-12 pb-6 md:pb-12">
            <video muted autoplay loop class="w-full h-auto"
                   preload="metadata">
                <source src="{{ asset('videos/video3.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <p class="pb-6 md:pb-12 text-sm md:text-base">Our modern designs are crafted with attention to detail, offering a perfect blend of style and comfort.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            <div class="bg-white p-4 shadow-md rounded-lg flex flex-col">
                <div class="flex-1">
                    <img src="{{ asset('assets/images/dress1.jpg') }}" alt="modern_dress1" class="w-full h-full object-cover rounded-md mb-4">
                </div>
                <h3 class="uppercase text-lg font-semibold">Minimalist Approach</h3>
                <p class="text-sm md:text-base mt-2">Embrace simplicity with our minimalist designs, focusing on clean lines and understated elegance.</p>
            </div>

            <div class="bg-white p-4 shadow-md rounded-lg flex flex-col">
                <div class="flex-1">
                    <img src="{{ asset('assets/images/dress2.jpg') }}" alt="modern_dress2" class="w-full h-full object-cover rounded-md mb-4">
                </div>
                <h3 class="uppercase text-lg font-semibold">Bold Statements</h3>
                <p class="text-sm md:text-base mt-2">Make a statement with bold colors and striking patterns, designed for those who dare to stand out.</p>
            </div>

            <div class="bg-white p-4 shadow-md rounded-lg flex flex-col">
                <div class="flex-1">
                    <img src="{{ asset('assets/images/dress3.jpg') }}" alt="modern_dress3" class="w-full h-full object-cover rounded-md mb-4">
                </div>
                <h3 class="uppercase text-lg font-semibold">Sustainable Fashion</h3>
                <p class="text-sm md:text-base mt-2">Our commitment to sustainability is reflected in our designs, featuring eco-friendly materials and processes.</p>
            </div>
        </div>

        <div class="mt-8 md:mt-12 w-full">
            <h2 class="uppercase text-xl md:text-2xl text-black pb-4">Design Philosophy</h2>

            <div class="flex flex-col md:flex-row items-center gap-4 pb-4">
                <div class="md:w-1/2 p-2">
                    <p class="text-sm md:text-base">Our modern design philosophy centers on blending innovation with tradition. We create pieces that are not only stylish but also timeless, ensuring they remain relevant for years to come.</p>
                </div>
                <div class="md:w-1/2">
                    <img src="{{ asset('assets/images/design_philosophy.jpg') }}" alt="design_philosophy" class="w-full h-auto rounded-md">
                </div>
            </div>
        </div>

    </div>
</x-guest-layout>
