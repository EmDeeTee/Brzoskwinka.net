<script setup lang="ts">
import CartProduct from '@/Components/CartProduct.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Product } from '@/types';
import { ref } from 'vue';
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
    <div class="py-16 flex flex-col md:flex-row">
        <div class="m-2 rounded-xl bg-white md:w-3/4">
            <h1 class="p-4 border-b font-bold text-2xl">
                {{$t('cart.your.cart')}} ({{ $page.props.auth.cart.product_ids.length }})
            </h1>
            <div class="">
                <CartProduct v-for="product in products" :product="product" />
            </div>
        </div>
        <div class="md:w-1/4">
            <div class="m-2 min-w-64 rounded-xl bg-white p-12 space-y-4">
                <button class="w-full p-2 mx-auto bg-[#ff503c] rounded-xl text-white hover:opacity-70 transition">
                    <p class="font-bold text-lg">
                        {{ $t('cart.checkout') }}
                    </p>
                </button>

                <div class="space-x-4">
                    <span class="font-bold">{{ $t('cart.total') }}: </span>
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
