<script setup lang="ts">
import CartProduct from '@/Components/CartProduct.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Product } from '@/types';
import { PropType } from 'vue';

const props = defineProps({
    products: Object as PropType<Product[]>
})

let totalPrice = 0

props.products!.forEach(element => {
    totalPrice += element.price
});

</script>

<template>
    <div class="py-16 flex flex-row">
        <div class="w-3/4 m-2 rounded-xl bg-white">
            <h1 class="p-4 border-b font-bold text-2xl">Your cart ({{ $page.props.auth.cart.product_ids.length }})</h1>
            <CartProduct v-for="product in props.products" :product="product" />
        </div>
        <div>
            <div class="w-full m-2 rounded-xl bg-white p-12 space-y-4">
                <button class="w-full p-2 mx-auto bg-[#ff503c] rounded-xl text-white">Go to checkout</button>
    
                <div class="space-x-4">
                    <span class="font-bold">TOTAL: </span>
                    <span>{{ totalPrice.toFixed(2) }} PLN</span>
                </div>
            </div>
        </div>

    </div>
</template>

<script lang="ts">
  export default {
    layout: GuestLayout
  }
</script>
