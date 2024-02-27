<script setup lang="ts">
import { Product } from '@/types';
import { Trash } from 'lucide-vue-next';
import { PropType } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';

const page = usePage()

const props = defineProps({
    product: Object as PropType<Product>
})

function removeItem(id: number) {
    axios.post('/cart/delete', {
        'cart_id': page.props.auth.cart.id,
        'cart_user_id': page.props.auth.cart.user_id,
        'product_id': props.product?.id
    }).then(function (res) {
        // NOTE: Refreshing the page every time you delete something is kinda meh
        location.reload()
    })
}

</script>

<template>
    <div class="p-4 flex flex-row items-center justify-between hover:bg-gray-200">
        <Link :href="'products/' + props.product?.id!">
            <div class="hover:underline flex items-center">
                <img :src="props.product?.imgSrc"/>
                <div class="px-4">
                    <h1 class="font-bold text-xl">{{ props.product?.name }}</h1>
                    <h1 class="">{{ props.product?.price }} PLN</h1>
                </div>
            </div>
        </Link>
        <div class="relative">
            <button @click="removeItem(props.product?.id!)"><Trash /></button>
        </div>
    </div>
</template>