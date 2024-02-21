<script setup lang="ts">

import Item from '@/Components/Item.vue';
import { Product } from '@/types/index'

const props = defineProps({
    title: String,
    products: Array<Product>
})

</script>

<template>


    <div class="bg-white rounded-xl overflow-auto min-w-2 max-w-full">
        <h1 class="p-2 font-bold text-2xl">{{props.title}}</h1>
        <div class="min-w-64 flex flex-row flex-wrap">
            <div class="space-x-4 m-3 flex justify-center">
                <Item v-for="product in props.products" :product="product" />
            </div>
        </div>
    </div>


</template>