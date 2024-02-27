<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import type { Product } from '@/types/index'
import { Check, ShoppingCart, Truck } from 'lucide-vue-next';
import { ref, type PropType } from 'vue'
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3'
import axios from 'axios';
import { POSITION, TYPE, useToast } from 'vue-toastification';

const page = usePage()
const addedToCart = ref(false)
const toast = useToast();

interface Seller {
    id: Number,
    name: String
}

const props = defineProps({
    product: Object as PropType<Product>,
    seller: Object as PropType<Seller>
})

function addToCart(product_id: number) {
    if (page.props.auth.user !== null && page.props.auth.user.id === props.seller?.id) {
        toast("You can't add your own items to cart", {
            position: POSITION.BOTTOM_CENTER,
            type: TYPE.INFO
        });
        return
    }
    axios.post('/cart/add', {
        'cart_id': page.props.auth.cart.id,
        'cart_user_id': page.props.auth.cart.user_id,
        'product_id': product_id
    })
    .then(function (res) {
        console.log(res);
        page.props.auth.cart.product_ids.push(product_id)
        addedToCart.value = true
    }).catch(function (err) {
        if (err.response.status == 418) {
            toast("You already have this item in your cart", {
                position: POSITION.BOTTOM_CENTER,
                type: TYPE.INFO
            });
        }
    })
}

if (page.props.auth.cart.product_ids.includes(props.product?.id!)) {
    addedToCart.value = true
}

</script>

<template>
    <div class="flex flex-row py-16">
        <div class="w-2/3 m-2 rounded-xl bg-white">
            <div class="m-3">
                <h1 class="font-bold text-2xl pb-2">{{ props.product?.name }}</h1>

                <div class="flex justify-center">
                    <img :src="props.product?.imgSrc" class="pb-3 size-64 flex"/>
                </div>

                <!-- <p class="mt-10">
                    Manufacturer: Dell <br />
                    Model: Inspiron 1525  <br />
                    CPU: Intel Pentium <br />
                    MHz: 2130 <br />
                    RAM: 4 GB <br />
                </p> -->

                <!-- NOTE: Isn't this a vector for an XSS attack? -->
                <p class="mt-10 p-2" v-html="props.product?.description">
                    
                </p>

            </div>
            
        </div>

        <div class="w-1/3 m-2 flex flex-col rounded-xl bg-white max-h-[22rem] md:max-h-[11rem]">
            <div class="m-2">
                <span class="font-light">{{$t('d.seller')}}: </span>
                <span class="font-bold" v-if="props.seller === null">
                    Brzoskwinka.Net
                </span>

                <span class="font-bold hover:underline" v-else> 
                    <Link :href="'/users/' + props.seller?.id">
                        {{ props.seller?.name }}
                    </Link>
                </span>
            </div>

            <div class="border-t border-b font-bold p-3 md:flex sm:block">
                <div>
                    <h1 class="text-3xl">{{ props.product?.price }} PLN</h1>
                    <p class="font-light">
                        {{ props.product?.units }} 
                        <span v-if="props.product?.units == 1">
                            {{ $t('d.unit') }}
                        </span>
                        <span v-else>
                            {{ $t('d.units') }}
                        </span>
                        {{$t('d.available')}}
                    </p>
                </div>
                <div class="flex items-center mx-auto ">
                    <button @click="addToCart(props.product?.id)" :class="{'bg-green-600 cursor-not-allowed': addedToCart}" class="text-white p-3 rounded-lg bg-[#ff503c] hover:opacity-70 w-40 md:w-56">
                        <span class="flex" v-if="addedToCart">
                            <div>
                                {{ $t('d.added.to.cart') }}
                            </div>
                            <div class="mx-auto">
                                <Check />
                            </div>
                        </span>
                        <span v-else>
                            {{$t('d.add.to.cart')}}
                        </span>
                    </button>
                </div>
            </div>

            <div class="flex p-3 space-x-1">
                <Truck />
                <p>12,99 PLN</p>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    export default {
        layout: GuestLayout
    }
</script>