<script setup lang="ts">
import { Product } from '@/types/index'
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    product: Object as () => Product
})

</script>

<template>
    <div class="text-center pt-4 hover:underline cursor-pointer">
        <Link :href="route('products.display', {id: product?.id})">
            <img :src="props.product?.imgSrc" class="pb-3"/>
            <span class="text-xl font-bold">
                {{ props.product?.price.toPrecision(2) }} PLN
            </span>
            <h1 class="m-0 p-0">
                {{ props.product?.name }}
            </h1>
        </Link>
    </div>
</template>