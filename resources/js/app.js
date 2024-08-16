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

const app = createApp({});
app.component('search-bar-component', SearchBarComponent);
app.mount('#app');

const app1 = createApp({
    data() {
        return {
            wishlistItems: [],
            selectedColor: '',
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

            const hiddenInput = element.querySelector('input[name="selected_color"]');
            if (hiddenInput) {
                hiddenInput.value = color;
            }
        },
        addToWishlist(product) {
            const activeImageElement = document.querySelector('.product-image.active');
            const activeImagePath = activeImageElement ? activeImageElement.getAttribute('data-path') : '';

            product.selectedColor = this.selectedColor; // Use the selected color from this instance
            product.image = activeImagePath;

            let wishlist = this.wishlistItems;
            const exists = wishlist.find(item => item.id === product.id && item.color === product.color);

            if (!exists) {
                wishlist.push(product);
                this.wishlistItems = wishlist;
                localStorage.setItem('wishlist_items', JSON.stringify(wishlist));

                Swal.fire({
                    icon: 'success',
                    title: 'Product added to wishlist!',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    location.reload();
                });
            } else {
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

app1.component('wishlist-component', WishlistComponent);
app1.mount('#app1');

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

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[id^="app1-"]').forEach((element) => {
        const appInstance = createApp({
            data() {
                return {
                    selectedColor: '' // Initialize selected color
                };
            },
            methods: {
                setColor(color) {
                    this.selectedColor = color;
                    console.log("Selected color:", this.selectedColor);
                },
                addToWishlist(product) {
                    const activeImageElement = document.querySelector('.product-image.active');
                    const activeImagePath = activeImageElement ? activeImageElement.getAttribute('data-path') : '';

                    product.selectedColor = this.selectedColor; // Use the selected color from this instance
                    product.image = activeImagePath;

                    let wishlist = JSON.parse(localStorage.getItem('wishlist_items')) || [];
                    const exists = wishlist.find(item => item.id === product.id && item.selectedColor === product.selectedColor);

                    if (!exists) {
                        wishlist.push(product);
                        localStorage.setItem('wishlist_items', JSON.stringify(wishlist));

                        Swal.fire({
                            icon: 'success',
                            title: 'Product added to wishlist!',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            location.reload();
                        });
                    } else {
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
