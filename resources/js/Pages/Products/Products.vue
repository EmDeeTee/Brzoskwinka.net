<script setup lang="ts" >
import GuestLayout from '@/Layouts/GuestLayout.vue';
import ShopPanel from '@/Components/ShopPanel.vue';
import { Product } from '@/types/index'
import type { PropType } from 'vue'
import { Search } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';


// const props = defineProps({
//     products: Object as PropType<Product>
// })

const props = defineProps<{
    products: Product[],
}>()

</script>

<template>
    <div className="py-20 mx-auto max-w-5xl bg-orange-0 space-y-8">
        <div class="flex justify-center ml-16 mr-16">
            <input class="min-w-[300px] rounded-l-xl md:min-w-full" type="text" :placeholder="`Search from ${props.products.length} products`" />
            <div class="mt-auto mb-auto p-2 bg-orange-500 rounded-r-xl">
                <Link href="/products/search/placeholder">
                    <Search :size="36" color="#ffffff" class="transition hover:scale-[85%] hover:rotate-12 active:scale-[110%] active:rotate-[66deg]" />
                </Link>
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
</script>