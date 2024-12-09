<script setup lang="ts" >
import GuestLayout from '@/Layouts/GuestLayout.vue';
import ShopPanel from '@/Components/ShopPanel.vue';
import { Category, Product } from '@/types/index'
import { ref } from 'vue'
import { Search } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';

const searchQuery = ref<String>('')
const searchCategoryId = ref<number>(0)
const props = defineProps<{
    products: Product[],
    totalProductsCount: number, // Count of products in the entire database
    lastSearchQuery: string,
    errorMsg: string | null,
    category: string | null,
    allCategories: Array<string>,
}>()

if (props.lastSearchQuery.length > 0) {
    searchQuery.value = props.lastSearchQuery
}

function onSearch() {
    if (searchQuery.value.trim().length == 0) {
        window.location.href = `/products`
        return;
    }
    window.location.href = `/products/search/${searchQuery.value}`
}

</script>

<template>
    <div className="py-20 mx-auto max-w-5xl bg-orange-0 space-y-8">
        <div v-if="props.errorMsg" class="flex justify-center">
            {{ props.errorMsg }}
        </div>
        <div class="flex justify-center ml-16 mr-16">
            <input v-model="searchQuery" v-on:keyup.enter="onSearch()" class="min-w-[200px] rounded-l-xl md:min-w-full md:text-lg" type="text" :placeholder="`Search from ${props.totalProductsCount} products`" />
            <select v-model="searchCategoryId">
                <option :value="0">All</option>
                <option v-for="(category, index) in props.allCategories" :value="index+1">{{ category }}</option>
            </select>
            <div class="mt-auto mb-auto p-2 bg-orange-500 rounded-r-xl">
                <button @click="onSearch()">
                    <Search :size="36" color="#ffffff" class="mt-1 transition hover:scale-[85%] hover:rotate-12 active:scale-[110%] active:rotate-[66deg]" />
                </button>
            </div>
        </div>
        <ShopPanel :title="props.category ? props.category : $t('all.listings').toUpperCase()" :products="props.products" />
    </div>
</template>

<script lang="ts">
    export default {
        layout: GuestLayout
    }
</script>