<script setup lang="ts" >
import GuestLayout from '@/Layouts/GuestLayout.vue';
import ShopPanel from '@/Components/ShopPanel.vue';
import { Product } from '@/types/index'
import type { PropType } from 'vue'

const props = defineProps({
    products: Object as PropType<Product>
})

</script>

<template>
    <div className="py-20 mx-auto max-w-5xl bg-orange-0 space-y-8">
        <ShopPanel :title="$t('laptops').toUpperCase()" :products="props.products" />
        <ShopPanel :title="$t('pcs').toUpperCase()" :products="props.products" />
        <ShopPanel :title="$t('monitors').toUpperCase()" :products="props.products" />
    </div>
</template>

<script lang="ts">
    export default {
        layout: GuestLayout
    }
</script>