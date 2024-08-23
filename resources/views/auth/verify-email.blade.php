<!-- views/auth/verify-email.blade.php -->
<x-guest-layout>
    <div class="flex flex-col items-center">
        <div class="w-1/2  text-center m-4 text-md text-gray-600 dark:text-gray-400">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                  <button
                    class="bg-[#C5B358] inline-block rounded py-2 px-2 text-sm font-bold uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
                  >
                        {{ __('Resend Verification Email') }}
                  </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
