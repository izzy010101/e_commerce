<!-- views/auth/login.blade.php -->
<x-guest-layout>
    <div class="flex flex-col lg:flex-row gap-4 px-6 pt-6">
        <div class="lg:w-1/2">
            <h3 class="text-2xl font-thin lg:pl-6">Welcome Back</h3>
            <p class="text-xs lg:pl-6">Sign in with your email address and password</p>

            <form method="POST" action="{{ route('login') }}" class="w-full p-0 lg:p-6">
                @csrf

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Email Address -->
                <div class="mt-4 lg:mt-0">
                    <x-input-label for="email" :value="__('Email*')" />
                    <input id="email"
                           class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-[#b8a93e] dark:focus:border-[#b8a93e] focus:ring-[#b8a93e] dark:focus:ring-[#b8a93e] rounded-md shadow-sm shadow-[#C5B358] block mt-1 w-full"
                           type="email"
                           name="email"
                           :value="old('email')"
                           autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password*')" />
                    <input id="password"
                           class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-[#b8a93e] dark:focus:border-[#b8a93e] focus:ring-[#b8a93e] dark:focus:ring-[#b8a93e] rounded-md shadow-sm shadow-[#C5B358] block mt-1 w-full"
                           type="password"
                           name="password"
                           autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-[#b8a93e] shadow-sm focus:ring-[#b8a93e] dark:focus:ring-[#b8a93e] dark:focus:ring-offset-[#b8a93e]" name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                {{-- Forgot password link --}}
                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    {{-- Login button --}}
                    <button class="primary_btn ms-3 inline-flex items-center px-4 py-2 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-[#b8a93e] dark:hover:bg-white focus:bg-[#b8a93e] dark:focus:bg-white active:bg-[#b8a93e] dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-[#b8a93e] focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        {{ __('Log in') }}
                    </button>
                </div>

                {{-- Don't have account section --}}
                <div class="text-gray-600 flex flex-col items-end pt-4">
                    <p>Don't have a Ziara account?</p>
                    <a href="/register" class="underline">Create yours now</a>
                </div>
            </form>
        </div>

        <!-- What will you get in Ziara account part of the page -->
        <div class="card w-full lg:w-1/2 h-auto lg:h-[500px] flex content-center justify-center mt-8 lg:mt-0">
            <div class="w-full lg:w-1/2 bg-[#e0e2e6] rounded h-auto lg:h-[360px] p-4 lg:p-6">
                <p class="uppercase text-xs font-thin mb-6">What will you find in your Ziara Account</p>

                <p class="flex items-center space-x-2 text-xs mb-4 pb-4 border-b border-b-[#C5B358]">
                    <img src="{{asset('assets/icons/cart_icon.png')}}" alt="cart_icon" class="w-[30px]">
                    <span>Select items and see in your cart</span>
                </p>

                <p class="flex items-center space-x-2 text-xs mb-4 pb-4 border-b border-b-[#C5B358]">
                    <img src="{{asset('assets/icons/credit_card_icon.png')}}" alt="credit_card_icon" class="w-[30px]">
                    <span>Manage your personal information</span>
                </p>

                <p class="flex items-center space-x-2 text-xs mb-4 pb-4 border-b border-b-[#C5B358]">
                    <img src="{{asset('assets/icons/newsletter_icon.png')}}" alt="newsletter_icon" class="w-[30px]">
                    <span>Receive Newsletters from Ziara Clothing</span>
                </p>

                <p class="flex items-center space-x-2 text-xs mb-4 pb-4 border-b border-b-[#C5B358]">
                    <img src="{{asset('assets/icons/offers_icon.png')}}" alt="offers_icon" class="w-[30px]">
                    <span>Get special offers and discounts</span>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
