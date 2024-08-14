import {createApp, reactive} from 'vue';
import SearchBarComponent from './components/SearchBarComponent.vue';
import WishlistComponent from './components/WishlistComponent.vue';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';


window.Alpine = Alpine;
Alpine.start();

const state = reactive({
    wishlistItems: JSON.parse(localStorage.getItem('wishlist_items')) || [],
});

// Initialize Vue for the search bar
const app = createApp({});
app.component('search-bar-component', SearchBarComponent);
app.mount('#app');

// Initialize Vue for the wishlist
const app1 = createApp({

    computed: {
        wishlist() {
            return state.wishlistItems;
        },
        wishlistCount() {
            return this.wishlistItems.length;
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


                // Show SweetAlert and refresh the page
                Swal.fire({
                    icon: 'success',
                    title: 'Product added to wishlist!',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    location.reload();
                });
            } else {
                console.log("Product already in wishlist");
                // Show SweetAlert for already existing product
                Swal.fire({
                    icon: 'info',
                    title: 'Product already in wishlist!',
                    showConfirmButton: false,
                    timer: 2000
                });
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


// Initialize Vue for the wishlist count
const app2 = createApp({

    computed: {
        wishlistCount() {
            return state.wishlistItems.length;
        }
    },
    methods: {
        updateWishlistCount() {
            const wishlist = JSON.parse(localStorage.getItem('wishlist_items')) || [];
            this.wishlistCount = wishlist.length;
        }
    },
    mounted() {
        this.updateWishlistCount();
        window.addEventListener('storage', this.updateWishlistCount);
    }
});

app2.mount('#app2');


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
