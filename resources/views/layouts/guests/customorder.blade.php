<!-- views/layouts/quests/customorder.blade.php -->
<x-guest-layout>
    <div class="flex flex-col items-center p-6 md:p-12 text-center justify-center text-gray-600">
        <h1 class="uppercase font-thin text-3xl md:text-4xl">Custom Measurements</h1>

        <p class="text-base md:text-lg pt-4 font-bold">Get the perfect fit with our custom measurement services tailored just for you.</p>

        <div class="w-full pt-6 md:pt-12 pb-6 md:pb-12">
            <video muted autoplay loop class="w-full h-auto"
                   preload="metadata">
                <source src="{{ asset('videos/video2.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <p class="pb-6 md:pb-12 text-sm md:text-base">Ensure your garments fit perfectly by taking advantage of our custom measurement services, available both online and in-store.</p>

        <div class="flex flex-col md:flex-row gap-4 md:gap-6">
            <a href="#onlinecustom" class="underline hover:text-primaryHover text-sm md:text-base">Online Customization</a>
            <a href="#instorecustom" class="underline hover:text-primaryHover text-sm md:text-base">In Store Service</a>
        </div>

        <section id="onlinecustom" class="mt-8 md:mt-12 w-full">
            <h2 class="uppercase text-xl md:text-2xl text-black pb-4">Online Customization</h2>

            <div class="flex flex-col md:flex-row items-center gap-4 pb-4">
                <div class="md:w-1/2 p-2">
                    <p class="text-sm md:text-base">Submit your measurements online to have your garments tailored exactly to your size. Our easy-to-use form guides you through the process to ensure accuracy and satisfaction.</p>
                    <p class="text-sm md:text-base">If you prefer, our experts can guide you through the process via a virtual appointment.</p>
                </div>
                <div class="md:w-1/2">
                    <img src="{{ asset('assets/images/measurments1.jpg') }}" alt="online_custom_measurements" class="w-full h-auto">
                </div>
            </div>
        </section>

        <section id="instorecustom" class="mt-8 md:mt-12 w-full">
            <h2 class="uppercase text-xl md:text-2xl text-black pb-4">In Store Service</h2>

            <div class="flex flex-col md:flex-row items-center gap-4 pb-4">
                <div class="md:w-1/2 order-2 md:order-1">
                    <img src="{{ asset('assets/images/measurments2.jpg') }}" alt="instore_custom_measurements" class="w-full h-auto">
                </div>
                <div class="md:w-1/2 p-2 order-1 md:order-2">
                    <p class="text-sm md:text-base">Visit our boutique to receive personalized measurement services. Our experts will ensure your garments are tailored to your exact specifications, with attention to detail and precision.</p>
                    <p class="text-sm md:text-base">Consult with a Style Advisor to find the best options for your wardrobe.</p>
                </div>
            </div>
        </section>

    </div>
</x-guest-layout>

