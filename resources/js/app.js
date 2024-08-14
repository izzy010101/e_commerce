import { createApp } from 'vue';
import SearchBarComponent from './components/SearchBarComponent.vue';
import WishlistComponent from './components/WishlistComponent.vue';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Initialize Vue for the search bar
const app = createApp({});
app.component('search-bar-component', SearchBarComponent);
app.mount('#app');

// Initialize Vue for the wishlist
const app1 = createApp({
    data() {
        return {
            wishlistItems: []
        };
    },
    computed: {
        wishlist() {
            return this.wishlistItems;
        }
    },
    methods: {
        addToWishlist(product) {
            console.log("Adding to wishlist:", product);
            let wishlist = this.wishlistItems;
            const exists = wishlist.find(item => item.id === product.id);

            if (!exists) {
                wishlist.push(product);
                this.wishlistItems = wishlist;
                localStorage.setItem('wishlist_items', JSON.stringify(wishlist));
                console.log("Product added to wishlist:", wishlist);
            } else {
                console.log("Product already in wishlist");
            }
        },
        loadWishlist() {
            const savedWishlist = localStorage.getItem('wishlist_items');
            if (savedWishlist) {
                this.wishlistItems = JSON.parse(savedWishlist);
            }
        }
    },
    mounted() {
        this.loadWishlist();
    }
});

// Mount the WishlistComponent to the main wishlist Vue instance
app1.component('wishlist-component', WishlistComponent);
app1.mount('#app1');

// Share wishlist data between apps
app.config.globalProperties.wishlistItems = app1.wishlistItems;

// Mount Vue instance on all wishlist buttons across the page
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[id^="app1-"]').forEach((element) => {
        const appInstance = createApp({
            methods: {
                addToWishlist(product) {
                    let wishlist = JSON.parse(localStorage.getItem('wishlist_items')) || [];
                    const exists = wishlist.find(item => item.id === product.id);

                    if (!exists) {
                        wishlist.push(product);
                        localStorage.setItem('wishlist_items', JSON.stringify(wishlist));
                        console.log("Product added to wishlist:", wishlist);
                    } else {
                        console.log("Product already in wishlist");
                    }
                }
            }
        });
        appInstance.mount(`#${element.id}`);
    });
});
