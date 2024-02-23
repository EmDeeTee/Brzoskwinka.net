<script setup lang="ts">
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';
import LangButtons from '@/Components/LangButtons.vue';
import Cart from '@/Components/Cart.vue';
import { LogOut, PlusCircle } from 'lucide-vue-next';

</script>

<template>
    <div>
        <div class="fixed w-full h-10 text-black space-x-4 justify-end flex border-b-2" style="background-color: #fff;">
            <LangButtons class="justify-start flex flex-grow pl-2 text-black" />
        

            <div v-if="$page.props.auth.user === null" class="items-center flex space-x-4">
                <PrimaryButton><Link href="/login">{{$t('l.login')}}</Link></PrimaryButton>
                <PrimaryButton class=""><Link href="/register">{{$t('l.register')}}</Link></PrimaryButton>
            </div>
            <span v-else class="flex items-center space-x-10">
                <Cart />
                <!-- <PrimaryButton class=" bg-transparent"><Link href="/products/add">{{$t('l.create.listing')}}</Link></PrimaryButton> -->
                <!-- <PrimaryButton class=" bg-transparent"><Link href="/logout">{{$t('l.logout')}}</Link></PrimaryButton> -->
                <Link href="/products/add"><PlusCircle class="hover:stroke-gray-400" /></Link>
                <Link href="/logout" class="pr-10"><LogOut class="hover:stroke-gray-400" /></Link>
                
            </span>
        </div>

        <div>
            <slot />
        </div>
    </div>
</template>
