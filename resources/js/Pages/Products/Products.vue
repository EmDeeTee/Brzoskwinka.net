<script setup lang="ts" >
import GuestLayout from '@/Layouts/GuestLayout.vue';
import ShopPanel from '@/Components/ShopPanel.vue';
import { Product } from '@/types/index'
import { ref } from 'vue'
import { Search } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
import { POSITION, TYPE, useToast } from 'vue-toastification';

const searchQuery = ref<String>('')
const toast = useToast()
const props = defineProps<{
    products: Product[],
    productsCount: number,
    lastSearchQuery: string,
    errorMsg: string | null,
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
            <input v-model="searchQuery" v-on:keyup.enter="onSearch()" class="min-w-[300px] rounded-l-xl md:min-w-full text-lg" type="text" :placeholder="`Search from ${props.productsCount} products`" />
            <div class="mt-auto mb-auto p-2 bg-orange-500 rounded-r-xl">
                <button @click="onSearch()">
                    <Search :size="36" color="#ffffff" class="mt-1 transition hover:scale-[85%] hover:rotate-12 active:scale-[110%] active:rotate-[66deg]" />
                </button>
            </div>
        </div>
        <ShopPanel :title="$t('laptops').toUpperCase()" :products="props.products" />
        <ShopPanel :title="$t('pcs').toUpperCase()" :products="props.products" />
        <ShopPanel :title="$t('monitors').toUpperCase()" :products="props.products" />
    </div>
</template>

<script lang="ts">
    export default {
        layout: GuestLayout
    }
</script>POSITION, TYPE, POSITION, TYPE, 