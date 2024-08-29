<template>
    <form @submit.prevent class="relative">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none h-full">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>

            <input
                v-model="query"
                @input="handleInput"
                type="search"
                id="default-search"
                :style="inputStyles"
                placeholder="Search..."
                class="w-full rounded-md shadow-sm block  p-2.5 ps-12 pe-12 text-gray-500"
                autocomplete="off"
            />

        </div>

        <ul v-if="limitedResults.length && !errorOccurred"
            class="absolute left-0 w-full max-w-full bg-white border border-gray-300 rounded-lg mt-1 max-h-60 overflow-y-auto z-30"
        >
            <li
                v-for="result in limitedResults"
                :key="result.id"
                @click="redirectToProduct(result.id)"
                class="p-2 hover:bg-gray-100 cursor-pointer dark:hover:bg-gray-600"
            >
                {{ result.name }}
            </li>
        </ul>
    </form>
</template>

<script setup>
import {ref, computed} from 'vue';
import axios from 'axios';

const query = ref('');
const results = ref([]);
const errorOccurred = ref(false);

const inputStyles = computed(() => {
    return {
        borderColor: errorOccurred.value ? 'red' : '#C5B358',
        boxShadow: errorOccurred.value ? '0 0 0 2px rgba(239, 68, 68, 0.5)' : '0 0 0 2px rgba(197, 179, 88, 0.5)',
        width: '100%',
        paddingLeft: '35px',
        borderRadius: '0.375rem',

    };
});

const handleInput = async () => {
    if (query.value.trim() === '') {
        applyErrorStyles();
        results.value = []; // Clear results if input is empty
    } else {
        await search();
        if (results.value.length > 0) {
            resetInputStyles();
        } else {
            applyErrorStyles();
        }
    }
};

const search = async () => {
    try {
        const response = await axios.get('/search-products', {
            params: {q: query.value}
        });
        results.value = response.data;
        errorOccurred.value = results.value.length === 0;
    } catch (error) {
        console.error('Search error:', error);
        results.value = [];
        applyErrorStyles();
    }
};

const resetInputStyles = () => {
    errorOccurred.value = false;
};

const applyErrorStyles = () => {
    errorOccurred.value = true;
};

const limitedResults = computed(() => results.value.slice(0, 7));

const redirectToProduct = (id) => {
    window.location.href = `/products/${id}`;
};

</script>

<style scoped>

input[type="search"]::-webkit-search-cancel-button {
    -webkit-appearance: none;
    height: 16px;
    width: 16px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23757575' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cline x1='18' y1='6' x2='6' y2='18'/%3E%3Cline x1='6' y1='6' x2='18' y2='18'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: center;
    cursor: pointer;
}

input[type="search"]::-webkit-search-cancel-button:hover {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23909090' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cline x1='18' y1='6' x2='6' y2='18'/%3E%3Cline x1='6' y1='6' x2='18' y2='18'/%3E%3C/svg%3E");
}
</style>
