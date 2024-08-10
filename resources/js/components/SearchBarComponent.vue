<template>
    <form @submit.prevent="search" class="relative">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none h-full">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>


            <input
                v-model="query"
                @input="search"
                type="search"
                id="default-search"
                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-[#C5B358] focus:border-[#C5B358] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#C5B358] dark:focus:border-[#C5B358]"
                placeholder="Search..."
                required
                style="padding-left: 35px;"
            />
            <button
                type="submit"
                class="text-white absolute bg-[#C5B358] hover:bg-[#C5B358] focus:ring-4 focus:outline-none focus:ring-[#C5B358] font-medium rounded-lg text-sm px-4 py-2 dark:bg-[#C5B358] dark:hover:bg-[#C5B358] dark:focus:ring-[#C5B358]"
                style="right: 10px; bottom: 10px;"
            >
                Search
            </button>
        </div>
        <ul v-if="limitedResults.length"
            class="absolute left-0 w-full max-w-full bg-white border border-gray-300 rounded-lg mt-1 max-h-60 overflow-y-auto z-10"
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
import { ref, computed } from 'vue';
import axios from 'axios';

const query = ref('');
const results = ref([]);

const search = async () => {
    if (query.value.trim() === '') {
        results.value = [];
        return;
    }

    try {
        const response = await axios.get('/search-products', {
            params: { q: query.value }
        });
        results.value = response.data;
    } catch (error) {
        console.error('Search error:', error);
    }
};

const limitedResults = computed(() => results.value.slice(0, 7));

const redirectToProduct = (id) => {
    window.location.href = `/products/${id}`;
};


</script>

<style scoped></style>
