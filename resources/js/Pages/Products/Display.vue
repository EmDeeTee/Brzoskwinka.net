<script setup lang="ts">
import type {Attributes, Product} from '@/types/index'
import {Check, HandCoins, Info, Truck} from 'lucide-vue-next';
import {ref} from 'vue'
import {Link, router, usePage} from '@inertiajs/vue3';
import axios from 'axios';
import {POSITION, TYPE, useToast} from 'vue-toastification';
import InfoBox from "@/Pages/Products/InfoBox.vue";

const page = usePage()
const addedToCart = ref(false)
const toast = useToast();
interface Seller {
    id: Number,
    name: String
}

const props = defineProps<{
    product: Product
    seller: Seller
}>()

const attrs:Attributes = JSON.parse(props.product.attributes)

function addToCart(product_id: number) {
    if (page.props.auth.user !== null && page.props.auth.user.id === props.seller?.id) {
        toast("You can't add your own items to cart", {
            position: POSITION.BOTTOM_CENTER,
            type: TYPE.INFO
        });
        return
    }
    if (page.props.auth.user === null) {
        toast("You have to log in to do this", {
            position: POSITION.BOTTOM_CENTER,
            type: TYPE.ERROR
        });
        router.get('/login')
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

if (page.props.auth.cart !== null && page.props.auth.cart.product_ids.includes(props.product?.id!)) {
    addedToCart.value = true
}

</script>

<template>
    <div class="flex justify-center py-16 flex-col md:flex-row">
        <InfoBox class="w-full md:w-2/3 m-2 rounded-xl bg-white">
            <div class="m-3">
                <div class="flex sm:flex-row flex-col items-center">
                    <h1 class="font-bold text-2xl">{{ props.product?.name }}</h1>
                    <div class="bg-orange-200 p-1 ml-3 rounded-xl" v-if="attrs.hasCertificate == 1">
                        <p class="font-semibold text-center">Expert Recommends</p>
                    </div>
                </div>

                <div class="flex justify-center pt-2">
                    <img :src="props.product?.imgSrc" @click="() => alert(props.product.imgSrc)" class="h-full"/>
                </div>

                <!-- NOTE: Isn't this a vector for an XSS attack? -->
                <p class="mt-10 p-2" v-html="props.product?.description"></p>
            </div>

        </InfoBox>

        <div class="flex flex-col">
            <InfoBox class="w-full m-2 flex flex-col rounded-xl bg-white h-fit">
                <div class="m-2">
                    <span class="font-light">{{$t('d.seller')}}: </span>
                    <span v-tooltip="'This listing was posted by Brzoskwinka.Net'" class="font-bold" v-if="props.seller.id === 0">
                        Brzoskwinka.Net
                    </span>

                    <span class="font-bold hover:underline" v-else>
                        <Link triggers="['hover']" v-tooltip="'Click to see all listings from this user'" :href="'/products/search/' + '!user=' + props.seller?.name">
                            {{ props.seller?.name }}
                        </Link>
                    </span>
                </div>

                <div class="border-t border-b font-bold p-3 flex justify-center">
                    <div class="w-1/3">
                        <h1 class="text-2xl">{{ props.product?.price }} PLN</h1>
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
                    <div class="flex items-center w-2/3">
                        <button @click="addToCart(props.product?.id)" :class="{'bg-green-600 cursor-not-allowed': addedToCart}" class="text-white p-2 rounded-lg bg-[#ff503c] text-xl mx-auto hover:opacity-70 w-9/12">
                            <span class="flex flex-row" v-if="addedToCart">
                                <div>
                                    {{ $t('d.added.to.cart') }}
                                </div>
                                <div class="mt-auto mb-auto ml-auto mr-1">
                                    <Check />
                                </div>
                            </span>
                            <span v-else>
                                {{$t('d.add.to.cart')}}
                            </span>
                        </button>
                    </div>
                </div>

                <div class="flex space-y-2 p-3 flex-col">
                    <div class="justify-center items-center flex space-x-1">
                        <Info :size="20" :stroke-width="1.5" />
                        <p class="text-sm ">
                            The costs below are not included in the price
                        </p>
                    </div>
                    <div class="flex flex-row space-x-1">
                        <Truck triggers="['hover']" v-tooltip="'Shipping cost'" />
                        <p>12.99 PLN</p>
                    </div>
                    <div class="flex flex-row space-x-1">
                        <HandCoins triggers="['hover']" v-tooltip="'Brzoskwinka.Net fee'" />
                        <p>2.00 PLN</p>
                    </div>
                </div>
            </InfoBox>
            <InfoBox v-if="attrs.hasCertificate == 1">
                <h2
                    v-tooltip="'MBSoA is a staple of guaranteed quality and means that this product was manually reviewed by an expert from Brzoskwinka.Net'"
                    class="text-center select-none hover:underline"
                >
                    This product has the <br /> <span  class="font-bold">Maślany Burżuj Seal of Approval</span>
                </h2>
                <hr class="my-2" />
                <div class="flex flex-col mx-auto">
                    <img class="max-w-[200px] " :src="'/seal.webp'" alt="seal of approval">
                </div>
            </InfoBox>
        </div>
    </div>
</template>

<script lang="ts">
    import GuestLayout from "@/Layouts/GuestLayout.vue";

    export default {
        layout: GuestLayout
    }
</script>
