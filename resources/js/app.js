import { createApp, reactive } from 'vue';
import SearchBarComponent from './components/SearchBarComponent.vue';
import WishlistComponent from './components/WishlistComponent.vue';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

window.Alpine = Alpine;
Alpine.start();

const state = reactive({
    wishlistItems: JSON.parse(localStorage.getItem('wishlist_items')) || [],
    selectedColor: '', // Default selected color
});

// Initialize Vue for the search bar
const app = createApp({});
app.component('search-bar-component', SearchBarComponent);
app.mount('#app');

// Initialize Vue for the wishlist

const app1 = createApp({
    data() {
        return {
            wishlistItems: [],
            selectedColor: null,  // Store the selected color
        };
    },
    computed: {
        wishlist() {
            return this.wishlistItems;
        },
        wishlistCount() {
            return this.wishlistItems.length;
        }
    },
    methods: {
        setColor(color) {
            this.selectedColor = color;
            console.log("Selected color:", this.selectedColor);
        },
        addToWishlist(product) {
            console.log("Adding to wishlist:", product);

            // Ensure that a color is selected
            const color = this.selectedColor || 'defaultColor';
            product.color = color;

            // Ensure that the currently active image is available
            const activeImageElement = document.querySelector('.product-image.active');
            if (!activeImageElement) {
                console.error('Active image element not found');
                return;
            }
            const selectedImage = activeImageElement.getAttribute('data-path');
            product.image = selectedImage;

            let wishlist = this.wishlistItems;
            const exists = wishlist.find(item => item.id === product.id && item.color === product.color);

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
                    // Get the active image path
                    const activeImageElement = document.querySelector('.product-image.active');
                    const activeImagePath = activeImageElement ? activeImageElement.getAttribute('data-path') : '';

                    // Add selected color and active image to the product object
                    product.selectedColor = state.selectedColor;
                    product.image = activeImagePath;

                    let wishlist = JSON.parse(localStorage.getItem('wishlist_items')) || [];
                    const exists = wishlist.find(item => item.id === product.id);

                    if (!exists) {
                        wishlist.push(product);
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
                            icon: 'warning',
                            title: 'Product already in wishlist!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                }
            }
        });
        appInstance.mount(`#${element.id}`);
    });
});
