<script setup lang="ts">

import Item from '@/Components/Item.vue';
import { Product } from '@/types/index'

const props = defineProps({
    title: String,
    products: Array<Product>
})

</script>

<template>
    <div class="bg-white rounded-xl max-w-full pb-4">
        <h1 class="p-2 font-bold text-2xl">{{props.title}}</h1>
        <div class="space-x-4 flex-wrap flex flex-row justify-center ml-1 mr-1">
            <Item :key="product.id" v-for="product in props.products" :product="product" />
        </div>
    </div>
</template>