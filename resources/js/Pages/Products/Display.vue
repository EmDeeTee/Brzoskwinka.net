<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import type { Product } from '@/types/index'
import type { PropType } from 'vue'

const props = defineProps({
    product: Object as PropType<Product>
})

</script>

<template>
    <GuestLayout>
        <div class="py-10">
            <h1>PRODUCT ID: {{ props.product?.id }}</h1>
            <h1>PRODUCT NAME: {{ props.product?.name }}</h1>
            <h1>PRODUCT PRICE: {{ props.product?.price }}</h1>
        </div>
    </GuestLayout>
</template>