<x-guest-layout>


    <div class="flex flex-col gap-4 p-6">
        <h3 class="text-2xl font-thin">Create Your Account</h3>
        <p class="text-xs">Create your account to have access to a more personalized experience.</p>
    </div>


        <div class="flex p-6">
            <form method="POST" action="{{ route('register') }}" class="w-1/2 h-[500px]">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name*')" />
                    <input id="name"  class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-[#b8a93e] dark:focus:border-[#b8a93e] focus:ring-[#b8a93e] dark:focus:ring-[#b8a93e] rounded-md shadow-sm shadow-[#C5B358] block mt-1 w-full type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email*')" />
                    <input id="email"
                           class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-[#b8a93e] dark:focus:border-[#b8a93e] focus:ring-[#b8a93e] dark:focus:ring-[#b8a93e] rounded-md shadow-sm shadow-[#C5B358] block mt-1 w-full"
                           type="email"
                           name="email"
                           :value="old('email')"
                           autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password*')" />

                    <input id="password"  class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-[#b8a93e] dark:focus:border-[#b8a93e] focus:ring-[#b8a93e] dark:focus:ring-[#b8a93e] rounded-md shadow-sm shadow-[#C5B358] block mt-1 w-full
                                    type="password"
                                    name="password"
                                    autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password*')" />

                    <input id="password_confirmation" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-[#b8a93e] dark:focus:border-[#b8a93e] focus:ring-[#b8a93e] dark:focus:ring-[#b8a93e] rounded-md shadow-sm shadow-[#C5B358] block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <button class="primary_btn ms-4 primary_btn ms-3 inline-flex items-center px-4 py-2 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-[#b8a93e] dark:hover:bg-white focus:bg-[#b8a93e] dark:focus:bg-white active:bg-[#b8a93e] dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-[#b8a93e] focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>

            <!-- What will you get in ziara account part of the page -->
            <div class="card w-1/2 h-[500px] flex content-center justify-center">
                <div class="w-1/2 rounded bg-[#e0e2e6] h-[360px]">
                    <p class="uppercase text-xs font-thin p-6">What will you find in your Ziara Account</p>


                    <p class="flex items-center space-x-2 text-xs m-4 pl-4 pb-4 border-b border-b-[#C5B358]">
                        <img src="{{asset('assets/icons/cart_icon.png')}}" alt="cart_icon" class="w-[30px]">
                        <span class="h-fit">Select items and see in your cart</span>
                    </p>

                    <p class="flex items-center space-x-2 text-xs m-4 pl-4 pb-4 border-b border-b-[#C5B358]">
                        <img src="{{asset('assets/icons/credit_card_icon.png')}}" alt="cart_icon" class="w-[30px]">
                        <span class="h-fit">Manage your personal information</span>
                    </p>

                    <p class="flex items-center space-x-2 text-xs m-4 pl-4 pb-4 border-b border-b-[#C5B358]">
                        <img src="{{asset('assets/icons/newsletter_icon.png')}}" alt="cart_icon" class="w-[30px]">
                        <span class="h-fit">Receive Newsletters from Ziara Clothing</span>
                    </p>

                    <p class="flex items-center space-x-2 text-xs m-4 pl-4 pb-4 border-b border-b-[#C5B358]">
                        <img src="{{asset('assets/icons/offers_icon.png')}}" alt="cart_icon" class="w-[30px]">
                        <span class="h-fit">Get special offers and discounts</span>
                    </p>
                </div>
            </div>
        </div>



</x-guest-layout>
