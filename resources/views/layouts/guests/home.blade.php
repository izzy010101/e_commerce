<!-- views/layouts/quests/home.blade.php -->
<x-guest-layout>
    <div class="flex flex-col lg:flex-row">

        <div class="order-2 lg:order-1 w-full lg:w-1/2 h-screen bg-cover bg-center"
             style="background-image: url('{{ asset('assets/images/bg_header.jpg') }}');"
        ></div>

        <div class="order-1 lg:order-2 w-full lg:w-1/2 h-screen px-6 py-20 text-center text-surface flex flex-col justify-center items-center dark:bg-neutral-700 dark:text-white">
            <h1 class="mb-6 text-6xl font-bold">Shop With Ease</h1>
            <h3 class="mb-8 text-3xl font-bold">Ziara Clothing</h3>
            <a class="bg-[#C5B358] inline-block rounded py-3 px-2 text-lg font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong" href="/register" role="button">Get started</a>
        </div>

    </div>


    {{--    middle part of the page--}}

    <div class="flex flex-col lg:flex-row">

        <div class="w-full lg:w-1/2 h-screen px-6 py-20 text-center text-surface flex flex-col justify-center items-center dark:bg-neutral-700 dark:text-white">
            <h1 class="mb-6 text-4xl font-thin">Introducing The Men 2024 Campaign</h1>
            <p class="mb-8 text-md w-full lg:w-1/2">Spotlighting individuality in Ziara Colluci’s new men’s campaign for the House.</p>
            <a class="inline-block py-3 px-2 text-lg font-medium uppercase leading-normal text-black font-semibold underline" href="{{ route('mencampaign') }}" role="button">Discover More</a>
        </div>

        <div class="w-full lg:w-1/2 bg-cover bg-no-repeat bg-center h-screen"
             style="background-image: url('{{ asset('assets/images/beige_man.jpg') }}');"
        ></div>

    </div>



    {{--    videos part of the page--}}
    <h1 class="font-thin lg:text-6xl text-5xl p-8 text-center mt-6 mb-6">Ziara Services</h1>

    <!-- videos -->
    <div class="flex flex-col items-center lg:flex-row lg:justify-center text-center lg:gap-10 lg:pb-8">

        <div class="max-w-sm lg:w-1/3">
            <a href="{{ route('personalization') }}">
                <video muted autoplay loop class="w-full h-[215.1px] lg:h-[300px]"
                       preload="metadata">
                    <source src="{{ asset('videos/video1.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </a>
            <div class="p-5">
                <a href="{{ route('personalization') }}">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white uppercase">Personalization</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">We create personalized luxury clothing tailored to individual styles, ensuring a unique and exclusive experience.</p>
                <a href="{{ route('personalization') }}" class="inline-flex items-center px-3 py-2 font-bold text-lg text-center text-black underline ">
                    Find Out How
                </a>
            </div>
        </div>

        <div class="max-w-sm lg:w-1/3">
            <a href="{{ route('customorder') }}">
                <video muted autoplay loop class="w-full h-[215.1px] lg:h-[300px]"
                       preload="metadata">
                    <source src="{{ asset('videos/video2.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </a>
            <div class="p-5">
                <a href="{{ route('customorder') }}">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white uppercase">Order your measurements</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Order with your exact measurements for a perfect fit, ensuring luxury and personalized comfort.</p>
                <a href="{{ route('customorder') }}" class="inline-flex items-center px-3 py-2 font-bold text-lg text-center text-black underline ">
                    Find Out How
                </a>
            </div>
        </div>

        <div class="max-w-sm lg:w-1/3">
            <a href="{{ route('moderndesign') }}">
                <video muted autoplay loop class="w-full h-[215.1px] lg:h-[300px]"
                       preload="metadata">
                    <source src="{{ asset('videos/video3.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </a>
            <div class="p-5">
                <a href="{{ route('moderndesign') }}">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white uppercase">Modern Design</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Order custom modern designs tailored to your style, offering exclusivity and personalized elegance.</p>
                <a href="{{ route('moderndesign') }}" class="inline-flex items-center px-3 py-2 font-bold text-lg text-center text-black underline ">
                    Find Out How
                </a>
            </div>
        </div>
    </div>


</x-guest-layout>

