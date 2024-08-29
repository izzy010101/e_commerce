<template>
    <div>
        <div v-for="item in wishlistItems" :key="item.id"
             class="flex items-center p-4 mb-4 border rounded-lg cursor-pointer hover:shadow-lg"
             style="transition: box-shadow 0.3s; box-shadow: none;" onmouseover="this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1)';" onmouseout="this.style.boxShadow='none';"
        >
            <img
                :src="item.image"
                :alt="item.name"
                class="w-16 h-16 object-cover rounded-lg mr-4 sm:w-24 sm:h-24 md:w-28 md:h-28"
            />
            <div class="flex-1">
                <p class="font-semibold">{{ item.name }}</p>
                <p class="text-sm text-gray-500">Color: {{ capitalizeFirstLetter(item.selectedColor || item.color) }}</p>
                <p v-if="isLoggedIn && !isAdmin" class="text-sm text-gray-500">Price: ${{ item.price }}</p>
            </div>
            <!-- Wrapper around the button with ml-auto to move it to the right -->
            <div class="ml-auto">
                <button @click="removeFromWishlist(item.id)" class="text-red-500 hover:text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>
            </div>
        </div>
        <p v-if="isLoggedIn && !isAdmin" class="mt-4">Total cost: ${{ subtotal }}</p>
    </div>
</template>

<script>
import Swal from "sweetalert2";

export default {
    data() {
        return {
            wishlistItems: [],
            isLoggedIn: false,
            isAdmin: false,
        };
    },
    computed: {
        subtotal() {
            return this.wishlistItems.reduce((total, item) => {
                return total + (item.price || 0);
            }, 0);
        }
    },
    methods: {
        capitalizeFirstLetter(string) {
            if (!string) return string;
            return string.charAt(0).toUpperCase() + string.slice(1);
        },
        removeFromWishlist(productId) {
            this.wishlistItems = this.wishlistItems.filter(item => item.id !== productId);
            localStorage.setItem('wishlist_items', JSON.stringify(this.wishlistItems));

            // Show SweetAlert and refresh the page
            Swal.fire({
                icon: 'success',
                title: 'Product removed from wishlist!',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                location.reload();
            });
        }
    },
    mounted() {
        const savedWishlist = localStorage.getItem('wishlist_items');
        if (savedWishlist) {
            this.wishlistItems = JSON.parse(savedWishlist);
        }

        const userMeta = document.querySelector('meta[name="user"]');
        if (userMeta) {
            const user = JSON.parse(userMeta.getAttribute('content'));
            this.isLoggedIn = true;
            this.isAdmin = user.role === 'admin';
        }
    }
}
</script>
