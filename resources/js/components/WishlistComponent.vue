<template>
    <div>
        <h2>My Wishlist</h2>
        <ul>
            <li v-for="item in wishlistItems" :key="item.id">
                <p>{{ item.name }}</p>
                <p>Selected Color: {{ item.selectedColor }}</p>
                <p v-if="isLoggedIn && !isAdmin">Price: ${{ item.price }}</p>
                <button @click="removeFromWishlist(item.id)">Remove</button>
            </li>
        </ul>
        <p v-if="isLoggedIn && !isAdmin">Total: ${{ subtotal }}</p>
    </div>
</template>

<script>
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
            console.log('Removing item with ID:', productId);
            this.wishlistItems = this.wishlistItems.filter(item => item.id !== productId);
            localStorage.setItem('wishlist_items', JSON.stringify(this.wishlistItems));
            console.log('Updated wishlist:', this.wishlistItems);
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

<style scoped>
/* Add your component-specific styles here */
</style>
