<script setup lang="ts">
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';
import LangButtons from '@/Components/LangButtons.vue';
import Cart from '@/Components/Cart.vue';
import { LogOut, PlusCircle, UserRound } from 'lucide-vue-next';
import { Head } from '@inertiajs/vue3';


</script>

<template>
    <Head>
        <title>Brzoskwinka.Net</title>
    </Head>
    <div>
        <div class="fixed w-full h-12 text-black space-x-4 justify-end flex border-b-2 bg-white" >
            <LangButtons class="justify-start flex flex-grow pl-2 text-black" />
        
            <div class="scale-125 items-center flex space-x-4 pr-3">
                <div v-if="$page.props.auth.user === null" class=" ">
                    <!-- <PrimaryButton><Link href="/login">{{$t('l.login')}}</Link></PrimaryButton>
                    <PrimaryButton class=""><Link href="/register">{{$t('l.register')}}</Link></PrimaryButton> -->
                    <Link href="/profile"><UserRound /></Link>
                </div>
                <div v-else class="flex items-center space-x-10">
                    <Cart />
                    <!-- <PrimaryButton class=" bg-transparent"><Link href="/products/add">{{$t('l.create.listing')}}</Link></PrimaryButton> -->
                    <!-- <PrimaryButton class=" bg-transparent"><Link href="/logout">{{$t('l.logout')}}</Link></PrimaryButton> -->
                    <Link href="/products/add"><PlusCircle class="hover:stroke-gray-400" /></Link>
                    <Link href="/profile"><UserRound /></Link>
                    <Link href="/logout" class="pr-10"><LogOut class="hover:stroke-gray-400" /></Link>
                </div>
            </div>
        </div>

        <div>
            <slot />
        </div>
    </div>
</template>
