<script setup lang="ts">

import Item from '@/Components/Item.vue';
import { Product } from '@/types/index'

const props = defineProps({
    title: String,
    products: Array<Product>
})

</script>

<template>
    <div class="bg-white rounded-xl min-w-2 max-w-full">
        <h1 class="p-2 font-bold text-2xl">{{props.title}}</h1>
        <div class="space-x-4 flex-wrap flex flex-row justify-center">
            <Item v-for="product in props.products" :product="product" />
        </div>
    </div>
</template>