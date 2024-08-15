<template>
    <div>
        <h2>My Wishlist</h2>
        <ul>
            <li v-for="item in wishlistItems" :key="item.id">
                <img :src="item.image" :alt="item.name" class="w-24 h-24 object-cover rounded-lg mr-4" />
                <p>{{ item.name }}</p>
                <p v-if="isLoggedIn && !isAdmin">Price: ${{ item.price }}</p>

                <button @click="removeFromWishlist(item.id)">Remove</button>
            </li>
        </ul>
        <p v-if="isLoggedIn && !isAdmin">Total: ${{ subtotal }}</p>
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
