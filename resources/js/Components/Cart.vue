<script setup lang="ts">
import { ShoppingCart } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div>
        <Link href="/cart">
            <div class="hover:animate-spin flex flex-row space-x-1">
                <!-- <span class="flex h-3 w-3 animate-ping absolute rounded-full bg-sky-400 opacity-75"></span> -->
                <ShoppingCart  />
                <span class="">{{ $page.props.auth.cart.product_ids.length }}</span>
            </div>
        </Link>
    </div>
</template>
