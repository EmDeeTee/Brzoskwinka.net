<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import type { Product } from '@/types/index'
import { ShoppingCart, Truck } from 'lucide-vue-next';
import type { PropType } from 'vue'

const props = defineProps({
    product: Object as PropType<Product>
})

</script>

<template>
    <GuestLayout>
        <div class="flex flex-row py-16">
            <div class="w-2/3 m-2 rounded-xl bg-white">
                <div class="m-3">
                    <h1 class="font-bold text-2xl pb-2">{{ props.product?.name }}</h1>

                    <div class="flex justify-center">
                        <img :src="props.product?.imgSrc" class="pb-3 size-64 flex"/>
                    </div>

                    <p class="mt-10">
                        Manufacturer: Dell <br />
                        Model: Inspiron 1525  <br />
                        CPU: Intel Pentium <br />
                        MHz: 2130 <br />
                        RAM: 4 GB <br />
                    </p>

                </div>
                
            </div>

            <div class="w-1/3 m-2 flex flex-col rounded-xl bg-white max-h-[22rem] md:max-h-[15rem]">
                <div class="m-2">
                    <span class="font-light">Seller: </span>
                    <span class="font-semibold">Brzoskwinka.Net</span>
                </div>

                <div class="border-t border-b font-bold p-3 md:flex">
                    <div>
                        <h1 class="text-3xl">{{ props.product?.price }} PLN</h1>
                        <p class="font-light">1 units available</p>
                    </div>
                    <div class="flex items-center mx-auto ">
                        <button class="text-white p-3 rounded-lg bg-[#ff503c] hover:opacity-70 w-40 md:w-56">Add to cart</button>
                    </div>
                </div>

                <div class="flex p-3 space-x-1">
                    <Truck />
                    <p>12,99 PLN</p>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>