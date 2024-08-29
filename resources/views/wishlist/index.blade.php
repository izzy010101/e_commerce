<!-- views/wishlist/index.blade.php -->
<x-app-layout>
    <div class="container mx-auto p-12">
        <div class="bg-[#C5B358] mt-1 ml-4 mr-4 mb-10 sm:mt-0 sm:ml-0 sm:mr-0 sm:mb-1 !mb-8 rounded-lg p-6 shadow-lg flex items-center justify-center">
            <h2 class="text-4xl font-extrabold text-gray-800 text-white tracking-wide text-center">Wishlist</h2>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div id="app1">
                <wishlist-component v-if="wishlistItems.length" :wishlist-items="wishlistItems"></wishlist-component>

                <template v-else>
                    <p>No items in your wishlist.</p>
                </template>
            </div>
        </div>
    </div>

</x-app-layout>
