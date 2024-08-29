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

            // Update the hidden input field in the cart form
            const hiddenInput = document.querySelector('input[name="selected_color"]');
            if (hiddenInput) {
                hiddenInput.value = color;
            }
        },
        addToWishlist(product) {
            const activeImageElement = document.querySelector('.product-image.active');
            const activeImagePath = activeImageElement ? activeImageElement.getAttribute('data-path') : '';

            console.log(product.selectedColor);
            if(product.selectedColor === 'undefined'){
                product.selectedColor = document.querySelector('#colors_circles_container').firstChild;

                // Check if the first child exists and retrieve its background color
                if (firstChild) {
                    const firstChildBackgroundColor = window.getComputedStyle(firstChild).backgroundColor;
                    console.log('First child background color:', firstChildBackgroundColor);

                    // Assign the background color to product.selectedColor
                    product.selectedColor = firstChildBackgroundColor;
                } else {
                    console.log('No child elements found in the container.');
                }
            }
            product.selectedColor = this.selectedColor;


            product.image = activeImagePath;

            let wishlist = this.wishlistItems;
            const exists = wishlist.find(item => item.id === product.id && item.color === product.selectedColor);

            if (!exists) {
                wishlist.push(product);
                this.wishlistItems = wishlist;
                localStorage.setItem('wishlist_items', JSON.stringify(wishlist));

                // Update session after adding to the wishlist
                this.updateCartSession();

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
        updateCartSession() {
            const wishlist = JSON.parse(localStorage.getItem('wishlist_items')) || [];
            sessionStorage.setItem('cart_item_count', wishlist.length);

            // Update the UI or red dot based on the new cart item count
            if (wishlist.length > 0) {
                // Show red dot
                document.querySelector('#cart-icon').classList.add('has-items');
            } else {
                // Hide red dot
                document.querySelector('#cart-icon').classList.remove('has-items');
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
                setColor(color, productId) {
                    this.selectedColor = color;
                    console.log("Selected color:", this.selectedColor);

                    // Update the hidden input field in the cart form using productId
                    const hiddenInput = document.getElementById(`selectedColor_${productId}`);
                    if (hiddenInput) {
                        hiddenInput.value = color;
                    }
                },
                addToWishlist(product) {
                    const activeImageElement = document.querySelector('.product-image.active');
                    const activeImagePath = activeImageElement ? activeImageElement.getAttribute('data-path') : '';

                        // Use selected color or fallback to the first child's background color name
                        if (!this.selectedColor) {
                            // Query the specific container for the current product by matching product ID
                            const container = document.querySelector(`#colors_circles_container-${product.id}`);

                            if (container) {
                                const firstChild = container.firstElementChild;

                                // Check if the first child exists
                                if (firstChild) {
                                    // Directly access the color name from the inline style attribute
                                    const firstChildBackgroundColor = firstChild.style.backgroundColor;

                                    // Ensure the color name is retrieved and used; fallback to first computed color if needed
                                    if (firstChildBackgroundColor) {
                                        console.log(`First child color name:`, firstChildBackgroundColor);
                                        this.selectedColor = firstChildBackgroundColor;
                                    } else {
                                        // Retrieve the computed style if the inline style is not set
                                        const computedColor = window.getComputedStyle(firstChild).backgroundColor;
                                        console.log(`Computed color:`, computedColor);
                                        this.selectedColor = computedColor;
                                    }
                                } else {
                                    console.log(`Container has no child elements.`);
                                }
                            } else {
                                console.log(`No container found for product ID: ${product.id}`);
                            }
                        }


                        product.selectedColor = this.selectedColor; // Use the selected or default color


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

    // Handle local storage clearing on logout
    const logoutLink = document.getElementById('logout-link');

    if (logoutLink) {
        logoutLink.addEventListener('click', () => {
            // Clear local storage key 'wishlist_items'
            localStorage.removeItem('wishlist_items');
        });
    }
});
