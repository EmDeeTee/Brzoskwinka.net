<script setup lang="ts">
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';
import LangButtons from '@/Components/LangButtons.vue';
import Cart from '@/Components/Cart.vue';


</script>

<template>
    <div>
        <div class="fixed w-full h-10 text-white space-x-4 justify-end flex" style="background-color: #241e1e;">
            <LangButtons class="justify-start flex flex-grow pl-2" />
        

            <div v-if="!$page.props.auth ? true : false">
                <PrimaryButton class="mt-1 mb-1 bg-transparent"><Link href="/login">{{$t('l.login')}}</Link></PrimaryButton>
                <PrimaryButton class="mt-1 mb-1 bg-transparent"><Link href="/register">{{$t('l.register')}}</Link></PrimaryButton>
            </div>

            <div v-else>
                <span class="flex items-center space-x-2">
                    <Cart />
                    <PrimaryButton class=" bg-transparent"><Link href="/products/add">{{$t('l.create.listing')}}</Link></PrimaryButton>
                    <PrimaryButton class=" bg-transparent"><Link href="/logout">{{$t('l.logout')}}</Link></PrimaryButton>
                </span>
            </div>
        </div>

        <div>
            <slot />
        </div>
    </div>
</template>
