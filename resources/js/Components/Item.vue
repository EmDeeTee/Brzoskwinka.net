<script setup lang="ts">
import { Product } from '@/types/index'
import { Link } from '@inertiajs/vue3';
import {Attributes} from "@/types/index";

const props = defineProps<{
    product: Product
}>()

// FIXME: yo I don't think I get TS JSON types...
const attrs:Attributes = JSON.parse(props.product.attributes as unknown as string)

</script>

<template>
    <div class="text-center pt-4 cursor-pointer hover:underline transition">
        <Link :href="route('products.display', product?.id)">
            <div class="relative">
                <img :src="props.product?.imgSrc" class="pb-3 w-48 h-48"/>
                <img v-if="attrs.hasCertificate == 1" style="position: absolute; width: 50px; top: -10px; right: -20px; transform: rotate(-33deg)" src="/seal.webp" alt="seal of approval">
            </div>
            <span class="text-xl font-bold">
                {{ props.product?.price }} PLN
            </span>
            <h1 class="m-0 p-0">
                {{ props.product?.name }}
            </h1>
        </Link>
    </div>
</template>
